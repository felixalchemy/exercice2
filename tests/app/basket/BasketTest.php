<?php
/**
 *
 */
namespace Tests\App\Basket;

use App\Basket\BasketItem;
use PHPUnit\Framework\TestCase;
use App\Basket\Basket;
use App\Products\ProductList;
use Data\ProductData;


class BasketTest extends TestCase
{
	public function testAddProduct_UnknowReference_ShouldReturn_false()
	{
		/**
		 * Context : no reference in basket
		 */
		$dataProduct = new ProductData();
		$productsList = new ProductList();
		$productsList->load($dataProduct->get());

		$id = 'dummy';

		/**
		 * Test
		 */
		$basket = new Basket($productsList);

		$test = $basket->addProduct($id, 1);

		$this->assertSame($test, false);
	}

	public function testAddProduct_NegativeAmount_ShouldReturn_false()
	{
		/**
		 * Context : no reference in basket
		 */
		$dataProduct = new ProductData();
		$productsList = new ProductList();
		$productsList->load($dataProduct->get());

		$id = '8411782806049';

		/**
		 * Test
		 */
		$basket = new Basket($productsList);

		$test = $basket->addProduct($id, -1);

		$this->assertSame($test, false);
	}

	public function testAddProduct_OnEmptyBasket()
	{
		/**
		 * Context : no reference in basket
		 */
		$dataProduct = new ProductData();
		$productsList = new ProductList();
		$productsList->load($dataProduct->get());

		$productId = '8411782806049';
		$amount = 3;

		$basket = new Basket($productsList);

		/**
		 * Test
		 */
		$succes = $basket->addProduct($productId, $amount);

		$listBasketItem = $basket->getListItems();
		/** @var BasketItem $basketItem */
		$basketItem = $listBasketItem[$productId];

		/**
		 * Should return true as success
		 */
		$this->assertSame($succes, true);

		/**
		 * Check if only one item present
		 */
		$this->assertSame(sizeof($basket->getListItems()), 1);

		/**
		 * Check reference ID
		 */
		$this->assertSame($basketItem->getProductId(), $productId);

		/**
		 * Check amount
		 */
		$this->assertSame($basketItem->getAmount(), $amount);
	}

	public function testAddProduct_OnExistingItem_ShouldOverride()
	{
		/**
		 * Context : 1 reference added
		 */
		$dataProduct = new ProductData();
		$productsList = new ProductList();
		$productsList->load($dataProduct->get());

		$productId = '8411782806049';
		$amount = 3;
		$newAmount = 30;

		$basket = new Basket($productsList);

		$basket->addProduct($productId, $amount);

		/**
		 * Test
		 */
		$succes = $basket->addProduct($productId, $newAmount);

		$listBasketItem = $basket->getListItems();
		/** @var BasketItem $basketItem */
		$basketItem = $listBasketItem[$productId];

		/**
		 * Should return true as success
		 */
		$this->assertSame($succes, true);

		/**
		 * Check if only one item present (not new one is added)
		 */
		$this->assertSame(sizeof($basket->getListItems()), 1);

		/**
		 * Check amount
		 */
		$this->assertSame($basketItem->getAmount(), $newAmount);
	}

	public function testAddProduct_OnAmountSetToZero()
	{
		/**
		 * Context : 1 reference added
		 */
		$dataProduct = new ProductData();
		$productsList = new ProductList();
		$productsList->load($dataProduct->get());

		$productId = '8411782806049';
		$amount = 3;

		$basket = new Basket($productsList);

		$basket->addProduct($productId, $amount);

		/**
		 * Test
		 */
		$succes = $basket->addProduct($productId, 0);

		/**
		 * Should return true as success
		 */
		$this->assertSame($succes, true);

		/**
		 * Check if only one item present (not new one is added)
		 */
		$this->assertSame(sizeof($basket->getListItems()), 0);

	}

	public function testDelProduct_UnknowReference_ShouldReturn_false()
	{
		/**
		 * Context : no reference in basket
		 */
		$dataProduct = new ProductData();
		$productsList = new ProductList();
		$productsList->load($dataProduct->get());

		$productId = 'dummy';

		$basket = new Basket($productsList);

		/**
		 * Test
		 */
		$succes = $basket->delProduct($productId);

		/**
		 * Should return true as success
		 */
		$this->assertSame($succes, false);
	}

	public function testDelProduct()
	{
		/**
		 * Context : 1 reference added
		 */
		$dataProduct = new ProductData();
		$productsList = new ProductList();
		$productsList->load($dataProduct->get());

		$productId = '8411782806049';
		$amount = 3;

		$basket = new Basket($productsList);

		$basket->addProduct($productId, $amount);


		/**
		 * Test
		 */
		$succes = $basket->delProduct($productId);

		/**
		 * Should return true as success
		 */
		$this->assertSame($succes, true);

		/**
		 * Check if list item empty
		 */
		$this->assertSame(sizeof($basket->getListItems()), 0);

	}

}
