<?php session_start(); ?>
<html>
<head>
	<title>Record Run - Stats</title>

	<?php include("../includes/header2.php"); ?>
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.en_US.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/canvasjs.min.js"></script>
	<?php
		  include_once "../db/db.php";
	?>
</head>

<body>
	<?php
	include("../db/user.php");
	//include("../db/db.php");
	include("runs.php");
	include("../includes/navbar3.php");

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

			  <div class="col-md-12 col-lg-12">
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
			  <div class="col-md-12 col-lg-12">
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
	   <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Charts</h3>
		  </div>
		  <div class="panel-body">
			<div class="row">
			  <div class="col-md-12 col-lg-12">
				<table class="table table-user-information">
				  <tbody>
					<div id="chartContainer" style="height: 400px; width: 100%;"> </div>
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
			  <div class="col-md-12 col-lg-12">
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
 		    <td><b>Runs</b></td>
     	    <td><font color="blue">' . $runs->getTotalNumberOfRuns() . '</font></td>
		  </tr>';
	echo '<tr>
 		    <td><b>Distance</b></td>
     	    <td><font color="blue">' . $runs->getTotalDistance() . '</font></td>
		  </tr>';
	echo '<tr>
 		    <td><b>Time</b></td>
     	    <td><font color="blue">' . $runs->getTotalTime() . '</font></td>
		  </tr>';
	echo '<tr>
 		    <td><b>Calories</td>
     	    <td><font color="blue">' . $runs->getTotalCaloriesBurned() . '</font></td>
		  </tr>';

}

function userAverages() {
	$user = new User(getUserID($_COOKIE['User']));
	$runs = new UserRuns(getUserID($_COOKIE['User']));
	echo '<tr>
   		    <td><b>Distance</b></td>
			<td><font color="blue">' . $runs->getAverageDistance() . '</font></td>
		  </tr>';
	echo '<tr>
			<td><b>Time</b></td>
			<td><font color="blue">' . $runs->getAverageTime() . '</font></td>
		  </tr>';
	echo '<tr>
			<td><b>Pace</b></td>
			<td><font color="blue">' . $runs->getAveragePace() . '</font></td>
		  </tr>';
	echo '<tr>
			<td><b>Calories Burned</b></td>
			<td><font color="blue">' . $runs->getAverageCaloriesBurned() . '</font></td>
		  </tr>';
}

function userPersonalInfo() {
	$user = new User(getUserID($_COOKIE['User']));
	echo '<tr>
   		    <td><b>Height</b></td>
			<td><font color="blue">' . $user->getHeight() . '"</font></td>
		  </tr>';
	echo '<tr>
			<td><b>Weight</b></td>
			<td><font color="blue">' . $user->getWeight() . '</font></td>
		  </tr>';
	echo '<tr>
			<td><b>BMI</b></td>
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
	if (strcmp($BMI, "Set height and weight to calculate BMI.") === 0) { return "blue"; }
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

<script type="text/javascript">

  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Top Oil Reserves",   
      },
      axisY: {
        title: "Reserves(MMbbl)"
      },
      legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      theme: "theme2",
      data: [
      {       
        type: "column", 
        showInLegend: true,
        legendMarkerColor: "grey",
        legendText: "MMbbl = one million barrels",
        dataPoints: [     
        {y: 297571, label: "Venezuela"},
        {y: 267017,  label: "Saudi" },
        {y: 175200,  label: "Canada"},
        {y: 154580,  label: "Iran"},
        {y: 116000,  label: "Russia"},
        {y: 97800, label: "UAE"},
        {y: 20682,  label: "US"},       
        {y: 20350,  label: "China"},       
        ]
      },  
      ]
    });

    chart.render();

  }
</script>

