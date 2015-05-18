</p>
<?php
 function login(){
 session_start();
 $this->lib_include();
 $api = new Google_Client();
 $api->setApplicationName("InfoTuts");
 $api->setClientId('339205709123-oc6o7slpkoteuad3dffk8uhre4uh4if4.apps.googleusercontent.com');
 $api->setClientSecret('_aa6nFMVac04gq6RWNyf1wV4');
 $api->setAccessType('online');
 $api->setScopes(array('https://www.googleapis.com/auth/plus.login', 'https://www.googleapis.com/auth/plus.me', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'));
 $api->setRedirectUri('http://www.athena.nitc.ac.in/francis_b120459cs/AdminPage.html');
 $service = new Google_PlusService($api);
 $oauth2 = new Google_Oauth2Service($api);
 $api->authenticate();
 $_SESSION['token'] = $api->getAccessToken();
 if (isset($_SESSION['token'])) {
 $set_asess_token = $api->setAccessToken($_SESSION['token']);
 }
 if ($api->getAccessToken()) {
 $data = $service->people->get('me');
 $user_data = $oauth2->userinfo->get();
 }}
?>
<p style="text-align: justify;">
