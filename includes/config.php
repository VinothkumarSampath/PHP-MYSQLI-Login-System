<?php
session_start();
// Enter your Host name, Database Username, Password and Database Name.
// Change this to your connection info.
$con = mysqli_connect("localhost","root","","login");

// Check connection
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>