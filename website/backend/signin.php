<?php
	session_start();
	//enable php debugging
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	//database connection variable
	$dbconn = pg_connect("dbname=taogei user=ericfeng");

	//check if email and password match
	$email = $_POST["email"];
	$passwd = $_POST["password"];
	$verify = "select count(*) from users where email=$1 and password=$2;";
	pg_prepare($dbconn, "preparelogin", $verify);
	$result = pg_execute($dbconn, "preparelogin", array($email, $passwd));
	$row = pg_fetch_row($result);
	if($row[0] == 1)
	{
/*		
		//set secure database session information to prevent faking in "GET/POST" information
			$sessionid="select round(random()*10^9), (current_timestamp + '4 hours')";
			pg_prepare($dbconn, "sessionid", $sessionid);
			$result = pg_execute($dbconn, "sessionid", array());
			$row = pg_fetch_row($result);
			$rand = $row[0];
			$exp = $row[1];
			$setdb = "update session set sessionid='" . $rand . "' , expiration='" . $exp . "' where email='" . $email . "';";

			pg_prepare($dbconn, "setdb", $setdb);

			pg_execute($dbconn, "setdb", array());
*/

/* dnaiel's approach to generating time
		$sessionid="select (current_timestamp + '2 hours')";
		pg_prepare($dbconn, "sessionid", $sessionid);
		$result = pg_execute($dbconn, "sessionid", array());
		$row = pg_fetch_row($result);
*/

		$sid =  uniqid();
		$setdb = "update session set sessionid=$1, expiration=(current_timestamp + '2 hours') where email=$2";
		pg_prepare($dbconn, "setdb", $setdb);


		pg_execute($dbconn, "setdb", array($sid, $email));

		
		//get first name and last name for php session information to prevent constantly dialing into database
		$getname = "select fname, lname from users where email=$1;";



		pg_prepare($dbconn, "getname", $getname);
		$result = pg_execute($dbconn, "getname", array($email));
		$row = pg_fetch_row($result);

		//set session variables that are reused on almost every webpage
		$_SESSION["fname"] = $row[0];
		$_SESSION["lname"] = $row[1];
		$_SESSION["email"] = $email;
		$_SESSION["sid"] = $sid;
		header("Location: ../dashboard.php");
		//echo "2";
		exit();
	}

	else
	{
		echo "invalid";
	}
?>