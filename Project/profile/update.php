<?php 
session_start(); 
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

$error=FALSE;

// ========================================
// First Name
// ========================================
if (isset($_POST['firstName'])) {
    $_SESSION['firstName'] = $_POST['firstName'];
    // checking name length
    if (strlen($_POST['firstName']) > 20) {
        $_SESSION['failedFirstName'] = "Names cannot be longer than 20 letters!";
        $error=TRUE;
    }
    // checking for allowed characters
    if(!ctype_alpha($_POST["firstName"])) {
        $_SESSION['failedFirstName'] = "Names can only contain letters!";
        $error=TRUE;
    }
    // checks if first name is empty
    if (empty($_POST['firstName'])) {
        $_SESSION['failedFirstName'] = "Please fill in your first name!";
        $error=TRUE;
    }
}

// ========================================
// Last Name
// ========================================
if (isset($_POST['lastName'])) {
    $_SESSION['lastName'] = $_POST['lastName'];
    // checking name length
    if (strlen($_POST['lastName']) > 20) {
        $_SESSION['failedLastName'] = "Names cannot be longer than 20 letters!";
        $error=TRUE;
    }
    // checking for allowed characters
    if(!ctype_alpha($_POST["lastName"])) {
        $_SESSION['failedLastName'] = "Names can only contain letters!";
        $error=TRUE;
    }
    // checks if last name is empty
    if (empty($_POST['lastName'])) {
        $_SESSION['failedLastName'] = "Please fill in your last name!";
        $error=TRUE;
    }
}

// ========================================
// Email
// ========================================
if (!empty($_POST['email'])) {
	
}
else {
    $_SESSION['failedEmail'] = "Please Enter an Email!";
    $error=TRUE;
}

// ========================================
// State
// ========================================
if (!empty($_POST['state'])) {
    $_SESSION['state'] = $_POST['state'];
}
else {
    $_SESSION['failedState'] = "Please Select a State!";
    $error=TRUE;
}

// ========================================
// City
// ========================================
if (isset($_POST['city'])) {
    $_SESSION['city'] = $_POST['city'];

    // checking for allowed characters
    if(!ctype_alpha($_POST["city"])) {
        $_SESSION['failedCity'] = "City names can only contain letters!";
        $error=TRUE;
    }
    if (empty($_SESSION['city'])) {
        $_SESSION['failedCity'] = "Please Enter a City!";
        $error=TRUE;
    }
}

if($error) {header("Location: edit.php");} 
else {


$user = new User(getUserID($username));
$user->changeInfo($username, $email, $firstname, $lastname, $weight, $height, $aboutme, $city, $state);

if(isset($_FILE)){
	header("Location: profilePicUpload.php");
}
header("Location: profile.php");
}
?>