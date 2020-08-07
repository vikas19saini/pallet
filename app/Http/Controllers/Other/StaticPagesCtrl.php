<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaticPagesCtrl extends Controller
{
    public function aboutus()
    {
        return view('static-pages.about-us');
    }

    public function shippingAndReturns()
    {
        return view('static-pages.shipping-and-returns');
    }

    public function faqs()
    {
        return view('static-pages.faqs');
    }

    public function privacyPolicy()
    {
        return view('static-pages.privacy-policy');
    }

    public function termsAndConditions()
    {
        return view('static-pages.terms');
    }

    public function cookiePolicy()
    {
        return view('static-pages.cookies-policy');
    }

    public function contact(Request $request)
    {

        if ($request->method() === "POST") {
            $postedData = $request->except(['_token', '__geo_ip__']);

            if ($request->file('image') !== null) {
                $allowedfileExtension = ['jpeg', 'jpg', 'png'];
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();

                if (in_array($extension, $allowedfileExtension)) {
                    $name = "m-" . str_random(3) . "-" . time() . "." . $extension;
                    $file->storeAs('public/contact_files', $name);
                    $postedData['image'] = "contact_files/" . $name;
                } else {
                    Session::flash('message', 'Invalid image type.');
                }
            }

            if (\Illuminate\Support\Facades\DB::table('contact')->insert($postedData)) {
                Session::flash('message', 'Thanks for your details, We’ll get back to you within 24 hours.');
            } else {
                Session::flash('message', 'Oops, something went wrong, please try again.');
            }
        }

        return view('static-pages.contact');
    }

    public function livebrowsing(Request $request)
    {

        if ($request->method() === "POST") {
            $postedData = $request->except(['_token', '__geo_ip__']);

            if ($request->file('image') !== null) {
                $allowedfileExtension = ['jpeg', 'jpg', 'png'];
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();

                if (in_array($extension, $allowedfileExtension)) {
                    $name = "m-" . str_random(3) . "-" . time() . "." . $extension;
                    $file->storeAs('public/livebrowsing', $name);
                    $postedData['image'] = "livebrowsing/" . $name;
                } else {
                    Session::flash('message', 'Invalid image type.');
                }
            }

            if (isset($postedData['tool']) && !empty($postedData['tool'])) {
                $postedData['tool'] = implode(", ", $postedData['tool']);
                if (\Illuminate\Support\Facades\DB::table('livebrowsing')->insert($postedData)) {
                    Session::flash('message', 'Thanks for your details, We’ll get back to you within 24 hours.');
                } else {
                    Session::flash('message', 'Oops, something went wrong, please try again.');
                }
            } else {
                Session::flash('message', 'Please choose browsing tool.');
            }
        }

        return view('static-pages.livebrowsing');
    }
}
