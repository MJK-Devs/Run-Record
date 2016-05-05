<?php session_start(); ?>  
<html>
<head>
	<title>Record Run - Create</title>
	<?php include("includes/header.php"); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
			<div class="col-md-12">
				<h1 class="logo page-header text-center smaller-margin">Create An Account</h1>
				<div id="userInformation">
					<form class="form-inline" method="post" action="db/createUser.php">
						<div class="row">
							<div class="col-md-4 col-md-offset-1">
								<h3><b>Account Information</b></h3>

								<label for="usernameInput">Username<span style="color:#1a6ecc">*</span></label>
								<div class="control-group">
									<input type="text" class="form-control <?php errorOutline("failedUsername"); ?>" name="username" maxlength="20" <?php rememberField("username") ?> >
									<?php errorMessage("failedUsername"); ?>
								</div>
								<br>

								<label for="passwordInput">Password<span style="color:#1a6ecc">*</span></label>
								<div class="control-group">
	                  				<input type="password" class="form-control <?php errorOutline("failedPassword"); ?>" name="password" maxlength="20">
					 				<?php errorMessage("failedPassword"); ?>
								</div>
								<br>

								<label for="verifyPasswordInput">Verify Password<span style="color:#1a6ecc">*</span></label>
								<div class="control-group">
                  					<input type="password" class="form-control <?php errorOutline("failedVerifyPassword"); ?>" name="verifyPassword" maxlength="20">
                  					<?php errorMessage("failedVerifyPassword"); ?>
								</div>
								<br>

								<label for="emailInput">E-mail<span style="color:#1a6ecc">*</span></label><br>
								<div class="control-group">
									<input type="email" class="form-control <?php errorOutline("failedEmail");?>" name="email" maxlength="40" <?php rememberField("email") ?> >
									<?php errorMessage("failedEmail"); ?>
								</div>
								<br>
							</div>

							<div class="col-md-6 ">
								<h3><b>Contact Information</b></h3>
								<div class="row">
									<div class="col-md-6">
										<label for="firstNameInput">First Name<span style="color:#1a6ecc">*</span></label>
										<div class="control-group">
											<input type="text" class="form-control <?php errorOutline("failedFirstName"); ?>" name="firstName" maxlength="20" <?php rememberField("firstName") ?> >
											<?php errorMessage("failedFirstName"); ?>
										</div>
										<br>

										<label for="lastNameInput">Last Name<span style="color:#1a6ecc">*</span></label>
										<div class="control-group">
											<input type="text" class="form-control <?php errorOutline("failedLastName"); ?>" name="lastName" maxlength="20" <?php rememberField("lastName") ?> >
											<?php errorMessage("failedLastName"); ?>
										</div>
										<br>
																				<label for="genderInput">Gender<span style="color:#1a6ecc">*</span></label><br>
										<div class="btn-group" >
											<input type="radio" name="gender" value="male" class="form-control" <?php if(isset($_SESSION['gender'])){if(strcmp($_SESSION['gender'],"male") === 0) { print ' checked="checked"'; }}?> >Male
											<input type="radio" name="gender" value="female" class="form-control" <?php if(isset($_SESSION['gender'])){if(strcmp($_SESSION['gender'],"female") === 0) { print ' checked="checked"'; }}?> >Female
											<?php errorMessage("failedGender"); ?>
										</div>
										<br>
										<br>

										<div class="control-group">
											<label for="dateOfBirthInput">Date of Birth<span style="color:#1a6ecc">*</span></label><br>
											<input type="date" class="form-control <?php errorOutline("failedDateOfBirth"); ?>" name="dateOfBirth" <?php rememberField("dateOfBirth") ?> >
											<?php errorMessage("failedDateOfBirth"); ?>
										</div>
										<br>

									</div>

									<div class="col-md-6">
										<div class="control-group">
											<label for="cityInput">City<span style="color:#1a6ecc">*</span></label><br>
											<input type="text" class="form-control <?php errorOutline("failedCity"); ?>" name="city" maxlength="20" <?php rememberField("city") ?> >
											<?php errorMessage("failedCity"); ?>
										</div>
										<br>

										<div class="control-group <?php errorOutLine("failedState"); ?>">
										    <label for="stateInput">State<span style="color:#1a6ecc">*</span></label> <br>
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
											?> </select>
											<?php errorMessage("failedState"); ?>
										</div>
										<br>

										<div class="control-group">
											<label for="zipInput">Zip<span style="color:#1a6ecc">*</span></label><br>
											<input type="number" class="form-control <?php errorOutline("failedZip"); ?>" name="zip" maxLength="5" <?php rememberField("zip") ?> >
											<?php errorMessage("failedZip"); ?>
										</div>
									</div>
									<br>
								</div>
							</div>
							<div class="container">
							<div class="row">
								<div class="col-md-4 col-md-offset-4">
									<br>
									<input type="submit" name="submit" value="Create Account" class="btn btn-primary btn-block login-submit">
								</div>
							</div>
							</div>
						</div>
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
		echo '<br>' . $_SESSION[$failedType];
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
