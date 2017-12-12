<?php

if(!empty($_POST["package"])) {
	
// move to ecxternal file 
$servername="localhost" ; 
$username="USER" ; 
$password="PASS" ; 
$dbname="DBNAME" ; 
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM packages WHERE package_id='" . $_POST["package"] . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       echo '<div class="">';
		echo '<p style=" padding: 10px; background: #96c03d; color: #ffffff; text-transform:uppercase; font-weight:  bold;">Package Selected</p>';
       	echo '<h4>'.$row["package_name"].'</h3>';
        echo ' <p>'. $row["package_description"].'</p>';
        echo ' <p style="text-align: right; font-size: 18px; color: #537d4e; font-weight: bold;">Price £'. $row["package_price"] .' per month</p>';
        echo ' </div>';
		echo '<input type="hidden" name="package_id" value ="'. $row["package_id"].'">';
		echo '<input type="hidden" name="description" value ="'. $row["package_name"].'">';
        echo '<input type="hidden" id="price" name="price" value ="'. $row["package_price"].'">';
     }
} else {
   
}
mysqli_close($conn);
}
?>