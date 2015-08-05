<?php
	include "confidential.php";
	if ($con->connect_error) {
 	   die("Connection failed: " . $conn->connect_error);
	}
	$email = $_POST['email'];
	$passwd = $_POST['passwd'];
	$out = $con->query("SELECT * FROM person where email='".$email."'");

	//echo $email.$passwd;
	while($row = mysqli_fetch_array($out)){
		if($row['password']==$passwd){
			if ($row['whoisit']=="admin")
			{
				header("Location: http://localhost/spencers/adminpage.php?adminid=".$row['person_id']);
			}
			else if($row['whoisit']=="manager")
			{
				$tmp=$con->query("INSERT INTO employee (person_id) VALUES (".$row['person_id'].")");
				header("Location: http://localhost/spencers/managerpage.php?managerid=".$row['person_id']);
			}
			else
			{
				header("Location: http://localhost/spencers/customerpage.php?adminid=".$row['person_id']);
			}
		}
		else{
			echo "Invalid password";
		}
	}
?>
