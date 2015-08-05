<?php
	include "confidential.php";
	$query="DROP TABLE ".$_GET['tablename'];
	$res=$con->query($query);
	if($res){
		header("Location: http://localhost/spencers/adminpage.php?adminid=".$_GET['adminID']);
	}
?>