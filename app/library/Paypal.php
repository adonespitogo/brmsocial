<?php

class Paypal {

	public static function getExpressURL($items, $config = array())
	{

        $return_url = urlencode(Config::get('paypal.returnUrl'));
        $cancel_url = urlencode(Config::get('paypal.cancelUrl'));
        $notify_url = urlencode(Config::get('paypal.notifyUrl'));

        $return_url = isset($config['return_url'])? $config['return_url'] : $return_url;
        $cancel_url = isset($config['cancel_url'])? $config['cancel_url'] : $cancel_url;
        $notify_url = isset($config['notify_url'])? $config['notify_url'] : $notify_url;
    
        $nvpStr = "PAYMENTREQUEST_0_CURRENCYCODE=USD";
        $nvpStr .= "&PAYMENTREQUEST_0_PAYMENTACTION=SALE";
        $nvpStr .= "&PAYMENTREQUEST_0_NOTIFYURL=".$notify_url;
        
        $ctr = 0;
        $total = 0;
        
        foreach($items as $item) {

            $name = isset($item['name'])? $item['name'] : (isset($item['description'])? $item['description']: '');
            $description = isset($item['description'])? $item['description'] : isset($item['name'])? $item['name']: '';
            $quantity = isset($item['quantity'])? $item['quantity'] : 1;
            $amount = isset($item['amount'])? $item['amount'] : 0;

            $nvpStr .= '&L_PAYMENTREQUEST_0_NAME'.$ctr.'='.$name;
            $nvpStr .= '&L_PAYMENTREQUEST_0_QTY'.$ctr.'='.$quantity;
            $nvpStr .= '&L_PAYMENTREQUEST_0_AMT'.$ctr.'='.$amount;
            $nvpStr .= '&L_PAYMENTREQUEST_0_DESC'.$ctr.'='.$description;
            $total = $total + $amount;
            $ctr++;
        }         
        
        $nvpStr .= "&PAYMENTREQUEST_0_AMT=".$total; //total
        
        $nvpStr .= "&LANDINGPAGE=Billing";
        $nvpStr .= "&RETURNURL=".$return_url;
        $nvpStr .= "&CANCELURL=".$cancel_url;
        $nvpStr .= "&NoShipping=1";
        $nvpStr .= "&LocaleCode=US";

        $httpParsedResponseAr = self::PPHttpPost('SetExpressCheckout', $nvpStr);
        //return Paypal url if success
        if(strtoupper($httpParsedResponseAr["ACK"]) == 'SUCCESS' || strtoupper($httpParsedResponseAr["ACK"]) == 'SUCCESSWITHWARNING')
        {
            $token = urldecode($httpParsedResponseAr["TOKEN"]);  

            return "https://www.".Config::get('paypal.paypalDomain')."/webscr&cmd=_express-checkout&token=$token";

        }else{
            //show error and redirect to dashboard if error
            Session::flash('alert', urldecode($httpParsedResponseAr['L_LONGMESSAGE0']));
            return URL::to('services');
        }

	}

