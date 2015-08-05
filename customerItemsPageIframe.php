<html>
<head>
        <link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="./fontawesome/css/font-awesome.min.css">
        <script src="jquery.js"></script>
        <script src="jquery-ui/jquery-ui.js"></script>
</head>
<body>
<?php
	include "confidential.php";
	echo "<input id='info' active='' user='".$_GET["adminid"]."' style='display:none'></input>";
	$id = $_GET["adminid"];		
	$query = "SELECT purchase_id FROM customer where person_id=".$id;
	$out = $con->query($query);
	$row = mysqli_fetch_array($out);
	$table_header = "<tr><th>Name</th>
			     <th>Type</th>
			     <th>Company</th>
			     <th>Price</th>
			     <th>Qty</th>
			     <th></th>
			 </tr>";
	if($row['purchase_id']) {
		echo "<h2><i class='fa fa-check-square-o'></i> Items Added </h2>";
		echo "<table class='table'>";
		echo $table_header;
		$purchase_id = $row['purchase_id'];
		$query = "SELECT product.product_id, product.name, product.type, product.company, product.price, purchase_product.qty 
			  FROM product 
			  JOIN purchase_product 
			  ON product.product_id=purchase_product.product_id
			  WHERE purchase_id=".$purchase_id;
		$out = $con->query($query);
		while($new_row=mysqli_fetch_array($out)) {
                        $len = count($new_row);
                        echo "<tr>";
                        for ($x=1; $x<($len/2); $x+=1) {
                                echo"<td>".ucfirst($new_row[$x])."</td>";
                        }
                        $action_button = "<td>
                                <button id='rm-".$new_row[0]."' class='btn btn-danger rm'>Remove</button>
                                </td>";
                        echo $action_button;
                        echo "</tr>";	
		}	
	}
	else {
		echo "<h2><i class='fa fa-shopping-cart fa-2x'></i> Empty Cart!</h2>";
	}
?>
<script>
$(function(){

	removeFromCart = function(e) {
                var _id = this.getAttribute('id');
                var id = _id.split("-")[1];
                var _url = "removeFromCart.php?adminid=" + $("#info").attr("user");
        	        
                $.ajax({
                        type: "POST",
                        url: _url,
                        data:{
                              "product_id": id,
                              },
                        dataType: "html",
			}).done(function(html){
				window.location.reload();
			});
        };

	$('.rm').bind('click', removeFromCart);
});
</script>
</body>
</html>
