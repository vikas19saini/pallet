<?php

namespace App\Http\Controllers;

use Auth;

use App\Models\Products;

class HomeCtrl extends Controller {

    public function home() {
        $products = \Illuminate\Support\Facades\DB::table('products')->limit(20)->get();
        return view('pages.home')->with('products', $products);
    }

    public function index() {
        if (Auth::check()) {
            return redirect('home');
        }
        return view('account.login');
    }

}
