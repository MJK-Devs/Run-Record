<head>
	<title>Record Run - Edit Profile</title>
	<?php include("../includes/header2.php"); ?>
</head>

<body>
	<?php
	session_start();
	include_once("../db/user.php");
	include_once("../db/db.php");
	include_once("../includes/navbar3.php");

	$user = new User(getUserID($_COOKIE['User']));

	if(isset($_COOKIE['User'])) {
		$username = $_COOKIE['User'];
	} //else { $username = ""; }
	?>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
	   <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title"><?php echo $user->getUsername(); ?></h3>
		  </div>
		  <div class="panel-body">
			<div class="row">
			  <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Picture" src="../images/logo.png" class="img-circle img-responsive"> </div>
			  <div class="col-md-9 col-lg-9">
				<table class="table table-user-information">
				  <tbody>
				    <form method="post" action="update.php">
					  <?php userInfoTable_Edit(); ?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		  <div class="panel-footer">
		    <a href="changePassword.php" title="Change Password" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-lock"></i></a>
			<span class="pull-right">
			  <button type="submit" value="submit" title="Update" data-toggle="tooltip" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-ok"></i></button>
			  </form>
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
<?php
function userInfoTable_Edit() {
	$user = new User(getUserID($_COOKIE['User']));
	$formSize = "col-xs-7";

	echo '<tr>
 		    <td>First Name</td>
     	    <td>
				<div class="' . $formSize . '">
					<input class="form-control '.errorOutLine("failedFirstName").'"type="text" name="firstName" size="20"
						value="' . $user->getFirstName() . '">
						'.errorMessage('failedFirstName').'
				</div>
			</td>
		  </tr>';
	echo '<tr>
 		    <td>Last Name</td>
     	    <td>
				<div class="' . $formSize .'">
					<input class="form-control '.errorOutLine("failedLastName").'" type="text" name="lastName" size="20"
						value="' . $user->getLastName() . '">
						'.errorMessage('failedLastName').'
				</div>
			</td>
		  </tr>';
	echo '<tr>
		    <td>About me</td>
		    <td>
				<div class="col-xs-7">
					<textarea class="form-control no-resize" rows="3" name="aboutMe">' . $user->getAboutMe() . '</textarea>
				</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Height</td>
			<td>
				<div class="col-xs-7">
					<select name="height" class="form-control">';
						include("../includes/height.php");
						foreach($height as $h){
							if(strcmp($user->getHeight(), $h) === 0) {
								echo '<option selected="selected" value="' . $h . '">' . $h . '</option>';
							}
							else {
								echo '<option value="' . $h . '">' . $h . '</option>';
							}
						}
				echo '</select>
				</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>Weight</td>
			<td>
				<div class="' . $formSize . '">
					<input class="form-control" type="number" name="weight" max="1000" min="1"
						value="' . $user->getWeight() . '">
				</div>
			</td>
		  </tr>';
	echo '<tr>
			<td>City</td>
			<td>
				<div class="' . $formSize .'">
					<input class="form-control '.errorOutLine("failedCity").'" type="text" name="city" size="20"
						value="' . $user->getCity() . '">
						'.errorMessage("failedCity").'
				</div>
			</td>
		  </tr>';
	  echo '<tr>
				<td>State</td>
				<td>
					<div class="col-xs-7">
						<select name="state" class="form-control">';
							include("../includes/states.php");
							foreach($states as $s){
								if(strcmp($s, $user->getState()) === 0) {
									echo '<option selected="selected">' . $s . '</option>';
								}
								else {
									echo '<option value="' . $s . '">' . $s . '</option>';
								}
							}
					echo '</select>
					</div>
				</td>
			  </tr>';
	echo '<tr>
			<td>Email</td>
	    	<td>
				<div class="' . $formSize . '">
					<input class="form-control '.errorOutLine("failedEmail").'" type="email" name="email" size="20"
						value="' . $user->getEmail() . '">
						'.errorMessage("failedEmail").'
				</div>
			</td>
		  </tr>';
	echo '<tr>
 		    <td>Profile picture</td>
     	    <td>
				<input type="file" name="profilePicture">
			</td>
		  </tr>';

}

?>

<?php
// echos out the error message
// must pass in the $_SESSION parameter to check for
// Sample Usage: errorMessage("failedUsername");
function errorMessage($failedType) {
	if(!empty($_SESSION[$failedType])) {
		$message = $_SESSION[$failedType];
		unset($_SESSION[$failedType]);
		return '<div style="color:#1a6ecc">' . $message.'</div>';
	}
}

// outputs "error" into the class of an input box
// this will put a red line around the input box
// Sample Usage: errorMessage("failedUsername");
function errorOutline($failedType) {
	if(!empty($_SESSION[$failedType])) {
		//echo "error";
		return "error";
	}
}
?>
