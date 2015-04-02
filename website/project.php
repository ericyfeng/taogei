 <?php  include("backend/checksession.php"); ?> 
 <!DOCTYPE html>
<html lang="en">
<head>
	<?php include("template/base.php"); ?>
	<?php include("backend/detailproj.php"); ?>
	<!--<link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">-->
	<title><?php echo $title; ?></title>
</head>
<body>
	<?php include("template/loginnav.php"); 
		$_SESSION['pid'] = $pid ;?>
	<header id="head" class="secondary"></header>

	<div class="container">
		<div class="row">				
			<div class="col-md-8 col-md-offset-2 col-sm-9 col-sm-offset-2">
				<h1 class="text-center"><?php echo $title; ?></h1>
				<h4 class="text-center"><i class="fa fa-user"></i> <?php echo $fname . " " . $lname; ?></h4>
				<h4 class="text-center"><i class="fa fa-cog"></i> <?php echo $industry; ?></h4>
				<h4 class="text-center"><i class="fa fa-tag"></i> <?php echo $tag; ?></h4>
				<h4 class="text-center">
					<a href="backend/like.php">
						<i class="fa fa-thumbs-o-up"></i> Likes: <?php echo $likes ;?>
					</a>
					<a href="backend/dislike.php">
						<i class="fa fa-thumbs-o-down"></i> Unlikes: <?php echo $dislikes ;?>
					</a>
				</h4>		
				<h3>Description</h3>
				<p class="top-space"><?php echo $description; ?></p>
				<?php 
					$checkuser = "select email from session where sessionid=$1";
					pg_prepare($dbconn, "checkuser", $checkuser);
					$result = pg_execute($dbconn, "checkuser", array($sid));
					$row = pg_fetch_array($result);
					if ($row[0] == $email) {
				?>

					<div class="text-center">		
						<a class="btn btn-action" <?php echo "href='editidea.php?pid=". $_GET['pid'] ."'";?> >Edit</a>
						<a class="btn btn-danger" <?php echo "href='backend/delete.php'";?> >DELETE</a>
					</div>
		
				<?php } ?>
			</div>
		</div>  <!--/row -->			
	</div>
</body>