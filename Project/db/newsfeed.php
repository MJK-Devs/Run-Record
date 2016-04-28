<?php
	try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $query = "SELECT rrruns.RunID,`Distance`,`Time`,`AddDate`,rruser.`UserID`,rruser.Username FROM `rrruns` LEFT JOIN `rruserruns` on rrruns.RunID=rruserruns.RunID LEFT JOIN rruser on rruser.UserID=rruserruns.UserID ORDER BY `AddDate` DESC LIMIT 10";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
        $statement = $pdo->prepare($query);
        $statement->execute();

        // put query results into array
        $a = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach($a as $row) {
        	//echo $row['RunID']." ".$row['Distance']." ".$row['Time']." ".$row['AddDate']." ".$row['UserID']."<br />";

			echo '<div class="panel panel-primary">';
				echo '<div class="panel-heading">';
					echo '<h3 class="panel-title">'.$row['Username'].'\'s Run on '.$row['AddDate'].'</h3>';
				echo '</div>';
				echo '<div class="panel-body">';
					echo 'Distance:'.$row['Distance'].' miles<br />';
					echo 'Time:'.$row['Time'].'<br />';
				echo '</div>';
			echo '</div>';

        }

        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
?>