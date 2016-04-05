<?php
// set the expiration date to one hour ago
setcookie("User", "", time() - 3600, "/");
header('Location: https://webdev.cs.kent.edu/~mboehlke/Web2/RR/login.php');
?>