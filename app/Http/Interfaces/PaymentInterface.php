<?php
namespace App\Http\Interfaces;


interface PaymentInterface {
	public function authorize();
	public function payment();
	public function processPayment();
	public function capture();
}
