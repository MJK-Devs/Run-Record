<?php 

define("BASE_PATH", $CONFIGS['BASE_PATH']); 
$curent_dir = explode("/", $_SERVER['PHP_SELF']);

switch ($curent_dir[count($curent_dir)-2]) {
	case 'stats':
	$url = BASE_PATH . "/Project/";
		
		break;
	case 'Project':
		$url = BASE_PATH . "";
		break;	
	default:
		$url = "";
		break;
}

?>

<div id="navbar">
	<nav role="navigation" class="navbar navbar-inverse navbar-fixed">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
		    <span class="sr-only">Toggle navigation</span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand logo" href="<?php echo $url; ?>/main.php">Record•Run</a>
		</div>
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" role="button"
					href="#">Menu <span class="caret"></span></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="<?php echo $url; ?>record.php">Record a Run</a></li>
						<li><a href="<?php echo $url; ?>myruns.php">My Runs</a></li>
						<li><a href="#">My Races</a></li>
						<li><a href="<?php echo $url; ?>stats/stats_main.php">Statistics</a></li>
						<li><a href="#">Routes</a></li>
					</ul>
				</li>
				<li><a href="#">Community</a></li>
			</ul>
			<?php
			print('<ul class="nav navbar-nav navbar-right">');
					if(isset($_COOKIE['User'])) {
						echo '<li><a href="'.$url.'profile/profile.php">'.$_COOKIE['User'].'</a></li>';
						echo '<li><a href="'.$url.'logout.php">Log Out</a></li>';

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
<?php if($curent_dir[count($curent_dir)-2] == "stats"): ?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand logo" href="welcome.php">Record•Run</a>
        </div>
    </div>
</nav>
 <?php ENDIF; ?> 