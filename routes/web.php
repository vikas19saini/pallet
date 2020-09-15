<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeCtrl@index');

    Route::get('/email/verify/token', 'ProfileCtrl@verifyEmail');


    Route::get('about-us', 'Other\StaticPagesCtrl@aboutus');

    Route::get('shipping-and-returns', 'Other\StaticPagesCtrl@shippingAndReturns');
    Route::get('faqs', 'Other\StaticPagesCtrl@faqs');
    Route::get('privacy-policy', 'Other\StaticPagesCtrl@privacyPolicy');
    Route::get('cookie-policy', 'Other\StaticPagesCtrl@cookiePolicy');
    Route::get('terms-and-conditions', 'Other\StaticPagesCtrl@termsAndConditions');
    Route::get('contact', 'Other\StaticPagesCtrl@contact');
    Route::post('contact', 'Other\StaticPagesCtrl@contact');
    Route::get('livebrowsing', 'Other\StaticPagesCtrl@livebrowsing');
    Route::post('livebrowsing', 'Other\StaticPagesCtrl@livebrowsing');


    Route::group(['middleware' => 'auth'], function () {

        // After login route 
        Route::get('/home', 'ProductCtrl@home');

        Route::get('user/address/new', 'ProfileCtrl@showAddAddress');
        Route::post('user/address', 'ProfileCtrl@addAddress');

        //Route::post('user/address','ProfileCtrl@saveMyaccount');
        Route::get('user/address', 'ProfileCtrl@listAddresses');
        Route::get('user/preferences', 'ProfileCtrl@show_preferences');
        Route::get('user/address/{id}', 'ProfileCtrl@editAddress');
        Route::post('user/address/{id}', 'ProfileCtrl@updateAddress');
        Route::post('ajax/user/address/{id}/delete', 'ProfileCtrl@deleteAddress');


        Route::get('user/order/{type?}', 'NewOrderCtrl@viewByType')->where('type', 'sample|production');
        Route::get('user/contact-form', 'ProfileCtrl@showContactForm');
        Route::post('user/contact-form', 'ProfileCtrl@saveMyaccount');

        Route::post('ajax/cart/{id}/delete', 'CartCtrl@delete');

        // Route::get('cart','CartCtrl@index'); old cart 
        // Route::get('cart-new','NewCartCtrl@show_cart');  // new cart where old cart was moved 

        Route::get('cart', 'NewCartCtrl@show_cart');
        Route::get('cart/address', 'NewCartCtrl@address');
        Route::post('cart/select_address', 'NewCartCtrl@selectAddress');
        Route::get('cart/confirm', 'NewCartCtrl@confirm');


        Route::get('checkout', 'NewCartCtrl@checkout');

        Route::post('product/customization', 'ProductCtrl@customization');


        Route::get('/my-account', 'NewOrderCtrl@viewByType');
        Route::post('/my-account', 'ProfileCtrl@saveMyaccount');

        Route::get('address/new', 'OrderCtrl@addViewAddress');
        Route::post('address/new', 'OrderCtrl@saveMyAddress');
        Route::post('address/remove', 'OrderCtrl@removeAddress');


        Route::get('confirm', 'OrderCtrl@placeOrder');
        Route::post('confirm', 'OrderCtrl@confirmPlaceOrder');
        Route::get('confirm1', 'OrderCtrl@confirmPlaceOrder');

        Route::get('address', 'OrderCtrl@address');
        Route::post('address', 'OrderCtrl@saveAddress');

        Route::get('products', 'ProductCtrl@index');
        Route::post('ajax/product/{id}/wishlist', 'ProductCtrl@actionWishlist');
        Route::get('product/{title}/{id}', 'ProductCtrl@show');
        Route::post('product/{title}/{id}', 'ProductCtrl@submit');

        Route::get('p/{slug}', function ($slug) {
            return redirect($slug . "/p");
        });
        Route::post('{slug}/p', 'ProductCtrl@submitBySlug');
        Route::get('{slug}/p', 'ProductCtrl@showBySlug');
        // Route::post('{slug}/p','ProductCtrl@submitBySlug'); 


        // Save more quantity enquiry

        Route::post('save_more_quantity_request', 'ProductCtrl@save_more_quantity_request');

        Route::get('order/{type}/{orderId}', 'OrderCtrl@viewOrder');

        Route::get('c/{cat}', function ($slug) {
            return redirect($slug . "/c");
        });
        Route::get('{cat}/c', 'ProductCtrl@searchCategory');


        Route::post('ajax/country/{id}/state', 'ProfileCtrl@showStateByCountry');
        Route::post('/ajax/product/{id}/favourites', 'ProductCtrl@addToFavouries');

        Route::post('/ajax/cart/new', 'NewCartCtrl@addItemToCart');
        Route::post('/ajax/cart/check_delivery', 'NewCartCtrl@checkDelivery');

        Route::get('/order', 'NewOrderCtrl@index');
        Route::get('/order/{id}', 'NewOrderCtrl@show');
        // Route::get('{name}','ProductCtrl@category')->where('name','scarves|kaftans|parios|bandanas|footas');
    });
});


