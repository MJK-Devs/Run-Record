<?php
$string = "5'6\"";
echo $string . '<br>';
$test = convertStringHeightToInches($string);
echo $test . '<br>';
$test2 = convertInchesToStringHeight($test);
echo $test2 . '<br>';
if($string == $test2){
    echo 'WORKS';
}


function convertInchesToStringHeight($in){
	set_include_path(dirname(__FILE__)."/../includes/");
	require 'height.php';
	$feet = 0;
	while($in >= 12) {
		$in = $in - 12;
		$feet++;
	}
	$stringHeight = $feet . '\'' . $in . '"';
	return $stringHeight;
}

function convertStringHeightToInches($stringHeight){
	set_include_path(dirname(__FILE__)."/../includes/");
	require 'height.php';
	foreach($height as $inches=>$string){
		if(strcmp($stringHeight,$string) === 0){
			return $inches;
		}
	}
	return 0;
}

?>
