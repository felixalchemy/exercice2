<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Products;

class ProductList
{
	/**
	 * @var Product[] products list
	 */
	private $_list;

	public function __construct()
	{
		$this->_list = array();
	}

	/**
	 * Load product list from data given
	 *
	 * @param array $pListProduct
	 */
	public function load(array $pListProduct)
	{
		foreach ($pListProduct as $id => $product)
		{
			$this->_list[$id] = new Product($id, $product['label'], $product['price']);
		}
	}

	/**
	 * Return Product from id reference
	 *
	 * @param string $pProductId
	 *
	 * @return \App\Products\Product
	 * @throws \App\Products\ProductListException
	 */
	public function get(string $pProductId) : Product
	{
		if(! array_key_exists($pProductId, $this->_list))
		{
			throw new ProductListException('product "'.$pProductId.'"" not found.');
		}

		return($this->_list[$pProductId]);
	}

	/**
	 * @return Product[]
	 */
	public function getList() : array
	{
		return $this->_list;
	}
}
