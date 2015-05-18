<!doctype html>
<html>
<head>
<title>Update Quarter</title>
<link rel="stylesheet" type="text/css" href="forms.css"> 
</head>
<body>

<header>
<form action="http://staytherenitc.esy.es/AdminPage.php">
    <input type="submit" value="Go Back" class="backbutton"> 
</form>
</header>
<br>
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

if(isset($_POST["update"]))
{
	$plinth = $_POST["plinth"];

	$status = $_POST["status"];

	$sql = "UPDATE quarter SET plinth='$plinth',status='$status'
	WHERE qid='$_SESSION[qid]'";
	
	if ($conn->query($sql) === TRUE) 
	{
    	echo "<h3>successfully updated</h3><br>";
		header('Location: ' . "http://staytherenitc.esy.es/AdminPage.php");
	} 
	else 
	{
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	//destroy the session
	//session_destroy();

	die();
}
else
{
	$qid = $_POST["qid"];
	
	$_SESSION["qid"]=$qid;

	$sql = "SELECT qid,plinth,status
			FROM quarter WHERE qid = '$qid'";
	
	$result = $conn->query($sql);


	if ($conn->query($sql) == TRUE) 
	{
		if ($result->num_rows > 0) 
		{
			echo '<table border="2px" class="flat-table">';
				echo "<tr><th> <b>quarter ID</b> </th>
				<th> <b>Plinth Area</b> </th>
				<th> <b>Current Status </b> </th></tr><br>";
    		while($row = $result->fetch_assoc()) 
    		{
    			$qid=$row["qid"];
    			$plinth=$row["plinth"];
				$status=$row["status"];
        		echo "<tr><td>" . $row["qid"]. "</td><td>" . $row["plinth"]. "</td>
        		<td>" . $row["status"]. "</td></tr>";
    		}
    		echo "</table><br>";
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

<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" id="updatequarter"class="smart-green">
<h1>Update Quarter Details
<span>Please fill all the texts in the fields</span></h1>
<label>
<span>Plinth Area :</span>
<input type="text" name="plinth" value="<?php echo $plinth ?>">
</label>
<label>
<span>Current Status :</span>
<select name="status">
	<option value="<?php echo $status ?>"><?php echo $status ?></option>
	<option value="vacant">Vacant</option>
    <option value="advertised">Adverised</option>
    <option value="allocated">Allocated</option>
    <option value="occupycancel">Occupy/Cancel</option>
	<option value="occupied">Occupied</option>
	<option value="vacantpending">Vacant-Pending</option>
</select>
</label>
<br><br>
<label>
<span>&nbsp;</span>
<input type=submit class="button" name="update" value="Update Quarter">
</label>
</form>
</body>
</html>