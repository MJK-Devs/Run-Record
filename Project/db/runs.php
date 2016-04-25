<?php
include_once("user.php");

class UserRuns {
	private $TotalTime;
	private $TotalDistance;
	private $TotalCaloriesBurned;
	private $TotalNumberOfRuns;
	private $AverageDistance;
	private $AverageTime;
	private $AveragePace;
	private $AverageCaloriesBurned;
	private $MilesPerWeek;
	private $MilesPerMonth;
	private $MilesPerYear;
	
	function __construct($ID){
		try {
			$connString = "mysql:host=localhost;dbname=knovak18";
			$user = "knovak18";
			$pass = "web2";
			
			$pdo = new PDO($connString,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT Date, Distance, Time FROM rruser 
					NATURAL JOIN rruserruns NATURALJOIN rrruns WHERE
					UserID=" . $ID . "";
					
			$result = $pdo->query($sql);
			$runs = $result->fetch();
			
			date_default_timezone_set('America/New_York');
			
			$user = new User($ID);
			$years = array();
			$months = array();
			$weeks = array();
			
			foreach($runs as $run) {
				$distance = $run["Distance"];
				$time = $run["Time"];
				$date = $run["Date"];
				$dateParsed = date_parse($date);
				$year = $dateParsed["year"];
				$month = $dateParsed["month"];
				$week = date("w", strtotime($date));
				$caloriesBurned = calculateCaloriesBurned($user->getAge(), $user->getWeight, $user->getGender(), $time);
				
				$this->TotalNumberOfRuns = $this->TotalNumberOfRuns + 1;
				$this->TotalTime = $this->TotalTime + $time;
				$this->TotalDistance = $this->TotalDistance + $distance;
				if($caloriesBurned == -1) { $this->TotalCaloriesBurned = "Weight needs to be set to calculate."; }
				else {
					$this->TotalCaloriesBurned = $this->TotalCaloriesBurned + $caloriesBurned;
				}
				
			}
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
			return null;
		}	
	}
}



function calculateCaloriesBurned($age, $weight, $gender, $time, $heartRate = "") {
	$minutes = $time/60 + (($time%60)/60);
	if(empty($weight)){
		return -1;
	}
	else {
		if(strcmp($heartRate,"") === 0){
			$heartRate = getHeartRate($age);
		}
		if(strcmp($gender, "Male")) {
			$caloriesBurned = (($age * 0.2017) + ($weight * 0.09036)
							   +($heartRate * 0.4472) - 20.4022)
							   *($minutes / 4.184);
		}
		else {
			$caloriesBurned = (($age * 0.074) - ($weight * 0.05741) 
							   +($heartRate * 0.4472) - 20.4022)
							   *($minutes/4.184);
		}
		return $caloriesBurned;
	}
	
}

function getHeartRate($age){
	if(1 <= $age && $age <= 30){
		$heartRate = 135;
	}
	if(31 <= $age && $age <= 34){
		$heartRate = 128.5;
	}
	if(35 <= $age && $age <= 40){
		$heartRate = 125;
	}
	if(41 <= $age && $age <= 45){
		$heartRate = 121.5;
	}
	if(46 <= $age && $age <= 50) {
		$heartRate = 118.5;
	}
	if(51 <= $age && $age <= 55){
		$heartRate = 115;
	}
	if(56 <= $age && $age <= 60){
		$heartRate = 111.5;
	}
	if(61 <= $age && $age <= 65){
		$heartRate = 108;
	}
	if(66 <= $age && $age <=70){
		$heartRate = 105;
	}
	if($age >= 71){
		$heartRate = 101.5;
	}
	
	return $heartRate;
}