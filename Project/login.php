<?php
	session_start();
	include_once "db/db.php";
	checkCookie();
?>

<html>
<head>
	<title>Record Run Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="css/cosmo.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Bangers&text=Record%E2%80%A2Run' rel='stylesheet' type='text/css'>
</head>
<body class="login">
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand logo" href="#">Record•Run</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="create.php">Create An Account</a></li>
        <li><a href="#">Login</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	<div class="container">
		<div class="row">
		

		<div class="col-md-4 col-md-offset-4">
			<div id="login">

				<form role="form" action="db/authUser.php" method="post">
					<div class="form-group">
						<label for="usernameInput">Username</label>
						<input type="text" class="form-control" name="username">
					</div>

					<?php
						formPassword();
					?>
	              <button type="submit" value="submit" class="btn btn-primary btn-block login-submit">Login</button>
			  </form>
			</div>
		 </div>

		 <div class="col-md-6">
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
				<div class="form-group has-error">
				<label for="exampleInputPassword2">Password</label>
				<input type="password" class="form-control" name="password">
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
