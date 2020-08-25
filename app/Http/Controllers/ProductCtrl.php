<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\ProductCategories;
use App\Models\Products;
use Carbon\Carbon;
use Auth;
use App\Models\Fabrics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Event;
use App\Events\EventSendMail;
use App\Models\Countries;

class ProductCtrl extends Controller
{

    public static function relatedItems($catId)
    {
        $products = Products::with('image_primary')->where('status', 'LISTED');

        if ($catId)
            $products = $products->where('product_category_id', $catId);

        return $products->inRandomOrder()->limit(3)->get();
    }

    public static function getAllFabrics()
    {
        return Fabrics::all();
    }

    public static function home(Request $request)
    {
        $data['categories'] = ProductCategories::where(['status' => 'ACTIVE'])->get();
        if (!$data['categories'])
            return redirect()->back()->with('message', "Category not found");

        $data['products'] = self::getPaginatedProductReuslt($request);

        $data['meta'] = [
            'title' => "All products",
            'keywords' => "All products",
            'description' => "All products",
        ];

        $data['fabrics'] = self::getAllFabrics();
        return view('pages.all-products')->with($data);
    }

    public static function getPaginatedProductReuslt($request, $whereCondition = [])
    {
        $products = Products::with('image_primary')->with('category')->where('status', 'LISTED');

        if (!empty($whereCondition)) {
            $products = $products->where($whereCondition);
        }

        if ($request->get('filter_sort')) {

            if (in_array($request->get('filter_sort'), ['price_asc', 'price_desc'])) {
                if ($request->get('filter_sort') == "price_asc") {
                    $products = $products->orderBy('amount', 'ASC');
                } else {
                    $products = $products->orderBy('amount', 'DESC');
                }
            }

            if (in_array($request->get('filter_sort'), ['latest', 'oldest'])) {
                if ($request->get('filter_sort') == "latest") {
                    $products = $products->orderBy('id', 'ASC');
                } else {
                    $products = $products->orderBy('id', 'DESC');
                }
            }
        }

        return $products->distinct('id')->paginate();
    }

    public function myaccount()
    {
        return view('pages.my-account');
    }

    public function index(Request $request)
    {
        $data['products'] = self::getPaginatedProductReuslt($request, []);
        $data['fabrics'] = self::getAllFabrics();

        return view('pages.products')->with($data);
    }

    public function showBySlug($slug)
    {
        $product = Products::where('slug', $slug)->first();
        if ($product) {
            return $this->show($product->title, $product->id);
        } else {
            $data = ['message' => 'Product Not Available', 'status' => false, 'product' => null];
            return view('pages.product')->with($data);
        }

        return redirect()->back()->with('message', 'Product Not Available');
    }

    public function show($str, $id)
    {
        $product = Products::with('category', 'image_primary', 'productColors', 'product_has_fabrics')->find($id);
        // $product->description = "A classic striped pattern that enriches the crew-neck sweater is created by alternating cotton and bouclé yarns in contrast colors which create a slightly voluminous effect. The Garza technique of the cotton yarn, lightweight and compact at the same time, gives the garment a balanced weight, ideal to wear in the spring.";
        // $product->status = 'LISTED'; $product->save(); 

        $data = [];
        if ($product->other_images) {
            $exploded = explode(",", $product->other_images);
            if (count($exploded) > 1 && !is_numeric($exploded[0])) {
                $data['productImages'] = $exploded;
            } else {
                $data['productImages'] = Media::whereRaw('id in (' . $product->other_images . ' ) ')->get();
            }
        } else
            $data['productImages'] = [];

        $data['product'] = $product;
        $data['meta'] = [
            'title' => $product->meta_title,
            'keywords' => $product->meta_keywords,
            'description' => $product->meta_description,
        ];

        $data['fabricPrices'] = [];
        foreach ($data['product']->product_has_fabrics as $item) {
            $data['fabricPrices'][] = ['fabric_id' => $item->fabric_id, 'fabric' => $item->fabric->name, 'amount' => $item->amount];
        }

        $data['countries'] = Countries::all();

        return view('pages.product')->with($data);
    }

    public function category(Request $request, $name)
    {
        $data['categories'] = ProductCategories::where(['status' => 'ACTIVE'])->get();
        $data['category'] = ProductCategories::where('slug', $name)->first();
        if (!$data['category'])
            return redirect()->back()->with('message', "Category not found");

        $data['products'] = self::getPaginatedProductReuslt($request, ['product_category_id' => $data['category']->id]);

        $data['meta'] = [
            'title' => $data['category']->meta_title,
            'keywords' => $data['category']->meta_keywords,
            'description' => $data['category']->meta_description,
        ];

        $data['fabrics'] = self::getAllFabrics();
        return view('pages.products')->with($data);
    }

    public function searchCategory(Request $request, $name)
    {
        return $this->category($request, $name);
    }

    public function submitBySlug(Request $request, $slug)
    {
        $product = Products::where('slug', $slug)->first();
        if ($product) {
            return $this->submit($request, $product->title, $product->id);
        }
    }

