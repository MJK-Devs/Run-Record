<?php
include_once "db/db.php";

echo "hello world";

$errMessage = "";
$filledOutForms = isset($_POST['date']) and
				  isset($_POST['distance']) and 
				  isset($_POST['hours']) and
				  isset($_POST['minutes']) and
				  isset($_POST['seconds']);

if($filledOutForms) {
	$timeInSeconds = convertTimeToSeconds($_POST['hours'], $_POST['minutes'], $_POST['seconds'])
	createRun($_POST['date'], $_POST['distance'], $timeInSeconds);
	header('Location: ../main.php');
	echo "all forms filled out";
}
else {
	echo "forms not filled out";
	header('Location: ../record.php');
	//$errMessage = '<h6 color="red">All forms must be filled out.</h6>';
}

function convertTimeToSeconds($hours, $minutes, $seconds) {
	$newTime = ( $hours * 60 * 60 ) + ( $minutes * 60 ) + ( $seconds );
	return $newTime;
}

?>