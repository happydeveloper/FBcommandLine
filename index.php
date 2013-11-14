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
    <title>fbCommandLine</title>
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
<?php
	include_once 'include/nav.php';
?>

    <?php if ($user): ?>
      <a href="<?php echo 'common/logout.php';//echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        <a href="<?php echo $loginUrl; ?>">얼굴책 들어가기</a>
	<!-- <a href="<?php echo $loginUrl; ?>">Login with Facebook</a> -->
      </div>
    <?php endif ?>

    <?php
	if($user) {
	foreach($result as $row){
			foreach($row as $key=>$value){
				if($key == 'pic') {
				//echo $key . " : " . $value . " </br>";
					echo "<img src='". $value."' />";
				}
			}
 
	}
	}
	else {
		echo "<h2>얼굴책 명령어 라인</h2>";
	}
    ?>
  </body>

</html>
