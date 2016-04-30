

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




<div class="container">
	<div class="row">
		<div class="col-md-10">
			<h3><b>Record a Run</b></h3>
			<?php
			if(isset($errMessage)) {
				echo $errMessage;
			}
			?>
				<div id="record-a-run">
					<form class="form-inline" method="post" action="db/createRun.php">
						<div class="form-inline" method="post">
							<label>Date:</label>
							<br>
							<input type="date" value= "<?php echo date('Y-m-d'); ?>" class="form-control" name="date">
						</div>
						<br>
						<div class="form-inline">
							<label>Distance:</label>
							<br>
							<input type="number" min="0" max="100" step="0.01" value="0.00" class="numeric form-control" name="distance">
							<label>miles</label>
						</div>
						<br>
						<div class="form-inline">
							<label>Time:</label>
							<br>
							<?php printTimeForms(); ?>
						</div>
						<br>

						<button type="submit" value="submit" class="btn btn-primary" >Save this Run</button>
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
function printTimeForms() {
	$hours = 0;
	$minutes = 0;
	$seconds = 0;

	//print hour options
	echo '<select name="hours" class="form-control">';
	while($hours <= 12) {
		echo '<option>' . $hours . '</option>';
		$hours = $hours + 1;
		echo $hours;
	}
	echo '</select>';
	echo '<label> &nbsp; h &nbsp; </label>';

	//print minute options
	echo '<select name="minutes" class="form-control">';
	while($minutes <= 60) {
		echo '<option>' . $minutes . '</option>';
		$minutes = $minutes + 1;
		echo $minutes;
	}
	echo '</select>';
	echo '<label> &nbsp; m &nbsp; </label>';

	//print second options
	echo '<select name="seconds" class="form-control">';

	while($seconds <= 60) {
		echo '<option>' . $seconds . '</option>';
		$seconds = $seconds + 1;
		echo $seconds;
	}
	echo '</select>';
	echo '<label> &nbsp; s</label>';

}
?>
