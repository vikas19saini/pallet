<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use FedEx\RateService\Request;
use FedEx\RateService\ComplexType;
use FedEx\RateService\SimpleType;
use Carbon\Carbon;
use App\Models\Addresses;
use App\Models\Countries;
use App\Models\Fabrics;

class Cart extends Model {

    protected $table = "cart";

    //  user_id product_id 


    public static function changeCurrencyFormat($price, $helper = "INR") {
        if ($helper == "INR")
            return self::changeToIndianFormat($price);

        return self::changeToUSDForamt($price);
    }

    public static function changeToIndianFormat($price) {
        // $num = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $price);
        return $price;
        // return $num; 
    }

    public static function changeToUSDForamt($price) {
        return number_format($price, 2, '.', ',');
    }

    public function product() {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
    
    public function fabrics(){
        return $this->belongsTo(Fabrics::class, 'fabric_id', 'id');
    }

    public function address() {
        return $this->belongsTo(Addresses::class, 'address_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function calc_shipping($cart = null) {
        //echo json_encode($cart);exit();
        $Key = 'u0QJgd2tlSzYG578';
        $Password = 'IWGvyMFFVa0ne1vz7r4DhqXUx';
        $AccountNumber = '510087860';
        $MeterNumber = '113999824';

        $rateRequest = new ComplexType\RateRequest();
        $rateRequest->WebAuthenticationDetail->UserCredential->Key = $Key;
        $rateRequest->WebAuthenticationDetail->UserCredential->Password = $Password;
        $rateRequest->ClientDetail->AccountNumber = $AccountNumber;
        $rateRequest->ClientDetail->MeterNumber = $MeterNumber;

        $rateRequest->ReturnTransitAndCommit = true;
        $rateRequest->RequestedShipment->PreferredCurrency = 'USD';

        $rateRequest->RequestedShipment->PackageCount = 1;

        $rateRequest->RequestedShipment->Shipper->Address->StreetLines = ['HP Singh Agencies Private Limited 111, 82-83 Vaikunth Building, Nehru Place'];
        $rateRequest->RequestedShipment->Shipper->Address->City = 'New Delhi';
        $rateRequest->RequestedShipment->Shipper->Address->StateOrProvinceCode = 'DL';
        $rateRequest->RequestedShipment->Shipper->Address->PostalCode = 110019;
        $rateRequest->RequestedShipment->Shipper->Address->CountryCode = 'IN';
        $rateRequest->RequestedShipment->PackagingType = 'YOUR_PACKAGING';

        $shippingDate = Carbon::now();
        $shippingDate = $shippingDate->modify('+24 hours')->format('c');
        $rateRequest->RequestedShipment->ShipTimestamp = $shippingDate;

        $rateRequest->RequestedShipment->RateRequestTypes = [SimpleType\RateRequestType::_PREFERRED];
        $rateRequest->RequestedShipment->ShippingChargesPayment->PaymentType = SimpleType\PaymentType::_SENDER;

        $rateRequest->TransactionDetail->CustomerTransactionId = 'Testing..';
        $rateRequest->Version->ServiceId = 'crs';
        $rateRequest->Version->Major = 24;
        $rateRequest->Version->Minor = 0;
        $rateRequest->Version->Intermediate = 0;

        if (property_exists($recipiantAddress, 'address')) {
            //$rateRequest->RequestedShipment->Recipient->Address->StreetLines = [$recipiantAddress->address];
        }

        if (property_exists($recipiantAddress, 'city')) {
            //$rateRequest->RequestedShipment->Recipient->Address->City = $recipiantAddress->city;
        }

        if (property_exists($recipiantAddress, 'zone')) {
            //$rateRequest->RequestedShipment->Recipient->Address->StateOrProvinceCode = $recipiantAddress->zone->code;
        }

        $address = Addresses::all()->where('id', $cart[0]['address_id'])->first();
        $country = Countries::all()->where('country_id', $address->country)->first();
        
        $rateRequest->RequestedShipment->Recipient->Address->PostalCode = $address->zipcode;
        $rateRequest->RequestedShipment->Recipient->Address->CountryCode = $country->iso_code_2;

        $requestPackageLineItem = new ComplexType\RequestedPackageLineItem();
        $weight = 0;

        foreach ($cart as $product) {
            $weight += ceil(0.5 * $product->quantity);
        }

        $requestPackageLineItem->Weight->Value = $weight;
        $requestPackageLineItem->Weight->Units = SimpleType\WeightUnits::_KG;
        $requestPackageLineItem->Dimensions->Length = 10;
        $requestPackageLineItem->Dimensions->Width = 10;
        $requestPackageLineItem->Dimensions->Height = 10;
        $requestPackageLineItem->Dimensions->Units = SimpleType\LinearUnits::_IN;
        $requestPackageLineItem->GroupPackageCount = 1;

        //create package line items
        $rateRequest->RequestedShipment->RequestedPackageLineItems = [$requestPackageLineItem];

        $rateServiceRequest = new Request();

//        if (!\Cake\Core\Configure::read('debug')) {
//            $rateServiceRequest->getSoapClient()->__setLocation(Request::PRODUCTION_URL); //use production URL   
//        }

        $rateReply = $rateServiceRequest->getGetRatesReply($rateRequest); // send true as the 2nd argument to return the SoapClient's stdClass response.
        $shipping_responses = [];

        if (!empty($rateReply->RateReplyDetails)) {

            foreach ($rateReply->RateReplyDetails as $rateReplyDetails) {
                $response = [];
                $deliveyDate = Carbon::parse($rateReplyDetails->DeliveryTimestamp);
                $deliveyDate = $deliveyDate->format('Y-m-d');

                $response += [
                    'DeliveryTimestamp' => $rateReplyDetails->DeliveryTimestamp,
                    'DeliveryDayOfWeek' => $rateReplyDetails->DeliveryDayOfWeek,
                    'DeliveryDate' => $deliveyDate,
                    'ServiceType' => 'FedEX-' . $rateReplyDetails->ServiceType,
                ];

                if (!empty($rateReplyDetails->RatedShipmentDetails)) {
                    $deliveryAmountText = $rateReplyDetails->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount;
                    $deliveryAmount = $rateReplyDetails->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount;
                    $response += [
                        'DeliveryChargesText' => $deliveryAmountText,
                        'DeliveryCharges' => $deliveryAmount,
                    ];
                }
                array_push($shipping_responses, $response);
            }
        }

        usort($shipping_responses, function($a, $b) {
            return $a['DeliveryCharges'] - $b['DeliveryCharges'];
        });

        if (!empty($shipping_responses)) {
            $shipping_responses = $shipping_responses[0];
        }

        if (array_key_exists('DeliveryCharges', $shipping_responses)) {
            return $shipping_responses + ['status' => 'success'];
        } else {
            return $shipping_responses + ['status' => 'error', 'message' => 'Delivery not available at this location.'];
        }
    }

}
