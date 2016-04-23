<?php session_start(); ?>
<head> <title>Change Password</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="style.css" type="text/css" rel="stylesheet"></link>
</head>

<body>
	<?php 
	include("../db/user.php");
	include("../db/db.php");
	include("navbar.php");
	
	$user = new User(getUserID($_COOKIE['User']));
	
	if(isset($_COOKIE['User'])) {
		$username = $_COOKIE['User'];
	} //else { $username = ""; }
	?>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
	   <div class="panel panel-info">
		  <div class="panel-heading">
			<h3 class="panel-title">Change Password</h3>
		  </div>
		  <div class="panel-body"> <br><br>
			<div class="row">
			  <div class="c1ol-md-9 col-lg-9">
				<table class="table table-user-information">
				  <tbody>
				    <form method="post" action="dbChangePassword.php">
					  <?php passwordChangeTable(); ?>
					
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		  <div class="panel-footer">&nbsp;
			<span class="pull-right">
			  <button type="submit" value="submit" title="Change" data-toggle="tooltip" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-ok"></i></button>
			  </form>
			  <a href="edit.php" title="Cancel" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
			</span>
		  </div>
		</div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
<?php
function passwordChangeTable() {
	$user = new User(getUserID($_COOKIE['User']));
	$formSize = "col-xs-7";

	echo '<tr>
 		    <td>Current Password</td>
     	    <td>
				<div class="control-group">
					<input class="form-control ' . errorOutline("failedCurrent") . '" type="password" name="current" maxlength="20">';
					errorMessage("failedCurrent");
				'</div>
			</td>
		  </tr>';
	echo '<tr>
 		    <td>New Password</td>
     	    <td>
				<div class="control-group">
					<input class="form-control ' . errorOutline("failedNew") . '" type="password" name="new" maxlength="20">';
					errorMessage("failedNew");
				'</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Confirm Password</td>
			<td>
				<div class="control-group">
					<input class="form-control ' . errorOutline("failedConfirm") . '" type="password" name="confirm" maxlength="20">';
					errorMessage("failedConfirm");
	echo		'</div>
			</td>
		  </tr>';
	
}

// echos out the error message
// must pass in the $_SESSION parameter to check for
// Sample Usage: errorMessage("failedUsername");
function errorMessage($failedType) {
	if(!empty($_SESSION[$failedType])) {
		echo '<label style="color:red">' . $_SESSION[$failedType] . '</label>';
		unset($_SESSION[$failedType]);
	}
}

// outputs "error" into the class of an input box
// this will put a red line around the input box
// Sample Usage: errorMessage("failedUsername");
function errorOutline($failedType) {
	if(!empty($_SESSION[$failedType])) {
		echo "error";
	}
}

?>


