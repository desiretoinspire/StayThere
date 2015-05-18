<html>
<title>Apply for Quarter</title>
<link rel="stylesheet" type="text/css" href="forms.css">
<body>
<?php

require 'connect_user.php';

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

session_start();

	$sql = "SELECT * FROM ads";
	
	$result = $conn->query($sql);


	if ($conn->query($sql) == TRUE) 
	{
    	echo '<table border="2px">';

		echo "<tr><td> <b>Quarter ID</b> </td>
				<td> <b>Deadline</b> </td></tr><br>";

		if ($result->num_rows > 0) 
		{
    		while($row = $result->fetch_assoc()) 
    		{
        		echo "<tr><td>" . $row["quarterid"]. "</td>
        		<td>" . $row["duedate"]. "</td></tr>";
    		}
    		echo "</table>";
		}

		else
		{
    		echo "0 entries";
		}
	} 
	else 
	{
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}


if(isset($_POST["apply"]))
{
	$quarterid = $_POST["quarterid"];

	$sql = "SELECT name,mail,dob,designation,doj,basic,grade FROM user 
	WHERE mail = '$_SESSION[mail]'";

	$result = $conn->query($sql);
	
	if ($conn->query($sql) == TRUE) 
	{
    	echo "";
    	$row = $result->fetch_assoc();
	} 
	else 
	{
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$sql2 = "INSERT INTO $quarterid (name,mail,dob,designation,doj,basic,grade)
	VALUES ('$row[name]','$row[mail]','$row[dob]','$row[designation]','$row[doj]','$row[basic]','$row[grade]')";

	$result = $conn->query($sql2);
	echo "applied for " .$quarterid;
	/*
	if ($conn->query($sql2) == TRUE) 
	{
    	echo "applied";
	} 
	else 
	{
    	echo "Error: " . $sql2 . "<br>" . $conn->error;
	}*/
}
else
{
	$mail = $_SESSION["current_session_email"];
	$_SESSION["mail"]=$mail;
}

$conn->close();
?>
<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" id="updateuser" class="smart-green">
<h1>Apply for Quarter
<span>Please fill all the texts in the fields</span></h1>
<label>
<span>Quarter ID :</span>
<input type="text" name="quarterid">
</label>
<br>
<br>
<label>
<span>&nbsp;</span>
<input type=submit name="apply" class="button" value="Apply">
</label>
</form>
</body>
</html>