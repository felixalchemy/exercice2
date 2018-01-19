<?php
/**
 * This file is part of Alchemy exercise 2
 */
namespace Data;

class ProductData
{
	public function __construct()
	{

	}

	/**
	 * Return product data.
	 *
	 * @return array
	 */
	public function get() : array
	{
		$products = array(
			'8411782806049' => array(
				'label' => 'MARCHEPIEDS BLEU',
				'price' => 11
			),
			'3178040637863' => array(
				'label' => 'TRIO S/GLUE3 2X1G+1G S/GLUE2X1',
				'price' => 15.3
			),
			'3086126789873' => array(
				'label' => 'BRIQUET J25 3+1 DECO J25 3+1',
				'price' => 47
			),
			'8712269126859' => array(
				'label' => 'WWF PELUCHE DE LA FORET DISPLAY',
				'price' => 23.5
			),
			'8027638022435' => array(
				'label' => 'VIOLETTA KIT MAQUILLAGE',
				'price' => 145
			),
			'8027638016410' => array(
				'label' => 'VIOLETTA V MONTRE AST',
				'price' => 56.7
			),
			'5702015345132' => array(
				'label' => 'LEGO FRIENDS DRESSAGE CHIOTS',
				'price' => 22
			),
			'5011666088658' => array(
				'label' => 'MARVEL FIGURINE SACHET MYSTERE',
				'price' => 78
			),
			'5010994804619' => array(
				'label' => 'PETSHOP SINGLE ASST B',
				'price' => 159
			),
			'4891813882442' => array(
				'label' => 'OISEAU DIGIBIRD OISEAU',
				'price' => 753
			),
			'4038033951118' => array(
				'label' => 'MAQUILLAGE DISNEY PRINCESSES',
				'price' => 69
			),
			'3700514313326' => array(
				'label' => 'MAGIC SIRENE',
				'price' => 59
			)
		);

		return ($products);
	}
}