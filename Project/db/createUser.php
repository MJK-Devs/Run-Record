<?php
include_once 'db.php';
$gender = null;
if ($_POST['male'] == "on") {
    $gender = 'M';
} else if ($_POST['female'] == "on") {
    $gender = 'F';
}
createUser($_POST['username'], $_POST['password'], $_POST['email'], $_POST['firstName'], $_POST['lastName'], $_POST['dateOfBirth'], $gender);
?>
