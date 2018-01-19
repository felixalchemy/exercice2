<?php
/**
 * User object definition
 */
namespace App\Users;

class User
{
	/**
	 * @var string product id.
	 */
	private $_id;

	/**
	 * @var string user name.
	 */
	private $_name;

	/**
	 * @var string user firstname.
	 */
	private $_firstname;

	/**
	 * @var bool true if user authenticate
	 */
	private $_authenticate;

	public function __construct(string $pId = '', string $pName = '', string $pFirstname = '', bool $pAuthenticate = false)
	{
		$this->_id = $pId;
		$this->_name = $pName;
		$this->_firstname = $pFirstname;
		$this->_authenticate = $pAuthenticate;
	}

	/**
	 * Load user value from php session if exist
	 *
	 * @return bool true on values session exist.
	 */
	public function loadValuesFromSession() : bool
	{
		if(isset($_SESSION['User']))
		{
			/** @var User $user */
			$user = $_SESSION['User'];

			$this->_id = $user->getId();
			$this->_name = $user->getName();
			$this->_firstname = $user->getFirstname();
			$this->_authenticate = $user->isAuthenticate();
			return(true);
		}

		return(false);
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
	public function getName() : string
	{
		return $this->_name;
	}

	/**
	 * @return string
	 */
	public function getFirstname() : string
	{
		return $this->_firstname;
	}

	/**
	 * @return boolean
	 */
	public function isAuthenticate()
	{
		return $this->_authenticate;
	}

	/**
	 * @param boolean $authenticate
	 */
	public function setAuthenticate($authenticate)
	{
		$this->_authenticate = $authenticate;
	}


}
