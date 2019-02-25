<?php

namespace Payment;
use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

class Payment
{
    private $pay;
    private $card;

    function makepayment($value,$token){
        try{

            // Setup payment Gateway
            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey('sk_test_WDDBxqHa87ZHzWB5fLX4TGpo');
            $gateway->setTestMode(true);


            // Send purchase request
            $response = $gateway->purchase(
                [
                    'amount' => $value['amount'],
                    'currency' => $value['currency'],
                    'token' => $token
                ]
            )->send();

            // Process response
            if ($response->isSuccessful()) {

                return json_encode((object) [
                    'success' => true,
                    'msg' => "Thankyou for your bussiness!",
                ]);

            } elseif ($response->isRedirect()) {

                // Redirect to offsite payment gateway
                return json_encode((object) [
                    'success' => false,
                    'msg' => "Payment Failed!".$response->getMessage() ,
                    'redirect_url' => $response->getMessage(),
                ]);

            } else {
                // Payment failed
                return json_encode((object) [
                    'success' => false,
                    'msg' => "Payment Failed!".$response->getMessage() ,
                ]);
            }
        }
        catch(\Exception $ex){
            return $ex->getMessage();
        }
    }
}