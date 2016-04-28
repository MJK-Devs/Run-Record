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
				<h3 align="center"><b>My Runs</b></h3>
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
        $user = "knovak18";
        $pass = "web2";

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
		echo '<div class="col-xs-9 col-sm-9 col-md-7 col-lg-7 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3  toppad" >';
        while ($row = $result->fetch()) {
			$dayOfWeek = date("l",strtotime($row['Date']));
			$month = date("F",strtotime($row['Date']));
			$day = date("j",strtotime($row['Date']));
			$year = date("Y",strtotime($row['Date']));
			echo	
					   '<div class="panel panel-info">
						  <div class="panel-heading">
							<h3 class="panel-title"><strong>' . $dayOfWeek . ', ' . $month . ' ' . $day . ', ' . $year . '</strong></h3>
						  </div>
						  <div class="panel-body">
							<div class="row">
							  <div class="col-md-6 col-lg-6">
								<table class="table table-user-information">
								  <tbody>
								    <tr>
									  <td>Distance</td>
									  <td>' . $row['Distance'] . ' miles</td>
									</tr>
									<tr>
									  <td>Time</td>
									  <td>' . gmdate("H:i:s", $row['Time']) . '</td>
									</tr>
									<tr>
									  <td>Pace</td>
									  <td>' . gmdate("i:s", $row['Time']/$row['Distance']) . '</td>
									</tr>
								  </tbody>
								</table>
							  </div>
							</div>
						  </div>
						</div>';
			//echo '<div style="margin:3px 3px 15px 3px">';


			//echo '<strong>' . $dayOfWeek . ', ' . $month . ' ' . $day . ', ' . $year . '</strong>';
			//echo '<br>';

			//echo 'Distance: ' . $row['Distance'] . ' Miles';
			//echo '<br>';

			//echo 'Time: ' . gmdate("H:i:s", $row['Time']);

			//echo '</div>';
		}
		echo '</div>';
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}
?>
