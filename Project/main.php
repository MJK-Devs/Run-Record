<?php 
date_default_timezone_set('America/New_York'); 
session_start();
?>

<head>
	<title>Record Run</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/main.js" type="text/javascript"></script>
	<?php include("includes/header.php"); ?>
</head>

<body>
<?php include("includes/navbar.php"); ?>
<div class="container">
	<div class="row">
		<div class="col-md-3"><!--Div for left sidebar content--> </div>

		<div class="col-md-6" id="newsfeed">
		<!--Div for newsfeed content-->
			<?php printNTopRuns(5);?>
		</div>

		<div class="col-md-3"> <!--Div for right sidebar content--></div>
	</div>
</div>
</body>


<?php
function printNTopRuns($n) {
	try{
	// connect to database
        $connString = "mysql:host=localhost;dbname=knovak18";
        $user = "knovak18";
        $pass = "web2";

        $query = 'SELECT rrruns.RunID,`Distance`,`Time`,`AddDate`,`Date`,rruser.`UserID`,rruser.Username FROM `rrruns` LEFT JOIN `rruserruns` on rrruns.RunID=rruserruns.RunID LEFT JOIN rruser on rruser.UserID=rruserruns.UserID ORDER BY `AddDate` DESC LIMIT '.$n;

        $pdo = new PDO($connString,$user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // create query
        $statement = $pdo->prepare($query);
        $statement->execute();

        // put query results into array
        $a = $statement->fetchAll(PDO::FETCH_ASSOC);


        //The results printed here are not static. They *WILL* be modified by 
        //js/main.js. These are just to fill the page with content when the page
        //loads!!
       foreach($a as $row) {
			$dayOfWeek = date("l",strtotime($row['Date']));
            $month = date("F",strtotime($row['Date']));
            $day = date("j",strtotime($row['Date']));
            $year = date("Y",strtotime($row['Date']));

        	$html="";
        	$html = $html.'<div class="panel panel-info" id="'.$row['RunID'].'"><div class="panel-heading"><h3 class="panel-title"><strong>'.$row['Username']."'s run on " . $dayOfWeek . ', ' . $month . ' ' . $day . ', ' . $year . '</strong></h3></div><div class="panel-body"><div class="row"><div class="col-md-6 col-lg-6"><table class="table table-user-information"><tbody><tr><td>Distance</td><td>' . $row['Distance'] . ' miles</td></tr><tr><td>Time</td><td>' . gmdate("H:i:s", $row['Time']) . '</td></tr><tr><td>Pace</td><td>' . gmdate("i:s", $row['Time']/$row['Distance']) . '</td></tr></tbody></table></div></div></div></div>';
        	echo $html;

        }

        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
        return null;
    }
}
?>