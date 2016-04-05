<?php
	
	include_once "db/db.php";


	if(isset($_COOKIE['User'])) { 
		//redirect user to main page if they are already authenticated.
		header('Location: https://webdev.cs.kent.edu/~mboehlke/Web2/RR/main.php');
	}

?>

<head> <title>Record Run Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="style.css" rel="stylesheet">
<?php include_once "db/db.php"; ?>
</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$invalidCredentials = true;
	$invalidCredsMessage = "Invalid username or password";
	
	if(isset($_POST['username'])) {
		print_r($_POST['username']);
	}
	if(isset($_POST['password'])) {
		
	}
	$authenticated = authenticate($_POST['username'], $_POST['password']);
}
?>
<body>
<div class="header">
	<a href="main.php"><img width="100" height="100" alt="" src="images/logo.png"></a>
	<h1><b>Login</b></h1>
</div>

<div class="container">
	<div class="row">
	</div>
	<div class="col-md-6">
		<div id="login">
			
<<<<<<< HEAD
			<form class="form" method="post">
				<div class="form-group">
					<label for="usernameInput">Username</label>
					<input type="text" class="form-control" name="username">
=======
			<form role="form" action="db/authUser.php" method="post">
				<div class="form-group">
					<label >Username</label>
					<input type="text" class="form-control" name="email">
>>>>>>> origin/master
				</div>
				<div class="form-group">
                  <label for="passwordInput">Password</label>
                  <input type="password" class="form-control" name="password">
                </div>
<<<<<<< HEAD
			  
			  <button type="submit" class="btn btn-primary" action="post">Login</button>
              <!--<input type="submit" action="post" name="submit">	-->
=======
              <button type="submit" value="submit" class="btn btn-primary">Login</button>
>>>>>>> origin/master
            </form>  
         </div>
      </div>
      <div class="col-md-6">
      </div>
   </div>  
</div>  <!-- end container -->
</body>
<?php





?>

