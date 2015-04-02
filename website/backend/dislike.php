<?php	
	//enable php debuggin
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include("checksession.php");
	$pid = $_SESSION["pid"];


	$currentuser = "select email from session where sessionid = $1";
	pg_prepare($dbconn, "email", $currentuser);
	$result = pg_execute($dbconn, "email", array($sid));
	$row = pg_fetch_row($result);
	$useremail = $row[0];

	$voted = "select 1 from vote where email=$1 and projid=$2";
	pg_prepare($dbconn, "voted", $voted);
	$result = pg_execute($dbconn, "voted", array($useremail, $pid));
	$row = pg_fetch_array($result);
	if ($row[0] != 1){ 
		$vote = "insert into vote (projid, email, rating) values($1, $2, $3)";
		pg_prepare($dbconn, "vote", $vote);
		pg_execute($dbconn, "vote", array($pid, $useremail, -1));
	}

	header("Location: ../project.php?pid=". $pid);

?>