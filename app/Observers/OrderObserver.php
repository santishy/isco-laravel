<?php
namespace App\Observers;
use App\Order;

class OrderObserver{
	public function created(Order $order){
		$products=$order->shopping_cart->products()->get();
		$order->sendMail();
	}
}