	public static function confirmOrders($token)
	{
		$details = self::PPHttpPost('GetExpressCheckoutDetails', "TOKEN=".$token);
        if("SUCCESS" == strtoupper($details["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($details["ACK"]))
        {
            $checkout_details = $details;
            $httpParsedResponseAr = PayPalHelper::confirmCheckout($details);

            if($httpParsedResponseAr != false)
            {

                $paypal_info = self::decodePaypalInfo($httpParsedResponseAr);

                return json_decode(
                    json_encode(
                        array(
                            'orders' => PayPalHelper::getOrderDetails($checkout_details),
                            'paypal_info' => $paypal_info
                        )
                    )
                );

                // return PayPalHelper::getOrderDetails($checkout_details);
            }
            else
            {
                return false;
            }
        }
        else{
            return false;
        }
	}

    public static function confirmCheckout($checkoutDetails){
        $token = $checkoutDetails['TOKEN'];
        $payerID = $checkoutDetails['PAYERID'];
        
        $nvpStr = "TOKEN=".$token;  
        
        $total = 0;
        for($ctr = 0; isset($checkoutDetails['L_AMT'.$ctr]); $ctr++) {
            $nvpStr .= '&L_PAYMENTREQUEST_0_NAME'.$ctr.'='.urldecode($checkoutDetails['L_PAYMENTREQUEST_0_NAME'.$ctr]);
            $nvpStr .= '&L_PAYMENTREQUEST_0_QTY'.$ctr.'=1';
            $nvpStr .= '&L_PAYMENTREQUEST_0_AMT'.$ctr.'='.urldecode($checkoutDetails['L_PAYMENTREQUEST_0_AMT'.$ctr]);
            $nvpStr .= '&L_PAYMENTREQUEST_0_DESC'.$ctr.'='.urldecode($checkoutDetails['L_PAYMENTREQUEST_0_DESC'.$ctr]);
            
            $total = $total + urldecode($checkoutDetails['L_PAYMENTREQUEST_0_AMT'.$ctr]);
        }

        $nvpStr .= "&PAYERID=".$payerID;
        $nvpStr .= "&PAYMENTREQUEST_0_AMT=".$total;  
        $nvpStr .= "&PAYMENTREQUEST_0_PAYMENTACTION=Sale";

        $httpParsedResponseAr = self::PPHttpPost('DoExpressCheckoutPayment', $nvpStr);

        if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"]))
        {

            // $data = array(
         //        "mc_gross" => urldecode($httpParsedResponseAr["PAYMENTINFO_0_AMT"]),
         //        "payer_id" => urldecode($checkoutDetails['PAYERID']),
         //        "tax" => urldecode($httpParsedResponseAr['PAYMENTINFO_0_FEEAMT']),
         //        "payment_date" => urldecode($httpParsedResponseAr['TIMESTAMP']),
         //        "mc_shipping" => urldecode($checkoutDetails['SHIPPINGAMT']),
         //        "first_name" => urldecode($checkoutDetails['FIRSTNAME']),
         //        "mc_fee" => urldecode($httpParsedResponseAr['PAYMENTINFO_0_FEEAMT']),
         //        "address_country_code" => urldecode($checkoutDetails['COUNTRYCODE']),
         //        "custom" => "",
         //        "payer_email" => urldecode($checkoutDetails['EMAIL']),
         //        "txn_id" => urldecode($httpParsedResponseAr['PAYMENTINFO_0_TRANSACTIONID']),
         //        "payment_type" => urldecode($httpParsedResponseAr['PAYMENTINFO_0_PAYMENTTYPE']),
         //        "last_name" => urldecode($checkoutDetails['LASTNAME']),
         //        "payment_gross" => urldecode($httpParsedResponseAr["PAYMENTINFO_0_AMT"]),
         //        "payment_status" => urldecode($httpParsedResponseAr['PAYMENTINFO_0_PAYMENTSTATUS']),
         //        "pending_reason" => urldecode($httpParsedResponseAr['PAYMENTINFO_0_PENDINGREASON'])
         //    );

            return $httpParsedResponseAr;
        }
        else{
            return false;
        }

        
    }

    public static function getOrderDetails($checkoutDetails)
    {
        $orders = array();
        $total = 0;
        for($ctr = 0; isset($checkoutDetails['L_AMT'.$ctr]); $ctr++) {
            $order = array();
            $order['name'] = urldecode($checkoutDetails['L_PAYMENTREQUEST_0_NAME'.$ctr]);
            $order['quantity'] = urldecode($checkoutDetails['L_PAYMENTREQUEST_0_QTY'.$ctr]);
            $order['amount'] = urldecode($checkoutDetails['L_PAYMENTREQUEST_0_AMT'.$ctr]);
            $order['description'] = urldecode($checkoutDetails['L_PAYMENTREQUEST_0_DESC'.$ctr]);
            $orders[] = $order;
        }

        return $orders;
    }

    public static function decodePaypalInfo($httpParsedResponseAr)
    {   
        foreach ($httpParsedResponseAr as $key => $value) {
            $httpParsedResponseAr[$key] = urldecode($value);
        }
        return $httpParsedResponseAr;
    }

    public static function PPHttpPost($methodName_, $nvpStr_) {   


		$API_UserName = urlencode(Config::get('paypal.username'));
		$API_Password = urlencode(Config::get('paypal.password'));
		$API_Signature =urlencode(Config::get('paypal.signature'));
		$API_Endpoint = 'https://api-3t.'.Config::get('paypal.paypalDomain').'/nvp';
               
        $version = urlencode('94.0');
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
    
        //turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
    
        //set the API operation, version, and API signature in the request.
        $nvpreq = "METHOD=$methodName_&USER=$API_UserName&PWD=$API_Password&SIGNATURE=$API_Signature&VERSION=$version&$nvpStr_";
    
        //set the request as a POST FIELD for curl.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
    
        //get response from the server.
        $httpResponse = curl_exec($ch);
                //echo $httpResponse; die;
    
        if(!$httpResponse) {
            exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
        }
    
        //extract the response details.
        $httpResponseAr = explode("&", $httpResponse);
    
        $httpParsedResponseAr = array();
        foreach ($httpResponseAr as $i => $value) {
            $tmpAr = explode("=", $value);
            if(sizeof($tmpAr) > 1) {
                $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
            }
        }
                
        if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
            exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
        }
    
        return $httpParsedResponseAr;
    }

}