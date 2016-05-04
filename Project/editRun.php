<?php
session_start();
?>


<html>
<head>
	<title>Record Run - Edit Run</title>
	<?php include("includes/header.php"); ?>
</head>
<body>

<?php
	  include "includes/navbar.php";
	  include_once "db/db.php";
	  include_once "includes/displayFunctions.php";
	  include_once "stats/runs.php";

	  if(isset($_SESSION['failedCreateRun'])) {
		  $errMessage = $_SESSION['failedCreateRun'];
	  }
	  $runs = new UserRuns(getUserID($_COOKIE['User']));
	  $run = $runs->getRun($_GET["ID"]);
	  print_r($run);
?>

<?php
	  if(isset($errMessage)) {
		  echo $errMessage;
	  }
?>
<div id="record-a-run">
 <div class="row">
  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 col-sm-offset-2 col-xs-offset-2 toppad" >
	<div class="panel panel-primary">
	  <div class="panel-heading">&nbsp;
	    <span class="pull-left">
			 <h3 class="panel-title">Edit Run</h3>
		</span>
		<span class="pull-right">
			  <a href="myruns.php" title="Cancel" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
		</span>
	  </div>
	  <div class="panel-body">
	    <form method="post" action="db/updateRun.php?ID=<?php echo $_GET["ID"]; ?>">
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
			<textarea style="width:100%" rows="3" name="comments">
			<?php $run->getComments(); ?></textarea>
		  </div>
	  </div>
	    
	  <div class="panel-footer">
		<div class="wrapper" align="center">
			<button type="submit" value="submit" class="btn btn-primary" >Update</button>
		</div>
		</form>
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
</html>
<?php
function printColumnOne() {
	$formSize = "col-md-11";
	date_default_timezone_set('America/New_York');
	$todaysDate = date('Y-m-d', strtotime("today"));
	$runs = new UserRuns(getUserID($_COOKIE['User']));
	$run = $runs->getRun($_GET["ID"]);
	$hours = gmdate("H", $run->getTime());
	$minutes = gmdate("i", $run->getTime());
	$seconds = gmdate("s", $run->getTime());
	
	echo '<tr>
			<td>Date</td>
			<td>
				<div class="' . $formSize . '">
					<input type="date" value= "' . $run->getRunDate() . '" class="form-control" name="date">
				</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Distance</td>
			<td>
				<div class="' . $formSize . '">
					<input type="number" min="0" max="100" step="0.01" value="' . $run->getDistance() . '" class="numeric form-control" name="distance">
				</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Time</td>
			<td><div class="form-inline">';
				displayTime((int)$hours, (int)$minutes, (int)$seconds);
	echo		
			'</div></td>
		  </tr>';
	echo '<tr>
			<td>Time Of Day</td>
			<td>
				<div class="' . $formSize . '">';
					//displayTimeOfDay($run->getTimeODay());
	echo        $hours . ' ' . $minutes . ' ' . $seconds . '</div>
			</td>
		  </tr>';
}

function printColumnTwo() {
	$formSize = "col-md-11";
	$runs = new UserRuns(getUserID($_COOKIE['User']));
	$run = $runs->getRun($_GET["ID"]);
	
	echo '<tr>
			<td>Difficulty</td>
			<td>
				<div class="' . $formSize . '">';
					displayDifficulty($run->getDifficulty());
	echo		'</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Terrain</td>
			<td>
				<div class="' . $formSize . '">';
					displayTerrain($run->getTerrain());
	echo		'</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Conditions</td>
			<td>
				<div class="' . $formSize . '">';
					displayConditions($run->getConditions());
	echo		'</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Temperature</td>
			<td>
				<div class="' . $formSize . '">';
					displayTemperature($run->getTemperature());
	echo		'</div>
			</td>
		  </tr>';
}

?>