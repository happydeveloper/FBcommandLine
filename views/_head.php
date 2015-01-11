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
	.post article .comment{
background-color:#444;color:#F0F8FF;margin-left:45px; border-bottom: 1px solid #ddd;}
	.post article .later {
		background-color: #f8c54d;
	}
	.comment {
		background-color:#444;color:#F0F8FF;margin-left:45px; border-bottom: 1px solid #ddd;}
    </style>

    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width-device-width, minimal-ui">
    <meta name="viewport" content="width=device-width, minimal-ui">
    <title> 페이스북 그룹 글 </title>
  </head>
  <body>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58453511-1', 'auto');
  ga('send', 'pageview');

</script>
