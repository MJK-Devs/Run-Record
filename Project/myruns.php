<?php
session_start();
date_default_timezone_set('America/New_York');
include "db/db.php";
include_once "stats/runs.php";
?>

<html>
<head>
	<title>Record Run - My Runs</title>
	<?php include("includes/header.php"); ?>
</head>
<body>
	<?php include("includes/navbar.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-3"><!--Div for left sidebar content--> </div>
			<div class="col-md-6">
				<?php displayRuns(getUserID($_COOKIE['User'])); ?>
			</div>
			<div class="col-md-3"> <!--Div for right sidebar content--></div>
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
	$r = new UserRuns(getUserID($_COOKIE['User']));
	$runs = $r->getRuns();

	if(empty($runs)) {
		echo '<br /> <br />';
		echo'<a class="btn btn-primary btn-large text-center" style="display:block" href="record.php">Record Your First Run! </a>';
		return;
	}

	$IDtoEdit = "";
	if(isset($_GET["RunID"])){
		$IDtoEdit = $_GET["RunID"];
	}

	// print each run as a panel
	foreach($runs as $run) {
		echo $run->printRunPanel();
	}

}
?>
