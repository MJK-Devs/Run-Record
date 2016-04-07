

<html>
<head>
	<title>Record a Run</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
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
			
			<br>
			<br>
			<h3><b>General Run Information</b></h3>
			<br>
			<?php echo $errMessage; ?>
			<br>
			
			
				<div id="record-a-run">
					<form class="form-inline" method="post" action="db/createRun.php">
						<div class="form-inline" method="post">
							<label>Date</label>
							<input type="date" class="form-control" name="date">
						</div>
						<br>
						<div class="form-inline">
							<label>Distance</label>
							<input type="number" min="0" class="form-control" name="distance">
							<label>miles</label>
						</div>
						<br>
						<div class="form-inline">
							<label>Time</label>
							<?php printTimeForms(); ?>
						</div>
						<br>
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
	echo '<select name="hour" class="form-control">';
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