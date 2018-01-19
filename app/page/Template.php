<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace App\Page;

class Template
{
	const TEMPLATE_PATH = 'template';

	private $_buffer;

	public function __construct()
	{
		$this->_buffer = '';
	}

	/**
	 * Bufferize html content loaded and make replacement
	 *
	 * @param string $pTemplate
	 * @param array|null $pSearch
	 * @param array|null $pReplacement
	 *
	 * @return bool
	 */
	public function load(string $pTemplate, array $pSearch = null, array $pReplacement = null) : bool
	{
		$pathTemplate = self::TEMPLATE_PATH . DIRECTORY_SEPARATOR . $pTemplate;
		$fileSize = filesize($pathTemplate);

		if($fileSize == 0)
		{
			return(true);
		}

		try
		{
			$handleFile = fopen($pathTemplate, 'r');
			$html = fread($handleFile, filesize($pathTemplate));
			fclose($handleFile);

			if($pSearch !== null)
			{
				$html = str_replace($pSearch ,$pReplacement, $html);
			}


			$this->_buffer.= $html;
		}
		catch(\Throwable $e)
		{
			return(false);
		}

		return(true);
	}

	/**
	 * @return string
	 */
	public function getBuffer()
	{
		return $this->_buffer;
	}
}
