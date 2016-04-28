<?php
include("../db/user.php");
include("../db/db.php");

$username = $_COOKIE['User'];
$firstname = $_POST['firstName'];
$lastname = $_POST['lastName'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$city = $_POST['city'];
$email = $_POST['email'];
$state = $_POST['state'];
$aboutme = $_POST['aboutMe'];

$user = new User(getUserID($username));
$user->changeInfo($username, $email, $firstname, $lastname, $weight, $height, $aboutme, $city, $state);

if(isset($_FILE)){
	header("Location: profilePicUpload.php");
}
header("Location: profile.php");
?>