<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Basket;



class BasketItem
{
	/**
	 * @var string product id.
	 */
	private $_productId;

	/**
	 * @var int product amount.
	 */
	private $_amount;


	public function __construct(string $pProductId, int $pAmout)
	{
		$this->_productId = $pProductId;
		$this->_amount = $pAmout;
	}

	/**
	 * @return string
	 */
	public function getProductId()
	{
		return $this->_productId;
	}

	/**
	 * @return int
	 */
	public function getAmount()
	{
		return $this->_amount;
	}

	/**
	 * @param int $amount
	 */
	public function setAmount($amount)
	{
		$this->_amount = $amount;
	}
}
