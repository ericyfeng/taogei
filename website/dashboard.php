 <?php  include("backend/checksession.php"); ?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("template/base.php"); ?>
	<!--<link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">-->
	<title>Dashboard</title>
</head>
<body>
	<header id="head" class="secondary"></header>
	<?php include("template/loginnav.php"); ?>
	<div class="container">
		<div class="top-margin industry">
			<label>Industry</label>
			<select class="form-control" id="industry" name="industry">
				<option value="0">All Industries</option>
				<option value="1">Health</option>
				<option value="2">Technology</option>
				<option value="3">Education</option>
				<option value="4">Finance</option>
				<option value="5">Travel</option>
			</select>
		</div>
		<div class="top-margin tag">
			<label>Tag</label>
			<select class="form-control" id="tag" name="tag">
				<option value="0">All Tags</option>
				<option value="1">Social Network</option>
				<option value="2">Game</option>
				<option value="3">Vitamin</option>
				<option value="4">Drug</option>
				<option value="5">Safety</option>
			</select>									
		</div>

		<br> 
		<h1 class="text-center">All Ideas</h1>
		<?php 
			$allproject = "select * from project natural join projectindustry natural join projecttag where email!= (select email from session where sessionid=$1)";
			pg_prepare($dbconn, "allproject", $allproject);
			$result = pg_execute($dbconn, "allproject", array($sid));
			include("template/ideas.php");
		?>


	</div>

	<div class="container">
		<br>
		<h1 class="text-center">My Ideas</h1>
		<?php 
			$myproject = "select * from project natural join projectindustry natural join projecttag where email= (select email from session where sessionid=$1)";
			pg_prepare($dbconn, "myproject", $myproject);
			$result = pg_execute($dbconn, "myproject", array($sid));
			include("template/ideas.php");
		?>
	</div>

	<?php 
		include("template/footers.php");
		include("template/scripts.php"); 
	?> 
	<script src="assets/js/signin.js"></script>
	<script src="assets/js/sorttable.js"></script>
	<script src="assets/js/filter.js"></script>

</body>
</html>