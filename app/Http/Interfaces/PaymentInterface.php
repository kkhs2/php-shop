<?php
namespace App\Http\Interfaces;


interface PaymentInterface {
	public function authorize();
	public function processPayment();
	public function capture();
}
