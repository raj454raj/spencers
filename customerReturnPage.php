<html>
<head>
	<title>Return</title>
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
	<script src="jquery.js"></script>
	<script src="jquery-ui/jquery-ui.js"></script>
<style>
</style>
</head>
<body>
<?php
	include "header.php";
	include "confidential.php";
	echo "<div class='container'>";
	echo "<h1><i class='fa fa-hand-o-right'></i> Easy Returns</h1><hr>";
        if(isset($_POST['purchase_id'])&&isset($_POST['product_id'])){
                $q = $con->query("SELECT * FROM purchase_product WHERE purchase_id=".$_POST['purchase_id']." AND product_id=".$_POST['product_id']);
                $flag = 0;
                while($row = mysqli_fetch_array($q)){
                        $flag = 1;
                        $qty = $row['qty'];
                        $purchase_product_id=$row['purchase_product_id'];
                }
                if( $flag == 0 ) {
                        echo "<div class='well'><h4><i class='fa fa-info-circle'></i> Please fill in Valid Details</h4></div>";
                }
                else {
                $q = $con->query("SELECT * FROM product WHERE product_id=".$_POST['product_id']);
                while($row = mysqli_fetch_array($q)){
                        //print_r($row);
                        $price = $row['price'];
                        $stock = $row['stock'];
                }
                $stock += $qty;
                $q = $con->query("UPDATE product SET stock=".$stock." WHERE product_id=".$_POST['product_id']);
                if($q){
                        $q=$con->query("DELETE FROM purchase_product WHERE purchase_product_id=".$purchase_product_id);
                }
                $refund = $price * $qty;
                $result = $con->query("INSERT INTO `return` (purchase_id, product_id, date, refund) VALUES (".$_POST['purchase_id'].", ".$_POST['product_id'].", '".date("Y-m-d")."', ".$refund.")");
                echo "<div class='well'><h4><i class='fa fa-check-circle'></i>  Item Returned!</h2></div>";
                }
        }
        else{
                //echo "Fill the fields";
        }

        $id = $_GET["adminid"];
        $out = $con->query("SELECT * FROM customer where person_id=".$id);
        $row = mysqli_fetch_array($out);
        $cust = $row["customer_id"];
	echo "<form class='form' action='' method='POST'>";
	// Get all purchase_ids for user
        $query = "SELECT purchase.customer_id, purchase.purchase_id 
		  FROM purchase 
	  	  JOIN customer ON customer.customer_id=purchase.customer_id 
	  	  WHERE customer.customer_id=".$cust.";";
	$out = $con->query($query);
	$select = "<select name='purchase_id' class='form-control'>";
	while($rows = mysqli_fetch_array($out)) {
		$select = $select."<option value='".$rows['purchase_id']."'> ".$rows['purchase_id']."</option>";
	}
	$select = $select."</select>";
	// Get all product Id's
	echo "Purchase Id: <br>";
	echo $select;
        $query = "SELECT * FROM product";
        $out = $con->query($query);
        $select = "<select name='product_id' class='form-control'>";
        while($rows = mysqli_fetch_array($out)) {
                $select = $select."<option value='".$rows['product_id']."'> ".$rows['name']." ( ".$rows['company']." )</option>";
        }
        $select = $select."</select>";
	echo "Product Id: <br>";
	echo $select."<hr>";
	echo "<button class='btn btn-primary'><i class='fa fa-arrow-right'></i> Return</button>";
	echo "</form>";


?>
</div>
</div>
</body>
</html>
