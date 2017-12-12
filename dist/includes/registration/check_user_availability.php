<?php

if(!empty($_POST["username"])) {
	
// move to ecxternal file 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration"; 
	
/* Remove me

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT count(*) FROM owner_login WHERE owner_login_username='" . $_POST["username"] . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        if($row['count(*)'] > 0 ) {
			echo "fail";
    		return false;
			//echo "<span class='status-not-available' style='color:red;'> Username Not Available.</span>";
		} else {
			echo "success"; 
    		return false; 
			 //echo "<span class='status-available' style='color:green;'> Username Available.</span>";
		}
    }
} else {
}
mysqli_close($conn);
*/
}

?>
