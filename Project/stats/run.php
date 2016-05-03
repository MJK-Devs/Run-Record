<?php
set_include_path(dirname(__FILE__)."/../includes/");
require_once "displayFunctions.php";
date_default_timezone_set('America/New_York');

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
	public $TimeOfDay = "";


	function __construct($runID, $date, $distance, $time, $calories, $terrain, $difficulty, $conditions, $temperature, $timeOfDay, $comments) {
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
		$this->TimeOfDay = $timeOfDay;
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
	public function printRunPanel() {
			$dayOfWeek = date("l",strtotime($this->_date));
			$month = date("F",strtotime($this->_date));
			$day = date("j",strtotime($this->_date));
			$year = date("Y",strtotime($this->_date));
			$formattedTime = gmdate("H:i:s", $this->_time);

			$panel = '
						<div class="panel panel-primary" id="' . $this->RunID .'">
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
								<table class="table table-user-information table-margin">
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
								<table class="table table-user-information table-margin">
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
							  </div>';

							  if ($this->Comments != "") {
								  $panel .= '<div class="col-md-12 col-lg-12">
									<div class="comments-div">' . $this->Comments . '</div>
								  </div>';
							  }

							  $panel .= '
							</div>
						  </div>
						  <div class="panel-footer">&nbsp;
						    <span class="pull-right">
							  <a href="editRun.php?ID=' . $this->RunID . '" title="Edit" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
							  <a href="deleteRun.php?ID=' . $this->RunID . '" title="Delete" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
							</span>
						  </div>
						</div>';
		return $panel;
	}
	function printEditPanel() {
		$formSize = "col-md-11";
		date_default_timezone_set('America/New_York');
		$todaysDate = date('Y-m-d', strtotime("today"));

		echo'<div class="panel panel-primary" id="' . $this->RunID .'">
			   <div class="panel-heading">
				 <div class="pull-left">
				   <h3 class="panel-title"><strong>Edit Run</strong></h3>
				 </div>
			   </div>
			   <div class="panel-body">
				<form method="post" action="db/createRun.php">
				  <div class="col-md-6 col-lg-6">
					<table class="table table-user-information table-margin">
					  <tbody>
						<tr>
							<td>Date</td>
							<td>
								<div class="' . $formSize . '">
									<input type="date" value= "' . $this->_date . '" class="form-control" name="date">
								</div>
							</td>
						  </tr>';
		echo			  '<tr>
							<td>Distance</td>
							<td>
								<div class="' . $formSize . '">
									<input type="number" min="0" max="100" step="0.01" value="0.00" class="numeric form-control" name="distance">
								</div>
							</td>
						  </tr>';
		echo			  '<tr>
							<td>Time</td>
							<td><div class="form-inline">';
								displayTime();
		echo
							'</div></td>
						  </tr>';
		echo			  '<tr>
							<td>Time Of Day</td>
							<td>
								<div class="' . $formSize . '">';
									displayTimeOfDay();
		echo    				'</div>
							</td>
						  </tr>
					  </tbody>
					</table>
				  </div>
				  <div class="col-md-6 col-lg-6">
					<table class="table table-user-information table-margin">
					  <tbody>
		echo 			<tr>
							<td>Difficulty</td>
							<td>
								<div class="' . $formSize . '">';
									displayDifficulty();
		echo					'</div>
							</td>
						  </tr>';
		echo			 '<tr>
							<td>Terrain</td>
							<td>
								<div class="' . $formSize . '">';
									displayTerrain();
		echo					'</div>
							</td>
						  </tr>';
		echo 			'<tr>
							<td>Conditions</td>
							<td>
								<div class="' . $formSize . '">';
									displayConditions();
		echo					'</div>
							</td>
						  </tr>';
		echo			 '<tr>
							<td>Temperature</td>
							<td>
								<div class="' . $formSize . '">';
									displayTemperature();
		echo					'</div>
							</td>
						  </tr>
					  </tbody>
					</table>
				  </div>
				  <div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
					<div class="wrapper" align="center">
						<td>Comments</td>
					</div>
					<textarea style="width:100%" style="overflow:hidden" rows="3" name="comments"></textarea>
				  </div>
			  </div>
			  <div class="panel-footer">
				<div class="wrapper" align="center">
					<button type="submit" value="submit" class="btn btn-primary" >Save this Run</button>
				</div>
				</form>
			  </div>';

	}
}
