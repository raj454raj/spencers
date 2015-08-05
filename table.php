<html>
<head>
	<title>Table Display</title>
	<style>

		table, td, th {
    		border:0.1px solid;
    		border-collapse: collapse;
			text-align: center;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">

	<script>
		function handlethis(event, index, tablename, adminID){
			/*if(adminID == index || index ==0)
			{
				alert("Cant do");
				return false;
			}
			else
			*/
			console.log(event+" "+index+" "+tablename+" "+adminID);
		{
				flag = "D";
				if(event.textContent=="Update")
					flag="U";
				if(flag == "D")
					window.location.href="http://localhost/spencers/deletefromtable.php?index="+index+"&tablename="+tablename+"&adminID="+adminID;
				else
					window.location.href="http://localhost/spencers/updatetable.php?index="+index+"&tablename="+tablename+"&adminID="+adminID;
			}
		}
	</script>
	<style>
		button{
			padding: 10px;
		}
	</style>
</head>
<body>
<h1>Table</h1>
<br/><br/>
<?php

if(isset($_GET['tablename']) && isset($_GET['adminID'])){	
	$tablename = $_GET['tablename'];
	include 'confidential.php';
	$columndetails = $con->query("SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='introtodb' 
    AND `TABLE_NAME`='".$tablename."'");

	$column_names = array();
echo "<table class='table'><tr/>";
	$newvar = " ";
	while($row=mysqli_fetch_array($columndetails)){
		echo "<td><b>";
		echo $row[0];
		array_push($column_names, $row[0]);
		echo "</b></td>";
	}

	echo "<td><b>Options</b></td>";
echo "</tr>";
	$no_of_columns = count($column_names);
	$table = $con->query("SELECT * FROM `".$tablename."`");
	while($row=mysqli_fetch_array($table)){
		echo "<tr>";
		for($i=0;$i<$no_of_columns;$i++){
			echo "<td>".$row[$column_names[$i]]."</td>";
			if ($column_names[$i] == $tablename."_id")
				$tmpid=$row[$column_names[$i]];
		}
		echo "<td><button class='btn btn-warning' onclick=\"handlethis(this,".$tmpid.", '".$tablename."', ".$_GET['adminID'].")\">Update</button> &nbsp;<button class='btn btn-danger' onclick=\"handlethis(this, ".$tmpid.", '".$tablename."', ".$_GET['adminID'].")\">Delete</button></td>";
		echo "</tr>";
	}
echo "</table>";
}
else{
	print_r($_GET);
	echo "Pass arguments";
}
?>
</body>
</html>
