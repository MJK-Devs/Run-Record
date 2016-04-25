<?php
	session_start();
	include_once "db/db.php";
	checkCookie();
?>

<html>
<head>
	<title>Record Run - Login</title>
	<?php include("includes/header.php"); ?>
</head>
<body class="login">
	<?php include("includes/navbar2.php"); ?>
	<div class="container">
		<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div id="login">
				<h1 class="logo page-header text-center">Login</h1>
				<form role="form" action="db/authUser.php" method="post">
					<div class="form-group">
						<label for="usernameInput">Username</label>
						<input type="text" class="form-control" name="username">
					</div>

					<?php
						formPassword();
					?>
	              <button type="submit" value="Login" class="btn btn-primary btn-block login-submit">Login</button>
			  </form>
			</div>
		 </div>

	 </div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>

<?php
function checkCookie() {
	if(isset($_COOKIE['User'])) {
		//redirect user to main page if they are already authenticated.
		header('Location: ./main.php');
	}
}

function formPassword() {
	if(isset($_COOKIE['loginError'])) {
		if(strcmp($_COOKIE['loginError'],"password") == 0) {
			print('
				<div class="form-group">
				<label for="exampleInputPassword2">Password</label>
				<input type="password" class="form-control error" name="password">
				Sorry, that is an invalid username and password combination.
				</div>'
			);
			setcookie("loginError", "", time() - 3600, "/");
		}
	}
	else {
		print('
				<div class="form-group">
				<label for="exampleInputPassword2">Password</label>
				<input type="password" class="form-control" name="password">
				</div>'
			);
	}
}
?>
