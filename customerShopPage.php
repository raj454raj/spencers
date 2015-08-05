<html>
<head>	
	<link rel="stylesheet" type="text/css" href="jquery-ui/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
	<script src="jquery.js"></script>
	<script src="jquery-ui/jquery-ui.js"></script>
<style>
</style>
</head>
<body>
<?php
	include "header.php";
	echo "<input id='info' active='' user='".$_GET["adminid"]."' style='display:none'></input>";
	echo "<div class='container'>";
	$tablename = "product";
        $columndetails = $con->query("SELECT `COLUMN_NAME` 
				      FROM `INFORMATION_SCHEMA`.`COLUMNS` 
				      WHERE `TABLE_SCHEMA`='introtodb' 
    				      AND `TABLE_NAME`='".$tablename."'");

        $column_names = array();
	$table_header = "";
        while($row=mysqli_fetch_array($columndetails)){
		if( $row[0] != "product_id" ) {	
		$table_header = $table_header."<th>".
				ucfirst($row[0])."</th>";
                array_push($column_names, $row[0]);
        	}
	}
	$table_header = $table_header."<th> Choose Item </th>";
	$query = "SELECT type FROM product GROUP BY type";    
        $out = $con->query($query);
        $types = "";
 	$tables = "";

	$iframe = "<iframe id='myIframe' src='http://localhost/spencers/customerItemsPageIframe.php?adminid=".$_GET['adminid']."'></iframe>";
	$headings = "<h2><i class='fa fa-archive'></i> Categories</h2><hr>";	
	while($row = mysqli_fetch_array($out)) {
		$types = $types."<button class='btn btn-info displayTable' product-type='".$row['type']."'>".ucfirst($row['type'])."</button> | ";
		$tables = $tables."<table id='table_".$row['type']."' class='table' style='display: none'>";
		$tables = $tables."<tr>".$table_header."</tr>";	
		$query = "SELECT * FROM product where type='".$row['type']."'";
		$type = $con->query($query);
		while($row_type=mysqli_fetch_array($type)){
			$len = count($row_type);
			$tables = $tables."<tr>";
                	for ($x=1; $x<($len/2); $x+=1) {
                		$tables = $tables."<td>".$row_type[$x]."</td>";
			}
			$action_button = "<td>
				<input id='qty-".$row_type[0]."' max='".$row_type['stock']."' min='1' number-format='n'></input>
				<button id='add-".$row_type[0]."' class='btn btn-info cart'>Add to Cart</button>
				</td>";
			$tables = $tables.$action_button;
			$tables = $tables."</tr>";
		}
		$tables = $tables."</table>";
	}
	echo $headings;
	echo $types."<hr>";
	echo $tables;
	echo $iframe;
?>
</div>
</div>
<script>
$(function(){
	
	printTable = function(e) {
		var tablename = 'table_' + this.getAttribute('product-type');
		var old_tablename = $("#info").attr("active");
		if( old_tablename != '' ){ 
			$old_tablename = $('#'+old_tablename);
			$old_tablename.attr({
				style: "display: none",
			});
		}
		$('#info').attr({
			active: tablename
		});
		$tablename = $('#'+tablename);
		$tablename.attr({
			style: 'display:block'
		});
	};
	
	addToCart = function(e) {

		var _id = this.getAttribute('id');
		var id = _id.split("-")[1];
		_input = 'qty-' + id;
		var _url = "addToCart.php?adminid=" + $("#info").attr("user");
		
		if ($('#'+_input).spinner("isValid")) {
			quantity = $('#'+_input).val();
			_data = {"id": id,
				 "qty": quantity
				 }
			_data = JSON.stringify(_data);
			console.log(_data);
			$.ajax({
				type: "POST",
				url: _url,
				data:{
					"id": id,
					"qty": quantity	
				},
			}).done(function(html) {
				$('#myIframe').attr('src', $('#myIframe').attr('src'));
			});						
		}
		else {
			alert("Please enter a valid value");
		}
	}
	
	$('.displayTable').bind('click', printTable);
	$('iframe').attr({
		frameborder: 0,
		scrolling: "auto",
		seamless: "seamless",
		height: "100%",
		width: "100%"
	});
	$('.cart').bind('click', addToCart);

	k = document.getElementsByTagName("input");
	for(i=0; i<k.length; i++) {
		// initialize each input to spinner

	 	_id = k[i].getAttribute("id");
		if ( _id != "info" ) {
			var spinner = $("#"+_id).spinner();
		}
	}

});
</script>
</div>
</html>
</body>
