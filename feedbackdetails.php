<html>
<head>
<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
</head>
<body>
<?php
	include 'confidential.php';
	$q = $con->query("SELECT * FROM suggestion JOIN feedback ON feedback.feedback_id=suggestion.feedback_id JOIN customer ON feedback.customer_id=customer.customer_id JOIN person ON person.person_id=customer.person_id");
	echo "<h1>Suggestions</h1>";
	echo "<table class='table'>";

	echo "<tr><th>Customer name</th><th>Date</th><th>Time</th><th>Suggestion</th></tr>";
	while($row=mysqli_fetch_array($q)){
		//print_r($row);
		echo "<tr><td>".$row['name']."</td><td>".$row['date']."</td><td>".$row['time']."</td><td>".$row['text']."</td></tr>";
	}
	echo "</table><br/><br/>";

	$q = $con->query("SELECT * FROM complaint JOIN feedback ON feedback.feedback_id=complaint.feedback_id JOIN customer ON feedback.customer_id=customer.customer_id JOIN person ON person.person_id=customer.person_id");
	echo "<h1>Complaints</h1>";
	echo "<table class='table'>";

	echo "<tr><th>Customer name</th><th>Date</th><th>Time</th><th>Suggestion</th></tr>";
	while($row=mysqli_fetch_array($q)){
		//print_r($row);
		echo "<tr><td>".$row['name']."</td><td>".$row['date']."</td><td>".$row['time']."</td><td>".$row['text']."</td></tr>";
	}
	echo "</table><br/><br/>";
?>
</body>
</html>
