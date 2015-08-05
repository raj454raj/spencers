<?php
	include "confidential.php";

	$product_id = $_POST["id"];
	$qty = $_POST["qty"];
	$person_id = $_GET["adminid"];
	$query = "SELECT customer_id, purchase_id FROM customer WHERE 
		  person_id=".$person_id;
	$out = $con->query($query);
	$row = mysqli_fetch_array($out);
	$customer_id = $row['customer_id'];
	if($row['purchase_id']) {
		// purchase exists
		// add product to product_purchase
		// check if product already exists ?
		$purchase_id = $row['purchase_id'];
		$query = "SELECT * FROM purchase_product WHERE product_id=".$product_id." and purchase_id=".$row['purchase_id'];
		$out = $con->query($query);
		$row = mysqli_fetch_array($out);
		if($row) {
			$query = "UPDATE purchase_product SET qty=".$qty." WHERE product_id=".$product_id." and purchase_id=".$purchase_id;
			$out = $con->query($query);
			echo $query;
		} 
		else {
			$query = "INSERT INTO purchase_product (product_id, purchase_id, qty) VALUES (".$product_id.",".$purchase_id.",".$qty.")";
			$out = $con->query($query);	
			echo $query;
		}
		
	}
	else {
		//New Purchase
		// Create a temp Purchase id
        	$date = date('Y-m-d');
	        $time = date('H:i:s');
		$query = "INSERT INTO purchase (date, time, net_total, customer_id) VALUES ('".$date."','".$time."',20,".$row['customer_id'].")";
		$out = $con->query($query);
		$row = mysqli_fetch_array($out);
		$query = "SELECT * FROM purchase";
                $out = $con->query($query);
		$temp = array();
                while($row=mysqli_fetch_array($out)) {
			$temp['purchase_id'] = $row['purchase_id'];
		}
		// $temp stores last id
		// Update the customers current purchase
		$query = "UPDATE customer SET purchase_id=".$temp['purchase_id']." WHERE customer_id=".$customer_id;
		$out = $con->query($query);
                $query = "INSERT INTO purchase_product (product_id, purchase_id, qty) VALUES (".$product_id.",".$temp['purchase_id'].",".$qty.")";
                $out = $con->query($query);
                echo $query;
	}
?>
