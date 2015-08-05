<?php
	include "confidential.php";

	$total = $_POST["total"];
	$person_id = $_GET["adminid"];
	$query = "SELECT customer_id, purchase_id FROM customer WHERE 
		  person_id=".$person_id;
	$out = $con->query($query);
	$row = mysqli_fetch_array($out);
	$customer_id = $row['customer_id'];
	if($row['purchase_id']) {
		// set net_total in purchase
		// set NUll as pur id in customer as null
		$purchase_id = $row['purchase_id'];
		$query = "SELECT * from purchase_product where purchase_id=".$purchase_id.";";
		$out = $con->query($query);
		while($irow = mysqli_fetch_array($out)) {
			$iqty = $irow['qty'];
			$ipro_id = $irow['product_id'];
			$query = "UPDATE product AS p SET p.stock = p.stock - ".$iqty." WHERE product_id=".$ipro_id.";";
			$con->query($query);
		}
		$query = "UPDATE purchase SET net_total=".$total." WHERE purchase_id=".$purchase_id;
		$out = $con->query($query);
		$query = "UPDATE customer SET purchase_id=NULL WHERE person_id=".$person_id;
		$out = $con->query($query);	
		$query = "UPDATE customer SET points = points + 5 WHERE person_id=".$person_id;
		$out = $con->query($query);
		echo "Success!";
	}
	else {
		echo "<i class='fa-thumbs-o-down'></i>Empty Cart!";
	}
?>
