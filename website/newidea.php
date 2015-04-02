<?php  include("backend/checksession.php"); ?> 
<html lang="en">
<head>
	<?php include("template/base.php"); ?>
	<title>New Idea</title>
</head>
<body>
	<?php include("template/loginnav.php"); ?>
	<header id="head" class="secondary"></header>

	<div class="container">
		<div class="row">	
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">New Idea</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Creating a New Pitch</h3>
							<hr>	
							<form method="POST" action="backend/createidea.php">
								<div class="top-margin">
									<label>Title</label>
									<input type="text" class="form-control" id="title" name="title">
								</div>
								<div class="top-margin">
									<label>Industry</label>
									<select class="form-control" id="industry" name="industry">
										<option value="1">Health</option>
										<option value="2">Technology</option>
										<option value="3">Education</option>
										<option value="4">Finance</option>
										<option value="5">Travel</option>
									</select>									
								</div>
								<!-- tags, implemented the same way as industries, might come back and change implementation later -->
								<div class="top-margin">
									<label>Tag</label>
									<select class="form-control" id="tag" name="tag">
										<option value="1">Social Network</option>
										<option value="2">Game</option>
										<option value="3">Vitamin</option>
										<option value="4">Drug</option>
										<option value="5">Safety</option>
									</select>									
								</div>	
								<div class="top-margin">
									<label>Description</label>
									<textarea type="text" class="form-control" id="description" name="description" rows="6"></textarea>
									<!--<textarea rows='5' class="form-control" name="description" id="description"></textarea>-->
								</div>																		
								<div id="errmsg"></div>
								<hr>
								<div class="row">
									<div class="col-lg-offset-8 col-lg-4 text-right">
										<!--<button id="login" class="btn btn-action" type="submit" onclick="rm()">Sign in</button>-->
										<input type="submit" class="btn btn-action" value="Submit">
									</div>
								</div>
							</form>

						</div>
					</div>
				</div>
				
			</article>  <!-- /Article -->
		</div>  <!--/row -->
	</div> <!-- container -->
	<?php 
		include("template/footers.php");
		include("template/scripts.php"); 
	?>
</body>