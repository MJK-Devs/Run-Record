<?php
include("../db/user.php");
include("../db/db.php");

$user = new User(getUserID($_COOKIE['User']));
$user->deleteUser();

header("Location: ../welcome.php");

?>