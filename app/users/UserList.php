<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Users;

class UserList
{
	/**
	 * @var User[] users list
	 */
	private $_list;

	public function __construct()
	{
		$this->_list = array();
	}

	/**
	 * Load user list from data given
	 *
	 * @param array $pListUser
	 */
	public function load(array $pListUser)
	{
		foreach ($pListUser as $id => $user)
		{
			$this->_list[$id] = new User($id, $user['name'], $user['firstname']);
		}
	}

	public function get(string $pId) : User
	{
		if(! array_key_exists($pId, $this->_list))
		{
			return(false);
		}
		return($this->_list[$pId]);
	}

	/**
	 * Return object user from name and firstname
	 *
	 * @param string $pName
	 * @param string $pFirstName
	 *
	 * @return \App\Users\User
	 * @throws \App\Users\UsertListException
	 */
	public function getUserObjectFromUserName(string $pName, string $pFirstName) : User
	{
		reset($this->_list);
		/** @var User $user */
		foreach ($this->_list as $user)
		{
			if( ($pName == $user->getName()) && ($pFirstName == $user->getFirstname()) )
			{
				return($user);
			}
		}
		throw new UsertListException('user not found');
	}

	/**
	 * @return User[]
	 */
	public function getList()
	{
		return $this->_list;
	}
}
