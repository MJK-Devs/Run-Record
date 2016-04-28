<?php
	try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $query = "SELECT `RunID`,`Distance`,`Time`,`AddDate`,`UserID` FROM `rrruns` NATURAL JOIN `rruserruns` ORDER BY `AddDate` DESC LIMIT 10";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
        $statement = $pdo->prepare($query);
        $statement->execute();

        // put query results into array
        $a = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach($a as $row) {
        	echo $row['RunID']." ".$row['Distance']." ".$row['Time']." ".$row['AddDate']." ".$row['UserID']."<br />";
        }

        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
?>