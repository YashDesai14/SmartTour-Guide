<script>
function myFunc()
	{
		alert("Registration Successful.");
		window.location="index.html";
	}
  </script>
<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$uname = $_POST['uname'];
$email = $_POST['email'];
$pass = $_POST['pass'];


	$mysqli = new mysqli('localhost', 'root','', 'travel_database');

	if($mysqli->connect_errno > 0){
   		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	$query = "INSERT INTO user_login (f_name, l_name, username, email, password)
VALUES ('$fname', '$lname','$uname', '$email', '$pass')";


	$insert_row = $mysqli->query($query);

	if($insert_row){
		  echo "<script type='text/javascript'>myFunc()</script>";
	}
	else{
   		die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
     ?>
