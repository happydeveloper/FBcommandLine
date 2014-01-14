<?php
if(false) //개발중일때는 직접실행 허용 //상수로 허용
{
	exit('No direct script access allowed');
}

if (($loader = require_once __DIR__ . './../vendor/autoload.php') == null)  {
  die('Vendor directory not found, Please run composer install.');
}

$base = realpath(dirname(__FILE__) . '/..');
require_once "$base/classes/fqlmanager.php";
require_once "$base/classes/basetaskfacebook.php";
?>
