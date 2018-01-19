<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Basket;

use App\Products\ProductList;
use App\Products\ProductListException;
use Data\ProductData;
use PHPUnit\Framework\TestCase;

class BasketException extends \Exception
{
	public function __construct($pMessage, $pCode = 0, \Exception $pPrevious = null)
	{
		parent::__construct($pMessage, $pCode, $pPrevious);
	}
}