<html>
<head>
	<title>Admin Page</title>
	<script src="jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
	<script>
		function clickButton(e, adminID){
			window.location.href= "http://localhost/spencers/table.php?tablename="+e.id.slice(0,-5)+"&adminID="+adminID;
		}
		function inserttable(e, adminID){
			window.location.href= "http://localhost/spencers/insertintotable.php?tablename="+e.id.slice(0,-6)+"&adminID="+adminID;
		}
		function droptable(e, adminID){
			window.location.href= "http://localhost/spencers/droptable.php?tablename="+e.id.slice(0,-4)+"&adminID="+adminID;
		}
	</script>
</head>

<body>
	<div id="button-box">
		<?php
			include "confidential.php";
			if(isset($_GET['adminid'])){
			$adminID=$_GET['adminid'];
			$table = $con->query("SHOW tables");
			echo "<table class='table-condensed'><tr><th>Tablename</th><th>Insert Into table</th><th>Drop Table</th></tr>";
			while($row=mysqli_fetch_array($table))
			{
				echo "<tr><td><button class=\"btn btn-default\" id=\"".$row[0]."table\" onclick=\"clickButton(this, $adminID)\">".ucfirst($row[0])."</button></td>";
				echo "<td><button class=\"btn btn-success\" id=\"".$row[0]."insert\" onclick=\"inserttable(this, $adminID)\">Insert</button></td>";
				echo "<td><button class=\"btn btn-danger\" id=\"".$row[0]."drop\" onclick=\"droptable(this, $adminID)\">Drop</button></td></tr>";
			}
			echo "</table>";
		}
		else
			echo "Pass arguments";
		?>
	</div>
</body>
</html>
