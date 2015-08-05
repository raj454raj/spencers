<?php
	if(isset($_GET['tablename'])&&isset($_GET['index']))
	{
	include 'confidential.php';
	$sql = "DELETE FROM ".$_GET['tablename']." WHERE ".$_GET['tablename']."_id = ".$_GET['index'];
	if ($con->query($sql) === TRUE) {
		header("Location: http://localhost/spencers/table.php?tablename=".$_GET['tablename']."&adminID=".$_GET['adminID']);
	} 
	else {
    	echo "Error deleting record: " . $con->error;
	}
}
else
	echo "Pass arguments";
?>