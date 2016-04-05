<?php
// set the expiration date to one hour ago
setcookie("User", "", time() - 3600, "/");
setcookie("loginError", "", time() - 3600, "/"); // reset any login errors
header('Location: https://webdev.cs.kent.edu/~mboehlke/Web2/RR/login.php');
?>