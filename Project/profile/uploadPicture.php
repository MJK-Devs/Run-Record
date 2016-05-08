<?php session_start(); ?>
<head>
	<title>Record Run - Change Profile Picture</title>
	<?php include("../includes/header2.php"); ?>
</head>

<body>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
	<?php
	include("../db/user.php");
	include("../db/db.php");
	include("../includes/navbar3.php");

	$user = new User(getUserID($_COOKIE['User']));
	$userID = getUserID($_COOKIE['User']);
	$profilePicture = "default.png";
	if(file_exists('images/' . $userID . '.png')){$profilePicture = $userID . '.png';}
	if(file_exists('images/' . $userID . '.PNG')){$profilePicture = $userID . '.PNG';}
	if(file_exists('images/' . $userID . '.jpeg')){$profilePicture = $userID . '.jpg';}
	if(file_exists('images/' . $userID . '.JPEG')){$profilePicture = $userID . '.JPEG';}
	if(file_exists('images/' . $userID . '.jpg')){$profilePicture = $userID . '.jpg';}
	if(file_exists('images/' . $userID . '.JPG')){$profilePicture = $userID . '.JPG';}

	  if(isset($_FILES['image'])){
      $errors= array();
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=explode('.',$_FILES['image']['name']);
	  $file_ext_lower=strtolower(end(explode('.',$_FILES['image']['name'])));
	  $file_name = (string)$userID . '.' . end($file_ext);
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext_lower,$extensions)=== false){
         $errors[]="Extension not allowed, please choose a JPEG or PNG file.";
      }
      
	  $errors[] = $file_size;
	  
      if($file_size > 2097152){
         $errors[]="File size must be less than 2 MB.";
      }
      
      if(empty($errors)==true){
		 unlink('images/' . $profilePicture);
         move_uploaded_file($file_tmp,"images/".$file_name);
		 $_SESSION["uploadSuccess"] = '<div class="alert alert-success" role="alert"><div class="wrapper" align="center">Succesfully uploaded!</div></div>';
		 header("Location: edit.php");
      }else{
         echo '<div class="alert alert-danger" role="alert">';
		 foreach($errors as $e) {
			 echo '<div class="wrapper" align="center"><h4>' . $e . '</h4></div>';
		 }
		 echo '</div>';
      }
   }
?>
	
	
	   <div class="panel panel-primary">
		  <div class="panel-heading">
			<h3 class="panel-title">Change Profile Picture</h3>
		  </div>
		  <div class="panel-body"> <br><br>
			<div class="row">
			  <div class="c1ol-md-12 col-lg-12">
			    <div align="center"> <img alt="User Picture" src="images/<?php echo $profilePicture; ?>" class="img-circle img-responsive"> </div>
				<table class="table table-user-information">
				  <tbody>
				    <form method="post" action="" enctype="multipart/form-data">
					<tr>
					  <td><input type="file" name="image" /></td>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		  <div class="panel-footer">&nbsp;
			<span class="pull-right">
			  <button type="submit" value="submit" title="Change" data-toggle="tooltip" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-ok"></i></button>
			  </form>
			  <a href="edit.php" title="Cancel" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
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

?>
