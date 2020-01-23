
<?php
// Pass session data over. Only needed if not already passed by another script like WordPress.
// 세선 시작. 
//session_start();
if(!session_id()) {
    session_start();
}

// Include the required dependencies.
// 의존성 추가
require_once( 'vendor/autoload.php' );

// Initialize the Facebook PHP SDK v5. 
// 초기화 - 페이스북앱 FS - Test1
$fb = new Facebook\Facebook([
    'app_id'                => '187124949355240',
    'app_secret'            => 'b706108eac776ec5aa90e3ca0e34f09a',
    'default_graph_version' => 'v5.0',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email', 'user_posts']; // Optional permissions
$callback_url = 'http://localhost:8080/fb-callback.php';
$loginUrl = $helper->getLoginUrl($callback_url, $permissions);
 
echo '<a href="' . $loginUrl . '">로그인 Facebook!</a>';
