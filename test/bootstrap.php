<?php
$base = realpath(dirname(__FILE__) . '/..');

/**
* Genearal 영역
*/
require_once "$base/classes/fqlmanager.php";
require_once "$base/classes/basetaskfacebook.php";
require_once "$base/classes/comment.php";
require_once "$base/classes/measure.php";

//db 연결 담당
require_once "$base/classes/library_my.php";

//require_once "$base/classes/appSetting.php";
//Facebook API 연결부분클래스
require_once "$base/classes/streamfactory.php";

require_once "$base/classes/appsetting.php";
/**
* 업무 영역
*/
require_once "$base/classes/engfordev.php";
require_once "$base/classes/codingeverybody.php";
require_once "$base/classes/codingeverybodyintodb.php";
//require_once "$base/classes/codingeverybodyfilter.php";
