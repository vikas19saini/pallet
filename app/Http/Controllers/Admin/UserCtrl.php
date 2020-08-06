<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\ProductCategories;
use App\Models\ProductImages;
use App\Models\Products;
use App\User;
use Illuminate\Http\Request;

class UserCtrl extends Controller
{

    public function index(Request $request)
    {
        $users = User::paginate(10);
        return view('admin.users.list')->with('users',$users);
    }

    public function viewAddress(Request $request)
    {
        $addresses = Addresses::with('user')->paginate();
        return view('admin.addresses.list')->with('addresses',$addresses);
    }

}
