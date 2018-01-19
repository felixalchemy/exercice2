<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Page\Authentication;

use App\Page\Template;

class AuthenticationView
{
	/**
	 * @var \App\Page\Template
	 */
	private $_template;

	public function __construct()
	{
		$this->_template = new Template();
	}

	public function display()
	{
		$jsLink = '<script src="res/js/aja.min.js"></script><script src="res/js/authentication.js"></script>';
		$cssLink = '<link rel="stylesheet" href="res/css/authentication.css">';

		$this->_template->load('header.html',
			array('{{js}}', '{{css}}'),
			array($jsLink, $cssLink)
		);
		$this->_template->load('authentication.html');
		$this->_template->load('footer.html');

		echo($this->_template->getBuffer());
	}
}