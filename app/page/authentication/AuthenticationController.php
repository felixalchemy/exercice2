<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Page\Authentication;

class AuthenticationController
{
	public function __construct()
	{
		$this->display();
	}

	private function display()
	{
		$view = new AuthenticationView();
		$view->display();
	}
}
