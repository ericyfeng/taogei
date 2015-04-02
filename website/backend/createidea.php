<?php
	session_start();
	//enable php debuggin
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	//connection to database
	$dbconn = pg_connect("dbname=taogei user=ericfeng");
	$sid= $_SESSION["sid"];	
	$title = $_POST["title"];
	$description = $_POST["description"];
	$industryid = $_POST["industry"];
	$tagid = $_POST["tag"];

	$idea = "insert into project (projid, email, title, description, likes, dislikes, submitdate) values(default, (select email from session where sessionid=$1), $2, $3, 0, 0, $4) returning projid";
	pg_prepare($dbconn, "idea", $idea);
	$result = pg_execute($dbconn, "idea", array($sid, $title, $description, date("Y-m-d")));
	$row = pg_fetch_array($result);	
	$projid = $row[0];
	
	$tag = "insert into projecttag (tagid, projid) values($1, $2)";
	pg_prepare($dbconn, "tag", $tag);
	pg_execute($dbconn, "tag", array($tagid, $projid));

	$industry = "insert into projectindustry (iid, projid) values($1, $2)";
	pg_prepare($dbconn, "industry", $industry);
	pg_execute($dbconn, "industry", array($industryid, $projid));

	$vote = "insert into vote (vid, projid, email, rating) values(default, $1, (select email from session where sessionid=$2), 1)";
	pg_prepare($dbconn, "vote", $vote);
	pg_execute($dbconn, "vote", array($projid, $sid));

	header("Location: ../dashboard.php");


?> 