<?php
	include "confidential.php";
	date_default_timezone_set('India/Kolkata');
	$text = $_POST["text"];
	$id = $_GET["adminid"];
        $out = $con->query("SELECT * FROM customer WHERE person_id=".$id);
        $row = mysqli_fetch_array($out);
	$cust = $row['customer_id'];
	$date = date('Y-m-d');
	$time = date('H:i:s');

	$query = "INSERT INTO feedback (customer_id, date, time)
		  VALUES ($cust,'$date','$time')";
	$out = $con->query($query);
	$query = "SELECT * FROM feedback ORDER BY feedback_id DESC LIMIT 1";
	$out = $con->query($query);
	$row = mysqli_fetch_array($out);
	$fid = $row['feedback_id'];	
	$type = $_GET["type"];
	$query = "INSERT INTO $type (feedback_id, text) 
		  VALUES ($fid, '$text')";
	$out = $con->query($query);
?>
