<?php	
	//enable php debuggin
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include("checksession.php");
	$pid = $_SESSION["pid"];

	$project = "select email from project where projid=$1";
	pg_prepare($dbconn, "project", $project);
	$result = pg_execute($dbconn, "project", array($pid));
	$row = pg_fetch_array($result);
	$email = $row[0];


	$checkuser = "select email from session where sessionid=$1";
	pg_prepare($dbconn, "checkuser", $checkuser);
	$result = pg_execute($dbconn, "checkuser", array($sid));
	$row = pg_fetch_array($result);
	echo $row[0];
	if ($row[0] == $email) {	
		$delete = "delete from project where projid=$1";
		pg_prepare($dbconn, "delete", $delete);
		pg_execute($dbconn, "delete", array($pid));

		header("Location: ../dashboard.php");
	}
	else {
		header("Location: ../dashboard.php");
	}
?>