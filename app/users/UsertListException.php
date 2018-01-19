<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Users;

class UsertListException extends \Exception
{
	public function __construct($pMessage, $pCode = 0, \Exception $pPrevious = null)
	{
		parent::__construct($pMessage, $pCode, $pPrevious);
	}
}