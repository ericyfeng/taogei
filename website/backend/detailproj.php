<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	$pid = $_GET["pid"];

	$project = "select * from project natural join users natural join projecttag natural join projectindustry where projid=$1";
	pg_prepare($dbconn, "project", $project);
	$result = pg_execute($dbconn, "project", array($pid));
	$row = pg_fetch_array($result);
	$title = $row['title'];
	$fname = $row['fname'];
	$lname = $row['lname'];
	$iid = $row['iid'];
	$tagid = $row['tagid'];
	$description = $row['description'];	
	$email = $row['email'];

	$likecount = "select count(*) from vote where projid=$1 and rating=1 group by projid";
	pg_prepare($dbconn, "like", $likecount);
	$result = pg_execute($dbconn, "like", array($pid));
	$row = pg_fetch_row($result);
	$likes = $row[0];

	$votes = "select count(*) from vote where projid=$1 and rating=-1 group by projid";
	pg_prepare($dbconn, "dislike", $votes);
	$result = pg_execute($dbconn, "dislike", array($pid));
	$row = pg_fetch_row($result);
	$dislikes = $row[0];	


	$tagname = "select description from tag where tagid=$1";
	pg_prepare($dbconn, "tagname", $tagname);
	$result = pg_execute($dbconn, "tagname", array($tagid));
	$row = pg_fetch_row($result);
	$tag = $row[0];


	$indname = "select description from industry where iid=$1";
	pg_prepare($dbconn, "indname", $indname);
	$result = pg_execute($dbconn, "indname", array($iid));
	$row = pg_fetch_row($result);
	$industry = $row[0];



?>	