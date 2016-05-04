<div id="navbar">
	<nav role="navigation" class="navbar navbar-inverse navbar-fixed">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
		    <span class="sr-only">Toggle navigation</span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand logo" href="main.php">Record•Run</a>
		</div>
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="record.php">Record a Run</a></li>
				<li><a href="myruns.php">My Runs</a></li>
				<li><a href="stats/stats_main.php">Statistics</a></li>
			</ul>
			<?php
			print('<ul class="nav navbar-nav navbar-right">');
					if(isset($_COOKIE['User'])) {
						print('<li><a href="profile/profile.php">'.$_COOKIE['User'].'</a></li>');
						print('<li><a href="logout.php">Log Out</a></li>');
					}
					else {
						print('<li><a href="login.php#">Login</a></li>');
						print('<li><a href="create.php">Create Account</a></li>');
						header('Location: welcome.php');
					}
				?>
				<!-- if the user is logged in, replace create account with
						"Profile" instead, and link to "Profile.php"-->
			</ul>
		</div>
	</nav>
</div>

<!-- NAVBAR BUFFER -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand logo" href="welcome.php">Record•Run</a>
        </div>
    </div>
</nav>
