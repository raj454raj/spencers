<head>
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
</head>
<body>
<?php
	echo "<h1>Get Stock</h1>";
?>
<?php
	if(isset($_GET['id'])){
		include 'confidential.php';
		$today = date("Y-m-d");
		$q = $con->query("SELECT * FROM warehouse_product WHERE product_id=".$_GET['id']." AND stock>0");
		echo "<table class='table'>";
		echo "<tr><th>warehouse_id</th><th>Stock</th><th></th></tr>";
		while($row = mysqli_fetch_array($q)){
			echo "<tr><td>".$row['warehouse_id']."</td><td>".$row['stock']."</td><td><form method='POST'><input name='qty' placeholder='Stock required'/><input name='values' style='visibility:hidden;position:absolute;' value='qty_".$row['warehouse_id']."_".$row['stock']."_".$row['warehouse_product_id']."'/><input type='submit' value='Get Stock'/></form></td></tr>";
		}
		echo "</table>";
	
	if($_POST['qty']){
		include 'confidential.php';
		$arr = explode('_',$_POST['values']);
		$warehouse_id=$arr[1];
		$previousqty = $arr[2];
		$warehouse_product_id=$arr[3];
		$newqty = $previousqty - $_POST['qty'];
        if($newqty>=0)
		{
			$q = $con->query("UPDATE warehouse_product SET stock=".$newqty." WHERE warehouse_product_id=".$warehouse_product_id);
			if($q){
				$q=$con->query("SELECT * FROM product WHERE product_id=".$_GET['id']);
				while($row=mysqli_fetch_array($q)){
					$prostock = $row['stock']+$_POST['qty'];
				}
				$q=$con->query("UPDATE product SET stock=".$prostock." WHERE product_id=".$_GET['id']);
				if($q){
					header("Location: http://localhost/spencers/managerpage.php");
				}
			}
		}
		else
			echo "Insufficient Stock";
		
	
	}
}
?>
</body>
</html>
