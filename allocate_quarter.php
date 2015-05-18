<html>
<head>
<title>Allocate Quarter</title>
<link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>
<header>
<form action="http://staytherenitc.esy.es/AdminPage.php">
    <input type="submit" value="Go Back" class="backbutton"> 
</form>
</header>
<br>
<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" id="updateuser" class="smart-green">
<h1>Allocate Quarter
<span>Please fill all the texts in the fields</span></h1>
<label>
<span> Quarter ID : </span>
<br><input type="text" name="quarterid">
</label>
<br>
<br>
<label>
<span>&nbsp;</span>
<input type=submit name="check" class="button" value="Check">
</label>
</form>
<?php

require 'connect.php';

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

session_start();

	$sql = "SELECT * FROM ads";
	
	$result = $conn->query($sql);

	if ($conn->query($sql) == TRUE) 
	{
    	echo '<table border="2px" class="flat-table">';

		echo "<tr><th> <b>Quarter ID</b> </th>
				<th> <b>Deadline</b> </th></tr><br>";

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

	$sql = "SELECT name,mail,age,doj,basic,grade FROM user 
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
	
	$sql2 = "INSERT INTO $quarterid (name,mail,age,doj,basic,grade)
	VALUES ('$row[name]','$row[mail]','$row[age]','$row[doj]','$row[basic]','$row[grade]')";

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
else if(isset($_POST["allocate"]))
{
	$mail = $_POST["mail"];

	$quarterid = $_POST["quarterid"];

	$sql = "UPDATE user SET quarterid='$quarterid' WHERE mail = '$mail'";

	$result = $conn->query($sql);
	
	if ($conn->query($sql) == TRUE) 
	{	
		echo "allocated";
		$msg = "You have been allocated" . $quarterid .".";
		mail($mail,"Quarter Allocated",$msg);
	}
}
else if (isset($_POST["check"]))
{
	$quarterid = $_POST["quarterid"];
	
	$_SESSION["quarterid"]=$quarterid;

	$sql = "SELECT mail,name,grade,doj,dob FROM $quarterid ORDER BY grade DESC,doj ASC,dob ASC";
	
	$result = $conn->query($sql);

	$flag=0;

	if ($conn->query($sql) == TRUE) 
	{
    	echo '<table border="2px" class="flat-table">';

    	echo "<tr><th colspan=4>$quarterid<td></tr><br>";
		echo "<tr><th> <b>Name</b> </th>
		<th> <b>Grade Pay</b> </th>
	<th> <b>date of Joining</b> </th>
		<th> <b>date of birth</b> </th></tr><br>";
		if ($result->num_rows > 0) 
		{
    		while($row = $result->fetch_assoc()) 
    		{
    			if($flag==0)
    			{
    				$flag = 1;
    				$allotte = $row["mail"];
    			}

        		echo "<tr><td>" . $row["name"]. "</td>
        		<td>" . $row["grade"]. "</td>
        		<td>" . $row["doj"]. "</td>
        		<td>" . $row["dob"]. "</td></tr>";
    		}
    		echo "</table>";

    		?>

    	<form action="allocate_quarter.php" class="smart-green" method="post">
    		<input type="hidden"  value="<?php echo $quarterid ?>" name="quarterid">
			<input type="hidden"  value="<?php echo $allotte ?>" name="mail">
			<input type="submit" value="allocate" name="allocate" class="button">
		</form>

    <?php		
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

}

$conn->close();
?>
</body>
</html>