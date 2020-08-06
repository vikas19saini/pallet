<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Auth;

class CartCtrl extends Controller {

    public function index() {
        $data['cartList'] = Cart::with('product')->where('user_id', Auth::id())->paginate();
        return view('pages.cart')->with($data);
    }

    public function delete(Request $request, $cartId) {
        $cart = Cart::find($cartId);

        if ($cart && $cart->user_id == Auth::id()) {
            $cart->delete();
            return response()->json([
                        'status' => true,
                        'message' => "Record Deleted Successfully"
            ]);
        }

        return response()->json([
                    'status' => false,
                    'message' => "Unable to delete record"
        ]);
    }
}
