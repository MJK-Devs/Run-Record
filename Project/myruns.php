

<html>
<head>
	<title>Record a Run</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="style.css" rel="stylesheet">
</head>
<body>
	<?php include("includes/navbar.php"); ?>

	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<?php displayRuns(getUserID($_COOKIE['User'])); ?>
			</div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
<?php
function displayRuns($UserID) {
    try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
		$sql = "select Date, Distance, Time from rruser natural join rruserruns natural join rrruns where UserID=" . $UserID;
        $result = $pdo->query($sql);

        // put query results into array
        $array = array();
        while ($row = $result->fetch()) {
			echo "Date: " . $row['Date'] . "  Distance: " . $row['Distance'] . "  Time: " . $row['Time'] . "<br>";
        }
        $pdo = null;

        // return the results
        return $array;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}

function getUserID($username) {
	try {
         // connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
		$sql = 'select * from rruser where Username="' . $username . '"';
        $result = $pdo->query($sql);

        // put query results into array
        $array = array();
        while ($row = $result->fetch()) {
			$id = $row['UserID'];
        }
        $pdo = null;

        // return the results
        return $id;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}

?>
