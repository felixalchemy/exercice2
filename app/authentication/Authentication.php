<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Authentication;

use App\Basket\Basket;
use App\Products\ProductList;
use App\Users\User;
use App\Users\UserList;
use App\Users\UsertListException;
use Data\ProductData;
use Data\UserData;

class Authentication
{
	const POST_ACTION = 'action';
	const POST_FIRSTNAME = 'firstname';
	const POST_NAME = 'name';
	const POST_ACTION_AUTH = 'auth';

	private $_userList;

	public function __construct()
	{

	}

	/**
	 * Check if authenticate POST values received
	 *
	 * @return bool true on POST values received, false otherwise
	 */
	public function isAuthenticateValuesReceived() : bool
	{
		if(! isset($_POST[self::POST_ACTION]) )
		{
			return(false);
		}

		if($_POST[self::POST_ACTION] != self::POST_ACTION_AUTH)
		{
			return(false);
		}

		if(! isset($_POST[self::POST_FIRSTNAME]) )
		{
			return(false);
		}

		if(! isset($_POST[self::POST_NAME]) )
		{
			return(false);
		}

		return(true);
	}

	/**
	 * Try to authenticate user from POST values
	 * Return JSON result to browser.
	 * On authenticate success, if session basket exist, it override basket user file
	 */
	public function registerNewUser()
	{
		$firstname = $_POST[self::POST_FIRSTNAME] ?? '';
		$name = $_POST[self::POST_NAME] ?? '';

		$dataUser = new UserData();
		$this->_userList = new UserList();
		$this->_userList->load($dataUser->get());

		try
		{
			/** @var User $user */
			$user = $this->_userList->getUserObjectFromUserName($name, $firstname);
		}
		catch(UsertListException $e)
		{
			/**
			 * Send 'authenticate failed' JSON response
			 */
			echo '{"state":false}';
			return;
		}

		/**
		 * Store user in session
		 */
		$user->setAuthenticate(true);
		$_SESSION['User'] = $user;

		/**
		 * If session basket exist, it override basket user file
		 */
		if(isset($_SESSION['Basket']))
		{
			$this->storeBasketSessionToBasketFile($user);
		}

		/**
		 * Send 'authenticate success' JSON response
		 * that will cause html page reload.
		 */
		echo '{"state":true}';
	}

	/**
	 * Store Basket session data to Basket file
	 *
	 * @param \App\Users\User $pUser
	 */
	private function storeBasketSessionToBasketFile(User $pUser)
	{
		$dataProduct = new ProductData();
		$productsList = new ProductList();
		$productsList->load($dataProduct->get());

		$basket = new Basket($productsList);
		$basket->loadFromSession();
		$basket->saveToFile($pUser);
	}
}
