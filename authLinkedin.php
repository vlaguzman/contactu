<?php
// Change these
define('API_KEY',      'nyvx5ricm4ew'                            );
define('API_SECRET',   '4g7zNA4J8UMuG6g0'                        );
define('REDIRECT_URI', 'http://beta.contactu.co/authLinkedin.php');
define('SCOPE',        'r_fullprofile r_emailaddress r_contactinfo');
define('STATE',        'YCEEFWF45453sdffef424'                   );


// You'll probably use a database
session_name('linkedin');
session_start();

// OAuth 2 Control Flow
if (isset($_GET['error'])) {
	// LinkedIn returned an error
	print $_GET['error'] . ': ' . $_GET['error_description'];
	exit;
} elseif (isset($_GET['code'])) {
	// User authorized your application
	//if ($_SESSION['state'] == $_GET['state']) {
	if (STATE == $_GET['state']) {	
		// Get token so you can make API calls
		getAccessToken();
	} else {
		print("error");
		exit;
	}
} else { 
	if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
		// Token has expired, clear the state
		$_SESSION = array();
	}
	if (empty($_SESSION['access_token'])) {
		// Start authorization process
		getAuthorizationCode();
	}
}

// Congratulations! You have a valid token. Now fetch your profile 
$user = fetch('GET', '/v1/people/~:(firstName,lastName,industry,emailAddress,pictureUrl,primaryTwitterAccount)');
$twitter = $user->primaryTwitterAccount->providerAccountName;
$fname = $user->firstName;
$lname = $user->lastName; 
$industry = $user->industry; 
$email = $user->emailAddress; 
$photo = $user->pictureUrl;

	$params = array('twitter' => $twitter,
					'fname' => $fname,
					'lname' => $lname,
					'industry' => $industry, // unique long string
					'email' => $email,
					'photo' => $photo,
			  );

	// Authentication request
	$url = 'http://beta.contactu.co?' . http_build_query($params);

echo "<script language='javascript'>window.location='$url'</script>;";
exit;

function getAuthorizationCode() {
	$params = array('response_type' => 'code',
					'client_id' => API_KEY,
					'scope' => SCOPE,
					'state' => uniqid('', true), // unique long string
					'redirect_uri' => REDIRECT_URI,
			  );

	// Authentication request
	$url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
	
	// Needed to identify request when it returns to us
	$_SESSION['state'] = $params['state'];

	// Redirect user to authenticate
	header("Location: $url");
	exit;
}
	
function getAccessToken() {

/*
	$params = array('grant_type' => 'authorization_code',
					'client_id' => API_KEY,
					'client_secret' => API_SECRET,
					'code' => $_GET['code'],
					'redirect_uri' => REDIRECT_URI,
			  );
	
	// Access Token request
	$url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
	
	// Tell streams to make a POST request
	$context = stream_context_create(
					array('http' => 
						array('method' => 'POST',
	                    )
	                )
	            );

	// Retrieve access token information
	$response = file_get_contents($url, false, $context);

	// Native PHP object, please
	$token = json_decode($response);
	*/
	$url = 'https://www.linkedin.com/uas/oauth2/accessToken';
	$data = array('grant_type' => 'authorization_code', 
				  'code' => $_GET['code'], 
				  'redirect_uri' => REDIRECT_URI, 
				  'client_id' => API_KEY, 
				  'client_secret' => API_SECRET);
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

	$token = json_decode($result);

	// Store access token and expiration time
	$_SESSION['access_token'] = $token->access_token; // guard this! 
	$_SESSION['expires_in']   = $token->expires_in; // relative time (in seconds)
	$_SESSION['expires_at']   = time() + $_SESSION['expires_in']; // absolute time
	
	return true;
}

function fetch($method, $resource, $body = '') {
	$params = array('oauth2_access_token' => $_SESSION['access_token'],
					'format' => 'json',
			  );
	
	// Need to use HTTPS
	$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
	// Tell streams to make a (GET, POST, PUT, or DELETE) request
	$context = stream_context_create(
					array('http' => 
						array('method' => $method,
	                    )
	                )
	            );


	// Hocus Pocus
	$response = file_get_contents($url, false, $context);

	// Native PHP object, please
	return json_decode($response);
}
?>