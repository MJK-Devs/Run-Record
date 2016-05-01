<?php
function displayConditions() {
	set_include_path(dirname(__FILE__)."/");
	require 'runOptions.php';
	echo '<select name="conditions" class="form-control">';
	foreach($conditions as $c){
		echo '<option value="' . $c . '">' . $c . '</option>';
	}
	echo '</select>';
}

function displayDifficulty() {
	set_include_path(dirname(__FILE__)."/");
	require 'runOptions.php';
	echo '<select name="difficulty" class="form-control">';
	foreach($difficulty as $d){
		echo '<option value="' . $d . '">' . $d . '</option>';
	}
	echo '</select>';
}

function displayTemperature() {
	set_include_path(dirname(__FILE__)."/");
	require 'runOptions.php';
	echo '<select name="temperature" class="form-control">';
	foreach($temperature as $t){
		if(strcmp("Pleasant", $t) === 0) {
			echo '<option selected="selected">' . $t . '</option>';
		}
		echo '<option value="' . $t . '">' . $t . '</option>';
	}
	echo '</select>';
}

function displayTerrain() {
	set_include_path(dirname(__FILE__)."/");
	require 'runOptions.php';
	echo '<select name="terrain" class="form-control">';
	foreach($terrain as $t){
		echo '<option value="' . $t . '">' . $t . '</option>';
	}
	echo '</select>';
}

function displayTimeOfDay() {
	set_include_path(dirname(__FILE__)."/");
	require 'runOptions.php';
	echo '<select name="timeOfDay" class="form-control">';
	foreach($timeOfDay as $t){
		echo '<option value="' . $t . '">' . $t . '</option>';
	}
	echo '</select>';
}


function displayTime() {
	displayHours();
	displayMinutes();
	displaySeconds();
}

function displayHours() {
	$hours = 0;
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<select name="hours" class="form-control">';
	while($hours <= 60) {
		echo '<option value="' . $hours . '">' . $hours . '</option>';
		$hours = $hours + 1;
	}
	echo '</select><label> &nbsp; h &nbsp; </label>';
}

function displayMinutes() {
	$minutes = 0;
	echo '<select name="minutes" class="form-control">';
	while($minutes <= 59) {
		echo '<option value="' . $minutes . '">' . $minutes . '</option>';
		$minutes = $minutes + 1;
	}
	echo '</select><label> &nbsp; m &nbsp; </label>';
}

function displaySeconds() {
	$seconds = 0;
	echo '<select name="seconds" class="form-control">';
	while($seconds <= 59) {
		echo '<option value="' . $seconds . '">' . $seconds . '</option>';
		$seconds = $seconds + 1;
	}
	echo '</select><label> &nbsp; s &nbsp; </label>';
}

?>