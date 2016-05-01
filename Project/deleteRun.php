<?php
include_once("stats/runs.php");

$runid = $_GET['ID'];
$r = new UserRuns(getUserID($_COOKIE['User']));
$r->deleteRun($runid);
header("Location: myruns.php");


?>