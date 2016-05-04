<?php
function displayConditions($default = null) {
	if ( null === $default ) {
		$default = "Normal";
	}
	set_include_path(dirname(__FILE__)."/");
	require 'runOptions.php';
	echo '<select name="conditions" class="form-control">';
	foreach($conditions as $c){
		if(strcmp($default,$c) === 0) {
			 echo '<option selected="selected">' . $default . '</option>';
		} else {
			 echo '<option value="' . $c . '">' . $c . '</option>';
		}
	}
	echo '</select>';
}

function displayDifficulty($default = null) {
	if ( null === $default ) {
		$default = "Normal";
	}
	set_include_path(dirname(__FILE__)."/");
	require 'runOptions.php';
	echo '<select name="difficulty" class="form-control">';
	foreach($difficulty as $d){
		if(strcmp($default,$d) === 0) {
			 echo '<option selected="selected">' . $default . '</option>';
		} else {
			 echo '<option value="' . $d . '">' . $d . '</option>';
		}
	}
	echo '</select>';
}

function displayTemperature($default = null) {
	if ( null === $default ) {
		$default = "Pleasant";
	}
	set_include_path(dirname(__FILE__)."/");
	require 'runOptions.php';
	echo '<select name="temperature" class="form-control">';
	foreach($temperature as $t){
		if(strcmp($default,$t) === 0) {
			 echo '<option selected="selected">' . $default . '</option>';
		} else {
			 echo '<option value="' . $t . '">' . $t . '</option>';
		}
	}
	echo '</select>';
}

function displayTerrain($default = null) {
	if ( null === $default ) {
		$default = "Road";
	}
	set_include_path(dirname(__FILE__)."/");
	require 'runOptions.php';
	echo '<select name="terrain" class="form-control">';
	foreach($terrain as $t){
		if(strcmp($default,$t) === 0) {
			 echo '<option selected="selected">' . $default . '</option>';
		} else {
			 echo '<option value="' . $t . '">' . $t . '</option>';
		}
	}
	echo '</select>';
}

function displayTimeOfDay($default = null) {
	if ( null === $default ) {
		$default = "Morning";
	}
	set_include_path(dirname(__FILE__)."/");
	require 'runOptions.php';
	echo '<select name="timeOfDay" class="form-control">';
	foreach($timeOfDay as $t){
		if(strcmp($default,$t) === 0) {
			 echo '<option selected="selected">' . $default . '</option>';
		} else {
			 echo '<option value="' . $t . '">' . $t . '</option>';
		}
	}
	echo '</select>';
}


function displayTime($hours = null, $minutes = null, $seconds = null) {
	displayHours($hours);
	displayMinutes($minutes);
	displaySeconds($seconds);
}

function displayHours($default = null) {
	if ( null === $default ) {
		$default = 0;
	}
	$hours = 0;
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<select name="hours" class="form-control">';
	for($hours ; $hours < 60; ++$hours){
		if($hours === $default) {
			 echo '<option selected="selected">' . $default . '</option>';
		}
		else {
			 echo '<option value="' . $hours . '">' . $hours . '</option>';
		}
	}
	echo '</select><label> &nbsp; h &nbsp; </label>';
}

// displays minutes, default selected is 0 unless otherwise specified
function displayMinutes($default = 0) {
	if ( null === $default ) {
		$default = 0;
	}
	$minutes = 0;
	echo '<select name="minutes" class="form-control">';
	while($minutes <= 59) {
		if($minutes === $default) {
			 echo '<option selected="selected">' . $default . '</option>';
		} else {
			 echo '<option value="' . $minutes . '">' . $minutes . '</option>';
		}
		$minutes = $minutes + 1;
		
	}
	echo '</select><label> &nbsp; m &nbsp; </label>';
}

function displaySeconds($default = 0) {
	if ( null === $default ) {
		$default = 0;
	}
	$seconds = 0;
	echo '<select name="seconds" class="form-control">';
	while($seconds <= 59) {
		if($seconds === $default) {
			 echo '<option selected="selected">' . $default . '</option>';
		} else {
			 echo '<option value="' . $seconds . '">' . $seconds . '</option>';
		}
		$seconds = $seconds + 1;
	}
	echo '</select><label> &nbsp; s &nbsp; </label>';
}

?>