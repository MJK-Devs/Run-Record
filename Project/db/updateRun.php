<?php
	set_include_path(dirname(__FILE__)."/../stats/");
	require_once "runs.php";
	include_once "createRun.php";
	$r = new UserRuns(getUserID($_COOKIE['User']));
	$timeInSeconds = convertTimeToSeconds($_POST['hours'], $_POST['minutes'], $_POST['seconds']);
	$r->updateRun($_GET["ID"], $_POST['date'], $_POST['distance'], $timeInSeconds, $_POST['terrain'], $_POST['difficulty'], $_POST['conditions'], $_POST['temperature'], $_POST['timeOfDay'], $_POST['comments']);
	print_r($_POST);
	
	header('Location: myruns.php');
?>