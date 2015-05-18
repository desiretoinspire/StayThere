<html>
<body>
<?php

require 'connect.php';

$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["verify"])||isset($_POST["remove"]))
{
	$name = $_POST["name"];

	$mail = $_POST["mail"];

	$age = $_POST["age"];

	$date = $_POST['year']."-". $_POST['month']."-".$_POST['day'];

	$basic = $_POST["basic"];

	$grade = $_POST["grade"];

	if ($age < 0)
	{
		echo "<h1>Invalid input: Age</h1>";
	}
	else
	{
		if(isset($_POST["verify"]))
		{
			$sql = "INSERT INTO user (name,mail, age,doj,basic,grade)
			VALUES ('$name','$mail','$age','$date','$basic','$grade')";
	
			if ($conn->query($sql) === TRUE) 
			{
    			echo "<h3>Verified</h3><br>";
			} 
			else 
			{
    			echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}

		$sql = "DELETE FROM temp_user WHERE mail = '$mail'";
	
		if ($conn->query($sql) === TRUE) 
		{
    		if(!isset($_POST["verify"]))
    			echo "<h3>Removed</h3><br>";
		} 
		else 
		{
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}	

	$sql = "SELECT name,mail,age,doj,basic,grade
			FROM temp_user";
	
	$result = $conn->query($sql);

	if ($conn->query($sql) == TRUE) 
	{

		$i=1;

		if ($result->num_rows > 0) 
		{
    		echo '<table border="2px">';
			echo "<tr><td> <b>Name</b> </td>
				<td> <b>Mail</b> </td>
				<td> <b>Age </b> </td>
				<td> <b>doj </b> </td>
				<td> <b>Basic pay </b> </td>
				<td> <b>Grade pay </b> </td></tr><br>";
    		
    		while($row = $result->fetch_assoc()) 
    		{
    			if($i==1)
    			{
    				$name=$row["name"];
    				$mail=$row["mail"];
    				$age=$row["age"];
    				$basic=$row["basic"];
    				$grade=$row["grade"];
    				$doj=$row["doj"];
    				$time=strtotime($doj);
    				$day=date("j",$time);
					$month=date("F",$time);
					$year=date("Y",$time);
					$i=0;
				}
        		echo "<tr><td>" . $row["name"]. "</td><td>" . $row["mail"]. "</td>
        		<td> " . $row["age"] ."</td><td> " . $row["doj"] ."</td>
        		<td>" . $row["basic"]. "</td><td>" . $row["grade"]. "</td></tr>";
    		}
    		echo "</table>";
		}

		else
		{
    		echo "Verification Complete";
    		die();
		}
	} 
	else 
	{
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

$conn->close();
?>
<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" id="updateuser">
<fieldset>
<legend>Verify User details</legend>
<center><b>
Name <br><input type="text" name="name" value="<?php echo $name ?>"><br>
Mail<br><input type="text" name="mail" value=<?php echo $mail ?>><br>
Age<br><input type="text" name="age" value=<?php echo $age ?>><br>
Date of Joining<br>
<select name="month">>
	<option value="<?php echo date("n",$time); ?>"><?php echo $month ?></option>
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

<select name="day" >
	<option value="<?php echo $day ?>"><?php echo $day ?></option>
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

<select name="year">
	<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
	<option value="2029">2029</option>
	<option value="2028">2028</option>
	<option value="2027">2027</option>
	<option value="2026">2026</option>
	<option value="2025">2025</option>
	<option value="2020">2020</option>
	<option value="2019">2019</option>
	<option value="2018">2018</option>
	<option value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>
	<option value="2011">2011</option>
	<option value="2010">2010</option>
	<option value="2009">2009</option>
	<option value="2008">2008</option>
	<option value="2007">2007</option>
	<option value="2006">2006</option>
	<option value="2005">2005</option>
	<option value="2004">2004</option>
	<option value="2003">2003</option>
	<option value="2002">2002</option>
	<option value="2001">2001</option>
	<option value="2000">2000</option>
	<option value="1999">1999</option>
	<option value="1998">1998</option>
	<option value="1997">1997</option>
	<option value="1996">1996</option>
	<option value="1995">1995</option>
	<option value="1994">1994</option>
	<option value="1993">1993</option>
	<option value="1992">1992</option>
	<option value="1991">1991</option>
	<option value="1990">1990</option>
	
</select><br>
Basic Pay<br><input type="text" name="basic" value=<?php echo $basic ?>><br>
Grade Pay<br><input type="text" name="grade" value=<?php echo $grade ?>><br>
<br>

<input type=submit name="verify" value="Verify">
<input type=submit name="remove" value="Remove">
</b>
</fieldset>
</form>
</body>
</html>