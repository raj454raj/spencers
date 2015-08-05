<?php
        include "confidential.php";
        $id = $_GET["adminid"];
        $product_id = $_POST["product_id"];
	$query = "SELECT purchase_id FROM customer where person_id=".$id;
        $out = $con->query($query);
        $row = mysqli_fetch_array($out);
	$purchase_id = $row["purchase_id"];
	
	$query = "DELETE FROM purchase_product WHERE product_id=".$product_id." AND purchase_id=".$purchase_id;
        $out = $con->query($query);
	echo $query;
?>