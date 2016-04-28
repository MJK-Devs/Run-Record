<head> <title>Record Run - Delete Profile</title>
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
	<div class="col-xs-7 col-sm-7 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
	   <div class="panel panel-info">
		  <div class="panel-heading">
			<h3 class="panel-title"><?php echo $user->getUsername(); ?></h3>
		  </div>
		  <div class="panel-body">
			<div class="row">
			  <h3>&nbsp; Are you sure you want to delete your account?</h3>
			</div>
		  </div>
		  <div class="panel-footer">&nbsp;
			<span class="pull-right">
			  <a href="confirmedDelete.php" title="Confirm" data-toggle="tooltip" type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-ok"></i></a>
			  <a href="profile.php" title="Cancel" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
			</span>


		  </div>
		</div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
