<html>
<head>
<title>Update User</title>
<link rel="stylesheet" type="text/css" href="forms.css">
</head>
<body>
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
	$name = $_POST["name"];

	//$mail = $_POST["mail"];

	$doj = $_POST['dojyear']."-". $_POST['dojmonth']."-".$_POST['dojday'];

	$dob = $_POST['dobyear']."-". $_POST['dobmonth']."-".$_POST['dobday'];

	$designation = $_POST['designation'];

	$basic = $_POST["basic"];

	$grade = $_POST["grade"];

	$quarterid = $_POST["quarterid"];

		$sql = "UPDATE user SET name='$name',dob='$dob',designation='$designation'
		,doj='$doj',basic='$basic',
		grade='$grade',quarterid='$quarterid' WHERE mail='$_SESSION[mail]'";
	
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

	die();
}
else
{
	$mail = $_POST["mail"];
	
	$_SESSION["mail"]=$mail;

	$sql = "SELECT *
			FROM user WHERE mail = '$mail'";
	
	$result = $conn->query($sql);


	if ($conn->query($sql) == TRUE) 
	{
    	echo "<h3>successful</h3><br>";
    	echo '<table border="2px">';

		echo "<tr><td> <b>Name</b> </td>
				<td> <b>Mail</b> </td>
				<td> <b>dob </b> </td>
				<td> <b>designation </b> </td>
				<td> <b>doj </b> </td>
				<td> <b>Basic pay </b> </td>
				<td> <b>Grade pay </b> </td>
				<td> <b>Quarter ID </b> </td></tr><br>";

		if ($result->num_rows > 0) 
		{
    		while($row = $result->fetch_assoc()) 
    		{
    			$name=$row["name"];
    			$dob=$row["dob"];
    			$designation=$row["designation"];
    			$dobtime=strtotime($dob);
    			$dobday=date("j",$dobtime);
				$dobmonth=date("F",$dobtime);
				$dobyear=date("Y",$dobtime);
    			$basic=$row["basic"];
    			$grade=$row["grade"];
    			$doj=$row["doj"];
    			$dojtime=strtotime($doj);
    			$dojday=date("j",$dojtime);
				$dojmonth=date("F",$dojtime);
				$dojyear=date("Y",$dojtime);
				$quarterid=$row["quarterid"];
        		echo "<tr><td>" . $row["name"]. "</td><td>" . $row["mail"]. "</td>
        		<td> " . $row["dob"] ."</td>
        		<td> " . $row["designation"] ."</td><td> " . $row["doj"] ."</td>
        		<td>" . $row["basic"]. "</td><td>" . $row["grade"]. "</td>
        		<td>" . $row["quarterid"]. "</td></tr>";
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
}

$conn->close();
?>
<form action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" id="updateuser" class="smart-green">
<h1>Update User Details
<span>Please fill all the texts in the fields</span></h1>
<label>
<span>Quarter ID :</span>
<input type="text" name="name" value="<?php echo $name ?>">
</label>
<!--Mail<br><input type="text" name="mail" value=<?php echo $mail ?>><br>-->
<label>
<span>Date of Birth :</span>
</label>
<br><br><br>
<label>
<select name="dobmonth" class="dd">
	<option value="<?php echo date("n",$dobtime); ?>"><?php echo $dobmonth ?></option>
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
<select name="dobday" class="dd">
	<option value="<?php echo $dobday ?>"><?php echo $dobday ?></option>
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
<select name="dobyear" class="dd">
	<option value="<?php echo $dobyear; ?>"><?php echo $dobyear; ?></option>
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
	<option value="1989">1989</option>
	<option value="1988">1988</option>
	<option value="1987">1987</option>
	<option value="1986">1986</option>
	<option value="1985">1985</option>
	<option value="1984">1984</option>
	<option value="1983">1983</option>
	<option value="1982">1982</option>
	<option value="1981">1981</option>
	<option value="1980">1980</option>
	<option value="1979">1979</option>
	<option value="1978">1978</option>
	<option value="1977">1977</option>
	<option value="1976">1976</option>
	<option value="1975">1975</option>
	<option value="1974">1974</option>
	<option value="1973">1973</option>
	<option value="1972">1972</option>
	<option value="1971">1971</option>
	<option value="1970">1970</option>
	<option value="1969">1969</option>
	<option value="1968">1968</option>
	<option value="1967">1967</option>
	<option value="1966">1966</option>
	<option value="1965">1965</option>
	<option value="1964">1964</option>
	<option value="1963">1963</option>
	<option value="1962">1962</option>
	<option value="1961">1961</option>
	<option value="1960">1960</option>	
</select>
</label>
<label>
<span>Designation :</span>
<input type="text" name="designation" value=<?php echo $designation ?>>
</label>
<label>
<span>Date of Joining :</span>
</label>
<br><br><br>
<label>
<select name="dojmonth" class="dd">
	<option value="<?php echo date("n",$dojtime); ?>"><?php echo $dojmonth ?></option>
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
<select name="dojday" class="dd">
	<option value="<?php echo $dojday ?>"><?php echo $dojday ?></option>
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
<select name="dojyear" class="dd">
	<option value="<?php echo $dojyear; ?>"><?php echo $dojyear; ?></option>
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
	<option value="1989">1989</option>
	<option value="1988">1988</option>
	<option value="1987">1987</option>
	<option value="1986">1986</option>
	<option value="1985">1985</option>
	<option value="1984">1984</option>
	<option value="1983">1983</option>
	<option value="1982">1982</option>
	<option value="1981">1981</option>
	<option value="1980">1980</option>
	
</select>
</label>
<label>
<span>Basic Pay :</span>
<input type="text" name="basic" value=<?php echo $basic ?>>
</label>
<label>
<span>Grade Pay :</span>
<input type="text" name="grade" value=<?php echo $grade ?>>
</label>
<label>
<span>Quarter ID :</span>
<input type="text" name="quarterid" value=<?php echo $quarterid ?>>
</label>
<label>
<input type=submit class="button" name="update" value="Update User">
</label>
</form>
</body>
</html>