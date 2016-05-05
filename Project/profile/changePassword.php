<?php session_start(); ?>
<head>
	<title>Record Run - Change Password</title>
	<?php include("../includes/header2.php"); ?>
</head>

<body>
	<?php
	include("../db/user.php");
	include("../db/db.php");
	include("../includes/navbar3.php");

	$user = new User(getUserID($_COOKIE['User']));

	if(isset($_COOKIE['User'])) {
		$username = $_COOKIE['User'];
	} //else { $username = ""; }
	?>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
	   <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Change Password</h3>
		  </div>
		  <div class="panel-body"> <br><br>
			<div class="row">
			  <div class="c1ol-md-9 col-lg-9">
				<table class="table table-user-information">
				  <tbody>
				    <form method="post" action="dbChangePassword.php">
						<tr>
						  <td>Current Password</td>
						  <td>
						    <div class="col-xs-7">
							  <div class="form-group has-<?php errorOutline("failedCurrent"); ?>">
							    <input class="form-control" type="password" name="current" maxlength="20">
							    <?php errorMessage("failedCurrent"); ?>
							  </div>
							</div>
						  </td>
						</tr>
						<tr>
						  <td>New Password</td>
						  <td>
						    <div class="col-xs-7">
							  <div class="form-group has-<?php errorOutline("failedNew"); ?>">
							    <input class="form-control" type="password" name="new" maxlength="20">
							    <?php errorMessage("failedNew"); ?>
							  </div>
							</div>
						  </td>
						</tr>
						<tr>
						  <td>Confirm Password</td>
						  <td>
						    <div class="col-xs-7">
						      <div class="form-group has-<?php errorOutline("failedConfirm"); ?>">
							    <input class="form-control" type="password" name="confirm" maxlength="20">
							    <?php errorMessage("failedConfirm"); ?>
							  </div>
							</div>
						  </td>
						</tr>
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
// echos out the error message
// must pass in the $_SESSION parameter to check for
// Sample Usage: errorMessage("failedUsername");
function errorMessage($failedType) {
	if(!empty($_SESSION[$failedType])) {
		echo $_SESSION[$failedType];
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
