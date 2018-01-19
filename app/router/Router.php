<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Router;

use App\Authentication\Authentication;
use App\Basket\Basket;
use App\Page\Authentication\AuthenticationController;
use App\Page\CheckOut\CheckoutController;
use App\Page\Shop\ShopController;
use App\Users\User;

class Router
{
	const CHECKOUT_QUERY = 'checkout';
	const LOGOUT_QUERY = 'logout';

	/** @var int */
	private $_alchemyOption;

	/** @var \App\Authentication\Authentication */
	private $_authentication;

	/** @var User */
	private $_user;

	public function __construct(int $pAlchemyOption)
	{
		$this->_alchemyOption = $pAlchemyOption;
		$this->_authentication = new Authentication();
		$this->_user = new User();
	}

	/**
	 * Initialize PHP session
	 */
	private function startSession()
	{
		$cookieLifeTime = time()+(3600*3/*nbHeures*/);
		$cookiePath = '/';
		$cookieDomain = $_SERVER['HTTP_HOST'];
		$cookieSecure = isset($_SERVER["HTTPS"]);

		session_name('sid');
		session_set_cookie_params($cookieLifeTime, $cookiePath, $cookieDomain, $cookieSecure, true);
		session_start();
	}

	/**
	 * Destroy session and back to homepage
	 */
	private function logout()
	{
		unset($_SESSION['User']);
		unset($_SESSION['Basket']);
		header('Location: ./');
		exit();
	}

	/**
	 * Router.
	 *
	 * - Initialize session.
	 * - Initialize objects from session values.
	 * - Manage authentication.
	 * - Route controller from server query string.
	 *
	 * @param string $pQueryString
	 */
	public function load(string $pQueryString)
	{
		$this->startSession();

		if($this->_authentication->isAuthenticateValuesReceived())
		{
			$this->_authentication->registerNewUser();
			exit();
		}

		/**
		 * Load user values from php session
		 */
		$this->_user->loadValuesFromSession();

		switch ($pQueryString)
		{
			case self::LOGOUT_QUERY :
				$this->logout();

				break;

			case self::CHECKOUT_QUERY :
				if($this->_alchemyOption == 1)
				{
					/**
					 * Load Checkout controller
					 */
					new CheckoutController();
				}
				else
				{
					/**
					 * Load Authentification controller
					 */
					if($this->_user->isAuthenticate())
					{
						/**
						 * Load Checkout controller
						 */
						new CheckoutController();
					}
					else
					{
						/**
						 * Load Authentification controller
						 */
						new AuthenticationController();
					}
				}
				break;

			default :
				if($this->_alchemyOption == 1)
				{
					if($this->_user->isAuthenticate())
					{
						/**
						 * Load Shop controller
						 */
						new ShopController($this->_user);
					}
					else
					{
						/**
						 * Load Authentification controller
						 */
						new AuthenticationController();
					}
				}
				else
				{
					/**
					 * Load Shop controller
					 */
					new ShopController($this->_user);
				}
		}
	}
}
