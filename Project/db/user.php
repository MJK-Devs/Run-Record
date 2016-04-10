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
	
	
	function __construct($ID){
		try {
			$connString = "mysql:host=localhost;dbname=knovak18";
			$user = "knovak18";
			$pass = "web2";
			
			$pdo = new PDO($connString,$user,$pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sql = "SELECT Username, Password, Email, FirstName,
				LastName, DOB, Gender, Weight, JoinDate
				FROM rruser WHERE UserID = ?";
			
			// create a prepared statement to completely sanitize the input
			$statement = $pdo->prepare($sql);
			$statement->bindValue(1,$ID);
			$statement->execute();
			
			// grab the associative array from the query
			$a = $statement->fetch();
			
			// populate the variables with data from the associative array
			$this->Username = $a['Username'];
			$this->Password = $a['Password'];
			$this->Email = $a['Email'];
			$this->FirstName = $a['FirstName'];
			$this->LastName = $a['LastName'];
			$this->DOB = $a['DOB'];
			$this->Weight = $a['Weight'];
			$this->JoinDate = $a['JoinDate'];
			if($a['Gender'] == "m" or $a['Gender'] == "M"){ $this->Gender = "Male"; }
			else { $this->Gender = "Female";}
		}
		catch (PDOException $e) {
			die( $e->getMessage() );
			return null;
		}		
	}	
	//getter methods
	public function getArtistID() {return $this->ArtistID;}
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
}



?>