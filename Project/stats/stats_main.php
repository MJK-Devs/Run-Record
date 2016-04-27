<?php session_start(); ?>
<html>
<head>
	<title>Record Run - Stats</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.en_US.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.js" type="text/javascript"></script>

	<?php
		  include_once "../db/db.php";
	?>
</head>

<body>
	<?php
	include("../db/user.php");
	//include("../db/db.php");
	include("navbar.php");
	include("runs.php");

	$user = new User(getUserID($_COOKIE['User']));

	if(isset($_COOKIE['User'])) {
		$username = $_COOKIE['User'];
	} //else { $username = ""; }
	?>

	<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 toppad" >
	   <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Totals</h3>
		  </div>
		  <div class="panel-body">
			<div class="row">

			  <div class="c1ol-md-9 col-lg-9">
				<table class="table table-user-information">
				  <tbody>
					<?php userTotals(); ?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
		<div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Averages</h3>
		  </div>
		  <div class="panel-body">
			<div class="row">
			  <div class="c1ol-md-9 col-lg-9">
				<table class="table table-user-information">
				  <tbody>
					<?php userAverages(); ?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	</div>


	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6  toppad" >
	   <div class="panel panel-info">
		  <div class="panel-heading">
			<h3 class="panel-title">Charts</h3>
		  </div>
		  <div class="panel-body">
			<div class="row">
			  <div class="c1ol-md-9 col-lg-9">
				<table class="table table-user-information">
				  <tbody>

				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	</div>

	<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 toppad" >
	   <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Personal Info</h3>
		  </div>
		  <div class="panel-body">
			<div class="row">
			  <div class="c1ol-md-9 col-lg-9">
				<table class="table table-user-information">
				  <tbody>
				    <?php userPersonalInfo(); ?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>


<?php

function userTotals() {
	$user = new User(getUserID($_COOKIE['User']));
	
	$runs = new UserRuns(getUserID($_COOKIE['User']));
	echo '<tr>
 		    <td>Runs</td>
     	    <td>' . $runs->getTotalNumberOfRuns() . '</td>
		  </tr>';
	echo '<tr>
 		    <td>Distance</td>
     	    <td>' . $runs->getTotalDistance() . '</td>
		  </tr>';
	echo '<tr>
 		    <td>Time</td>
     	    <td>' . $runs->getTotalTime() . '</td>
		  </tr>';
	echo '<tr>
 		    <td>Calories Burned</td>
     	    <td>' . $runs->getTotalCaloriesBurned() . '</td>
		  </tr>';

}

function userAverages() {
	$user = new User(getUserID($_COOKIE['User']));
	$runs = new UserRuns(getUserID($_COOKIE['User']));
	echo '<tr>
   		    <td>Distance</td>
			<td>' . $runs->getAverageDistance() . '</td>
		  </tr>';
	echo '<tr>
			<td>Time</td>
			<td>' . $runs->getAverageTime() . '</td>
		  </tr>';
	echo '<tr>
			<td>Pace</td>
			<td>' . $runs->getAveragePace() . '</td>
		  </tr>';
	echo '<tr>
			<td>Calories Burned</td>
			<td>' . $runs->getAverageCaloriesBurned() . '</td>
		  </tr>';
}

function userPersonalInfo() {
	$user = new User(getUserID($_COOKIE['User']));
	echo '<tr>
   		    <td>Height</td>
			<td>' . $user->getHeight() . '"</td>
		  </tr>';
	echo '<tr>
			<td>Weight</td>
			<td>' . $user->getWeight() . '</td>
		  </tr>';
	echo '<tr>
			<td>BMI</td>
			<td><font color="' . BMIcolor($user->getBMI()) . '">' . $user->getBMI() . " " . BMIhealthStatus($user->getBMI()) . '</font></td>
		  </tr>';
}

function BMIhealthStatus($BMI){
	if (strcmp($BMI, "Set height and weight to calculate BMI.") === 0) { return ""; }
	else {
		if($BMI < 18.5){
			return "(Underweight)";
		}
		else if($BMI >= 18.5 and $BMI <= 25){
			return "(Healthy)";
		}
		else if($BMI > 25 and $BMI < 30) {
			return "(Overweight)";
		}
		else {
			return "(Obese)";
		}
	}
	
	
}

function BMIcolor($BMI) {
	if (strcmp($BMI, "Set height and weight to calculate BMI.") === 0) { return "black"; }
	else {
		if($BMI < 18.5){
			return "blue";
		}
		else if($BMI >= 18.5 and $BMI <= 25){
			return "green";
		}
		else if($BMI > 25 and $BMI < 30) {
			return "orange";
		}
		else {
			return "red";
		}
	}
	
}

function convertDate($date){
	date_default_timezone_set('America/New_York');
	$newDate = date("m-d-Y", strtotime($date));
	return $newDate;
}
?>
