<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Addresses;
use App\Models\Countries;
use App\Models\Products;
use App\Models\NewPayment;
use App\Models\NewPaymentProducts;
use Illuminate\Http\Request;
use Auth;
use Log;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class * */

use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;


class NewCartCtrl extends Controller
{

    private $_api_context;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** PayPal api context * */
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret']
        ));

        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function addItemToCart(Request $request)
    {

        $exist = Cart::where('product_id', $request->post('product_id'))->where('user_id', Auth::id())->first();
        if ($exist)
            return [
                'status' => true,
                'message' => "Item Already exist in cart",
                'data' => []
            ];

        $cart = new Cart;
        $type = $request->post('type');
        $amount = floatval($request->post('amount'));
        $fabric_id = intval($request->post('fabric_id'));
        $quantity = intval($request->post('quantity'));
        $discount = intval($request->post('discount'));
        $production_quantity = intval($request->post('production_quantity'));

        if (!in_array($type, ['production', 'sample'])) {
            response()->json(['status' => false, 'message' => 'Order type not matched', 'data' => []]);
        }

        $product = Products::with('product_has_fabrics')->find($request->post('product_id'));

        if (!$product)
            return response()->json(['status' => false, 'message' => 'Product not found', 'data' => []]);

        // check if fabric exist 
        $check_fabric = $product->getDiscountedPrice($type, $fabric_id, $quantity, $production_quantity, $discount);
        if ($check_fabric['status'] === false)
            return ['status' => false, 'message' => $check_fabric['message'], 'data' => []];

        // $cartRepsonse = $product->getDiscountedPrice($type,$fabric_id,$quantity,$production_quantity);
        $cart = new Cart;
        $cart->product_id = $product->id;
        $cart->user_id = Auth::id();
        $cart->amount = $check_fabric['amount'];
        $cart->fabric_id = $fabric_id;
        $cart->order_type = strtoupper($type);
        $cart->discount = $discount;
        $cart->quantity = $cart->order_type == "SAMPLE" ? $quantity : $production_quantity;
        $cart->save();

        //return ['status' => 'true', 'message' => "Item added to cart", 'data' => []];

        // return [$product, $product->product_has_fabrics->where('fabric_id',$fabric_id)->first(),$request->all()]; 
    }

    public function show_cart(Request $request)
    {
        $data['cartItems'] = Cart::with('product')->with('fabrics')->where('user_id', Auth::id())->get();
        return view('pages.cart-new')->with($data);
    }

    public function address()
    {
        $addressList = Addresses::where('user_id', Auth::id())->get();
        $countries = Countries::all();
        return view('pages.address')->with('addressList', $addressList)->with('countries', $countries);
    }

    public function checkout(Request $request)
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();

        // prepare carts fields  

        $preparedCart = self::prepareCartForPayment($cart, $request->session()->get('shipping_cost'));

        // create payment object for payment init 
        return self::createPaymentObject($cart, $preparedCart);

        // all goes well initiate payment.
        // save response  
    }

    public function selectAddress(Request $request)
    {
        \Illuminate\Support\Facades\DB::table('cart')->where('user_id', $request->user()->id)->update(['address_id' => $request->post('address')]);

        return redirect('cart/confirm');
    }

    public function confirm(Request $request)
    {
        error_reporting(0);
        $data['cartItems'] = Cart::with('product')->with('address')->where('user_id', Auth::id())->get();
        
        $data['shipping'] = Cart::calc_shipping($data['cartItems']);

        if (!array_key_exists('DeliveryCharges', $data['shipping'])) {
            return redirect('cart');
        }

        $request->session()->put('shipping_cost', $data['shipping']['DeliveryCharges']);

        return view('pages.place-order')->with($data);
    }

    public function checkDelivery(Request $request)
    {
        $isoCode2 = $request->post('iso_code_2');
        $postCode = $request->post('postcode');
        $productId = $request->post('product_id');
        $product = Products::where('id', $productId)->first();
        $item = [
            'quantity' => 3,
            'product' => $product
        ];
        $res = Cart::calc_shipping([(object)$item], $isoCode2, $postCode);
        return response()->json($res);
    }

    public static function prepareCartForPayment($cart, $shipping_cost)
    {
        if (count($cart) == 0) {
            return [];
        }

        $user_id = $cart[0]->user_id;

        $payment_obj = new NewPayment;
        $payment_obj->user_id = $user_id;
        $payment_obj->payment_provider_id = 1;
        $payment_obj->item_count = count($cart);
        $payment_obj->currency = 'USD';

        $productItems = [];
        $amount = 0;
        foreach ($cart as $item) {
            $productItem = new NewPaymentProducts;
            $productItem->product_id = $item->product_id;
            $productItem->actual_amount = floatval($item->amount);
            $productItem->effective_amount = floatval($item->amount);
            $productItem->quantity = $item->quantity;
            $productItem->fabric_id = $item->fabric_id;
            $productItem->order_type = $item->order_type;  // ['SAMPLE','PRODUCTION'] 
            array_push($productItems, $productItem);
            $amount += $item->amount;
        }

        $payment_obj->products_amount = floatval($amount);
        $payment_obj->shipping_amount = $shipping_cost;
        $payment_obj->total_amount = $payment_obj->shipping_amount + $payment_obj->products_amount;
        $payment_obj->total_amount = floatval($payment_obj->total_amount);

        return [
            'payment_obj' => $payment_obj,
            'payment_products' => $productItems
        ];
    }

    public function createPaymentObject($cart, $preparedCart)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal'); // payment_obj->payment_provider

        $items = [];
        foreach ($cart as $cart_item) {
            $item_1 = new Item();
            $item_1->setName($cart_item->product->title)
                /** item name * */
                ->setCurrency($preparedCart['payment_obj']->currency)
                ->setQuantity($cart_item->quantity)
                ->setPrice($cart_item->amount);
            /** unit price * */
            array_push($items, $item_1);
        }

        $item_list = new ItemList();
        //$item_list->setItems([]);
        $item_list->setItems($items);

        $amount = new Amount();
        $amount->setCurrency($preparedCart['payment_obj']->currency)
            ->setTotal($preparedCart['payment_obj']->total_amount);


        $transaction = new Transaction();
        $transaction->setAmount($amount);

        //print_r($transaction);exit();

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('paypal/status'))
            /** Specify return URL * */
            ->setCancelUrl(URL::to('paypal/status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
            $preparedCart['payment_obj']->payment_gateway_id = $payment->getToken();
            //https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=EC-7HE52166L5895012M 
            $preparedCart['payment_obj']->save();

            foreach ($preparedCart['payment_products'] as $item) {
                $item->new_payment_id = $preparedCart['payment_obj']->id;
                $item->save();
            }
        } catch (\PayPal\xception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session * */
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('paypal_payment_token', $payment->getToken());

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/my-account');
    }

    public function verifyCallbackPayment()
    {
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID * */
        Session::forget('paypal_payment_id');

        // $payment_id = "PAYID-LWYYWKQ4Y990891SM761833J"; 

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::to('/');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /*         * Execute the payment * */
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success');
            $new_payment_object = self::paymentVerifyForToken(Input::get('token'), $payment_id);
            if ($new_payment_object) {
                $orderCtrl = new NewOrderCtrl;
                $orderCtrl->confirmPlaceOrderAfterPayment($new_payment_object);
                return redirect('user/order');
            }

            return Redirect::to('/');
        }

        \Session::put('error', 'Payment failed');
        return Redirect::to('/');
    }

    public static function paymentVerifyForToken($token, $payment_id)
    {
        $paymentInit = NewPayment::where('payment_gateway_id', $token)->first();

        if (!$paymentInit || $paymentInit->payment_status == "PLACED")
            return false;

        $paymentInit->payment_status = 'PLACED';
        $paymentInit->payment_gateway_id = $payment_id;
        $paymentInit->save();
        return $paymentInit;
    }
}
