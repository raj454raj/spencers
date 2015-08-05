<html>
<head>
	<title>Update row</title>
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
</head>
<body>
	<h1>Update</h1>
	<?php 
		if(isset($_GET['tablename'])&&$_GET['index'])
		{
		$tablename=$_GET['tablename'];
		$id = $_GET['index'];
		include 'confidential.php';
		$columndetails = $con->query("SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='introtodb' 
    AND `TABLE_NAME`='".$tablename."'");
	$column_names = array();
	$result = $con->query("SELECT * FROM ".$tablename." WHERE ".$tablename."_id = ".$id);
	echo "<form class=\"form-horizontal\" method='POST' action=''>";
	while($thisrow=mysqli_fetch_array($result)){
		while($row=mysqli_fetch_array($columndetails)){
				if($row[0]!=$tablename."_id"){
					array_push($column_names, $row[0]);
					echo "<div class=\"form-group\">";
    				echo "<label for=\"".$row[0]."\" class=\"col-sm-2 control-label\">".ucfirst($row[0])."</label>";
					echo "<div class='col-sm-10'>";
					if(strpos($row[0], "date") !== false) {
						echo "<input name='".$row[0]."' class='form-control' type='date' value='".$thisrow[$row[0]]."'></input><br/>";
					}
					else{
						echo "<input name='".$row[0]."' class='form-control' value='".$thisrow[$row[0]]."'></input><br/>";
					}
					echo "</div></div>";
			}
		}
	}
	echo "<input type='submit' value='Update' class='btn btn-primary'/>";
	echo "</form>";
	}
	?>
	<?php
	if(isset($_GET['tablename'])&&isset($_GET['index'])&&isset($_GET['adminID']))
	{
		$tmpstring="";
		$request_elements=array();
		if(isset($_POST[$column_names[0]]))
		{
		$tmpstring=$column_names[0]." = '".$_POST[$column_names[0]]."'";
		for($i=1;$i<count($column_names);$i++){
			//echo $column_names[$i]."<br/>";
			$tmpstring.=",".$column_names[$i]." = '".$_POST[$column_names[$i]]."'";
		}
		 
		$updatequery = "UPDATE ".$tablename." SET ".$tmpstring." WHERE ".$tablename."_id = ".$id;
		//echo $updatequery;
		$return=$con->query($updatequery);
		if($return ==1 ){
			header("Location: http://localhost/spencers/table.php?tablename=".$tablename."&adminID=".$_GET['adminID']);
		}
	}
	else
		echo "Pass arguments";
	}	//print_r($request_elements);
	?>
</body>
</html>
