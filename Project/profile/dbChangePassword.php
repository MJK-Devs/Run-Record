<?php
session_start();
include("../db/user.php");
include("../db/db.php");

$username = $_COOKIE['User'];
$current = $_POST['current'];
$new = $_POST['new'];
$confirm = $_POST['confirm'];

// ========================================
// Current password
// ========================================
// if authetntication returns true
$error = !authUser($username, $current);

if($error){
	$_SESSION['failedCurrent'] = "Invalid password";
}

// ========================================
// New Password
// ========================================
// if password is set
if (isset($new)) {
    // checking password length
    if (strlen($new) < 8 || strlen($new) > 20) {
        $_SESSION['failedNew'] = "Password must be between 8 and 20 characters!";
        $error=TRUE;
    }
    // checking for allowed characters
    if(!ctype_alnum($new)) {
        $_SESSION['failedNew'] = "Passwords can only contain alphanumeric characters!";
        $error=TRUE;
    }
    // checks if password is empty
    if (empty($new)) {
        $_SESSION['failedNew'] = "Password cannot be empty!";
        $error=TRUE;
    }
}

// ========================================
// Confirm
// ========================================
// if confirm password is set
if (isset($confirm)) {
    // checks if verify is empty
    if (empty($confirm)) {
        $_SESSION['failedConfirm'] = "Please verify your password!";
        $error=TRUE;
    } else {
        // otherwise if verify is not empty
        // and verify doesnt match, then send an error
        if (isset($confirm)) {
            if ($new != $confirm) {
                $_SESSION['failedConfirm'] = "Passwords do not match!";
                $error=TRUE;
            }
        }
    }
}

print_r($_SESSION);

if($error){
	header("Location: changePassword.php");
} 
else {
	$user = new User(getUserID($username));
	$user->changePassword($new);

	header("Location: edit.php");
}


?>