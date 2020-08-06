<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;

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



}
