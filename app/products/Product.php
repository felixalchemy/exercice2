<?php
/**
 * Product object definition
 */
namespace App\Products;

class Product
{
	/**
	 * @var string product id.
	 */
	private $_id;

	/**
	 * @var string product label.
	 */
	private $_label;

	/**
	 * @var float product price.
	 */
	private $_price;

	public function __construct(string $pId, string $pLabel, float $pPrice)
	{
		$this->_id = $pId;
		$this->_label = $pLabel;
		$this->_price = $pPrice;
	}

	/**
	 * @return string
	 */
	public function getId() : string
	{
		return $this->_id;
	}

	/**
	 * @return string
	 */
	public function getLabel() : string
	{
		return $this->_label;
	}

	/**
	 * @return float
	 */
	public function getPrice() : float
	{
		return $this->_price;
	}
}
