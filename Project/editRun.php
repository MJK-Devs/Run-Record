<?php
echo $_GET["ID"];
if(isset($_GET["ID"])){
	header("Location: myruns.php#" . $_GET["ID"] . "");	
}
else {
	//header("Location: myruns.php");
}
?>