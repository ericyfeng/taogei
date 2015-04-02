<?php
	session_start();

	if (!isset($_SESSION["sid"]) && $_SESSION["sid"] = "" ) {
		$_SESSION["errmsg"] = "Plase sign in first";
		header("Location: signin.php");
		exit();
	}	

	$sid = $_SESSION["sid"];
	$dbconn = pg_connect("dbname=taogei user=ericfeng");
	$verify = "select 1 from session where sessionid=$1";
	pg_prepare($dbconn, "verify", $verify);
	$result = pg_execute($dbconn, "verify", array($sid));
	$row = pg_fetch_row($result);

	if ($row[0] != 1) {
		$_SESSION["errmsg"] = "Please sign in again";
		header("Location: signin.php");
		exit();
	}

	$expiry = "select expiration from session where sessionid=$1";
	pg_prepare($dbconn, "expiry", $expiry);
	$result = pg_execute($dbconn, "expiry", array($sid));
	$row = pg_fetch_row($result);
	$dbdate = new DateTime($row[0]);
	if($dbdate < new DateTime())
	{
		echo "Please login again";
		exit();
	}


?>