<?php
namespace App\Http\Classes;
use Adyen\Client;
use Adyen\Model\Checkout\PaymentMethodsRequest;
use Adyen\Model\Checkout\PaymentRequest;
use Adyen\Model\Checkout\PaymentCaptureRequest;
use Adyen\Model\Checkout\PaymentDetailsRequest;
use Adyen\Service\Checkout\ModificationsApi;
use Adyen\Service\Checkout\PaymentsApi;


class Payment {

	private $client; 
	private $service;


	public function __construct() {
		$this->client = new Client();
		$this->client->setEnvironment(\Adyen\Environment::TEST);
		$this->client->setXApiKey(env('ADYEN_API_KEY'));
		$this->client->setTimeout(30);
		$this->service = new PaymentsApi($this->client);
	}

	public function paymentMethods() {
		$params = [
			'countryCode' => env('ADYEN_COUNTRY_CODE'),
  		'shopperLocale' => env('ADYEN_SHOPPER_LOCALE'),
			'channel' => env('ADYEN_CHANNEL'),
  		'merchantAccount' => env('ADYEN_MERCHANT_ACCOUNT'),
		];
		$request = new PaymentMethodsRequest($params);
		$paymentMethods = $this->service->paymentMethods($request);
		return $paymentMethods['paymentMethods'][0]['brands'];
	}

	public function payments($params = []) {
		$request = new PaymentRequest($params);
		$result = $this->service->payments($request);

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
		$modification = new ModificationsApi($this->client);
		$params = [
			'merchantAccount' => env('ADYEN_MERCHANT_ACCOUNT'),
			'amount' => $authResult['amount'],
			'reference' => $authResult['merchantReference']
		];
		$request = new PaymentCaptureRequest($params);
		return $modification->captureAuthorisedPayment($authResult['pspReference'], $request);
	}


	public function paymentDetails($threeDsResult) {
		$request = new PaymentDetailsRequest($threeDsResult);
		return $this->service->paymentsDetails($request);
	}
}