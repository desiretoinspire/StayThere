<!doctype html>
<html>
<head>
<title>View Current Quarter</title>
<link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>

<header>
<form action="http://staytherenitc.esy.es/AdminPage.php">
    <input type="submit" value="Go Back" class="backbutton"> 
</form>
</header>
<br>

<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" id="viewcurrentquarter" class="smart-green">
<h1>View Current Quarter
<span>Please fill all the texts in the fields</span></h1>
<label>
<span>Nitc mail-id :</span>
<input type="text" name="mail" placeholder="nitc mail id">
</label>
<br>
<label>
<span>&nbsp;</span>
<input type=submit class="button" name="viewqrt" value="View Current Quarter">
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
if(isset($_POST["viewqrt"]))
{
	$mail = $_POST["mail"];
	
	$sql = "SELECT name,quarterid
	FROM user WHERE mail = '$mail'";
	$result = $conn->query($sql);


	if ($conn->query($sql) == TRUE) 
	{
		if ($result->num_rows > 0) 
		{
			echo '<table border="2px" class="flat-table">';
			echo "<tr><th> <b>Name</b> </th>
			<th> <b>Quarter ID </b> </th></tr><br>";
    		
    		while($row = $result->fetch_assoc()) 
    		{
        		echo "<tr><td>" . $row["name"]. "</td>
        		<td>" . $row["quarterid"]. "</td></tr>";
    		}
    		echo "</table>";
		}
		else
		{
    		echo "<h1 class=\"smart-green\">No entries<h1>";
		}
	} 
	else 
	{
    	$message = "ERROR : Try Again";
    	echo "<script type='text/javascript'>alert('$message');</script>";
	}
}
$conn->close();

?>