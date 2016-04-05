<?php
	
	include_once "db/db.php";


	if(isset($_COOKIE['User'])) { 
		//redirect user to main page if they are already authenticated.
		header('Location: https://webdev.cs.kent.edu/~mboehlke/Web2/RR/main.php');
	}

	function formPassword() {
		if(isset($_COOKIE['loginError'])) {
			if(strcmp($_COOKIE['loginError'],"password") === 0) {
				print('<div class="form-group has-error">');
				print('
					<div class="form-group">
                 	<label for="exampleInputPassword2">Password</label>
                  	<input type="password" class="form-control" name="password">
                  	</div>'
                );
				setcookie("loginError", "", time() - 3600, "/");
			}
		}
		else {
			print('<div class="form-group>"');
			print('
					<div class="form-group">
                  	<label for="exampleInputPassword2">Password</label>
                  	<input type="password" class="form-control" name="password">
                  	</div>'
                );
		}
	}

?>

<head> <title>Record Run Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="style.css" rel="stylesheet">
</head>

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
			
			<form role="form" action="db/authUser.php" method="post">
				<div class="form-group">
					<label for="usernameInput">Username</label>
					<input type="text" class="form-control" name="username">
				</div>
				<?php
					formPassword();
				?>
              <button type="submit" value="submit" class="btn btn-primary">Login</button>
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

