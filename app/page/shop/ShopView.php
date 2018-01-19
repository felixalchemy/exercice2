<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Page\Shop;

use App\Basket\Basket;
use App\Page\Template;
use App\Products\Product;
use App\Products\ProductList;
use App\Users\User;

class ShopView
{
	/**
	 * @var \App\Page\Template
	 */
	private $_template;

	public function __construct()
	{
		$this->_template = new Template();
	}

	/**
	 * Output HTML shop
	 *
	 * @param \App\Products\ProductList $pProductsList
	 * @param \App\Basket\Basket $pBasket
	 * @param \App\Users\User $pUser
	 */
	public function display(ProductList $pProductsList, Basket $pBasket, User $pUser)
	{
		$jsLink = '<script src="res/js/aja.min.js"></script><script src="res/js/shop.js"></script>';
		$cssLink = '';

		$this->_template->load('header.html',
			array('{{js}}', '{{css}}'),
			array($jsLink, $cssLink)
		);

		if($pUser->isAuthenticate())
		{
			$this->_template->load('shopHeaderAuthenticate.html',
				array('{{firstname}}', '{{name}}'),
				array($pUser->getFirstname(), $pUser->getName())
			);
		}
		else
		{
			$this->_template->load('shopHeader.html');
		}


		/** @var Product $product */
		foreach($pProductsList->getList() as $product)
		{
			$this->_template->load('shopItem.html',
				array('{{productId}}', '{{productLabel}}', '{{productPrice}}', '{{productAmount}}'),
				array($product->getId(), $product->getLabel(), $product->getPrice(), $pBasket->getAmount($product->getId()))
			);
		}


		$this->_template->load('shopFooter.html');
		$this->_template->load('footer.html');

		echo($this->_template->getBuffer());
	}
}
