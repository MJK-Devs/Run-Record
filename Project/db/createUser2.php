<?php
session_start();

if (isset($_POST['username'])) {
    // checks if username is empty
    if (empty($_POST['username'])) {
        $_SESSION['failedUsername'] = "Username cannot be empty!";
    }
}

if (isset($_POST['password'])) {
    // checks if password is empty
    if (empty($_POST['password'])) {
        $_SESSION['failedPassword'] = "Password cannot be empty!";
    }
}

if (isset($_POST['verifyPassword'])) {
    // checks if password is empty
    if (empty($_POST['verifyPassword'])) {
        $_SESSION['failedVerifyPassword'] = "Please verify your password!";
    } else {
        if (isset($_POST['password'])) {
            if ($_POST['password'] != $_POST['verifyPassword']) {
                $_SESSION['failedVerifyPassword'] = "Passwords do not match!";
            }
        }
    }
}

header("Location: ../create2.php");
?>
