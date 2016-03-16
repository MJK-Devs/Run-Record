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

// =======================================
// Sample Usage:
// =======================================
// $artists = executeQuery("select * from artists", "LastName");
// foreach($artists as $value) {
//     echo $value . '<br/>';
// }
?>
