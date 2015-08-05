<html>
<head>
        <link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
        <script src="jquery.js"></script>
        <script src="jquery-ui/jquery-ui.js"></script>
</head>
<body>
<?php
	include "header.php";	
	include "confidential.php";
	echo "<div class='container'>";
	$id = $_GET["adminid"];	
	$offer = 0;	
	$query = "SELECT purchase_id, customer_id FROM customer where person_id=".$id;
	$out = $con->query($query);
	$row = mysqli_fetch_array($out);
	$cust = $row['customer_id'];
	// check for Bank Details

	$query2 = "SELECT * FROM bankdetail WHERE customer_id=$cust";
	$out2 = $con->query($query2);		
	$row2 = mysqli_fetch_array($out2);
	if( $row2 ) {
		$flag = 1;
	}
	else {
		$flag = 0;
	}
	echo "<input id='info2' active='' cust='".$cust."' user='".$_GET["adminid"]."' bank='".$flag."' style='display:none'></input>";
	$table_header = "<tr><th>Name</th>
			     <th>Type</th>
			     <th>Company</th>
			     <th>Price</th>
			     <th>Qty</th>
			     <th>Discount/unit</th>
			     <th>Net Amount</th>
			     <th></th>
			 </tr>";
	if($row['purchase_id']) {
		echo "<h2><i class='fa fa-credit-card'></i>  Bill Info </h2>";
		echo "<hr><button id='purchase' class='btn btn-lg btn-primary'>Buy!</button> | ";
		echo "<span id='totalamount'><b>Total Amount</b></span><hr>";
		echo "<table class='table'>";
		echo $table_header;
		$purchase_id = $row['purchase_id'];
		$today = date("Y-m-d");
		// put condition for date
		$query = "SELECT product.product_id, product.name, product.type, product.company, product.price, purchase_product.qty,
				 offer.discount, offer.max_qty, offer.min_qty, offer.start_date, offer.end_date 
			  FROM product
			  JOIN purchase_product ON product.product_id=purchase_product.product_id
			  JOIN offer ON product.product_id=offer.product_id
			  WHERE purchase_product.purchase_id=".$purchase_id." AND purchase_product.qty<=offer.max_qty AND purchase_product.qty>=offer.min_qty AND '$today' BETWEEN offer.start_date AND offer.end_date;";
		$out = $con->query($query);
		$offers = array();
		while($new_row=mysqli_fetch_array($out)) {
                        $len = count($new_row);
			// id => [offer.discount]
			$offers[$new_row['product_id']] = $new_row['discount'];
		}	
	        $query = "SELECT product.product_id, product.name, product.type, product.company, product.price, purchase_product.qty
        	          FROM product
	                  JOIN purchase_product ON product.product_id=purchase_product.product_id
               	          WHERE purchase_product.purchase_id=".$purchase_id.";";
		$out = $con->query($query);
		while($new_row=mysqli_fetch_array($out)) {
			$len = count($new_row);
			for ($x=1; $x<($len/2); $x+=1) {
				echo"<td>".ucfirst($new_row[$x])."</td>";
			}
			$discount = $offers[$new_row['product_id']];
			$p_qty = $new_row['qty'];
			$p_price = $new_row['price'];
			$subtract = 0;
			$total = $p_qty*$p_price;
			if ($discount && $discount < $p_price) {
				echo "<td>".$discount."</td>";
				$subtract = $discount*$p_qty;
			}
			else
				echo "<td>-</td>";
			$total = $total - $subtract;
			echo "<td class='netprice'>".$total."</td>";
			echo "</tr>";
		}

	}
	else {
		echo "<h2><i class='fa fa-shopping-cart fa-2x'></i> Empty Cart!</h2>";
	}
?>
</div>
</div>
<div id='bankdetails' class='modal fade'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
        <h4 class='modal-title'>Please fill in Bank Details</h4>
      </div>
      <div class='modal-body'>
      	<form class='form' role='form' method="POST"> 
		<input name="name" type="text" class="form-control" placeholder="Bank Name" required autofocus/><hr>
		<input name="acc_no" class="form-control" type="number" placeholder="Account Number" required/><hr>
		<input name="acc_type" class="form-control" type="text" placeholder="Account Type" required/><hr>
        	<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        	<button id='bankdetails-save' type='submit' class='btn btn-primary'>Submit</button>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<script>
$(function(){

	$('input').val("");

	addTotal = $('.netprice');
	var sum = 0;
	for(i=0; i<addTotal.length; i++) {
		sum = sum + parseInt(addTotal[i].innerHTML);
	}
	$('#totalamount').html("<b>Total Amount: " + sum + "</b>");
	$('#totalamount').attr({
		sum: sum
	});
	$('form').attr({
		action: "bankdetails.php?adminid=" + $("#info2").attr("user") + "&custard=" + $("#info2").attr("cust"),
	});
	function purchase(e) {
		total = $('#totalamount').attr("sum");
                var _url = "completePurchase.php?adminid=" + $("#info2").attr("user");
		console.log($("#info2").attr("bank"));

    		if ( $("#info2").attr("bank") == 0 ) {
			$('#bankdetails').modal();
		}
		else {
                	$.ajax({
                        	type: "POST",
                       		url: _url,
                        	data:{
                              	"total": total,
                              	},
                        	dataType: "html",
                        }).done(function(html){
				alert("Items Purchased!");
                                window.location.reload();
                        	});
		}
        };
	
	$('#purchase').bind('click', purchase);
});
</script>
</body>
</html>
