<?php session_start(); ?>
<html>
<head>
	<title>Create Account</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.en_US.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.js" type="text/javascript"></script>

	<?php
		  include_once "db/db.php";
		  include_once "includes/states.php";
	?>
</head>

<body>
	<div class="header">
		<a href="main.php"><img width="100" height="100" alt="" src="images/logo.png"></a>
		<h1><b>Create Account</b></h1>
	</div>
	<div class="container">
		<div class="row">
		</div>
		<div class="col-md-5">
			<div id="userInformation">
				<form class="form-inline" method="post" action="db/createUser2.php">

					<h3><b>Account Information</b></h3>

					<label for="usernameInput">Username<span style="color:red">*<span></label>
					<div class="control-group">
						<input type="text" class="form-control <?php errorOutline("failedUsername"); ?>" name="username" maxlength="20" <?php rememberField("username") ?> >
						<?php errorMessage("failedUsername"); ?>
						<?php echo $_SESSION['username']; ?>
					</div>
					<br>

					<label for="passwordInput">Password<span style="color:red">*<span></label>
					<div class="control-group">
	                  	<input type="password" class="form-control <?php errorOutline("failedPassword"); ?>" name="password" maxlength="20">
					 	<?php errorMessage("failedPassword"); ?>
					</div>
					<br>

					<label for="verifyPasswordInput">Verify Password<span style="color:red">*<span></label>
					<div class="control-group">
                  		<input type="password" class="form-control <?php errorOutline("failedVerifyPassword"); ?>" name="verifyPassword" maxlength="20">
                  		<?php errorMessage("failedVerifyPassword"); ?>
					</div>
					<br>

					<h3><b>Contact Information</b></h3>

					<label for="firstNameInput">First Name<span style="color:red">*<span></label>
					<div class="control-group">
						<input type="text" class="form-control <?php errorOutline("failedFirstName"); ?>" name="firstName" maxlength="20" <?php rememberField("firstName") ?> >
						<?php errorMessage("failedFirstName"); ?>
						<?php echo $_SESSION['firstname']; ?>
					</div>
					<br>


					<label for="lastNameInput">Last Name<span style="color:red">*<span></label>
					<div class="control-group">
						<input type="text" class="form-control <?php errorOutline("failedLastName"); ?>" name="lastName" maxlength="20" <?php rememberField("lastName") ?> >
						<?php errorMessage("failedLastName"); ?>
						<?php echo $_SESSION['lastname']; ?>
					</div>
					<br>

					<label for="genderInput">Gender</label>
					<div class="btn-group has-<?php errorOutLine("failedGender"); ?>" >
						<label class="radio-inline"><input type="radio" name="gender" value="male" class="form-control" <?php if(strcmp($_POST['gender'],"male") === 0) { print ' checked="checked"';}?> >Male</label>
						<label class="radio-inline"><input type="radio" name="gender" value="female" class="form-control" <?php if(strcmp($_POST['gender'],"female") === 0) { print ' checked="checked"'; }?> >Female</label>
						<?php errorMessage("failedGender"); ?>
						<?php echo $_SESSION['gender']; ?>
					</div>


					<br>
					<br>
					<label for="dateOfBirthInput">Date of birth</label>
					<div class="form-group has-<?php errorOutLine("failedDateOfBirth"); ?>">
						<?php echo '<input type="date" class="form-control" name="dateOfBirth" '; rememberField("dateOfBirth"); 
								echo'>';?>
						<?php errorMessage("failedDateOfBirth"); ?>
						<?php echo $_SESSION['dateOfBirth']; ?>
					</div>

					<br>
					<br>
					<label for="emailInput">E-mail</label>
					<div class="form-group has-<?php errorOutline("failedEmail");?>">
						<?php echo '<input type="email" class="form-control" name="email" maxlength="40" class="errorOutLine("failedEmail")." '; rememberField("email"); echo">";?>
						<?php errorMessage("failedEmail"); ?>
						<?php echo $_SESSION['email']; ?>
					</div>


					<br>
					<br>

					<div class="form-group has-<?php errorOutLine("failedState"); ?>">
					    <label for="stateInput">State</label>

						<?php
						echo '<select name="state" class="form-control <?php errorOutline("failedState"); ?>" selected="' . $_SESSION['state'] . '">';
						foreach($states as $s){
							if($s === $state) {
								echo '<option selected="selected">' . $s . '</option>';
							}
							else {
								echo '<option value="' . $s . '">' . $s . '</option>';
							}
						}
						?>
						</select>
						<?php errorMessage("failedState"); ?>
						<?php echo $_SESSION['state']; ?>
					</div>

					<br>
					<br>
					<div class="form-group has-<?php errorOutLine("failedCity"); ?>">
					<label for="cityInput">City</label>
						<?php echo '<input type="text" class="form-control" name="city" maxlength="20"'; rememberField("city"); echo '>'; ?>
						<?php errorMessage("failedCity"); ?>
						<?php echo $_SESSION['city']; ?>
					</div>

					<br>
					<br>
					<label for="zipInput">Zip</label>
					<div class="form-group has-<?php errorOutLine("failedZip"); ?>">
						<?php echo '<input type="number" class="form-control" name="zip" maxLength="5" '; rememberField("zip");
							echo '> <span class="help-inline"> </span>';
						?>
						<?php errorMessage("failedZip"); ?>
						<?php echo $_SESSION['zip']; ?>
					</div>

					<br />
					<br />
					<input type="submit" name="submit">
				</form>
	        </div>
	   </div>
	</div>
</body>
</html>

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

// remembers the field accross submits
// for example if a user types in their name
// as "Bob", it will not ask them to re-enter
// remember to save the session variable first in createUser.php
// Sample Usage: errorMessage("firstName");
function rememberField($fieldType) {
	if(isset($_SESSION[$fieldType])) {
		echo 'value="'. $_SESSION[$fieldType] . '"';
	}
}
?>

