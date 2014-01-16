<!DOCTYPE html>
<html lang="en">
<?php

if (($loader = require_once 'vendor/autoload.php') == null)  {
  die('Vendor directory not found, Please run composer install.');
}

?>	
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    
    <style>
	.post {list-style:none;}
	.post article {background-color:#eee;}
	.post article .message {background-color:#EDEFF4;padding:4px;margin-top:1px;margin-left:30px;}
	.post article .comment{background-color:#f5f5f5;margin-left:40px;}
    </style>

    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width-device-width">
    <title> 페이스북 그룹 글 </title>
  </head>
  <body>
