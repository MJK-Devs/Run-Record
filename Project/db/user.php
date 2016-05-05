<?php
class User {
	private $Username = "";
	private $Password = "";
	private $Email = "";
	private $FirstName = "";
	private $LastName = "";
	private $DOB = "";
	private $Gender = "";
	private $Weight = "";
	private $JoinDate = "";
	private $City = "";
	private $State = "";
	private $ZipCode = "";
	private $Height = "";
	private $AboutMe = "";
	private $BMI = "";


	function __construct($ID){
		try {
			$connString = "mysql:host=localhost;dbname=knovak18";
			$user = "knovak18";
			$pass = "web2";

			$pdo = new PDO($connString,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "SELECT Username, Password, Email, FirstName,
				LastName, DOB, Gender, Weight, JoinDate, Height,
				City, State, AboutMe
				FROM rruser WHERE UserID = ?";

			// create a prepared statement to completely sanitize the input
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1,$ID);
			$statement->execute();

			// grab the associative array from the query
			$a = $statement->fetch();

			// populate the variables with data from the associative array
			$this->UserID = $ID;
			$this->Username = $a['Username'];
			$this->Password = $a['Password'];
			$this->Email = $a['Email'];
			$this->FirstName = $a['FirstName'];
			$this->LastName = $a['LastName'];
			$this->DOB = $a['DOB'];
			$this->Weight = $a['Weight'];
			$this->JoinDate = $a['JoinDate'];
			$this->Height = convertInchesToStringHeight($a['Height']);
			$this->City = $a['City'];
			$this->State = $a['State'];
			$this->AboutMe = $a['AboutMe'];

			if($a['Gender'] == "m" or $a['Gender'] == "M"){ $this->Gender = "Male"; }
			else { $this->Gender = "Female";}
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
			return null;
		}
	}

	// error handling is done outside of the function
	// therefore, this assumes all inputs are valid and non-empty
	function changeInfo($Username, $Email, $FirstName, $LastName, $Weight, $Height, $AboutMe, $City, $State) {
		try {
			// if any fields are empty, they are not to be updated
			if(strcmp("",$Email)==0){ $Email = $this->Email;}
			if(strcmp("",$FirstName==0)){ $FirstName = $this->FirstName;}
			if(strcmp("",$LastName==0)){ $LastName = $this->LastName;}
			if(strcmp("",$Weight)==0){ $Weight = $this->$Weight;}
			if(strcmp("",$State)==0){ $State = $this->State;}
			if(strcmp("",$Height)==0){$Height = $this->Height;}

			$connString = "mysql:host=localhost;dbname=knovak18";
			$user = "knovak18";
			$pass = "web2";

			$pdo = new PDO($connString,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "UPDATE rruser
					SET Username=:Username, Email=:Email, FirstName=:FirstName,
						LastName=:LastName, Weight=:Weight, Height=:Height, AboutMe=:AboutMe,
						Height=:Height, City=:City, State=:State
					WHERE UserID=:ID";

			$statement = $pdo->prepare($sql);
			$statement->execute(array(
				"Username" => $Username,
				"Email" => $Email,
				"FirstName" => $FirstName,
				"LastName" => $LastName,
				"Weight" => $Weight,
				"AboutMe" => $AboutMe,
				"Height" => convertStringHeightToInches($Height),
				"City" => $City,
				"State" => $State,
				"ID" => $this->UserID
			));

			$this->Username = $Username;
			$this->Email = $Email;
			$this->FirstName = $FirstName;
			$this->LastName = $LastName;
			$this->Weight = $Weight;
			$this->Height = convertInchesToStringHeight($Height);
			$this->City = $City;
			$this->State = $State;
			$this->AboutMe = $AboutMe;

		}
		catch (PDOException $e) {
			die( $e->getMessage() );
			return null;
		}
	}



	function changePassword($newPassword) {
		try {
			$connString = "mysql:host=localhost;dbname=knovak18";
			$user = "knovak18";
			$pass = "web2";

			$pdo = new PDO($connString,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "UPDATE rruser
					SET Password=:Password
					WHERE UserID=:ID";

			$statement = $pdo->prepare($sql);
			$statement->execute(array(
				"Password" => $newPassword,
				"ID" => $this->UserID
			));
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
			return null;
		}
	}

	function deleteUser(){
		$connString = "mysql:host=localhost;dbname=knovak18";
		$user = "knovak18";
		$pass = "web2";

		$pdo = new PDO($connString,$user,$pass);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "DELETE FROM rruser
				WHERE UserID=" . $this->UserID . "";

		$statement = $pdo->prepare($sql);
		$statement->execute();
	}

	//getter methods
	public function getUsername() {return $this->Username;}
	public function getPassword() {return $this->Password;}
	public function getEmail() {return $this->Email;}
	public function getFirstName() {return $this->FirstName;}
	public function getLastName() {return $this->LastName;}
	public function getDOB() {return $this->DOB;}
	public function getGender() {return $this->Gender;}
	public function getWeight() {return $this->Weight;}
	public function getJoinDate() {return $this->JoinDate;}
	public function getState() {return $this->State;}
	public function getCity() {return $this->City;}
	public function getHeight() {return $this->Height;}
	public function getZipCode() {return $this->ZipCode;}
	public function getAboutMe() {return $this->AboutMe;}
	public function getAge() {
		date_default_timezone_set('America/New_York');
		$age = date_diff(date_create($this->DOB), date_create('today'))->y;
		return $age;
	}
	public function getBMI() {
		if((strcmp($this->Height,"") != 0) and ((strcmp($this->Weight,"") != 0)) and ($this->Weight != 0 )){
			$inches = convertStringHeightToInches($this->Height);

			$kg = $this->Weight * 0.45;
			$m = $inches * 0.025;
			$mSquared = $m * $m;
			$BMI = $kg / $mSquared;

			return (number_format($BMI, 1));
			return calculateBMI($this->Height, $this->Weight);
		}
		else{
			return "Set height and weight to calculate BMI.";
		}
	}
}

function convertInchesToStringHeight($in){
	set_include_path(dirname(__FILE__)."/../includes/");
	require 'height.php';
	foreach($height as $inches=>$string){
		if(strcmp($in,$inches) === 0){
			return $string;
		}
	}
}

function convertStringHeightToInches($stringHeight){
	set_include_path(dirname(__FILE__)."/../includes/");
	require 'height.php';
	foreach($height as $inches=>$string){
		if(strcmp($stringHeight,$string) === 0){
			return $inches;
		}
	}
}


?>
