<?php

namespace Tests\App\Products;

use App\Products\ProductList;
use App\Products\ProductListException;
use Data\ProductData;
use PHPUnit\Framework\TestCase;

class ProductListTest extends TestCase
{
	public function testGet_ValidId_ShouldReturn_ExpectedValues()
	{
		$dataProduct = new ProductData();
		$productsList = new ProductList();
		$productsList->load($dataProduct->get());

		$id = '8411782806049';

		$productRef = $dataProduct->get()[$id];

		$product = $productsList->get($id);

		$this->assertSame($id, $product->getId());
		$this->assertSame($productRef['label'], $product->getLabel());
		$this->assertSame((float)$productRef['price'], $product->getPrice());
	}

	public function testGet_UnknowId_ShouldReturn_Exception()
	{
		$dataProduct = new ProductData();
		$productsList = new ProductList();
		$productsList->load($dataProduct->get());

		$id = 'dummy';

		$this->expectException(ProductListException::class);

		$product = $productsList->get($id);

	}
}
