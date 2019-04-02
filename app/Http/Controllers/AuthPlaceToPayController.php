<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class AuthPlaceToPayController extends Controller
{
   private $scretKey;
   private $login;
   private $endpoint;

   public function __construct()
    {
        $this->scretKey = env('PLACE_TO_PAY_SECRET');
        $this->login = env('PLACE_TO_PAY_LOGIN');
        $this->endpoint = 'https://test.placetopay.com/redirection/';
    }

    public function createPay()
    {
    	$auth = $this->getAuth();

    	return $auth->query('188760')->toArray();
    }

    public function getAuth()
    {
		$placetopay = new \Dnetix\Redirection\PlacetoPay([
	    'login' => $this->login,
	    'tranKey' => $this->scretKey,
	    'url' => $this->endpoint,
		]);

		return $placetopay;
    }

    public function createPayRequest($placetopay)
    {
    	$reference = "123344";
		$request = [
		    'payment' => [
		        'reference' => $reference,
		        'description' => 'Testing payment',
		        'amount' => [
		            'currency' => 'COP',
		            'total' => 120000,
		        ],
		    ],
		    'expiration' => date('c', strtotime('+2 days')),
		    'returnUrl' => 'http://localhost/placetopay/callback/' . $reference,
		    'ipAddress' => '127.0.0.1',
		    'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
		];
		$response = $placetopay->request($request);

		if ($response->isSuccessful()) {

			 Log::info('place.requests', ['requestid' => $response->requestId()]);
			 Log::info('place.requests', ['requesturl' => $response->processUrl()]);
		    // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
		    // Redirect the client to the processUrl or display it on the JS extension
		    //header('Location: ' . $response->processUrl());
			 dd($response);
		} else {
			 dd($response);
		    // There was some error so check the message and log it
		    $response->status()->message();
		}
    }

    public function callbackHandler($ref)
    {

    	$response = $auth->query('188760');

    	 return $response->toArray();


    }
}
