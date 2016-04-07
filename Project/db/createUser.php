<?php
session_start();
include_once 'db.php';

$error=FALSE;

// ========================================
// Username
// ========================================
// if username is set
if (isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
    // checking username length
    if (strlen($_POST['username']) < 5 || strlen($_POST['username']) > 20) {
        $_SESSION['failedUsername'] = "Username must be between 5 and 20 characters!";
        $error=TRUE;
    }
    // checking for allowed characters
    if(!ctype_alnum($_POST["username"])) {
        $_SESSION['failedUsername'] = "Usernames can only contain alphanumeric characters!";
        $error=TRUE;
    }
    // checks if username is empty
    if (empty($_POST['username'])) {
        $_SESSION['failedUsername'] = "Username cannot be empty!";
        $error=TRUE;
    }
    if(getUserID($_POST['username']) > 0) {
        $_SESSION['failedUsername'] = "Username already in use.";
        $error = TRUE;
    }
}

// ========================================
// Password
// ========================================
// if password is set
if (isset($_POST['password'])) {
    // checking password length
    if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20) {
        $_SESSION['failedPassword'] = "Password must be between 8 and 20 characters!";
        $error=TRUE;
    }
    // checking for allowed characters
    if(!ctype_alnum($_POST["password"])) {
        $_SESSION['failedPassword'] = "Passwords can only contain alphanumeric characters!";
        $error=TRUE;
    }
    // checks if password is empty
    if (empty($_POST['password'])) {
        $_SESSION['failedPassword'] = "Password cannot be empty!";
        $error=TRUE;
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
        $error=TRUE;
    } else {
        // otherwise if verify is not empty
        // and verify doesnt match, then send an error
        if (isset($_POST['password'])) {
            if ($_POST['password'] != $_POST['verifyPassword']) {
                $_SESSION['failedVerifyPassword'] = "Passwords do not match!";
                $error=TRUE;
            }
        }
    }
}

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
// Gender
// ========================================
if (!empty($_POST['gender'])) {
    $_SESSION['gender'] = $_POST['gender'];
}
else {
    $_SESSION['failedGender'] = "Please Select a Gender!";
    $error=TRUE;
}

// ========================================
// Date Of Birth
// ========================================
if (!empty($_POST['dateOfBirth'])) {
    $_SESSION['dateOfBirth'] = $_POST['dateOfBirth'];
    // checking name length
}
else {
    $_SESSION['failedDateOfBirth'] = "Please Select a Birthday!";
    $error=TRUE;
}

// ========================================
// Email
// ========================================
if (!empty($_POST['email'])) {

    if(!checkEmail($_POST['email'])) {
        $_SESSION['email'] = $_POST['email'];
    }
    else {
        $_SESSION['failedEmail'] = "This email already in use.";
    }
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

// ========================================
// Zip
// ========================================
if (!empty($_POST['zip'])) {
    $_SESSION['zip'] = $_POST['zip'];  
}
else{
    $_SESSION['failedZip'] = "Please Enter your Zip Code!";
    $error=TRUE;
}


// if errors go to create page
if($error) {header("Location: ../create.php");}
else{

createUser($_SESSION['username'],$_POST['password'], $_SESSION['email'], $_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['dateOfBirth'], $_SESSION['gender']);

header("Location: ../login.php");
 }
// if no errors then create the user
// use the createUser function in db.php
// then go to the main page
?>
