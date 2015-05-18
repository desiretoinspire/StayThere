<?php
session_start();
if (strcmp($_SESSION['session_role'], "admin") <> 0)
{
	  session_unset();
	  header('Location: ' . "http://staytherenitc.esy.es/index.php?reset=1"); //redirect user back to page
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Page</title>
<link href="bootstrap.min.css" rel="stylesheet">
<link href="Admin Page.css" rel="stylesheet">
</head>
<body>
<div class="heading">
	<h1>ADMIN PAGE</h1>
</div>
<ul class="navigation">
    <li class="nav-item">
    	<a href="add_user.php"><button class="adduser">ADD USER</button>
    </a>
    </li>
    <li class="nav-item">
    	<a href="remove_user.html"><button class="removeuser">REMOVE USER</button>
    </a>
    </li> 
    <li class="nav-item">
    	<a href="allocate_quarter.php"><button class="allocatequarters">ALLOCATE QUARTERS</button>
    </a>
    </li>
    <li class="nav-item">
    	<a href="post_ad.php"><button class="advertisequarters">ADVERTISE QUARTERS</button>
    </a>
    </li>
    <li class="nav-item">
    	<a href="add_quarter.php"><button class="addquarters">ADD QUARTERS</button>
    </a>
    </li>

    <li class="nav-item">
    	<a href="remove_quarter.html"><button class="removequarter">REMOVE
                QUARTERS</button>
    </a>
    </li>
    <li class="nav-item">
    	<a href="viewuserhistory.html"><button class="removeuser">VIEW USER HISTORY</button>
    </a>
    </li>
    <li class="nav-item">
    	<a href="viewquarterhistory.html"><button class="removeuser">VIEW QUARTER
                HISTORY</button>
    </a>
    </li> 
    <li class="nav-item">
    	<a href="remove_ad.php"><button class="removeuser">REMOVE ADVERTISEMENT</button>
    </a>
    </li> 
    <li class="nav-item">
    	<a href="view_current_quarter.php"><button class="removeuser">VIEW CURRENT
                QUARTERS</button>
    </a>
    </li> 

    <li class="nav-item">
    	<a href="view_current_resident.php"><button class="viewcurrentresident">VIEW CURRENT
                RESIDENT</button>
    </a>
    </li>
    <li class="nav-item">
    	<a href="view_all.php"><button class="removeuser">VIEW ALL</button>
    </a>
    </li>    <li class="nav-item">
    	<a href="update_user.html"><button class="updateuser">UPDATE USER</button>
    </a>
    </li> 
    <li class="nav-item">
    	<a href="update_quarter.html"><button class="updatequarter">UPDATE QUARTERS</button>
    </a>
    </li><li class="nav-item">
    	<button class="help">HELP</button>
    </li> 
    <li class="nav-item">
    	<a href="http://staytherenitc.esy.es/index.php?reset=1"><button class="logout">LOGOUT</button>
    </a>
	</li>
</ul>
<input type="checkbox" id="nav-trigger" class="nav-trigger" />
<label for="nav-trigger"></label>
<div class="hide"></div>
<div class="site-wrap">
</div>
</body>
</html>