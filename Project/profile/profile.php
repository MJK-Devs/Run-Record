<?php session_start(); ?>
<head>
	<title>Record Run - Profile</title>
	<?php
		include_once("../includes/header2.php");
		include_once("../db/user.php");
		include_once("../db/db.php");
		include_once("../includes/navbar3.php");

		$user = new User(getUserID($_COOKIE['User']));
		$userID = getUserID($_COOKIE['User']);
		$profilePicture = "profile_pictures/default.png";
		if(file_exists('images/' . $userID . '.png')){$profilePicture = $userID . '.png';}
		if(file_exists('images/' . $userID . '.PNG')){$profilePicture = $userID . '.PNG';}
		if(file_exists('images/' . $userID . '.jpeg')){$profilePicture = $userID . '.jpg';}
		if(file_exists('images/' . $userID . '.JPEG')){$profilePicture = $userID . '.JPEG';}
		if(file_exists('images/' . $userID . '.jpg')){$profilePicture = $userID . '.jpg';}
		if(file_exists('images/' . $userID . '.JPG')){$profilePicture = $userID . '.JPG';}

		if(isset($_COOKIE['User'])) {
			$username = $_COOKIE['User'];
		}
	?>
</head>

<body>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
	   <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title"><?php echo $user->getUsername(); ?></h3>
		  </div>
		  <div class="panel-body">
			<div class="row">
			  <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Picture" src="../images/<?php echo $profilePicture; ?>" class="img-circle img-responsive"> </div>
			  <div class="c1ol-md-9 col-lg-9">
				<table class="table table-user-information">
				  <tbody>
					<?php userInfoTable(); ?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		  <div class="panel-footer">
		    <a href="../stats/stats_main.php" title="Statistics" data-toggle="tooltip" type="button" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-stats"></i></a>
			<span class="pull-right">
			  <a href="edit.php" title="Edit Profile" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
			  <a href="delete.php" title="Delete Account" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
			</span>


		  </div>
		</div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

<?php
function userInfoTable() {
	$user = new User(getUserID($_COOKIE['User']));
	echo '<tr>
 		    <td>Name</td>
     	    <td>' . $user->getFirstName() . ' ' . $user->getLastName() . '</td>
		  </tr>';
	echo '<tr>
 		    <td>About me</td>
     	    <td>' . $user->getAboutMe() . '</td>
		  </tr>';
  	echo '<tr>
			<td>Gender</td>
			<td>' . $user->getGender() . '</td>
		  </tr>';
	echo '<tr>
   		    <td>Age</td>
			<td>' . $user->getAge() . '</td>
		  </tr>';
  	echo '<tr>
		    <td>Height</td>
		    <td>' . $user->getHeight() . '</td>
			</tr>';
	echo '<tr>
			<td>Weight</td>
			<td>' . $user->getWeight() . '</td>
		  </tr>';
	echo '<tr>
			<td>Location</td> <!-- city, state -->
			<td>' . $user->getCity() . ", " . $user->getState() . '</td>
		  </tr>';
	echo '<tr>
			<td>Email</td>
	    	<td>'. $user->getEmail() . '</td>
		  </tr>';
	echo '<tr>
			<td>Member Since</td>
			<td>' . convertDate($user->getJoinDate()) . '</td>
		  </tr>';
}

// function calculateAge($DOB) {
// 	date_default_timezone_set('America/New_York');
//     return date_diff(date_create($DOB), date_create('today'))->y;
// }

function convertDate($date){
	date_default_timezone_set('America/New_York');
	$newDate = date("m-d-Y", strtotime($date));
	return $newDate;
}
?>
