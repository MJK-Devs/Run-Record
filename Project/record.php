

<html>
<head>
	<title>Record Run - Record</title>
	<?php include("includes/header.php"); ?>
</head>
<body>

<?php
	  include "includes/navbar.php";
	  include_once "db/db.php";

	  if(isset($_SESSION['failedCreateRun'])) {
		  $errMessage = $_SESSION['failedCreateRun'];
	  }
?>

<?php
	  if(isset($errMessage)) {
		  echo $errMessage;
	  }
?>
<div id="record-a-run">
  <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-md-offset-2 col-lg-offset-1.5 col-sm-offset-0 col-xs-offset-0 toppad" >
	<div class="panel panel-primary">
	  <div class="panel-heading">
		<h3 class="panel-title">Record a Run</h3>
	  </div>
	  <div class="panel-body">
	    <form method="post" action="db/createRun.php">
		  <div class="col-md-6 col-lg-6">
		    <table class="table table-user-information">
			  <tbody>
			    <?php printColumnOne(); ?>
			  </tbody>
			</table>
		  </div>
		  <div class="col-md-6 col-lg-6">
		    <table class="table table-user-information">
			  <tbody>
			    <?php printColumnTwo(); ?>
			  </tbody>
			</table>
		  </div>
		  <div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
		    <div class="wrapper" align="center">
				<td>Comments</td>
			</div>
			<textarea style="width:100%" style="overflow:hidden" rows="3" name="comments"></textarea>
		  </div>
	  </div>
	    
	  <div class="panel-footer">
		<div class="wrapper" align="center">
			<button type="submit" value="submit" class="btn btn-primary" >Save this Run</button>
		</div>
		</form>
	  </div>
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
function printColumnOne() {
	$formSize = "col-md-11";
	date_default_timezone_set('America/New_York');
	$todaysDate = date('Y-m-d', strtotime("today"));
	
	echo '<tr>
			<td>Date</td>
			<td>
				<div class="' . $formSize . '">
					<input type="date" value= "' . $todaysDate . '" class="form-control" name="date">
				</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Distance</td>
			<td>
				<div class="' . $formSize . '">
					<input type="number" min="0" max="100" step="0.01" value="0.00" class="numeric form-control" name="distance">
				</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Time</td>
			<td><div class="form-inline">';
				//printTimeForms();
				
				displayTime();
	echo		
			'</div></td>
		  </tr>';
	echo '<tr>
			<td>Time Of Day</td>
			<td>
				<div class="' . $formSize . '">';
					displayTimeOfDay();
	echo        '</div>
			</td>
		  </tr>';
}

function printColumnTwo() {
	$formSize = "col-md-10";
	echo '<tr>
			<td>Difficulty</td>
			<td>
				<div class="' . $formSize . '">';
					displayDifficulty();
	echo		'</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Terrain</td>
			<td>
				<div class="' . $formSize . '">';
					displayTerrain();
	echo		'</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Conditions</td>
			<td>
				<div class="' . $formSize . '">';
					displayConditions();
	echo		'</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Temperature</td>
			<td>
				<div class="' . $formSize . '">';
					displayTemperature();
	echo		'</div>
			</td>
		  </tr>';
}


function displayConditions() {
	set_include_path(dirname(__FILE__)."/includes/");
	require 'runOptions.php';
	echo '<select name="condition" class="form-control">';
	foreach($conditions as $c){
		echo '<option value="' . $c . '">' . $c . '</option>';
	}
	echo '</select>';
}

function displayDifficulty() {
	set_include_path(dirname(__FILE__)."/includes/");
	require 'runOptions.php';
	echo '<select name="difficulty" class="form-control">';
	foreach($difficulty as $d){
		echo '<option value="' . $d . '">' . $d . '</option>';
	}
	echo '</select>';
}

function displayTemperature() {
	set_include_path(dirname(__FILE__)."/includes/");
	require 'runOptions.php';
	echo '<select name="temperature" class="form-control">';
	foreach($temperature as $t){
		if(strcmp("Pleasant", $t) === 0) {
			echo '<option selected="selected">' . $t . '</option>';
		}
		echo '<option value="' . $t . '">' . $t . '</option>';
	}
	echo '</select>';
}

function displayTerrain() {
	set_include_path(dirname(__FILE__)."/includes/");
	require 'runOptions.php';
	echo '<select name="terrain" class="form-control">';
	foreach($terrain as $t){
		echo '<option value="' . $t . '">' . $t . '</option>';
	}
	echo '</select>';
}

function displayTimeOfDay() {
	set_include_path(dirname(__FILE__)."/includes/");
	require 'runOptions.php';
	echo '<select name="timeOfDay" class="form-control">';
	foreach($timeOfDay as $t){
		echo '<option value="' . $t . '">' . $t . '</option>';
	}
	echo '</select>';
}


function displayTime() {
	$hours = 0;
	$minutes = 0;
	$seconds = 0;
	$formSize = "col-xs-1";
	displayHours();
	displayMinutes();
	displaySeconds();
}

function displayHours() {
			echo '&nbsp;&nbsp;&nbsp;&nbsp;<select name="hours" class="form-control">';
	while($hours <= 60) {
		echo '<option value="' . $hours . '">' . $hours . '</option>';
		$hours = $hours + 1;
	}
	echo '</select><label> &nbsp; h &nbsp; </label>';
}

function displayMinutes() {
	echo '
			<select name="minutes" class="form-control">';
	while($minutes <= 60) {
		echo '<option value="' . $minutes . '">' . $minutes . '</option>';
		$minutes = $minutes + 1;
	}
	echo '</select><label> &nbsp; m &nbsp; </label>';
}

function displaySeconds() {
	echo '
			<select name="seconds" class="form-control">';
	while($seconds <= 60) {
		echo '<option value="' . $seconds . '">' . $seconds . '</option>';
		$seconds = $seconds + 1;
	}
	echo '</select><label> &nbsp; s &nbsp; </label>';
}

?>
