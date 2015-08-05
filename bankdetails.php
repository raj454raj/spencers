<?php
	include 'confidential.php';
	$no = $_POST["acc_no"];
	$type = $_POST["acc_type"];
	$name = $_POST["name"];
	$id = $_GET["custard"];
	$query = "INSERT INTO bankdetail (customer_id, bank_name, account_type, account_no)
		  VALUES ($id, '$name', '$type', $no)";
	$out = $con->query($query);
	Header("Location: http://localhost/spencers/customerBillPage.php?adminid=".$_GET['adminid']);
?>
