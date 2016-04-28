<?php
session_start();
date_default_timezone_set('America/New_York');
?>

<html>
<head>
	<title>Record Run - My Runs</title>
	<?php include("includes/header.php"); ?>
</head>
<body>
	<?php
		include("includes/navbar.php");
		include_once "db/db.php"
	?>

	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<h3><b>My Runs</b></h3>
				<?php displayRuns(getUserID($_COOKIE['User'])); ?>
			</div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>

<?php
function displayRuns($UserID) {
    try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = DB_USERNAME;
        $pass = DB_PWD;

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
		$sql = "select Date, Distance, Time from rruser natural join rruserruns natural join rrruns where UserID=" . $UserID . " order by Date DESC, AddDate DESC";
        $result = $pdo->query($sql);

		//if no runs in database
		$number_of_rows = $result->rowCount();
		if ($number_of_rows == 0) {
			echo 'You have no recorded runs.';
			echo '<b><a href=record.php><br>Record your first run</a></b>';
		}

        while ($row = $result->fetch()) {
			echo '<div style="margin:3px 3px 15px 3px">';

			$dayOfWeek = date("l",strtotime($row['Date']));
			$month = date("F",strtotime($row['Date']));
			$day = date("j",strtotime($row['Date']));
			$year = date("Y",strtotime($row['Date']));
			echo '<strong>' . $dayOfWeek . ', ' . $month . ' ' . $day . ', ' . $year . '</strong>';
			echo '<br>';

			echo 'Distance: ' . $row['Distance'] . ' Miles';
			echo '<br>';

			echo 'Time: ' . gmdate("H:i:s", $row['Time']);

			echo '</div>';
		}
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}
?>
