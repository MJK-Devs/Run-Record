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
	echo '<tr>
 		    <td>Distance</td>
     	    <td>0</td>
		  </tr>';
	echo '<tr>
 		    <td>Time</td>
     	    <td>0</td>
		  </tr>';
	echo '<tr>
 		    <td>Calories Burned</td>
     	    <td>0</td>
		  </tr>';

}

function userAverages() {
	$user = new User(getUserID($_COOKIE['User']));
	echo '<tr>
   		    <td>Distance</td>
			<td>0</td>
		  </tr>';
	echo '<tr>
			<td>Time</td>
			<td>0</td>
		  </tr>';
	echo '<tr>
			<td>Pace</td>
			<td>0</td>
		  </tr>';
	echo '<tr>
			<td>Calories Burned</td>
			<td>0</td>
		  </tr>';
	echo '<tr>
			<td>Miles per Week</td>
			<td>0</td>
		  </tr>';
	echo '<tr>
			<td>Miles per Month</td>
			<td>0</td>
		  </tr>';
	echo '<tr>
			<td>Miles per Year</td>
			<td>0</td>
		  </tr>';

}

function userPersonalInfo() {
	$user = new User(getUserID($_COOKIE['User']));
	echo '<tr>
   		    <td>Height</td>
			<td>' . $user->getHeight() . '</td>
		  </tr>';
	echo '<tr>
			<td>Weight</td>
			<td>' . $user->getWeight() . '</td>
		  </tr>';
	echo '<tr>
			<td>BMI</td>
			<td>' . $user->getWeight() . '</td>
		  </tr>';
}


function userInfoTable() {
	$user = new User(getUserID($_COOKIE['User']));
	echo '<tr>
		    <td>Height</td>
		    <td>' . $user->getHeight() . '</td>
         </tr>';
	echo '<tr>
			<td>Gender</td>
			<td>' . $user->getGender() . '</td>
		  </tr>';
	echo '<tr>
			<td>Location</td> <!-- city, state -->
			<td>' . $user->getCity() . ", " . $user->getState() . '</td>
		  </tr>';
	echo '<tr>
			<td>Email</td>
	    	<td>'. $user->getEmail() . '</td>
		  </tr>';
	echo '<tr>
			<td>Member Since</td>
			<td>' . convertDate($user->getJoinDate()) . '</td>
		  </tr>';
}

function calculateAge($DOB) {
	date_default_timezone_set('America/New_York');
    return date_diff(date_create($DOB), date_create('today'))->y;
}

function convertDate($date){
	date_default_timezone_set('America/New_York');
	$newDate = date("m-d-Y", strtotime($date));
	return $newDate;
}
?>
