<?php
session_start();
include("../db/user.php");
$user = new User(getUserID($_COOKIE['User']));


$target_dir = "../images/profile_pictures/";
$target_file = $target_dir . basename($_FILES["profilePicture"][$user->getUserID()]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profilePicture"][$user->getUserID()]);
    if($check === false) {
        $_SESSION["failedImageCheck"] = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exist
/*
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
*/
// Check file size
if ($_FILES["profilePicture"]["size"] > 500000) {
    $_SESSION["failedSizeCheck"] = "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $_SESSION["failedTypeCheck"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 1) {
     "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["profilePicture"][$user->getUserID()], $target_file)) {
        //echo "The file ". basename( $_FILES["profilePicture"]["name"]). " has been uploaded.";
		//header("Location: profile.php");
    } else {
        $_SESSION["failedUpload"] = "Sorry, there was an error uploading your file.";
		header("Location: edit.php");
    }
}
?>
