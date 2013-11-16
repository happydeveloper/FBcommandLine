<?php

if (($loader = require_once __DIR__ . '/vendor/autoload.php') == null)  {
  die('Vendor directory not found, Please run composer install.');
}

$facebook = new Facebook(array(
		'appId' => '541305629256667',
		'secret' => '95492b0183156cd27d69b1308980ef26',
		'cookie' => true));
// Get User ID
echo $user = $facebook->getUser();

?>
