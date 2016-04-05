<head>  <title> Record Run </title> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href="style.css" rel="stylesheet">
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">-->
</head>

<body>

<div id="navbar">
	<nav role="navigation" class="navbar navbar-default">
		<div class="navbar-header">
			<button type="button" data-target="#navbarCollapse" data-toggle 
			="collapse" class="navbar-toggle collapsed" aria-expanded="false">
				<span class="sr-only"> Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" role="button"
					href="#">Menu <span class="caret"></span></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="#">Record a Run</a></li>
						<li><a href="#">My Runs</a></li>
						<li><a href="#">My Races</a></li>
						<li><a href="#">Statistics</a></li>
						<li><a href="#">Routes</a></li>
					</ul>
				</li>
				<li><a href="#">Community</a></li>
			</ul>
			<?php
			print('<ul class="nav navbar-nav navbar-right">');
					if(isset($_COOKIE['User'])) {
						print('<li><a href="profile.php">Profile</a></li>');
						print('<li><a href="logout.php">Log Out</a></li>');
					}
					else {
						print('<li><a href="login.php#">Login</a></li>');
						print('<li><a href="create.php">Create Account</a></li>');
					}
				?>
				<!-- if the user is logged in, replace create account with
						"Profile" instead, and link to "Profile.php"-->
			</ul>
		</div>
	</nav>
</div>
<!--
<div class="slider">
  <ul>
    <li><img src="images/quote_pictures/1.jpg"></li>
    <li><img src="images/quote_pictures/2.jpg"></li>
    <li><img src="images/quote_pictures/3.jpg"></li>
    <li><img src="images/quote_pictures/4.jpg"></li>
	<li><img src="images/quote_pictures/5.jpg"></li>
	<li><img src="images/quote_pictures/6.jpg"></li>
	<li><img src="images/quote_pictures/7.jpg"></li>
	<li><img src="images/quote_pictures/8.png"></li>
  </ul>
</div>
-->



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>
