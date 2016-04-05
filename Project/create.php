<head>
	<title>Create Account</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.en_US.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.js" type="text/javascript"></script>

	<?php //include "helper-functions.php";
		  include_once "db/db.php";
		  include_once "includes/states.php";
	?>
</head>

<body>
	<div class="header">
		<a href="main.php"><img width="100" height="100" alt="" src="images/logo.png"></a>
		<h1><b>Create Account</b></h1>
	</div>

<?php
	$usernameErr = $passwordErr = $verifyPasswordErr = $uname = $zipcodeErr = "";
	$formErr = "ERROR: All forms must be filled out";
	$badUsername = $badPassword = $badVerification = $badZipCode = false;
	$usernameFormGroup = "control-group";
	$passwordFormGroup = "control-group";
	$correctForms = 0;
	$filledOutAllForms = true;

	$firstName = $lastName = $dateOfBirth = $email = $state = $city = $zip = "";
	$gender="female";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(isset($_POST['firstName'])) {$firstName = $_POST['firstName']; $correctForms + 1;}
	if(isset($_POST['lastName'])) {$lastName = $_POST['lastName']; $correctForms + 1;}
	if(isset($_POST['gender'])) {$gender = $_POST['gender']; $correctForms + 1;}
	if(isset($_POST['dateOfBirth'])) {$dateOfBirth = $_POST['dateOfBirth']; $correctForms + 1;}
	if(isset($_POST['email'])) {$email = $_POST['email']; $correctForms + 1;}
	if(isset($_POST['state'])) {$state = $_POST['state']; $correctForms + 1;}
	if(isset($_POST['city'])) {$city = $_POST['city']; $correctForms + 1;}
	if(isset($_POST['zip'])) {
		$zip = $_POST['zip'];
		if(strlen($zip) != 5){ // if the zip code isn't 5 digits
			$zipcodeErr = "Invalid zip code. Must be 5 digits";
			$zip = "";
			$badZipCode = true;
		}
		$correctForms + 1;
	}

	if(empty($_POST["username"])){
		$usernameErr = "Username is required.";
		$usernameFormGroup = "control-group error";
		$badUsername = true;
	} else { //set uname to the username to place in the form
		if(containsBadCharacters($_POST["username"])) {
			$usernameErr = "Usernames can only contain alphanumeric characters";
			$usernameFormGroup = "control-group warning";
			$badUsername = true;
		}
		//if(userNameExists($_POST["username")) {
			//$usernameFormGroup = "conrol-group warning";
			//$badUsername = true;
			//$usernameErr = "Username already exists"
		//}
		else {
			$uname = $_POST['username'];
		}
	}
	if(empty($_POST["password"])){
		$passwordErr = "Password is required.";
		$passwordFormGroup = "control-group error";
		$badPassword = true;
	}
	if(empty($_POST["verifyPassword"])){
		$verifyPasswordErr = "Verification is required.";
		$passwordFormGroup = "control-group error";
		$badVerification = true;
	}
	else { // checks if the passwords match
		if(strcmp($_POST["password"], $_POST["verifyPassword"]) !== 0) {
			$passwordErr = "Passwords do not match";
			$passwordFormGroup = "control-group error";
			$badPassword = true;
		}
		else { // checks if password is less than 8 characters
			if(strlen($_POST["password"]) < 8) {
				$passwordErr = "Password must be greater than 8 characters";
				$passwordFormGroup = "control-group error";
				$badPassword = true;
			}
		}
	}

	$filledOutAllForms = ($correctForms === 8);

	// if there are no errors
	if(!$badUsername && !$badPassword && !$badVerification && !$badZipCode && filledOutAllForms){
		createUser($_POST['username'], $_POST['password']);
		header('Location: main.php');
	}
}
?>

