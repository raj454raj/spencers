<?php
	include "confidential.php";

	$id = $_GET["adminid"];
        $query = "SELECT purchase_id FROM customer where person_id=".$id.";";
        $out = $con->query($query);
        $row = mysqli_fetch_array($out);
	if($row['purchase_id']) {
		$purchase_id = $row['purchase_id'];
		// remove from purchase_product
		$query = "DELETE FROM purchase_product WHERE purchase_id=".$purchase_id.";";
		$out = $con->query($query);
		// update 'purchase_id == NULL' for customer
		$query = "UPDATE customer SET purchase_id=NULL WHERE person_id=".$id.";";
		$out = $con->query($query);
                $query = "DELETE FROM purchase WHERE purchase_id=".$purchase_id.";";
                $out = $con->query($query);
		echo "Cart Emptied!";
	}
	else {
		echo "Nothing in Cart!";
	}

?>
