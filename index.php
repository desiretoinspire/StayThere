<?php
	session_start();
	########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
	$google_client_id 		= '';
	$google_client_secret 	= '';
	$google_redirect_url 	= ''; //path to your script
	$google_developer_key 	= '';

	########## MySql details (Replace with yours) #############
	$db_username = ""; //Database Username
	$db_password = ""; //Database Password
	$hostname = ""; //Mysql Hostname
	$db_name = ''; //Database Name
	###################################################################

	//include google api files
	require_once 'src/Google_Client.php';
	require_once 'src/contrib/Google_Oauth2Service.php';

	//start session
	if ($_SESSION["sessionstart"] <> 1){
		header('Location: ' . "http://www.staytherenitc.esy.es/homepage.php");	
}
	$gClient = new Google_Client();
	$gClient->setApplicationName('StayThere');
	$gClient->setClientId($google_client_id);
	$gClient->setClientSecret($google_client_secret);
	$gClient->setRedirectUri($google_redirect_url);
	$gClient->setDeveloperKey($google_developer_key);

	$google_oauthV2 = new Google_Oauth2Service($gClient);
	$_SESSION["gClienttoken"] = new Google_Client();
	$_SESSION["gClienttoken"] = &$gClient;
	//If user wish to log out, we just unset Session variable
	if (isset($_REQUEST['reset']))
	{
	  unset($_SESSION['token']);
	  $gClient->revokeToken();
	  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
	}
	//If code is empty, redirect user to google authentication page for code.
	//Code is required to aquire Access Token from google
	//Once we have access token, assign token to session variable
	//and we can redirect user back to page and login.
	if (isset($_GET['code'])) 
	{ 
		$gClient->authenticate($_GET['code']);
		$_SESSION['token'] = $gClient->getAccessToken();
		header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
		return;
	}


	if (isset($_SESSION['token'])) 
	{ 
		$gClient->setAccessToken($_SESSION['token']);
	}


	if ($gClient->getAccessToken())
	{
		  //For logged in user, get details from google using access token
		  $user 				= $google_oauthV2->userinfo->get();
		  //$user_id 				= $user['id'];
		  $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
		  $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
		  //$personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
		  $_SESSION['token'] 	= $gClient->getAccessToken();
	}
	else 
	{
		//For Guest user, get google login url
		$authUrl = $gClient->createAuthUrl();
	}

	//HTML page start
	echo '<!DOCTYPE HTML><html>';
	echo '<head>';
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	echo '<title>Login with Google</title>';
	echo '</head>';
	echo '<body>';
	echo '<h1>Login with Google</h1>';

	if(isset($authUrl)) //user is not logged in, show login button
	{
		echo '<a class="login" href="'.$authUrl.'"><img src="images/google-login-button.png" /></a>';
	} 
	else // user logged in 
	{
	   /* connect to database using mysqli */
		$mysqli = new mysqli($hostname, $db_username, $db_password, $db_name);
		
		if ($mysqli->connect_error) {
			die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
		}
		
		//compare user id in our database
		$user_exist = $mysqli->query("SELECT COUNT(mail) as usercount FROM user WHERE mail='$email'")->fetch_object()->usercount;
		/*$res=array();
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$res[]=$row;*/
		$obj = $mysqli->query("SELECT * FROM user WHERE mail='$email'")->fetch_object();
		//print_r($obj->role);
		if($user_exist)
		{
			$_SESSION["current_session_email"]=$email;
			if (strcmp($obj->role, "admin") == 0){
				$_SESSION['session_role'] = "admin";
		header('Location: ' . "http://staytherenitc.esy.es/AdminPage.php");}
			else {
				$_SESSION['session_role'] = "user";
		header('Location: ' . "http://staytherenitc.esy.es/UserPage.php");}
				
			//echo 'Welcome back '.$user_email.'!';
		//echo '<br /><a class="logout" href="?reset=1">Logout</a>';
		}else{
			//user is new
			/*echo 'Hi '.$user_name.', Thanks for Registering!';
			$mysqli->query("INSERT INTO user (mail, google_link, google_picture_link) 
			VALUES ($user_id, '$user_name','$email','$profile_url','$profile_image_url')");
	  */
		header('Location: ' . "?reset=1");
		//echo '<br /><div class="logout" href="?reset=1">Logout</a>';
		}
		//echo '<br /><a class="logout" href="?reset=1">Logout</a>';
		//list all user details
	}
	 
	echo '</body></html>';
	?>
