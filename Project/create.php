<head> <title>Create Account</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="style.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.en_US.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.formhelpers/1.8.2/js/bootstrap-formhelpers-countries.js" type="text/javascript"></script>
</head>

<!-- SELECT COUNT(*) FROM table; -- returns the number of rows in the table	
		- will be helpful for delegating user ID's -->

<body>
<div class="header">
	<img width="100" height="100" alt="" src="images/logo.png">
	<h1><b>Create Account</b></h1>
</div>

<div class="container">
	<div class="row">
	</div>
	<div class="col-md-5">
		<div id="usernameAndPassword">
			<form class="form-inline">
<!--   -->		<label for="usernameInput">Username</label>
				<div class="form-group">
					<input type="text" class="form-control" name="username">
				</div><br><br>
				<!-- check if the name isn't already in the db -->
				<label for="passwordInput">Password</label>
				<div class="form-group">
                  <input type="password" class="form-control" name="password">
                </div><br><br>
				<label for="verifyPasswordInput">Verify Password</label>
				<div class="form-group">
                  <input type="password" class="form-control" name="verifyPassword">
                </div><br><br>
				<!-- check whether these equal before creating the account -->
				
				</div><br><br>
			</form>  
        </div>
		<div id="contactInformation">
			<h3> Contact Information </h3><br>
			<form class="form-inline">
				<label for="firstNameInput">First Name</label>
					<div class="form-group">
					<input type="text" class="form-control" name="firstName">
				</div>
				<label for="lastNameInput">&nbsp; &nbsp;Last Name</label>
					<div class="form-group">
					<input type="text" class="form-control" name="lastName">
				</div><br><br>
				<label for="genderInput">Gender &nbsp; &nbsp; &nbsp;</label>
				<div class="btn-group">
					<label class="radio-inline"><input type="radio" name="male">Male</label>
					<label class="radio-inline"><input type="radio" name="female">Female</label>
				</div><br><br>
				<label for="datOfBirthInput">Date of birth</label>
				<div class="form-group">
					<input type="date" class="form-control" name="dateOfBirth">
				</div><br><br>
				<label for="emailInput">E-mail</label>
				<div class="form-group">
					<input type="email" class="form-control" name="email">
				</div><br><br>
				<label for="countryInput">Country</label>
				<select class="input-medium bfh-countries">Country</select>
				<br><br>
				<label for="stateInput">State</label>
				<div class="form-group">
					<input type="text" class="form-control" name="state">
				</div><br><br>
				<label for="cityInput">City</label>
				<div class="form-group">
					<input type="text" class="form-control" name="city">
				</div><br><br>
				<label for="zipInput">Zip</label>
				<div class="form-group">
					<input type="number" class="form-control" name="zip">
				</div><br><br>
			</form>	
		</div>	
        <button type="submit" class="btn btn-primary">Create</button>
   </div>  
</div>  <!-- end container -->