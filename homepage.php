<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>StayThere</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="StayThere Login.css">
<script src='./StayThere.js'></script>
</head>
<body>
<div class="container">
  <div class="col-md-12">
    <h1>StayThere</h1>
    <img src="logonitc.jpg" alt="Not able to display">
    <p>NITC Quarters Allocation System</p>
  </div>
</div>
<?php
$_SESSION["sessionstart"] = 1;
$_SESSION["favcolor"] = 1;
?>
<div class="container">
    <div class="button red">
        <a href="index.php"><span>✓</span>LOGIN WITH GMAIL</a>
    </div>
</div>
</body>
</html>