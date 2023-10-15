<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use session;
use App\Http\Classes\Payment;

class PaymentController extends Controller
{
  //
  public function index() {
    
    if (!session()->has('basket.items')) {
      return redirect('/products');
    }
    $payment = new Payment();
    
    $basket = session()->get('basket.items');
    $totalPrice = array_sum(array_values(array_column($basket, 'price')));
    return view('payment', [
      'basket' => session()->get('basket.items'),
      'totalPrice' => $totalPrice,
      'paymentMethods' => $payment->paymentMethods(),
      'reference' => rand(1, 999999) . strtotime('now'),
      'clientKey' => env('ADYEN_CLIENT_KEY')
    ]);
  }

  public function payment(Request $request) {

    $request = $request->all();

    /* convert value to float in order for Adyen to be able to process, and then multiply by 100 to create the actual amount of the transaction */

    $value = (float) $request['amount']['value'] * 100;

    $params = [
      'amount' => [
        'currency' => env('ADYEN_CURRENCY'),
        'value' => $value
      ],
      'merchantAccount' => env('ADYEN_MERCHANT_ACCOUNT'),
      'billingAddress' => $request['billingAddress'],
      'paymentMethod' => $request['paymentMethod'],
      'channel' => env('ADYEN_CHANNEL'),
      /*'threeDS2RequestData' => [
        'notificationURL' => env('APP_URL') . '/payment/threeds'
      ],*/
      'authenticationData' => [
        'threeDSRequestData' => [
          'nativeThreeDS' => 'preferred'
        ]
      ],
      'returnUrl' => $request['returnUrl'],
      'browserInfo' => [
        'userAgent' => $_SERVER['HTTP_USER_AGENT'],
        'acceptHeader' => 'text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/webp,image\/apng,*\/*;q=0.8',
        'language' => 'en',
        'colorDepth' => 24,
        'screenHeight' => 723,
        'screenWidth' => 1536,
        'timeZoneOffset' => 0,
        'javaEnabled' => false 
      ],
      'origin' => env('APP_URL'),
      'reference' => $request['reference'],
      'shopperEmail' => $request['shopperEmail'],
      'shopperIP' => $_SERVER['REMOTE_ADDR'],

    ];

    /* Make a /payments request to Adyen */
    $payment = new Payment();
    $result = $payment->payments($params);
    
    return view('threeds', [
      'action' => json_encode($result)
    ]);

    /*return view('threeds', [
      'threeDSMethodURL' => $result['threeDSMethodURL'],
      'threeDSMethodData' => $result['threeDSMethodData']
    ]);*/
  }

   public function threedsIndex(Request $request) {
 
        $request = $request->all();
   
        $action = $request['result'] ?? '';

        return view('threeds', [
            'action' => $action
        ]);

    }

    public function threedsProcess(Request $request) {
      $request = $request->all();
      $threeDsResult = json_decode($request['stateDataDetails'], true);
      $payment = new Payment();
      $authResult = $payment->paymentDetails($threeDsResult);
      if ($authResult['resultCode'] != 'Authorised') {
        return back()->with('error', 'Your card authentication was not successful. Please try again or try with an alternative payment method.');
      }
      /* if set to manual capture, so need to call the captures method with the PSP reference returned from successful authorisation. Passing required params, and also need to generate the URL endpoint manually because currently cannot figure out a way to use the library methods to pass in the pspReference required in the URL. Otherwise, it is automatic capture so don't need to do any further steps. Now, we are attempting to do manual capture */
      $payment->capture($authResult);
      

      return redirect('confirmation')->with('success', 'Your order has been placed successfully. You will also receive an email confirmation with all the details.');
    }

  
}