    public function submit(Request $request, $str, $id)
    {
        $amount = $request->post('amount');
        $quantity = $request->post('quantity');
        $size = $request->post('size');
        $productionQuantity = $request->post('production_quantity');
        $type = $request->post('type');
        $fabric_id = $request->post('fabric_id');

        $product = Products::find($id);

        return $request->all();
        if (!$product || !$product->product_has_fabrics()->where('fabric_id', $fabric_id)->first()) {
            return redirect()->back()->with('message', 'Invalid operation : Fabric not allowed');
        }

        if ($product->status != "LISTED") {
            return redirect()->back()->with('message', "Product not allowed to sell");
        }

        $fabric = $product->product_has_fabrics()->where('fabric_id', $fabric_id)->first();

        if ($type != "sample") {
            $quantity = $productionQuantity;
            if ($quantity < $product->range_start) {
                $final_discount = 0;
            } else if ($quantity == $product->range_start) {
                $final_discount = $product->start_percentage;
            } else if ($quantity >= $product->range_end) {
                $final_discount = $product->end_percentage;
            } else {
                $range_percentage = $product->end_percentage - $product->start_percentage;
                $range_divider = $product->range_end - $product->range_start;
                $final_discount = ($quantity - $product->range_start) * $product->range_percentage / $range_divider;
            }

            $amt = $product->amount * $fabric->amount; // multiplier factor 
            $amount = $amt * (100 - $final_discount) / 100;
        }

        if (!is_numeric($amount) || !is_numeric($quantity)) {
            return redirect()->back()->with('message', 'Quantity & Amount');
        }

        if (!in_array($size, ["S", "M", "L", "XL"])) {
            return redirect()->back()->with('message', 'Invalid Size');
        }

        $timestamp = time();
        Session::put('product', [
            'quantity' => $quantity,
            'amount' => $amount,
            'size' => $size,
            'time' => $timestamp,
            'type' => $type,
            'product_id' => $id,
            'customization' => $type == "sample" ? $request->post('form_customization') : ''
        ]);

        return redirect('address?tid=' . $timestamp);
    }

    public function actionWishlist(Request $request, $productId)
    {
        $product = Products::find($productId);
        if (!$product) {
            return response()->json([
                'status' => false,
                "message" => "Product Not Found"
            ]);
        }

        $userId = Auth::id();
        $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();

        if (!$wishlist) {
            $wishlist = new Wishlist;
            $wishlist->user_id = $userId;
            $wishlist->product_id = $productId;
            $wishlist->save();
            $message = "Added to wishlist";
        } else {
            $message = "Removed from wishlist";
            $wishlist->delete();
        }

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function addToFavouries($productId)
    {
        $product = Products::find($productId);

        if ($product && $product->status == "LISTED") {
            Cart::where('user_id', Auth::id())->where('product_id', $productId)->delete();

            $cart = new Cart;
            $cart->user_id = Auth::id();
            $cart->product_id = $productId;
            $cart->save();

            return response()->json(['status' => true, 'message' => "Product added successfully"]);
        }

        return response()->json(['status' => false, 'message' => "Product not available"]);


        return $product;
    }

    public function addToCart($productId)
    {
    }

    public function save_more_quantity_request(Request $request)
    {

        $enquiry = [
            'user_id' => Auth::user()->id,
            'product_id' => $request->post('product_id'),
            'product_name' => $request->post('product_name'),
            'quantity' => $request->post('quantity'),
        ];

        \Illuminate\Support\Facades\DB::table('quantity_enquiries')->insert($enquiry);

        Session::flash('message', 'We have received your details.');

        Event::fire(new EventSendMail(Auth::user(), $enquiry, 'product.enquiry'));
        Event::fire(new EventSendMail(Auth::user(), $enquiry, 'product.enquiry.admin'));

        return redirect($request->post('redirect') . '/p');
    }

    public function customization(Request $request)
    {

        $postedData = [
            'note' => $request->post('note'),
            'fabric_customize' => $request->post('fabric_customize'),
            'print_customize' => $request->post('print_customize'),
            'size_customize' => $request->post('size_customize'),
            'product_id' => $request->post('product_id'),
        ];

        if ($request->file('image') !== null) {
            $allowedfileExtension = ['jpeg', 'jpg', 'png'];
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, $allowedfileExtension)) {
                $name = "m-" . str_random(3) . "-" . time() . "." . $extension;
                $file->storeAs('public/product-customize', $name);
                $postedData['image'] = "product-customize/" . $name;
            } else {
                Session::flash('message', 'Invalid image type.');
                return redirect($request->post('redirect') . '/p');
            }
        }

        if (\Illuminate\Support\Facades\DB::table('product_customization')->insert($postedData)) {
            Session::flash('message', 'Thanks for your details our team shall work out the best prices & revert soon.');
        } else {
            Session::flash('message', 'Oops, something went wrong, please try again.');
        }

        return redirect($request->post('redirect') . '/p');
    }
}
