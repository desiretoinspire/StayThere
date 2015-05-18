<?php
session_start();
if (strcmp($_SESSION['session_role'], "user") <> 0)
{
	  session_unset();
	  header('Location: ' . "http://staytherenitc.esy.es/index.php?reset=1"); //redirect user back to page
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User Page</title>
<link href="bootstrap.min.css" rel="stylesheet">
<link href="Admin Page.css" rel="stylesheet">
</head>
<body>
<div class="heading">
	<h1>USER PAGE</h1>
</div>
<ul class="navigation">
    <li class="nav-item">
    	<a href="apply_quarter.php"><button class="newquarters">APPLY FOR NEW QUARTERS</button></a>
    </li>
    <li class="nav-item">
    	<button class="contactadmin">CONTACT ADMIN</button>
    </li>
    <li class="nav-item">
    	    	<button class="">HELP</button>
    </li>
    <li class="nav-item">
    	<a href="http://staytherenitc.esy.es/index.php?reset=1"><button class="logout">LOGOUT</button>
    </li>
</ul>
<input type="checkbox" id="nav-trigger" class="nav-trigger" />
<label for="nav-trigger"></label>
<div class="hide"></div>
<div class="site-wrap">
</div>
<a class="logout" href="http://staytherenitc.esy.es/index.php?reset=1">Logout</a>
    <script src="jquery.min.js"></script>
    <script src="Admin Page.js"></script>
</body>
</html>