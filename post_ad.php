<!doctype html>
<html>
<head>
<title>Post Advertisement</title>
<link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>
<header>
<form action="http://staytherenitc.esy.es/AdminPage.php">
    <input type="submit" value="Go Back" class="backbutton"> 
</form>
</header>
<br>

<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" id="postad" class="smart-green">
<h1>Post New Advertisement
<span>Please fill all the texts in the fields</span></h1>
<label>
<span>Quarter ID :</span>
<input type="text" name="quarterid"/>
</label>
<label>
<span>Quarter ID :</span>
</label>
<br><br>
<label>
<select name="month" class="dd">
	<option> - Month - </option>
	<option value="1">January</option>
	<option value="2">Febuary</option>
	<option value="3">March</option>
	<option value="4">April</option>
	<option value="5">May</option>
	<option value="6">June</option>
	<option value="7">July</option>
	<option value="8">August</option>
	<option value="9">September</option>
	<option value="10">October</option>
	<option value="11">November</option>
	<option value="12">December</option>
</select>
</label>
<label>
<select name="day" class="dd">
	<option> - Day - </option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
</select>
</label>
<label>
<select name="year" class="dd">
	<option> - Year - </option>
	<option value="2015">2015</option>
	<option value="2016">2016</option>
	<option value="2017">2017</option>
	<option value="2018">2018</option>
	<option value="2019">2019</option>
	<option value="2020">2020</option>
	<option value="2021">2021</option>
	<option value="2022">2022</option>
	<option value="2023">2023</option>
	<option value="2024">2024</option>
</select>
</label>
<br>
<br>
<label>
<span>&nbsp;</span>
<input type=submit class="button" value="Post Advertisement" name="postad">
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
	if(isset($_POST["postad"]))
	{
		$quarterid = $_POST["quarterid"];
		$duedate = $_POST['year']."-". $_POST['month']."-".$_POST['day'];
		
		$sql = "INSERT INTO ads (quarterid,duedate)
		VALUES ('$quarterid','$duedate')";

		$result = $conn->query($sql);

		if ($result == TRUE) 
		{		    
		    $sql1 = "CREATE TABLE $quarterid (
			name VARCHAR(50),
			mail VARCHAR(50) PRIMARY KEY NOT NULL,
			dob DATE,
			designation VARCHAR(50),
			doj DATE,
			basic int(11),
			grade int(11)
			)";

			$result = $conn->query($sql1);

			if($result == TRUE)
			{
				$message = "$quarterid Advertised";
    			echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else
			{
				echo "Error: " . $sql1 . "<br>" . $conn->error;
			}
		} 
		else 
		{
	    	echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}

$conn->close();
?>