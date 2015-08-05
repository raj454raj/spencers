<html>
<head>
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./fontawesome/css/font-awesome.min.css">
</head>
<body>
<?php
	include "confidential.php";
	if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
        }
	// Check if person has been added to customer table
	$id = $_GET["adminid"];
	$out = $con->query("SELECT * FROM customer where person_id=".$id);
	$row = mysqli_fetch_array($out);
	if($row) {
		$cust = $row["customer_id"];
		$points = $row["points"];
		// Display Username
		include "header.php";
		// Show all previous Purchases!
		echo "<div class='container'>";	
		echo "<div class='well'>
			<h3><i class='fa fa-dot-circle-o'></i> Points: $points</h3>
		      </div>";
		echo "<div class='well'>
			<h3><i class='fa fa-tags'></i> Previous Purchases</h3>
		      </div>";
	        $query = "SELECT purchase.customer_id, purchase.purchase_id, purchase.date, purchase.time 
			  FROM purchase 
			  JOIN customer ON customer.customer_id=purchase.customer_id 
			  WHERE customer.customer_id=".$cust."
			  ORDER BY purchase.date DESC;";
		$out = $con->query($query);
		echo "<div>";
		while($rows = mysqli_fetch_array($out)) {
			$purchase_id = $rows["purchase_id"];
			echo "<div class='panel panel-info'>";
			echo "<div class='panel-heading'><b><i class='fa fa-tag'></i>&nbsp;&nbsp; Purchase Id: ".$purchase_id."&nbsp;&nbsp; | &nbsp;&nbsp; <i class='fa fa-clock-o'></i>&nbsp;&nbsp;&nbsp;".$rows['time']."&nbsp;&nbsp; |&nbsp;&nbsp;&nbsp; <i class='fa fa-calendar'></i>&nbsp;&nbsp;&nbsp; ".$rows['date']."</b></div>";
			echo "<div class='panel-body'>";
			echo "<table class='table stripped-table'>";
			$thead = "<thead>
					<th>Product Id</th>
					<th>Name</th>
					<th>Type</th>
					<th>Company</th>
					<th>Price</th>
					<th>Quantity</th>
				  </thead>";
			echo $thead;
			$query1 = "SELECT * FROM purchase_product
				   JOIN product ON product.product_id=purchase_product.product_id
				   WHERE purchase_product.purchase_id=".$purchase_id.";";
		 	$out1 = $con->query($query1);
			while($irows = mysqli_fetch_array($out1)) {	
				echo "<tbody>";
				echo "<td>".$irows['product_id']."</td>";
				echo "<td>".$irows['name']."</td>";
				echo "<td>".$irows['type']."</td>";
				echo "<td>".$irows['company']."</td>";
				echo "<td>".$irows['price']."</td>";
				echo "<td>".$irows['qty']."</td>";
				echo "</tbody>";
			}
			echo "</table>";
			echo "</div></div><hr>";
		}
		echo "</div>";
	}
	else {
		// Add customer to customer table;
		$tablename = "customer";
		$points = 0;
		$query = "INSERT INTO ".$tablename." (person_id, points) VALUES (".$id.",".$points.")";
		//echo $query;
		$out = $con->query($query);
	 	Header("Location: http://localhost/spencers/customerpage.php?adminid=".$id);
	}
	include "footer.php";
?>
</div>
</body>
</html>
