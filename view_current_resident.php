<!doctype html>
<html>
<head>
<title>View Current Resident</title>
<link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>

<header>
<form action="http://staytherenitc.esy.es/AdminPage.php">
    <input type="submit" value="Go Back" class="backbutton"> 
</form>
</header>
<br>

<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" id="viewcurrentresident" class="smart-green">
<h1>View Current Resident
<span>Please fill all the texts in the fields</span></h1>
<label>
<span>Quarter ID :</span>
<input type="text" name="quarterid"><br>
</label>
<br>
<label>
<span>&nbsp;</span>
<input type=submit class="button" name="viewres" value="View Current Resident">
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
if(isset($_POST["viewres"]))
{
	$quarterid = $_POST["quarterid"];
	
	$sql = "SELECT name
	FROM user WHERE quarterid = '$quarterid'";
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
        		<td>" . $quarterid. "</td></tr>";
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
