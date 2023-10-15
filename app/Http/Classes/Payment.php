<?php
namespace App\Http\Classes;
use Adyen\Client;
use Adyen\Service\Checkout;
use Adyen\Service\ResourceModel\Checkout\Captures;


class Payment {

	private $client; 
	private $service;


	public function __construct() {
		$this->client = new Client();
		$this->client->setEnvironment(\Adyen\Environment::TEST);
		$this->client->setXApiKey(env('ADYEN_API_KEY'));
		$this->service = new Checkout($this->client);
	}

	public function paymentMethods() {
		$params = [
			'countryCode' => env('ADYEN_COUNTRY_CODE'),
  		'shopperLocale' => env('ADYEN_SHOPPER_LOCALE'),
			'channel' => env('ADYEN_CHANNEL'),
			'merchantAccount' => env('ADYEN_MERCHANT_ACCOUNT'),

		];
		$result = $this->service->paymentMethods($params);
		return $result['paymentMethods'][0]['brands'];
	}

	public function payments($params = []) {
		$result = $this->service->payments($params);

		/* payment qualifies for threeDS2 */
		if ($result['action']['type'] == 'threeDS2') {
			return $result['action'];
		}

	}

	
	/*
	private function identifyShopper($result) {
		$decodedToken = json_decode(base64_decode($result['action']['token']), true);
			$threeDsObj = [
				'threeDSServerTransID' => $result['additionalData']['threeds2.threeDSServerTransID'],
				'threeDSMethodNotificationURL' => 'https://shop.local/payment/threeds'
			];
			$threeDsObjStringify = json_encode($threeDsObj);
			$threeDsObjEncoded = base64_encode($threeDsObjStringify);

			return [
				'threeDSMethodURL' => $decodedToken['threeDSMethodUrl'],
				'threeDSMethodData' => $threeDsObjEncoded
			];
	}	
	*/

	public function capture($authResult) {

		dd($authResult);

		//$capturesEndpoint = $capture->getCheckoutEndpoint($this->service) . '/' . $this->service->getClient()->getApiAccountVersion() . '/payments/' . $authResult['pspReference'] . '/captures';


		$captureParams = [
			'merchantAccount' => env('ADYEN_MERCHANT_ACCOUNT'),
			'amount' => $authResult['amount'],
			'reference' => $authResult['merchantReference']
		];

		$result = $this->service->captures($captureParams);
		dd($result);

		
		//$result = $this->service->captures($captureParams);

		
		
	}


	public function paymentDetails($threeDSResult) {

		$result = $this->service->paymentsDetails($threeDSResult);
		return $result;
	}
}