<link rel="stylesheet" href="dist/css/layout.css">
<link rel="stylesheet" href="dist/css/elements.css">
<link rel="shortcut icon" href="/favicon.ico">
<script src="dist/js/modernizr.min.js"></script>
<?php
// move to ecxternal file 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration"; 
// Create connection 
$conn=mysqli_connect($servername, $username, $password, $dbname); 
// Check connection 
if (!$conn) { 
die( "Connection failed: " . mysqli_connect_error()); 
} 
?>