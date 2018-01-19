<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Page\Shop;

use App\Basket\Basket;
use App\Products\ProductList;
use App\Users\User;
use Data\ProductData;

class ShopController
{
	/** @var \App\Basket\Basket */
	private $_basket;

	/** @var User */
	private $_user;

	/** @var ProductList */
	private $_productList;

	const POST_ACTION = 'action';
	const POST_ACTION_UPDATEAMOUNT = 'updateAmount';
	const POST_ID = 'id';
	const POST_AMOUNT = 'amount';


	public function __construct(User $pUser)
	{
		/**
		 * Load data product
		 */
		$dataProduct = new ProductData();
		$this->_productList = new ProductList();
		$this->_productList->load($dataProduct->get());

		/**
		 * New empty basket creation
		 */
		$this->_basket = new Basket($this->_productList);

		/** @var User _user */
		$this->_user = $pUser;


		/**
		 * Load basket from session or disk depend on user authentication state
		 */
		if($this->_user->isAuthenticate())
		{
			$this->_basket->loadFromFile($this->_user);
		}
		else
		{
			$this->_basket->loadFromSession();
		}

		/**
		 * If new amount values posted, update basket and exit
		 */
		if($this->isUpdateAmountProductValuesReceived())
		{
			$this->registerNewAmount();
			if($this->_user->isAuthenticate())
			{
				$this->_basket->saveToFile($this->_user);
			}
			else
			{
				$this->_basket->saveToSession();
			}

			exit();
		}


		$this->display();
	}

	/**
	 * Check if product amount POST values received
	 *
	 * @return bool true on POST values received, false otherwise
	 */
	public function isUpdateAmountProductValuesReceived() : bool
	{
		if(! isset($_POST[self::POST_ACTION]) )
		{
			return(false);
		}

		if($_POST[self::POST_ACTION] != self::POST_ACTION_UPDATEAMOUNT)
		{
			return(false);
		}

		if(! isset($_POST[self::POST_ID]) )
		{
			return(false);
		}

		if(! isset($_POST[self::POST_AMOUNT]) )
		{
			return(false);
		}

		return(true);
	}

	/**
	 * Register new amount to basket
	 */
	private function registerNewAmount()
	{
		$id = $_POST[self::POST_ID];
		$amount = 1 * $_POST[self::POST_AMOUNT];

		/**
		 * Filter amount value
		 */
		$amount = (int)$amount;
		if($amount < 0)
		{
			$amount = 0;
		}

		$this->_basket->addProduct($id, $amount);
	}

	/**
	 * Display HTML shop
	 */
	private function display()
	{
		$view = new ShopView();
		$view->display($this->_productList, $this->_basket, $this->_user);
	}
}
