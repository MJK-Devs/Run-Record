<?php
set_include_path(dirname(__FILE__)."/../stats/");
require 'runs.php';
include_once "db.php";


#echo "hello world";

$errMessage = "";
$filledOutForms = isset($_POST['date']) and
				  isset($_POST['distance']) and 
				  isset($_POST['hours']) and
				  isset($_POST['minutes']) and
				  isset($_POST['seconds']);

if($filledOutForms) {
	$r = new UserRuns(getUserID($_COOKIE['User']));
	$timeInSeconds = convertTimeToSeconds($_POST['hours'], $_POST['minutes'], $_POST['seconds']);
	$r->createRun($_POST['date'], $_POST['distance'], $timeInSeconds, $_POST['terrain'], $_POST['difficulty'], $_POST['conditions'], $_POST['temperature'], $_POST['timeOfDay'], $_POST['comments']);
	print_r($_POST);
	
	header('Location: ../myruns.php');
	echo "all forms filled out";
}
else {
	echo "forms not filled out";
	$_SESSION['failedCreateRun'] = "forms not filled out";
	header('Location: ../record.php');
	$errMessage = '<h6 color="red">All forms must be filled out.</h6>';
}

function convertTimeToSeconds($hours, $minutes, $seconds) {
	$newTime = ( $hours * 60 * 60 ) + ( $minutes * 60 ) + ( $seconds );
	return $newTime;
}



?>