<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Basket;

use App\Products\ProductList;
use App\Users\User;

class Basket
{
	const USER_UNDEFINED = 0;
	const BASKET_PATH = 'data'.DIRECTORY_SEPARATOR.'baskets';

	/**
	 * @var \App\Products\ProductList
	 */
	private $_productList;

	/**
	 * @var BasketItem[] items list
	 */
	private $_listItems;


	public function __construct(ProductList $pProductList)
	{
		$this->_productList = $pProductList;
		$this->_listItems = array();
	}

	/**
	 * Return amount from product id.
	 * Return 0 if not found in basket.
	 *
	 * @param string $pProductID
	 *
	 * @return int
	 */
	public function getAmount(string $pProductID) : int
	{
		if(array_key_exists($pProductID, $this->_listItems))
		{
			/** @var BasketItem $basketItem */
			$basketItem = $this->_listItems[$pProductID];
			return($basketItem->getAmount());
		}
		return(0);
	}

	/**
	 * Add product to basket.
	 * Delete product if amount set to 0
	 *
	 * @param string $pProductId reference product
	 * @param int $amount amount
	 *
	 * @return bool true on succes, false otherwise.
	 */
	public function addProduct(string $pProductId, int $amount) : bool
	{
		if ($amount == 0)
		{
			return ($this->delProduct($pProductId));
		}

		if ($amount < 0)
		{
			return (false);
		}

		/**
		 * Return false if product id not a real reference
		 */
		if (!array_key_exists($pProductId, $this->_productList->getList()))
		{
			return (false);
		}

		/**
		 * If product even exist in basket, just set new amount
		 */
		if (array_key_exists($pProductId, $this->_listItems))
		{
			$this->_listItems[$pProductId]->setAmount($amount);
		}
		else
		{
			$this->_listItems[$pProductId] = new BasketItem($pProductId, $amount);
		}

		return (true);
	}

	/**
	 * Delete product in basket.
	 *
	 * @param string $pProductId If product even exist
	 *
	 * @return bool true on succes, false otherwise.
	 */
	public function delProduct(string $pProductId) : bool
	{
		if (!array_key_exists($pProductId, $this->_listItems))
		{
			return (false);
		}
		unset($this->_listItems[$pProductId]);
		return (true);
	}

	/**
	 * Load basket list item from php session if exist
	 *
	 * @return bool true on values session exist.
	 */
	public function loadFromSession() : bool
	{
		if(isset($_SESSION['Basket']))
		{
			/** @var  $listItem */
			$listItem	= $_SESSION['Basket'];
			$this->_listItems = $listItem;

			return(true);
		}

		return(false);
	}

	/**
	 * Save  basket list item to php session
	 */
	public function saveToSession()
	{
		$_SESSION['Basket'] = $this->_listItems;
	}

	/**
	 * Save basket to file
	 *
	 * @param \App\Users\User $pUser
	 *
	 * @return bool true on success, false otherwise.
	 */
	public function saveToFile(User $pUser) : bool
	{
		$basketFilePath = $this->getBasketFilePath($pUser->getId());

		try
		{
			$handleFile = fopen($basketFilePath, 'w');
			fwrite($handleFile, $this->getSerializedBasket());
			fclose($handleFile);
		}
		catch(\Error $e)
		{
			return(false);
		}

		return(true);
	}

	/**
	 * Load basket from file.
	 *
	 * @param \App\Users\User $pUser
	 *
	 * @return bool true on success, false otherwise.
	 */
	public function loadFromFile(User $pUser) : bool
	{
		$basketFilePath = $this->getBasketFilePath($pUser->getId());

		if(! file_exists($basketFilePath))
		{
			return(false);
		}

		$handleFile = fopen($basketFilePath, 'r');
		$basketSerialized = fread($handleFile, filesize($basketFilePath));
		fclose($handleFile);

		$this->loadSerializedBasket($basketSerialized);

		return(true);
	}

	/**
	 * Return basket file path depend on user id.
	 *
	 * @param string $pUserId
	 *
	 * @return string
	 */
	private function getBasketFilePath(string $pUserId) : string
	{
		return(self::BASKET_PATH . DIRECTORY_SEPARATOR . $pUserId);
	}

	/**
	 * Return serializd basket
	 */
	public function getSerializedBasket() : string
	{
		return(
			serialize( array('listItems' => $this->_listItems))
		);
	}

	/**
	 * Load basket with serialized data.
	 * TODO : Check if product still exist in db.
	 *
	 * @param string $pSerializedBasket
	 */
	public function loadSerializedBasket(string $pSerializedBasket)
	{
		$unserializedBasket = unserialize($pSerializedBasket);
		$this->_listItems = $unserializedBasket['listItems'];
	}

	/**
	 * @return Product[]
	 */
	public function getListItems()
	{
		return $this->_listItems;
	}

	/**
	 * @param ProductList $productList
	 */
	public function setProductList($productList)
	{
		$this->_productList = $productList;
	}
}