<?php

	include_once "db.php";

	if(isset($_POST['email']) && isset($_POST['password'])) {

		$email = $_POST['email'];
		$pass = $_POST['password'];
		
		if(authUser($email, $pass)) {
			setcookie("User", $_POST['email'], time() + (86400 * 30), "/"); // 86400 = 1 day
			header('Location: https://webdev.cs.kent.edu/~mboehlke/Web2/RR/main.php');
		}
	}
?>