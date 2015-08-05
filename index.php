<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="./dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="./fontawesome/css/font-awesome.min.css">
<style>
body {
padding-top: 40px;
padding-bottom: 40px;
background-color: #eee;
}
.form-signin {
max-width: 330px;
padding: 15px;
margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
margin-bottom: 10px;
}
.form-signin .checkbox {
font-weight: normal;
}
.form-signin .form-control {
position: relative;
height: auto;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
padding: 10px;
font-size: 16px;
}
.form-signin .form-control:focus {
z-index: 2;
}
.form-signin input[type="email"] {
margin-bottom: -1px;
border-bottom-right-radius: 0;
border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
margin-bottom: 10px;
border-top-left-radius: 0;
border-top-right-radius: 0;
}
input {
margin-left: 19%;
}
</style>
</head>
<body>

	<div class="container">
		<div class='well'>
			<h1 class='text-center'><b>Spencers </b></h1><hr>
		<h1 class='text-center'>
		<form class="form-signin" role="form" action="mainpage.php" method="POST">
			<h2 class="form-signin-heading"><i class='fa fa-sign-in fa-1x'></i> Login</h2>
      			<input name="email" type="email" class="form-control" id="emailid" placeholder="Email" required autofocus>
      			<input name="passwd" class="form-control" type="password" id="passwordid" placeholder="Password" required><hr>
			<button class="btn btn-lg btn-primary" value="Login" type="submit">Sign in</button>
		</form></h1>
		</div>
	</div>
	<!--<div id="line"></div>
	<div id="register-box">
		<h1>Register</h1>
		<form action="bankdetails.php" method="POST">
			Name:<input name="Name" required/><br/>
			Email:<input name="Email" required/><br/>
			Phone No.:<input name="PhoneNo" required/><br/>
			DOB:<input name="DOB" required/><br/>
			Street Address:<input name="StreetAddr" required/><br/>
			City:<input name="City" required/><br/>
			State:<input name="State" required/><br/>
			Country:<input name="Country" required/><br/>
			Role:<input name="Whoisit" required/><br/>
			Password:<input name="Password" required/><br/>
			Confirm Password:<input name="ConfPassword" required/><br/>
			<input type="submit" class="btn btn-lg btn-primary" value="Submit"/>
		</form>
	</div>-->
</body>
</html>

