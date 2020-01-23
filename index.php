<!DOCTYPE html>
<html>
<head>
  <title>
    My Name 
  </title>
</head>

<body>
  <h1>Get My Name from Facebook</h1>

<?php

require_once __DIR__ . '/vendor/autoload.php';   

$fb = new \Facebook\Facebook([
  'app_id' => '187124949355240',           //Replace {your-app-id} with your app ID
  'app_secret' => 'b706108eac776ec5aa90e3ca0e34f09a',   //Replace {your-app-secret} with your app secret
  'graph_api_version' => 'v5.0',
]);


try {
   
// Get your UserNode object, replace {access-token} with your token
  $response = $fb->get('/me', $fb.default_ 'EAACqMGwiiugBADM66mxRNvf6nec8hukdfzfr2DqJrB3lnYZAaM7Tght2Hy58IMZBFRskt5CHZBbvhQir26FvL1jxYj8ZCZBTsbn9QpcugbE6YXSKg7WOsfjviFRyQgEMBwQIdAo2sexe87b0piNwg6uQGh0PGG1BsnLLw9XURwRNCgWYhZA4eQ31ZCpR2suy54xE8zClAEDNl42IHbS8JZCO4S345aGq7ZC2a2LU4jg6xgJvENOeEJp0d');

} catch(\Facebook\Exceptions\FacebookResponseException $e) {
        // Returns Graph API errors when they occur
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
        // Returns SDK errors when validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();

       //All that is returned in the response
echo 'All the data returned from the Facebook server: ' . $me;

       //Print out my name
echo 'My name is ' . $me->getName();

?>

</body>
</html>