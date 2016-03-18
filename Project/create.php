<head> <title>Create Account</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="style.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.en_US.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.js" type="text/javascript"></script>
<?php //include "helper-functions.php";
	  include_once "db/db.php";?>
</head>

<!-- SELECT COUNT(*) FROM table; - returns the number of rows in the table	
		- will be helpful for delegating user ID's -->

<body>
<div class="header">
	<img width="100" height="100" alt="" src="images/logo.png">
	<h1><b>Create Account</b></h1>
</div>


<?php  
	$usernameErr = $passwordErr = $verifyPasswordErr = $uname = "";
	$badUsername = $badPassword = $badVerification = false;
	$usernameFormGroup = "control-group";
	$passwordFormGroup = "control-group";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST["username"])){
		$usernameErr = "Username is required.";
		$usernameFormGroup = "control-group error";
		$badUsername = true;
	}
	else { //set uname to the username to place in the form
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
	
	
	// if there are no errors
	if(!$badUsername && !$badPassword && !$badVerification){
		//createUser($_POST['username'], $_POST['password']);
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
				<!--<?php echo '<div class="' . $usernameFormGroup . '">';?>-->
				  <?php echo '<input type="text" class="form-control" name="username" maxlength="20" value="' . $uname . '">';?>
				  <span class="help-inline"><?php echo $usernameErr; ?></span>
				</div>
				<br>
				<br>
				<label for="passwordInput">Password</label>
				<?php echo '<div class="' . $usernameFormGroup . '">'; ?>
                  <input type="password" class="form-control" name="password" maxlength="20">
				  <span class="help-inline"><?php echo $passwordErr; ?></span>
				</div>
				<br>
				<br>
				<label for="verifyPasswordInput">Verify Password</label>
				<div class="control-group warning">
                  <input type="password" class="form-control" name="verifyPassword" maxlength="20">
                  <span class="help-inline"><?php echo $verifyPasswordErr; ?></span>
				</div>
				<br>
				<br>
				<br>
				<br>
				
				
				<!--- commented out for now, will implement this for milestone 3
				<h3><b>Contact Information</b></h3>
				<br>
				 check whether these equal before creating the account 
				<label for="firstNameInput">First Name</label>
				<div class="form-group">
					<?php echo '<input type="text" class="form-control" name="firstName" maxlength="20" value="' . $firstName . '">';?>
				</div>
				<label for="lastNameInput">&nbsp; &nbsp;Last Name</label>
				<div class="form-group">
					<?php echo '<input type="text" class="form-control" name="lastName" maxlength="20" value="' . $lastName .'">';?>
				</div>
				<br>
				<br>
				<label for="genderInput">Gender &nbsp; &nbsp; &nbsp;</label>
				<div class="btn-group">
					<label class="radio-inline"><input type="radio" name="male">Male</label>
					<label class="radio-inline"><input type="radio" name="female">Female</label>
				</div>
				<br>
				<br>
				<label for="datOfBirthInput">Date of birth</label>
				<div class="form-group">
					<input type="date" class="form-control" name="dateOfBirth">
				</div>
				<br>
				<br>
				<label for="emailInput">E-mail</label>
				<div class="form-group">
					<input type="email" class="form-control" name="email" maxlength="40">
				</div>
				<br>
				<br>
				<label for="countryInput">Country</label>
				<select class="input-medium bfh-countries"></select>
				<br>
				<br>
				<label for="stateInput">State</label>
				<div class="form-group">
					<input type="text" class="form-control" name="state" maxlength="20">
				</div>
				<br>
				<br>
				<label for="cityInput">City</label>
				<div class="form-group">
					<input type="text" class="form-control" name="city" maxlength="20">
				</div>
				<br>
				<br>
				<label for="zipInput">Zip</label>
				<div class="form-group">
					<input type="number" class="form-control" name="zip" maxLength="5">
				</div>
				<br>
				<br>-->
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
