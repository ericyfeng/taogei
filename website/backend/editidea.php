<?php
	session_start();
	//enable php debuggin
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	//connection to database
	$dbconn = pg_connect("dbname=taogei user=ericfeng");
	$title = $_POST["title"];
	$description = $_POST["description"];
	$industryid = $_POST["industry"];
	$tagid = $_POST["tag"];
	$projid = $_SESSION['pid'];

	$edit = "update project set title=$1, description=$2 where projid=$3";
	pg_prepare($dbconn, "edit", $edit);
	pg_execute($dbconn, "edit", array($title, $description, $projid));
	
	$tag = "update projecttag set tagid=$1 where projid=$2";
	pg_prepare($dbconn, "tag", $tag);
	pg_execute($dbconn, "tag", array($tagid, $projid));

	$industry = "update projectindustry set iid=$1 where projid=$2";
	pg_prepare($dbconn, "industry", $industry);
	pg_execute($dbconn, "industry", array($industryid, $projid));

	header("Location: ../dashboard.php");


?> 