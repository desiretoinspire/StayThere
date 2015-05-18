<?php

require 'connect.php';

$mail = $_POST["mail"];

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
else
{

	$sql = "DELETE FROM user WHERE mail = '$mail'";

	if ($conn->query($sql) === TRUE) 
	{
    	echo "<h3>successful</h3><br>";
	} 
	else 
	{
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

$conn->close();
	header('Location: ' . "http://staytherenitc.esy.es/AdminPage.php");
?>