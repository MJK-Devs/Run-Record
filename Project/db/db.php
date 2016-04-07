<?php
// =======================================
// Execute Query
// =======================================
// function that returns an array of values from database
// see sample usage below
function executeQuery($query, $attribute) {
    try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

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
// Sample Usage: createUser("knovak19", "web3", "knovak19@kent.edu", "Kevin", "Novak", "1993-11-29", "M");
function createUser($username, $password, $email, $firstname, $lastname, $dob, $gender) {
    try {
        // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

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
// returns true if yes
// Sample Usage: authUser("knovak18", "web2");
function authUser($username, $password) {
    try {
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from rruser where Username=\"" . $username . "\"";
        $result = $pdo->query($sql);

        while ($row = $result->fetch()) {
            if($row['Password'] == $password) {
                return true;
            } else {
                return false;
            }
        }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

// =======================================
// Create Run
// =======================================
// creates a run in the database based on the passed parameters
// Sample Usage: createRun("01/01/2016","1.5","3600");
function createRun($date, $distance, $time) {
    //create record in rruns
    try {
        // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare("INSERT INTO rrruns(Date, Distance, Time)
            VALUES(:Date, :Distance, :Time)");
        $statement->execute(array(
			"Date" => $date,
			"Distance" => $distance,
			"Time" => $time
        ));
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }

    //get last runID created
    $aid = executeQuery("SELECT RunID FROM rrruns ORDER BY RunID DESC LIMIT 1","RunID");
    $id=$aid[0];
    $user = getUserID($_COOKIE['User']);

    //Create Record in rruserruns
        try {
        // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare("INSERT INTO rruserruns(UserID, RunID)
            VALUES(:UserID, :RunID)");
        $statement->execute(array(
            "UserID" => $user,
            "RunID" => $id,
        ));
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
    
}

// =======================================
// Get User ID
// =======================================
// function that returns the UserID based on the passed Username
// Sample Usage: geetUserID("knovak18");
// returns 1
function getUserID($username) {
	try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
		$sql = 'select * from rruser where Username="' . $username . '"';
        $result = $pdo->query($sql);

        // put query results into array
        $array = array();
        while ($row = $result->fetch()) {
			$id = $row['UserID'];
        }
        $pdo = null;

        // return the results
        return $id;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}

// =======================================
// OLD Authenticate User
// =======================================
// function authUser($username, $password) {
//     $pass = executeQuery("SELECT * FROM rruser WHERE Username ='".$username."'", "Password");
//     if(strcmp($pass[0], $password) == 0) {
//         return true;
//     }
//     return false;
// }

// authenticates a user. returns true if the user authenticated
// and false otherwise
/*function authenticate($username, $password) {
	    try {
        // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = "SELECT * FROM rrusers";

        // create query
        $result = $pdo->query($query);

        // put query results into array
        $array = array();
        $authenticated = false;
		print_r($users);

		// finds the username & password in the database
		foreach($users as $user) {
			if(strcmp($username, $user["username"]) === 0){
				if(strcmp($password, $user["password"]) === 0) {
					// credentials matched, so returns true
					$authenticated = true;
				}
			}
		}

		$pdo = null;

		return $authenticated;

    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}*/
?>
