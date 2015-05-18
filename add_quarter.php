<!doctype html>
<html>
<head>
<title>Add Quarter</title>
<link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>
<?php
	$qidErr = $areaErr = $statusErr = "";
?>
<header>
<form action="http://staytherenitc.esy.es/AdminPage.php">
    <input type="submit" value="Go Back" class="backbutton"> 
</form>
</header>
<br>
<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" id="addquarter" class="smart-green">
  <h1>Add New Quarter <span>* required field</span></h1>
  <label>
<span>Quarter ID :</span>
<span class="error">* <?php echo $qidErr;?></span>
<input type="text" name="qid" placeholder="quarter id in capitals">
</label>

<label>
<span>Plinth Area :</span>
<span class="error">* <?php echo $areaErr;?></span>
<input type="text" name="plinth" placeholder="plint area in sq.m">
</label>

<label>
<span>Current Status :</span>
<span class="error">* <?php echo $statusErr;?></span>
<select name="status">
	<option> -- status -- </option>
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
<input type=submit class="button" value="Add Quarter" name="addq">
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
	if(isset($_POST["addq"]))
	{
		$qid = $_POST["qid"];
		$plinth = $_POST["plinth"];
		$status = $_POST["status"];
	
		$sql = "INSERT INTO quarter (qid,plinth,status)
		VALUES ('$qid','$plinth','$status')";

		if ($conn->query($sql) === TRUE) 
		{
    		$message = "New Quarter $qid Added";
    		echo "<script type='text/javascript'>alert('$message');</script>";
		} 
		else 
		{
	    	$message = "ERROR : Quarter $qid Not Added";
    		echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
}
$conn->close();
?>