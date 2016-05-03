<?php
include_once("run.php");
set_include_path(dirname(__FILE__)."/../db/");
require_once 'user.php';
require_once 'db.php';

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
	private $LongestTime = 0;
	private $LongestDistance = 0;
	private $MostCalories = 0;
	private $QuickestPace = 100000000;
	private $user;
	private $UserID;
	private $runs = array();
	private $t;

	function __construct($ID){
		try {

			$connString = "mysql:host=localhost;dbname=knovak18";
			$user = "knovak18";
			$pass = "web2";

			$pdo = new PDO($connString,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT RunID, Date, Distance, Time, TimeOfDay, Difficulty, Terrain, Conditions, Temperature, Comments FROM rruser
					NATURAL JOIN rruserruns NATURAL JOIN rrruns WHERE
					UserID=" . $ID . " ORDER BY Date DESC, AddDate DESC";

			$result = $pdo->query($sql);
			$r = $result->fetchAll();

			date_default_timezone_set('America/New_York');

			$this->UserID = getUserID($_COOKIE['User']);
			$user = new User($this->UserID);

			foreach($r as $run) {
				// grab data from database for this run
				$RunID = $run["RunID"];
				$distance = $run["Distance"];
				$time = $run["Time"];
				$date = $run["Date"];
				$terrain = $run["Terrain"];
				$difficulty = $run["Difficulty"];
				$conditions = $run["Conditions"];
				$temperature = $run["Temperature"];
				$timeOfDay = $run["TimeOfDay"];
				$comments = $run["Comments"];
				$caloriesBurned = calculateCaloriesBurned($user->getAge(), $user->getWeight(), $user->getGender(), $time);

				// create new Run object and add it to $this->runs array
				$thisRun = new Run($RunID, $date, $distance, $time, $caloriesBurned, $terrain, $difficulty, $conditions, $temperature, $timeOfDay, $comments );
				$this->runs[] = $thisRun;

				// add totals for stats
				$this->TotalNumberOfRuns = $this->TotalNumberOfRuns + 1;
				$this->TotalTime = $this->TotalTime + $time;
				$this->TotalDistance = $this->TotalDistance + $distance;

				// calculate calories
				if($caloriesBurned == -1) { $this->TotalCaloriesBurned = "Weight needs to be set to calculate."; }
				else {
					$this->TotalCaloriesBurned = $this->TotalCaloriesBurned + $caloriesBurned;
				}

				// calculate personal records
				if($distance > $this->LongestDistance){ $this->LongestDistance = $distance; }
				if($time > $this->LongestTime){ $this->LongestTime = gmdate("H:i:s", $time); }
				if($caloriesBurned > $this->MostCalories){ $this->MostCalories = $caloriesBurned; }
				if(($time/$distance) < $this->QuickestPace){ $this->QuickestPace = gmdate("i:s",($time/$distance)); }
			}



			// calculate averages
			$this->AverageDistance = number_format($this->TotalDistance / $this->TotalNumberOfRuns, 1);
			$this->AverageTime = gmdate("H:i:s", $this->TotalTime / $this->TotalNumberOfRuns);
			$this->AveragePace = gmdate("i:s", $this->TotalTime / $this->TotalDistance);
			$this->AverageCaloriesBurned = number_format($this->TotalCaloriesBurned / $this->TotalNumberOfRuns, 1);
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
			return null;
		}
	}

	// returns an array of miles with key set as date timestamp and the value as miles
	// every day without a run will still have an entry but mileage will be at 0
	function getData($startDate, $endDate, $data) {
		try {
			$user = new User(getUserID($_COOKIE['User']));

			date_default_timezone_set('America/New_York');

			$dateDiff = floor(($endDate-$startDate)/(60*60*24));
			$interval = array();

			// add dates as keys and 0 each distance out in interval array
			for($i = 0; $i <= $dateDiff; ++$i) {
				$days = '+' . $i . ' days';
				$date = date('Y-m-d',strtotime($days, $startDate));
				$interval[$date] = 0;
			}

			// for each run, if it's in the interval,
			// add the distance to the corresponding date key
			foreach($this->runs as $run) {
				$runDataValue = $run->getDistance();
				$Date = $run->getRunDate();
				$formattedDate = date('Y-m-d', strtotime($Date));
				$y[$formattedDate] = $runDataValue;
				foreach($interval as $key=>$value) {
					if(strcmp($formattedDate, $key) === 0) {
						$interval[$formattedDate] = $run->getDistance();
					}
				}
			}
			return $interval;
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
			return null;
		}
	}

	function createRun($date, $distance, $time, $terrain = "", $difficulty ="", $conditions="", $temperature="", $timeOfDay = "", $comments="") {
				//create record in rruns
		try {
			// connect to database
			$connString = "mysql:host=localhost;dbname=knovak18";
			$user = "knovak18";
			$pass = "web2";

			$pdo = new PDO($connString,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$statement = $pdo->prepare("INSERT INTO rrruns(Date, Distance, Time, TimeOfDay, Difficulty, Terrain, Conditions, Temperature, Comments)
				VALUES(:Date, :Distance, :Time, :TimeOfDay, :Difficulty, :Terrain, :Conditions, :Temperature, :Comments)");
			$statement->execute(array(
				"Date" => $date,
				"Distance" => $distance,
				"Time" => $time,
				"TimeOfDay" => $timeOfDay,
				"Difficulty" => $difficulty,
				"Terrain" => $terrain,
				"Conditions" => $conditions,
				"Temperature" => $temperature,
				"Comments" => $comments
			));
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
			return null;
		}

		//get last runID created
		$aid = executeQuery("SELECT RunID FROM rrruns ORDER BY RunID DESC LIMIT 1","RunID");
		$id=$aid[0];
		$userID = getUserID($_COOKIE['User']);

		//Create Record in rruserruns
			try {
			// connect to database
			$connString = "mysql:host=localhost;dbname=knovak18";
			$user = "knovak18";
			$pass = "web2";

			$pdo2 = new PDO($connString,$user,$pass);
			$pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$statement = $pdo2->prepare("INSERT INTO rruserruns(UserID, RunID)
				VALUES(:UserID, :RunID)");
			$statement->execute(array(
				"UserID" => $userID,
				"RunID" => $id,
			));
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
			return null;
		}
	}

	function deleteRun($RunID){
		$connString = "mysql:host=localhost;dbname=knovak18";
		$user = "knovak18";
		$pass = "web2";

		$pdo = new PDO($connString,$user,$pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// delete from rrusers
		$sql = "DELETE FROM rrruns
				WHERE RunID=" . $RunID . "";

		$statement = $pdo->prepare($sql);
		$statement->execute();

		// delete from rruserruns
		$sql2 = "DELETE FROM rruserruns
				 WHERE RunID=" . $RunID . "
				 AND  UserID=" . $this->UserID . "";
	}
	
	function updateRun($runid, $date, $distance, $time, $terrain = "", $difficulty ="", $conditions="", $temperature="", $timeOfDay = "", $comments="") {
		//update record in rruns
		try {
			// connect to database
			$connString = "mysql:host=localhost;dbname=knovak18";
			$user = "knovak18";
			$pass = "web2";

			$pdo = new PDO($connString,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "UPDATE rruserruns
					SET	Date=:Date, Distance=:Distance, Time=:Time, TimeOfDay=:TimeOfDay,
						Difficulty=:Difficulty, Terrain=:Terrain, Conditions=:Conditions,
						Temperature=:Temperature, Comments=:Comments
					WHERE RunID=" . $runid . "";
					
			$statement = $pdo->prepare($sql);
			$statement->execute(array(
				"Date" => $date,
				"Distance" => $distance,
				"Time" => $time,
				"TimeOfDay" => $timeOfDay,
				"Difficulty" => $difficulty,
				"Terrain" => $terrain,
				"Conditions" => $conditions,
				"Temperature" => $temperature,
				"Comments" => $comments
			));
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
			return null;
		}
	}

	function getRun($ID){
		foreach($this->runs as $run){
			if ($run->getRunID() == $ID) {
				return $run;			}
		}
	}
	
	
	function getTotalDistance() { return number_format($this->TotalDistance, 1);}
	function getTotalNumberOfRuns() { return $this->TotalNumberOfRuns;}
	function getTotalTime() {return gmdate("H:i:s", $this->TotalTime);}
	function getTotalCaloriesBurned() {return number_format($this->TotalCaloriesBurned, 1);}
	function getAverageDistance() {return $this->AverageDistance;}
	function getAverageTime() {return $this->AverageTime;}
	function getAveragePace() {return $this->AveragePace;}
	function getAverageCaloriesBurned() {return $this->AverageCaloriesBurned;}
	function getLongestDistance() {return $this->LongestDistance;}
	function getLongestTime() {return $this->LongestTime;}
	function getMostCalories() {return $this->MostCalories;}
	function getQuickestPace() {return $this->QuickestPace;}
	function getRuns() {return $this->runs;}
	function test() { return $this->t; }
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
		return number_format($caloriesBurned, 0);
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

?>
