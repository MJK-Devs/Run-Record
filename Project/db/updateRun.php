<?php
	set_include_path(dirname(__FILE__)."/../stats/");
	require_once "runs.php";

	$r = new UserRuns(getUserID($_COOKIE['User']));
	$timeInSeconds = convertTimeToSeconds($_POST['hours'], $_POST['minutes'], $_POST['seconds']);
	$r->updateRun($_GET["ID"], $_POST['date'], $_POST['distance'], $timeInSeconds, $_POST['terrain'], $_POST['difficulty'], $_POST['conditions'], $_POST['temperature'], $_POST['timeOfDay'], $_POST['comments']);

	header("Location: ../myruns.php");
	
function convertTimeToSeconds($hours, $minutes, $seconds) {
	$newTime = ( $hours * 60 * 60 ) + ( $minutes * 60 ) + ( $seconds );
	return $newTime;
}
?>