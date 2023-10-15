<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index() {
        $url = 'https://fakestoreapi.com/products';
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        if($e = curl_error($curl)) {
            echo $e;
        } else {
            // Decoding JSON data
            $productsData = json_decode($response, true);

                 
            // Outputting JSON data in
            // Decoded form

            foreach ($productsData as $key => $val) {
                //$products[$key]['price'] = number_format($val['price'], 2);
                $productsData[$key]['price'] = $val['price'];
               
            }
            return view('products', ['products' => $productsData]);
        }
         
        // Closing curl
        curl_close($curl);
    }

    public function addToBasket(Request $request) {
        $basket = $request->all();
        $product = $basket['product' . $basket['submit']];
        session()->push('basket.items', $product);
       
        return redirect('basket')->with('success', 'The item has been added to your basket.');
    }

}
