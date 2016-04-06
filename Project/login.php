<?php
	include_once "db/db.php";

	// DEBUG - Comment the below for testing purposes
<?php
function checkCookie() {
	if(isset($_COOKIE['User'])) {
		//redirect user to main page if they are already authenticated.
		header('Location: https://webdev.cs.kent.edu/~mboehlke/Web2/RR/main.php');
	}
}

function formPassword() {
	if(isset($_COOKIE['loginError'])) {
		if(strcmp($_COOKIE['loginError'],"password") == 0) {
			print('
				<div class="form-group has-error">
				<label for="exampleInputPassword2">Password</label>
				<input type="password" class="form-control" name="password">
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
