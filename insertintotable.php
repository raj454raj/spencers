<html>
<head>
	<title>Insert</title>
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">

</head>
<body>
	<h1>Insert Into Table</h1>
	<?php
		if(isset($_GET['tablename']) && isset($_GET['adminID'])){
			include 'confidential.php';
			$columndetails = $con->query("SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='introtodb' 
    AND `TABLE_NAME`='".$_GET['tablename']."'");
	$column_names = array();
	$result = $con->query("SELECT * FROM ".$_GET['tablename']);

	echo "<form class='form-horizontal' method='POST' action=''>";
		while($row=mysqli_fetch_array($columndetails)){
				if($row[0]!=$_GET['tablename']."_id"){
				if(strpos($row[0], "_id") === false){
					echo "<div class=\"form-group\">";
    				echo "<label for=\"".$row[0]."\" class=\"col-sm-2 control-label\">".ucfirst($row[0])."</label>";
					echo "<div class='col-sm-10'>";
					array_push($column_names, $row[0]);
					if ( strpos($row[0], "date") !== false ) {
				 		echo "<input class='form-control' name='".$row[0]."' type='date' required></input><br/>";	
					}
					else {
						echo "<input class='form-control' name='".$row[0]."' required></input><br/>";
					}
					echo "</div></div>";
				}
				else{
					$tmptable = substr($row[0],0,-3);
					$res = $con->query("SELECT * FROM ".$tmptable);
					
					echo "<div class=\"form-group\">";
    				echo "<label for=\"".$row[0]."\" class=\"col-sm-2 control-label\">".ucfirst($row[0])."</label>";
					echo "<div class='col-sm-10'>";
					array_push($column_names, $row[0]);
					echo "<select name='".$tmptable."_id' class='form-control'>";
					while($tmprow = mysqli_fetch_array($res)){
						echo "<option value=".$tmprow[$tmptable.'_id'].">".$tmprow[$tmptable.'_id']."</option>";
					}
					echo "</select>";
					//echo "<input class='form-control' name='".$row[0]."' required></input><br/>";
					echo "</div></div>";
					
				}

			}
		}
	echo "<input type='submit' class='btn btn-primary' value='Insert'/>";
	echo "</form>";
	if(isset($_POST[$column_names[0]])){
		$query = "INSERT INTO ".$_GET['tablename'];
		$columntuple = "";
		$columntuple.="(".$column_names[0];
		for($i=1;$i<count($column_names);$i++){
			$columntuple.=", ".$column_names[$i];
		}
		$columntuple.=")";
		$valuetuple="";
		if(strpos($column_names[0], "_id") === true)
			$valuetuple.="(".$_POST[$column_names[0]]; 
	    else
			$valuetuple.="('".$_POST[$column_names[0]]."'"; 
		for($i=1;$i<count($column_names);$i++){
			if(strpos($column_names[$i], "_id") === true)
				$valuetuple.=", ".$_POST[$column_names[$i]];
			else
				$valuetuple.=", '".$_POST[$column_names[$i]]."'";
		}
		$valuetuple.=")";
		echo $valuetuple;
		$res=$con->query("INSERT INTO `".$_GET['tablename']."` ".$columntuple." VALUES ".$valuetuple);
		//echo "INSERT INTO ".$_GET['tablename']." ".$columntuple." VALUES ".$valuetuple;
		if($res == 1)
			header("Location: http://localhost/spencers/adminpage.php?adminid=".$_GET['adminID']);

	}
}
	else{
		echo "Pass arguments";
	}
	?>
</body>
</html>
