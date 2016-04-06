<?php session_start(); ?>
<html>
<head>
	<title>Create Account</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.en_US.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.js" type="text/javascript"></script>

	<?php
		  include_once "db/db.php";
		  include_once "includes/states.php";
	?>
</head>

<body>
	<div class="header">
		<a href="main.php"><img width="100" height="100" alt="" src="images/logo.png"></a>
		<h1><b>Create Account</b></h1>
	</div>
	<div class="container">
		<div class="row">
		</div>
		<div class="col-md-5">
			<div id="userInformation">
				<form class="form-inline" method="post" action="db/createUser2.php">

					<label for="usernameInput">Username</label>
					<div class="control-group">
						<div class="' . $usernameFormGroup . '">
							<input type="text" class="form-control" name="username" maxlength="20">
							<?php
								if(!empty($_SESSION['failedUsername'])) {
									echo $_SESSION['failedUsername'];
									unset($_SESSION['failedUsername']);
								}
							?>
						</div>
					</div>
					<input type="submit" name="submit">
				</form>
	        </div>
	   </div>
	</div>
</body>
</html>
