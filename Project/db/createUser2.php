<?php
session_start();

// ========================================
// Username
// ========================================
// if username is set
if (isset($_POST['username'])) {
    // checks if username is empty
    if (empty($_POST['username'])) {
        $_SESSION['failedUsername'] = "Username cannot be empty!";
    }
}

// ========================================
// Password
// ========================================
// if password is set
if (isset($_POST['password'])) {
    // checks if password is empty
    if (empty($_POST['password'])) {
        $_SESSION['failedPassword'] = "Password cannot be empty!";
    }
}

// ========================================
// Verify
// ========================================
// if verify password is set
if (isset($_POST['verifyPassword'])) {
    // checks if verify is empty
    if (empty($_POST['verifyPassword'])) {
        $_SESSION['failedVerifyPassword'] = "Please verify your password!";
    } else {
        // otherwise if verify is not empty
        // and verify doesnt match, then send an error
        if (isset($_POST['password'])) {
            if ($_POST['password'] != $_POST['verifyPassword']) {
                $_SESSION['failedVerifyPassword'] = "Passwords do not match!";
            }
        }
    }
}

// if errors go to create page
header("Location: ../create2.php");

// if no errors then create the user
// use the createUser function in db.php
// then go to the main page
?>
