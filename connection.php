<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);
// Check ection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}
?>