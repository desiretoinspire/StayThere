<!doctype html>
<html>
<head>
<title>Remove Advertisement</title>
<link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>
<header>
<form action="http://staytherenitc.esy.es/AdminPage.php">
    <input type="submit" value="Go Back" class="backbutton"> 
</form>
</header>
<br>
<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" id="removead" class="smart-green">
<h1>Remove Advertisement
<span>Please fill all the texts in the fields</span></h1>
<label>
<span>Quarter ID :</span>
<input type="text" name="quarterid"/><br>
</label>
<br>
<label>
<span>&nbsp;</span>
<input type=submit class="button" value="Remove Advertisement" name="removead">
</label>
</form>

</body>
</html>

<?php

require 'connect.php';

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
else
{
	if(isset($_POST["removead"]))
	{
		$quarterid = $_POST["quarterid"];

		$sql = "DELETE FROM ads WHERE quarterid = '$quarterid'";

		$result1 =$conn->query($sql);

		$sql = "DROP TABLE $quarterid";

		$result2 =$conn->query($sql);

		if ($result1 == TRUE && $result2 == TRUE )
		{	
	    	$message = "Advertisement of $quarterid Removed";
    		echo "<script type='text/javascript'>alert('$message');</script>";
		} 
		else 
		{
	    	$message = "ERROR : $quarterid was not Advertised";
    		echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
}

$conn->close();
?>