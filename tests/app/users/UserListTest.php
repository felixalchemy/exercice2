<?php

namespace Tests\App\Users;

use App\Users\User;
use App\Users\UserList;
use App\Users\UsertListException;
use Data\UserData;
use PHPUnit\Framework\TestCase;

class UserListTest extends TestCase
{
	public function testGetIdFromUserName_ValidRequest_ShouldReturn_ExpectedValues()
	{
		/**
		 * Context :
		 * - name : Lennon
		 * - firstname : john
		 */
		$dataUser = new UserData();
		$userList = new UserList();
		$userList->load($dataUser->get());
		$userList->getList();

		$id = 'john';
		$name = 'Lennon';
		$firstname = 'John';

		$userExpected = new User($id, $name, $firstname);

		/**
		 * Test
		 */

		$user = $userList->getUserObjectFromUserName($name, $firstname);

		$this->assertEquals($user, $userExpected);
	}

	public function testGetIdFromUserName_BadRequest_ShouldProduceException()
	{
		/**
		 * Context :
		 * - name : Jackson
		 * - firstname : Mickael
		 */
		$dataUser = new UserData();
		$userList = new UserList();
		$userList->load($dataUser->get());
		$userList->getList();

		$name = 'Jackson';
		$firstname = 'Mickael';

		/**
		 * Test
		 */
		$this->expectException(UsertListException::class);
		$id = $userList->getUserObjectFromUserName($name, $firstname);
	}
}

