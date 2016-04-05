<?php
include_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // array to keep track of which errors
    $createErrors = array();

    if (empty($_POST['username'])) {
        $createErrors[] = "username";
    }
    if (empty($_POST['password'])) {
        $createErrors[] = "password";
    }
    if (empty($_POST['email'])) {
        $createErrors[] = "email";
    }
    if (empty($_POST['firstName'])) {
        $createErrors[] = "firstName";
    }
    if (empty($_POST['lastName'])) {
        $createErrors[] = "lastName";
    }
    if (empty($_POST['dateOfBirth'])) {
        $createErrors[] = "dateOfBirth";
    }
    if (empty($_POST['gender'])) {
        $createErrors[] = "gender";
    }
    if (count($createErrors) > 0) {
        // comment the line below to debug
        header('Location: ../create.php');
        echo "ERROR - The following fields are empty:" . '<br/>';
        foreach ($createErrors as $error) {
            echo $error . '<br/>';
        }
    } else {
        createUser($_POST['username'], $_POST['password'], $_POST['email'], $_POST['firstName'], $_POST['lastName'], $_POST['dateOfBirth'], $_POST['gender']);
        header('Location: ../main.php');
    }
}
?>
