<?php
session_start();

if (isset($_POST['username'])) {
    if (empty($_POST['username'])) {
        $_SESSION['failedUsername'] = "Username cannot be empty!";
    }
}

header("Location: ../create2.php");
?>
