<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace Data;

class UserData
{
	public function __construct()
	{

	}

	/**
	 * Return users data.
	 *
	 * @return array
	 */
	public function get() : array
	{
		$users = array(
			'john'   => array(
				'firstname' => 'John',
				'name'      => 'Lennon'
			),
			'paul'   => array(
				'firstname' => 'Paul',
				'name'      => 'McCartney'
			),
			'george' => array(
				'firstname' => 'George',
				'name'      => 'Harrison'
			),
			'ringo'  => array(
				'firstname' => 'Ringo',
				'name'      => 'Starr'
			),
		);

		return($users);
	}
}