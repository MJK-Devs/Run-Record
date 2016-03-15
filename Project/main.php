<head>  <title> Record Run </title> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">-->
</head>

<body>

<div id="navbar">
	<nav role="navigation" class="navbar navbar-default">
		<div class="navbar-header">
			<button type="button" data-target="#navbarCollapse" data-toggle 
			= "collapse" class = "navbar-toggle">
				<span class="sr-only"> Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<!-- the navbar collapses into a button if the screen is too small
				however, the button doesnt display the dropdown menu that it was 
				supposed to. Needs fixed later on -->
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				
				<!-- Dropdown class here needs fixed as it wasn't working
					It should drop down a menu with the <li>'s below-->
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle"
					href="#">Menu <b class="caret"></b></a>
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
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login.php#">Login</a></li>
				<li><a href="create.php">Create Account</a></li>
				<!-- if the user is logged in, replace create account with
						"Profile" instead, and link to "Profile.php"-->
			</ul>
		</div>
	</nav>
</div>
				


</div>

</body>
