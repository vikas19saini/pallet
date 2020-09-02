<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use App\Models\Wishlist;
use App\Models\ProductionOrders;
use App\Models\SampleOrders;
use App\Models\Countries;
use App\Models\States;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\EmailConfirmation;
use App\User;

class ProfileCtrl extends Controller {

    public function myaccount() {
        $data['sampleOrders'] = SampleOrders::with('product')->where('user_id', Auth::id())->paginate();
        $data['productionOrders'] = ProductionOrders::with('product')->where('user_id', Auth::id())->paginate();
        $data['addresses'] = Addresses::where('user_id', Auth::id())->paginate();

        $data['preferences'] = Wishlist::where('user_id', Auth::id())->orderBy('id', 'desc')->limit(20)->get();

        $prod_overview = ProductionOrders::with('product')->where('user_id', Auth::id())->select(DB::raw("'production' as type"), "id", "user_id", "product_id", "amount", "quantity", "address_id", "size", "cancelled_on", "status", "created_at", "updated_at", "payment_id");
        $sample_overview = SampleOrders::with('product')->where('user_id', Auth::id())->select(DB::raw("'sample' as type"), "id", "user_id", "product_id", "amount", "quantity", "address_id", "size", "cancelled_on", "status", "created_at", "updated_at", "payment_id");

        $data['overview'] = $prod_overview->union($sample_overview)->orderBy('id', 'desc')->limit(5)->get();

        return view('pages.my-account')->with($data);
    }

    public function show_preferences() {
        $data['preferences'] = Wishlist::with('product')->where('user_id', Auth::id())->orderBy('id', 'desc')->limit(20)->get();
        return view('pages.preferences')->with($data);
    }

    public function showContactForm(Request $request) {
        return view('pages.contact-form');
    }

    public function saveMyaccount(Request $request) {
        $type = $request->post('type');
        if ($type == "contact_form") {
            $user = Auth::user();
            $user->mobile = $request->post('mobile');
            $user->alternative_mobile = $request->post('alternate_mobile');
//            $user->gender = $request->post('gender') == "male" ? "MALE" : 'FEMALE';
            $user->save();
        }

        return redirect()->back();
    }

    public function listAddresses() {
        $addressList = Addresses::where('user_id', Auth::id())->get();
        return view('pages.address-leftsidebar')->with('addressList', $addressList);
    }

    public function editAddress(Request $request, $id) {
        $data['address'] = Addresses::find($id);
        if (!$data['address'] || $data['address']->user_id != Auth::id())
            abort(404);

        $data['countries'] = Countries::all();

        return view('pages.user-address-edit')->with($data);
    }

    public function showAddAddress() {
        $data['countries'] = Countries::all();
        return view('pages.user-address-add')->with($data);
    }

    public function addAddress(Request $request) {
        $address = new Addresses();
        $address->user_id = $request->user()->id;
        $address->name = $request->post('name');
        $address->address = $request->post('address');
        $address->city = $request->post('city');
        $address->zipcode = $request->post('zipcode');
        $address->country = $request->post('country');
        $address->state = $request->post('state');
        $address->contact_no = $request->post('contact_no');

        $address->save();

        return redirect('user/address');
    }

    public function updateAddress(Request $request, $id) {

        $data['address'] = Addresses::find($id);
        if (!$data['address'] || $data['address']->user_id != Auth::id())
            abort(404);


        $data['address']->salution = $request->post('gender') == "male" ? "MALE" : "FEMALE";

        $fields = ['address', 'name', 'city', 'state', 'country', 'zipcode'];
        foreach ($fields as $field) {
            $data['address']->{$field} = $request->post($field);
        }

        $data['address']->save();
        return redirect('user/address');
    }

    public function deleteAddress($id) {
        $address = Addresses::find($id);
        if (!$address || $address->user_id != Auth::id())
            return response()->json([
                        'status' => false,
                        'message' => "Unable to deleted Media"
            ]);


        $address->delete();
        return response()->json([
                    'status' => true
        ]);
    }

    public function showStateByCountry($country_id) {
        $states = States::where('country_id', $country_id)->get();

        return response()->json([
                    'status' => true,
                    'data' => $states
        ]);
    }

    public static function addVerifyToken($user) {
        $email_token = bcrypt(time() . str_random(12));

        $emailConfirmation = new EmailConfirmation();
        $emailConfirmation->user_id = $user->id;
        $emailConfirmation->email = $user->email;
        $emailConfirmation->token = $email_token;
        $emailConfirmation->save();

        return $email_token;
    }

    public function verifyEmail(Request $request) {
        $token = $request->token;
        $email_conf = EmailConfirmation::where('token', $token)->first();

        if (!$email_conf) {
            return redirect('/')->with('message', "Invalid access token");
        }

        $user = User::find($email_conf->user_id);
        if ($user && $user->email_verified != 1) {
            $user->email_verified = 1;
            $user->save();
            return redirect('/login')->with('message', 'Email address verified');
        }

        return redirect('/')->with('message', "Invalid access token");
    }

}
