<?php
// =======================================
// Execute Query
// =======================================
// function that returns an array of values from database
// see sample usage below
function executeQuery($query, $attribute) {
    try {
         // connect to database
        #$connString = "mysql:host=localhost;dbname=knovak18";
        #$user = "knovak18";
        #$pass = "web2";
        $connString = "mysql:host=localhost;dbname=mboehlke";
        $user = "mboehlke";
        $pass = "01lJZjam";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
        $result = $pdo->query($query);

        // put query results into array
        $array = array();
        while ($row = $result->fetch()) {

            // selects the row based on the pased attribute
            $array[] = $row[$attribute];
        }
        $pdo = null;

        // return the results
        return $array;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}

// // Execute Query - Sample Usage:
// $artists = executeQuery("select * from rruser where UserID = 1", "FirstName");
// foreach($artists as $value) {
//     // echos out "Kevin"
//     echo $value . '<br/>';
// }

// =======================================
// Create User
// =======================================
// creates a user in the database based on the passed parameters
function createUser($username, $password, $email, $firstname, $lastname, $dob, $gender) {
    try {
        // connect to database
        #$connString = "mysql:host=localhost;dbname=knovak18";
        #$user = "knovak18";
        #$pass = "web2";
        $connString = "mysql:host=localhost;dbname=mboehlke";
        $user = "mboehlke";
        $pass = "01lJZjam";
        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare("INSERT INTO rruser(Username, Password, Email, FirstName, LastName, DOB, Gender)
            VALUES(:Username, :Password, :Email, :FirstName, :LastName, :DOB, :Gender)");
        $statement->execute(array(
            "Username" => $username,
            "Password" => $password,
            "Email" => $email,
            "FirstName" => $firstname,
            "LastName" => $lastname,
            "DOB" => $dob,
            "Gender" => $gender
        ));
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}

// =======================================
// Authenticate User
// =======================================
// Checks if a user with the provided password exists in the database
// returns TRUE if yes
function authUser($username, $password) {
    $pass = executeQuery("SELECT * FROM rruser WHERE Username ='".$username."'", "Password");
    if(strcmp($pass, $password) == 0) {
        return true;
    }
    return false;
}

// // Create User - Sample Usage:
// createUser("knovak19", "web3", "knovak19@kent.edu", "Kevin", "Novak", "1993-11-29", "M");
?>
