<html>
<head>
	<title>Manager</title>
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
	<script type="text/javascript">
		function warehouse(id){
			window.location.href="http://localhost/spencers/warehousedetails.php?id="+id;
		}	
		function feedback(){
			window.location.href="http://localhost/spencers/feedbackdetails.php";
		}
	</script>
</head>
<body>
<?php
	echo "<br/><button class='btn btn-success' onclick='feedback()'>Get feedback</button>";
	include 'confidential.php';
	$q = $con->query("SELECT * FROM product");
	echo "<h1>Products</h1>";
	echo "<table class='table'>";
	echo "<tr><th>Product_ID</th><th>Name</th><th>Type</th><th>Company</th><th>Price</th><th>Stock</th><th>Get More</th></tr>";
	while($row=mysqli_fetch_array($q)){
		echo "<tr><td>".$row['product_id']."</td><td>".$row['name']."</td><td>".$row['type']."</td><td>".$row['company']."</td><td>".$row['price']."</td><td>".$row['stock']."</td><td><button class='btn btn-warning' onclick='warehouse(".$row['product_id'].")'>Get Stock</button></td></tr>";
	}
	echo "</table>";

?>
</body>
</html>
