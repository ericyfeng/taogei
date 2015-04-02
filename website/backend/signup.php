
<?php
	//enable php debuggin
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	//connection to database
	$dbconn = pg_connect("dbname=taogei user=ericfeng");

	//check if email and password match
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$confirm = $_POST["confirm"];

	if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($confirm)) {
		echo "0";
	}
	else if ($password != $confirm) {
		echo "1";
	}
	else {
		$verify = "select count(*) from users where email=$1;";
		pg_prepare($dbconn, "verify", $verify);
		$result = pg_execute($dbconn, "verify", array($email));
		$row = pg_fetch_row($result);
		if (!$row[0]) {
			$register = "insert into users values ($1, $2, $3, $4);";
			pg_prepare($dbconn, "signup", $register);
			pg_execute($dbconn, "signup", array($email, $fname, $lname, $password));
			$newsession = "insert into session (email) values($1);";
			pg_prepare($dbconn, "session", $newsession);
			pg_execute($dbconn, "session", array($email));
			echo "2";
			exit();
		} 
		else {   //email taken
			echo "3";
		}
	}
?>
