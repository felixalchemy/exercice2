<?php
/**
 * Alchemy exercice 2
 */

/**
 * @var int $alchemyOption
 *
 * 1 : Imposer à l’utilisateur de s’identifier à l’entrée sur le site, son panier est conservé
 * quel que soit le poste de consultation.
 *
 * 2 : Permettre de remplir un panier sans être identifié, mais demander une identification
 * au moment de payer. Le panier est alors conservé pour l’utilisateur comme dans l’option 1.
 */
$alchemyOption = 1;

require('vendor/autoload.php');

$router = new \App\Router\Router($alchemyOption);
$router->load($_SERVER['QUERY_STRING']);
