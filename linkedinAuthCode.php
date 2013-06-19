<?php

$auth_code = $_GET['code'];

$url = 'https://www.linkedin.com/uas/oauth2/accessToken';
$data = array('grant_type' => 'authorization_code', 'code' => $auth_code, 'redirect_uri' => 'http://beta.contactu.co/linkedinAuthCode.php', 'client_id' => 'nyvx5ricm4ew', 'client_secret' => '4g7zNA4J8UMuG6g0');
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

$obj = json_decode($result);
$access_token = $obj->{'access_token'};
print(" ACCESS TOKEN ");
print($access_token);


$url_get = 'https://api.linkedin.com/v1/people/~:(firstName,lastName)';
$data_get = array('oauth2_access_token' => $access_token);
// use key 'http' even if you send the request to https://...
$options_get = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'GET',
        'content' => http_build_query($data_get),
    ),
);
$context_get  = stream_context_create($options_get);
$result_get = file_get_contents($url_get, false, $context_get);
print(" RESULTADO GET ");
var_dump($result_get);
// header( 'https://api.linkedin.com/v1/people/~?oauth2_access_token='+$access_token ) ;
?>