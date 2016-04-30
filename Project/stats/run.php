<?php

class Run {
	public $UserID;
	public $RunID = "";
	public $_time = "";
	public $Distance = "";
	public $_date = "";
	public $Terrain = "";
	public $Difficulty = "";
	public $Conditions = "";
	public $Temperature = "";
	public $Comments = "";
	public $Calories = "";
	public $Pace = "";
	public $TimeOfDay = "Evening";
	
	
	function __construct($runID, $distance, $time, $date, $calories, $terrain = "", $difficulty ="", $conditions="", $temperature="", $comments="") {
		$this->RunID = $runID;
		$this->Distance = $distance;
		$this->_time = $time;
		$this->_date = $date;
		$this->Calories = $calories;
		$this->Terrain = $terrain;
		$this->Difficulty = $difficulty;
		$this->Conditions = $conditions;
		$this->Temperature = $temperature;
		$this->Comments = $comments;
		$this->Pace = gmdate("i:s", ($this->_time/$this->Distance));
	}

	public function getRunID() { return $this->RunID;}
	public function getTime() {return $this->_time;}
	public function getDistance() {return $this->Distance;}
	public function getRunDate() {return $this->_date;}
	public function getTerrain() {return $this->Terrain;}
	public function getDifficulty() {return $this->Difficulty;}
	public function getConditions() {return $this->Conditions;}
	public function getComments() {return $this->Comments;}
	public function getCalories() {return $this->Calories;}
	public function getPace() {return $this->Pace;}
	public function printRunPanel($view=true) {
		// view mode
		/*if ($view=true) { */
			
			$dayOfWeek = date("l",strtotime($this->_date));
			$month = date("F",strtotime($this->_date));
			$day = date("j",strtotime($this->_date));
			$year = date("Y",strtotime($this->_date));
			$formattedTime = gmdate("H:i:s", $this->_time);

			$panel = '
						<div class="panel panel-primary">
						  <div class="panel-heading">
							<div class="pull-left">
							  <h3 class="panel-title"><strong>' . $dayOfWeek . ', ' . $month . ' ' . $day . ', ' . $year . '</strong></h3>
						    </div>
							<div class="pull-right">
							  <h3 class="panel-title"><strong>' . $this->TimeOfDay . '</strong></h3>
							</div>
							<div class="clearfix"></div>
						  </div>
						  <div class="panel-body">
							<div class="row">
							  <div class="col-md-6 col-lg-6">
								<table class="table table-user-information">
								  <tbody>
								    <tr>
									  <td>Distance</td>
									  <td>' . $this->Distance . ' miles</td>
									</tr>
									<tr>
									  <td>Time</td>
									  <td>' . $formattedTime . '</td>
									</tr>
									<tr>
									  <td>Pace</td>
									  <td>' . $this->Pace . '</td>
									</tr>
									<tr>
									  <td>Calories</td>
									  <td>' . $this->Calories . '</td>
									</tr>
								  </tbody>
								</table>
							  </div>
							  <div class="col-md-6 col-lg-6">
								<table class="table table-user-information">
								  <tbody>
								    <tr>
									  <td>Difficulty</td>
									  <td>' . $this->Difficulty . '</td>
									</tr>
									<tr>
									  <td>Terrain</td>
									  <td>' . $this->Terrain . '</td>
									</tr>
									<tr>
									  <td>Conditions</td>
									  <td>' . $this->Conditions . '</td>
									</tr>
									<tr>
									  <td>Temperature</td>
									  <td>' . $this->Temperature . '</td>
									</tr>
								  </tbody>
								</table>
							  </div>
							  <div class="col-md-12 col-lg-12">
								<textarea readonly style="width:100%">' . $this->Comments . '</textarea>
							  </div>
							</div>
						  </div>
						</div>';
		//}
		// edit mode
		//else {
		//	$panel = "";
		//}
		
		//$panel = "";
		
		return $panel;
	}
}