<?php
session_start();
$servername = "";
$username = "";
$password = "";
$dbname = "";

if (strcmp($_SESSION['session_role'], "user") <> 0)
{
	  session_unset();
	  header('Location: ' . "http://staytherenitc.esy.es/index.php?reset=1"); //redirect user back to page
}
?>
