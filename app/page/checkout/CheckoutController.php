<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Page\CheckOut;

class CheckoutController
{
	public function __construct()
	{
		$this->display();
	}

	private function display()
	{
		$view = new CheckoutView();
		$view->display();
	}
}
