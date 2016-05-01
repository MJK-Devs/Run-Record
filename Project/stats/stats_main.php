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
		  include_once("../db/user.php");
		  include_once("runs.php");
		  include_once("../includes/navbar3.php");
		  if(isset($_COOKIE['User'])) {
			$username = $_COOKIE['User'];
		  }
	?>
</head>

<body>
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
		<div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Personal Records</h3>
		  </div>
		  <div class="panel-body">
			<div class="row">
			  <div class="col-md-12 col-lg-12">
				<table class="table table-user-information">
				  <tbody>
				    <?php userRecords(); ?>
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

function userRecords() {
	$user = new User(getUserID($_COOKIE['User']));
	$runs = new UserRuns(getUserID($_COOKIE['User']));
	echo '<tr>
			<td><b>Distance</b></td>
			<td><font color="blue">' . $runs->getLongestDistance() . '</font></td>
		  </tr>';
	echo '<tr>
			<td><b>Time</b></td>
			<td><font color="blue">' . $runs->getLongestTime() . '</font></td>
		  </tr>';
	echo '<tr>
			<td><b>Pace</b></td>
			<td><font color="blue">' . $runs->getQuickestPace() . '</font></td>
		  </tr>';
	echo '<tr>
			<td><b>Calories</b></td>
			<td><font color="blue">' . $runs->getMostCalories() . '</font></td>
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

		// get dates and data for bar graph
		$runDataType = "Distance (miles)";
		$dates = array("10"=>(date('m-d',strtotime("-10 days"))),
					    "9"=>(date('m-d',strtotime("-9 days"))),
					    "8"=>(date('m-d',strtotime("-8 days"))),
					    "7"=>(date('m-d',strtotime("-7 days"))),
					    "6"=>(date('m-d',strtotime("-6 days"))),
					    "5"=>(date('m-d',strtotime("-5 days"))),
					    "4"=>(date('m-d',strtotime("-4 days"))),
					    "3"=>(date('m-d',strtotime("-3 days"))),
					    "2"=>(date('m-d',strtotime("-2 days"))),
					    "1"=>(date('m-d',strtotime("-1 days"))),
					    "0"=>(date('m-d',strtotime("today"))));
		$runs = new UserRuns(getUserID($_COOKIE['User']));
		$data = $runs->getData(strtotime("-10 days"), strtotime("+0 days"), $runDataType);
		$dataDates = array("10"=>($data[date('Y-m-d',strtotime("-10 days"))]),
							"9"=>($data[date('Y-m-d',strtotime("-9 days"))]),
							"8"=>($data[date('Y-m-d',strtotime("-8 days"))]),
							"7"=>($data[date('Y-m-d',strtotime("-7 days"))]),
							"6"=>($data[date('Y-m-d',strtotime("-6 days"))]),
							"5"=>($data[date('Y-m-d',strtotime("-5 days"))]),
							"4"=>($data[date('Y-m-d',strtotime("-4 days"))]),
							"3"=>($data[date('Y-m-d',strtotime("-3 days"))]),
							"2"=>($data[date('Y-m-d',strtotime("-2 days"))]),
							"1"=>($data[date('Y-m-d',strtotime("-1 days"))]),
							"0"=>($data[date('Y-m-d',strtotime("today"))]));

?>
<script type="text/javascript">
  window.onload = function () {
	var runDataType = "<?php echo $runDataType; ?>";
	// dates
	var ten = "<?php echo $dates["10"]; ?>";
	var nine = "<?php echo $dates["9"]; ?>";
	var eight = "<?php echo $dates["8"]; ?>";
	var seven = "<?php echo $dates["7"]; ?>";
	var six = "<?php echo $dates["6"]; ?>";
	var five = "<?php echo $dates["5"]; ?>";
	var four = "<?php echo $dates["4"]; ?>";
	var three = "<?php echo $dates["3"]; ?>";
	var two = "<?php echo $dates["2"]; ?>";
	var one = "<?php echo $dates["1"]; ?>";
	var today = "<?php echo $dates["0"]; ?>";

	//data
	var tenData = parseInt("<?php echo $dataDates["10"]; ?>", 10);
	var nineData  = parseInt("<?php echo $dataDates["9"]; ?>", 10);
	var eightData  = parseInt("<?php echo $dataDates["8"]; ?>", 10);
	var sevenData  = parseInt("<?php echo $dataDates["7"]; ?>", 10);
	var sixData  = parseInt("<?php echo $dataDates["6"]; ?>", 10);
	var fiveData  = parseInt("<?php echo $dataDates["5"]; ?>", 10);
	var fourData  = parseInt("<?php echo $dataDates["4"]; ?>", 10);
	var threeData  = parseInt("<?php echo $dataDates["3"]; ?>", 10);
	var twoData  = parseInt("<?php echo $dataDates["2"]; ?>", 10);
	var oneData  = parseInt("<?php echo $dataDates["1"]; ?>", 10);
	var todayData  = parseInt("<?php echo $dataDates["0"]; ?>", 10);
	
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "10 Day Mileage",   
      },
      axisY: {
        title: runDataType,
      },
      legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      theme: "theme2",
      data: [
      {       
        type: "column", 
        showInLegend: false,
        legendMarkerColor: "grey",
        legendText: "",
        dataPoints: [     
        {y: tenData, label: ten},
        {y: nineData,  label: nine },
        {y: eightData,  label: eight},
        {y: sevenData,  label: seven},
        {y: sixData,  label: six},
        {y: fiveData, label: five},
        {y: fourData,  label: four},       
        {y: threeData,  label: three},       
        {y: twoData,  label: two},       
        {y: oneData,  label: one},          
        ]
      },  
      ]
    });

    chart.render();

  }
</script>


