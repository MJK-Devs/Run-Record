<?php session_start(); ?>
<html>
<head>
	<title>Record Run - Create</title>
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.en_US.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.js" type="text/javascript"></script>
	<?php
		include("includes/header.php");
		include_once "db/db.php";
		include_once "includes/states.php";
	?>
</head>

<body class="createAccount">
	<?php include("includes/navbar2.php"); ?>
	<div class="container">
		<div class="row">
		<div class="col-md-8">
			<div id="userInformation">
				<form class="form-inline" method="post" action="db/createUser.php">
				<div class="row">
				<div class="col-md-6">
					<h3><b>Account Information</b></h3>

					<label for="usernameInput">Username<span style="color:red">*</span></label>
					<div class="control-group">
						<input type="text" class="form-control <?php errorOutline("failedUsername"); ?>" name="username" maxlength="20" <?php rememberField("username") ?> >
						<?php errorMessage("failedUsername"); ?>
					</div>
					<br>

					<label for="passwordInput">Password<span style="color:red">*</span></label>
					<div class="control-group">
	                  	<input type="password" class="form-control <?php errorOutline("failedPassword"); ?>" name="password" maxlength="20">
					 	<?php errorMessage("failedPassword"); ?>
					</div>
					<br>

					<label for="verifyPasswordInput">Verify Password<span style="color:red">*</span></label>
					<div class="control-group">
                  		<input type="password" class="form-control <?php errorOutline("failedVerifyPassword"); ?>" name="verifyPassword" maxlength="20">
                  		<?php errorMessage("failedVerifyPassword"); ?>
					</div>
					<br>
					</div>
					<div class="col-md-6">
					<h3><b>Contact Information</b></h3>

					<label for="firstNameInput">First Name<span style="color:red">*</span></label>
					<div class="control-group">
						<input type="text" class="form-control <?php errorOutline("failedFirstName"); ?>" name="firstName" maxlength="20" <?php rememberField("firstName") ?> >
						<?php errorMessage("failedFirstName"); ?>
					</div>
					<br>


					<label for="lastNameInput">Last Name<span style="color:red">*</span></label>
					<div class="control-group">
						<input type="text" class="form-control <?php errorOutline("failedLastName"); ?>" name="lastName" maxlength="20" <?php rememberField("lastName") ?> >
						<?php errorMessage("failedLastName"); ?>
					</div>
					<br>

					<label for="genderInput">Gender</label>
					<div class="btn-group has-<?php errorOutLine("failedGender"); ?>" >
						<label class="radio-inline"><input type="radio" name="gender" value="male" class="form-control" <?php if(isset($_SESSION['gender'])){if(strcmp($_SESSION['gender'],"male") === 0) { print ' checked="checked"'; }}?> >Male</label>
						<label class="radio-inline"><input type="radio" name="gender" value="female" class="form-control" <?php if(isset($_SESSION['gender'])){if(strcmp($_SESSION['gender'],"female") === 0) { print ' checked="checked"'; }}?> >Female</label>
						<?php errorMessage("failedGender"); ?>
					</div>


					<br>
					<br>
					<label for="dateOfBirthInput">Date of birth</label>
					<div class="form-group has-<?php errorOutLine("failedDateOfBirth"); ?>">
						<?php echo '<input type="date" class="form-control" name="dateOfBirth" '; rememberField("dateOfBirth");
								echo'>';?>
						<?php errorMessage("failedDateOfBirth"); ?>
					</div>

					<br>
					<br>
					<label for="emailInput">E-mail</label>
					<div class="form-group has-<?php errorOutline("failedEmail");?>">
						<?php echo '<input type="email" class="form-control" name="email" maxlength="40" class="errorOutLine("failedEmail")." '; rememberField("email"); echo">";?>
						<?php errorMessage("failedEmail"); ?>
					</div>


					<br>
					<br>

					<div class="form-group has-<?php errorOutLine("failedState"); ?>">
					    <label for="stateInput">State</label>

						<?php
						if(isset($_SESSION['state'])) {
							echo '<select name="state" class="form-control <?php errorOutline("failedState"); ?>" selected="' . $_SESSION['state'] . '">';
							echo '<option selected="selected" value="'.$_SESSION['state'].'">'.$_SESSION['state'].'</option>';
						}
						else{
							echo '<select name="state" class="form-control <?php errorOutline("failedState"); ?> >';
						}
						foreach($states as $s){
								echo '<option value="' . $s . '">' . $s . '</option>';
						}
						?>
						</select>
						<?php errorMessage("failedState"); ?>
					</div>

					<br>
					<br>
					<div class="form-group has-<?php errorOutLine("failedCity"); ?>">
					<label for="cityInput">City</label>
						<?php echo '<input type="text" class="form-control" name="city" maxlength="20"'; rememberField("city"); echo '>'; ?>
						<?php errorMessage("failedCity"); ?>
					</div>

					<br>
					<br>
					<label for="zipInput">Zip</label>
					<div class="form-group has-<?php errorOutLine("failedZip"); ?>">
						<?php echo '<input type="number" class="form-control" name="zip" maxLength="5" '; rememberField("zip");
							echo '> <span class="help-inline"> </span>';
						?>
						<?php errorMessage("failedZip"); ?>
					</div>

					<br />
					<br />
					</div>
					<input type="submit" name="submit">
				</form>
	        </div>
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
