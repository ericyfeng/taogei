<?php
	$projid = $_GET["pid"];
	$_SESSION['pid'] = $projid;
	$project = "select * from project natural join users natural join projecttag natural join projectindustry where projid=$1";
	pg_prepare($dbconn, "project", $project);
	$result = pg_execute($dbconn, "project", array($projid));
	$row = pg_fetch_array($result);
	$title = $row['title'];
	$iid = $row['iid'];
	$tagid = $row['tagid'];
	$description = $row['description'];	
	$email = $row['email'];

?>
