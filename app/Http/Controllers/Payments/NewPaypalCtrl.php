<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
/** All Paypal Details class **/
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

use Log;
use Auth;
use App\Models\Products; 
use App\Models\PaymentInit; 
use App\User;
use App\Http\Controllers\OrderCtrl; 

class NewPaypalCtrl extends Controller
{

    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    public static function prepareFieldsForPayment($product,$fields)
    {
        $product = Products::first(); 

        return [
            'amount' => $fields['amount'],
            'total' => $fields['amount'],
            'quantity' => $fields['quantity'],
            'payment_provider' => 'paypal',
            'payment_provider_id' => 1,
            'product' => $product,
            'currency' => 'USD',
            'shipping' => 0,
            'tax' => 0,
            'size' => $fields['size']
        ];
    }

    public static function savePaymentInDatabase($paymentFieldsArray)
    {
        $paymentInit = new PaymentInit; 
        $paymentInit->user_id  = Auth::id() ? Auth::id() : User::first()->id; 

        $paymentInit->payment_provider_id = $paymentFieldsArray['payment_provider_id']; 

        $paymentInit->tid = ''; 

        $paymentInit->total_amount = $paymentFieldsArray['total']; 
        $paymentInit->tax = $paymentFieldsArray['tax']; 
        $paymentInit->shipping = $paymentFieldsArray['shipping']; 

        $paymentInit->currency = $paymentFieldsArray['currency']; 
        $paymentInit->cart_id = null; // can be null  for compaitbilty with product_id 
        $paymentInit->product_id = $paymentFieldsArray['product']->id;  // can be null , for compatibility  with cart 

        $paymentInit->shipping_status = 'PLACED';  // can be change to deliver accordingly 

        $paymentInit->save(); 
        return $paymentInit; 
    }

    public static function paymentVerifyForToken($token,$payment_id)
    {
        $paymentInit = PaymentInit::where('payment_gateway_id',$token)->first(); 

        $paymentInit->payment_status = 'PLACED'; 
        $paymentInit->payment_gateway_id = $payment_id;
        $paymentInit->save(); 

    }

    public function payWithpaypal(Request $request,$paymentFieldsArray)
    {
        // prepared fields from last calling stack, now preparing and saving object. 
        $paymentInit = self::savePaymentInDatabase($paymentFieldsArray);

        $payer = new Payer();
        $payer->setPaymentMethod($paymentFieldsArray['payment_provider']); 

        $item_1 = new Item();
        $item_1->setName($paymentFieldsArray['product']->title) /** item name **/
            ->setCurrency($paymentFieldsArray['currency'])
            ->setQuantity($paymentFieldsArray['quantity'])            
            ->setPrice($paymentFieldsArray['amount']); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($paymentFieldsArray['currency'])            
            ->setTotal($paymentFieldsArray['total']);

    
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('paypal/status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('paypal/status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
            $paymentInit->payment_gateway_id = $payment->getToken(); 
            // https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=EC-7HE52166L5895012M 
            $paymentInit->save(); 
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

        // $redirect_url = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=EC-7HE52166L5895012M"; 

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('paypal_payment_token', $payment->getToken());

        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
    }

    public function getPaymentStatus(Request $request)
    {
        // Log::info('payment_info_callback',Input::all()); 

        // verify url == http://localhost:8000/paypal/status?paymentId=PAYID-LVP6SZA98G710955Y7692913&token=EC-7HE52166L5895012M&PayerID=A3JNHUPF28EQ4 
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::to('/');
        }

        $payment = Payment::get($payment_id, $this->_api_context); 
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success');
            self::paymentVerifyForToken(Input::get('token'),$payment_id);

            $orderCtrl = new OrderCtrl(); 
            return $orderCtrl->confirmPlaceOrderAfterPayment($request);
            return Redirect::to('/'); 
        }
        \Session::put('error', 'Payment failed');
        return Redirect::to('/');
    }
        
}


/*


we get id from payment create method by which we can verify payment 
$result = $payment->execute($execution, $this->_api_context);
 output 
Payment {#350 ▼
  -_propMap: array:9 [▼
    "id" => "PAYID-LVPOHTI8UP38275AR5178049"
    "intent" => "sale"
    "state" => "approved"
    "cart" => "1JV09751C3296410K"
    "payer" => Payer {#393 ▶}
    "transactions" => array:1 [▶]
    "create_time" => "2019-08-22T18:49:49Z"
    "update_time" => "2019-08-22T18:51:25Z"
    "links" => array:1 [▶]
  ]
}



url 
http://localhost:8000/paypal/status?paymentId=PAYID-LVPOHTI8UP38275AR5178049&token=EC-1JV09751C3296410K&PayerID=A3JNHUPF28EQ4 


"paymentId":"PAYID-LVPN6MQ39K20176E8542623S","token":"EC-9DX36126Y6284092L","PayerID":"A3JNHUPF28EQ4" 
*/ 


/*



    public function test_fields($request)
    {
        $product = Products::first(); 

        return [
            'amount' => 1,
            'total' => 1,
            'quantity' => 1,
            'payment_provider' => 'paypal',
            'product' => $product,
            'currency' => 'USD',
        ];
    }

    public function index(Request $request)
    {
        $product = Products::first(); 

        $field =  [
            'amount' => $product->amount,
            'total' => $product->amount,
            'quantity' => 1,
            'payment_provider' => 'paypal',
            'payment_provider_id' => 1,
            'product' => $product,
            'currency' => 'USD',
            'shipping' => 0,
            'tax' => 0,
            'product_id' => $product->id, // temp
        ];

        Session::put('product',$field); 
        $orderCtrl = new OrderCtrl;
        return $orderCtrl->confirmPlaceOrder($request);
    }

    */ 