<div class="container">
	<div class="row">
	</div>
	<div class="col-md-5">
		<div id="userInformation">
			<form class="form-inline" method="post" > <!--action="db/createUser.php"> -->

				<label for="usernameInput">Username</label>
				<div class="control-group">
				<?php echo '<div class="' . $usernameFormGroup . '">';?>
				  <?php echo '<input type="text" class="form-control" name="username" maxlength="20" value="' . $uname . '">';?>
				  <span class="help-inline"><?php echo $usernameErr;?></span>
				</div>
				<br>

				<label for="passwordInput">Password</label>
				<?php echo '<div class="' . $usernameFormGroup . '">';?>
                  <input type="password" class="form-control" name="password" maxlength="20">
				  <span class="help-inline"><?php echo $passwordErr;?></span>
				</div>
				<br>

				<label for="verifyPasswordInput">Verify Password</label>
				<div class="control-group warning">
                  <input type="password" class="form-control" name="verifyPassword" maxlength="20">
                  <span class="help-inline"><?php echo $verifyPasswordErr;?></span>
				</div>

				<br>
				<br>
				<br>
				<br>

				<h3><b>Contact Information</b></h3>

				<?php
					if(!$filledOutAllForms) {
						echo '<span class="help-inline">' . $formErr . '</span><br><br>';
					}
				?>
				<br>
				<label for="firstNameInput">First Name</label>
				<div class="form-group">
					<?php echo '<input type="text" class="form-control" name="firstName" maxlength="20" value="' . $firstName . '">';?>
				</div>
				<br>
				<br>
				<label for="lastNameInput">Last Name</label>
				<div class="form-group">
					<?php echo '<input type="text" class="form-control" name="lastName" maxlength="20" value="' . $lastName .'">';?>
				</div>
				<br>
				<br>
				<label for="genderInput">Gender &nbsp; &nbsp; &nbsp;</label>
				<div class="btn-group">
				<?php
				if($gender == "male"){
					echo '<label class="radio-inline"><input type="radio" name="gender" value="male" checked="checked">Male</label>';
					echo '<label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>';
				}
				else {
					echo '<label class="radio-inline"><input type="radio" name="gender" value="male">Male</label>';
					echo '<label class="radio-inline"><input type="radio" name="gender" value="female" checked="checked">Female</label>';
				}

				?>
				</div>
				<br>
				<br>
				<label for="datOfBirthInput">Date of birth</label>
				<div class="form-group">
				</div>
				<br>
				<br>
				<label for="emailInput">E-mail</label>
				<div class="form-group">
				</div>
				<br>
				<br>

				<div class="form-group">
				    <label for="stateInput">State</label>

					<?php
					echo '<select name = "state" class ="form-control" selected="' . $state . '">';

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
				</div>
				<br>
				<br>
				<div class="form-group">
				<label for="cityInput">City</label>
				</div>
				<br>
				<br>
				<label for="zipInput">Zip</label>
				<div class="form-group">
					<?php echo '<input type="number" class="form-control" name="zip" maxLength="5" value="' . $zip . '">' .
						'<span class="help-inline">  ' . $zipcodeErr . '</span>';
					?>

				</div>
				<br>
				<br>
				<input type="submit" action="post" name="submit">
			</form>
        </div>
   </div>
</div>  <!-- end container -->
</body>

<?php
function userNameExists($username, $pdo) {
	$sql = "SELECT * FROM rrusers";
	// create a prepared statement to completely sanitize the input
	$statement = $pdo->prepare($sql);
	$statement->bindValue(1,$ID);
	$statement->execute();

	// grab the associative array from the query
	$users = $statement->fetch();

	$returned = false;

	foreach($users as $user) {
		if(strcmp($username, $user["username"]) === 0){
			$returned = true;
		}
	}

	return $returned;
}

function containsBadCharacters($string) {
	// if string contains non-alphanumeric characters, returns true
	if(preg_match('/[^a-z_\A-Z\0-9]/', $string)) {
		return true;
	}
	else {
		return false;
	}
}
?>
