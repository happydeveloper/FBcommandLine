<!DOCTYPE html>
<html lang="en">



<?php
	include 'lib/facebook.php';

	$facebook = new Facebook(array(
		'appId' => '541305629256667',
		'secret' => '95492b0183156cd27d69b1308980ef26',
		'cookie' => true));

// Get User ID

$user = $facebook->getUser();
var_dump($user);
echo $user;
if($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}
// This call will always work since we are fetching public data.
$naitik = $facebook->api('/justinchronicles');

// Graph API TEST
$get = $facebook->api('/174499879257223_661898270517379');
if($user) {
 //Create Query
    $params = array(
        'method' => 'fql.query',
        'query' => "SELECT uid, pic, pic_square, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = ".$user.")",
    );
 
    //Run Query
    $result = $facebook->api($params);
}
?>	
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width-device-width">
    <title>php-sdk</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>

<nav id="main_menu">
	<div class="wrapper">
		<ul>
			<li><a href="./ot.php">생활코딩 페이스북 그룹</a></li>
			<li><a href="./GraphAPI.php">페이스북 FQL 테스트 페이지</a></li>
			<li><a href="./index.php">내 페이스북 친구들 얼굴들</a></li>
		</ul>
	</div>
</nav>
    <?php if ($user): ?>
      <a href="<?php echo 'Logout.php';//echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>

    <?php
	if($user) {
		var_dump($get);
	}
	else {
		echo "<h2>Command Line</h2>";
	}
    ?>
  </body>

</html>