Route::group(['prefix' => "admin", "namespace" => "Admin", 'middleware' => 'auth'], function () {

    Route::post('/ajax/product/{id}/color', 'ProductCtrl@addColor');
    Route::post('/ajax/product/{id}/color/{colorId}/delete', 'ProductCtrl@deleteColor');
    Route::get('/ajax/media/search', 'MediaCtrl@search');

    Route::get('/payments', 'PaymentCtrl@index');

    Route::get('/', 'DashboardCtrl@index')->name('index');

    Route::get('/home', 'DashboardCtrl@index')->name('home');
    Route::get('/products', 'ProductCtrl@index')->name('admin.product.list');
    Route::get('/products/add', 'ProductCtrl@add')->name('admin.product.add');
    Route::get('/products/{id}', 'ProductCtrl@edit')->name('admin.product.edit');
    Route::post('/products/{id}', 'ProductCtrl@update')->name('admin.product.update')->where('id', '\d+');
    Route::post('/products/add', 'ProductCtrl@store')->name('admin.product.store');

    Route::get('orders/{type}', 'OrderCtrl@index')->where('type', 'sample|production');
    Route::get('orders/{type}/{id}', 'OrderCtrl@show')->where('type', 'sample|production');


    Route::get('product-categories', 'ProductCategoriesCtrl@index');
    Route::get('product-categories/add', 'ProductCategoriesCtrl@add');
    Route::post('product-categories/add', 'ProductCategoriesCtrl@create');
    Route::get('product-categories/{id}', 'ProductCategoriesCtrl@edit')->where('id', '\d+');
    Route::post('product-categories/{id}', 'ProductCategoriesCtrl@update');

    Route::get('users', 'UserCtrl@index');
    Route::get('address', 'UserCtrl@viewAddress');


    Route::get('media/upload', 'MediaCtrl@index');
    Route::get('media/upload/add', 'MediaCtrl@add');
    Route::post('media/upload/add', 'MediaCtrl@create');


    Route::get('media/upload/{id}', 'MediaCtrl@edit');
    Route::post('media/upload/{id}', 'MediaCtrl@update');
    Route::post('/ajax/media/{id}/delete', 'MediaCtrl@delete');
    Route::post('/ajax/currencies/{id}/delete', 'CurrencyCtrl@delete');


    Route::get('currencies', 'CurrencyCtrl@index');
    Route::get('currencies/add', 'CurrencyCtrl@add');
    Route::post('currencies/add', 'CurrencyCtrl@create');
    Route::get('currencies/{id}', 'CurrencyCtrl@edit');
    Route::post('currencies/{id}', 'CurrencyCtrl@update');

    Route::get('fabrics', 'FabricCtrl@index');
    Route::get('fabrics/add', 'FabricCtrl@add');
    Route::post('fabrics', 'FabricCtrl@create');
    Route::get('fabrics/{id}', 'FabricCtrl@edit');
    Route::post('fabrics/{id}', 'FabricCtrl@update');
});

Route::get('test/mail', 'TestCtrl@test_mail');
/*function(){
    $user = App\User::find(1);
    $email_token = App\Http\Controllers\ProfileCtrl::addVerifyToken($user);
    // dd($email_token);
    return view('emails.verify-registration')->with('email_token',"email_token");
    Illuminate\Support\Facades\Event::fire( new App\Events\EventSendMail($user,['email_token'=>$email_token],'register.send') );
}); */


Route::get('upload/excel/test', 'Other\ExcelCtrl@show_test');
Route::post('upload/excel/test', 'Other\ExcelCtrl@test');


// route for processing payment
// Route::get('paypal', 'Payments\PaypalCtrl@index');
// Route::post('paypal', 'Payments\PaypalCtrl@payWithpaypal');

// route for check status of the payment
// Route::get('paypal/status', 'Payments\PaypalCtrl@getPaymentStatus'); // old one 
Route::get('paypal/status', 'NewCartCtrl@verifyCallbackPayment');
