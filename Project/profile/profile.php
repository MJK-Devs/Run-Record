<head> <title>Record Run Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="style.css" type="text/css" rel="stylesheet"></link>
</head>

<body>
	<?php include("../includes/navbar.php");
	if(isset($_COOKIE['User'])) {
		$username = $_COOKIE['User'];
	} //else { $username = ""; }
	?>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
	  <div class="panel-heading">
		<h3 class="panel-title">jryan</h3>
	  </div>
	  <div class="panel-body">
	    <div class="row">
		  <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../images/logo.png" class="img-circle img-responsive"> </div>
		  <div class="col-md-9 col-lg-9">
		    <table class=table table-user-information">
			  <tbody>
				<tr>
				  <td>First Name</td>
				  <td>Jason</td>
				</tr>
				<tr>
				  <td>Last Name</td>
				  <td>Ryan</td>
				</tr>
				  <td>State</td>
				  <td>Ohio</td>
				</tr>
			  </tbody>
			</table>
		  </div>
	  </div>
	  <div class="panel-footer">
	    <span class"pull-left">
		  <a href="#" data-original-title="Edit Profile" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a> 
		  <a href="#" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
		  </span>
	  </div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>