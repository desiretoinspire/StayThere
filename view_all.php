<html>
<head>
	<title>View All</title>
<link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>
<header>
<form action="http://staytherenitc.esy.es/AdminPage.php">
    <input type="submit" value="Go Back" class="backbutton"> 
</form>
</header>
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
	
	$sql = "SELECT * FROM user";
	$result = $conn->query($sql);


	if ($conn->query($sql) == TRUE) 
	{
		if ($result->num_rows > 0) 
		{
			echo '<table border="2px" class="flat-table">';
			echo "<tr><th> <b>Name</b> </th>
				<th> <b>E-mail</b> </th>
				<th> <b>Date of Birth</b> </th>
				<th> <b>Designation </b> </th>
				<th> <b>Date of Joining</b> </th>
				<th> <b>Basic pay </b> </th>
				<th> <b>Grade pay </b> </th>
				<th> <b>Quarter ID</b> </th></tr><br>";
    		
    		while($row = $result->fetch_assoc()) 
    		{
        		echo "<tr><td>" . $row["name"]. "</td>
        		<td>" . $row["mail"]. "</td><td> " . $row["dob"] ."</td>
        		<td> " . $row["designation"] ."</td>
        		<td> " . $row["doj"] ."</td><td>" . $row["basic"]. "</td>
        		<td>" . $row["grade"]. "</td><td>" . $row["quarterid"]. "</td></tr>";
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
</body>
</html>