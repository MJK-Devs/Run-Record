<?php

	include_once "db.php";

	if(isset($_POST['email']) && isset($_POST['password'])) {

		$email = $_POST['email'];
		$pass = $_POST['password'];
		
		if(authenticate($email, $pass)) {
			setcookie("User", $_POST['email'], time() + (86400 * 30), "/"); // 86400 = 1 day
			setcookie("loginError", "", time() - 3600, "/"); //reset any login errors
			header('Location: https://webdev.cs.kent.edu/~mboehlke/Web2/RR/main.php');
		}
		else {
			setcookie("loginError", "password", time() + (30), "/");
			header('Location: https://webdev.cs.kent.edu/~mboehlke/Web2/RR/login.php');
		}
	}
?>