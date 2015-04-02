<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include("template/base.php"); ?>
		<title>Sign in</title>
	</head>
	<body>
		<?php include("template/navbar.php"); ?>

		<header id="head" class="secondary"></header>

		<!-- container -->
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li class="active">Sign In</li>
			</ol>

			<div class="row">	
				<!-- Article main content -->
				<article class="col-xs-12 maincontent">
					<header class="page-header">
						<h1 class="page-title">Sign in</h1>
					</header>
					
					<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
						<div class="panel panel-default">
							<div class="panel-body">
								<h3 class="thin text-center">Sign in to your account</h3>
								<p class="text-center text-muted">Don't have an account? <a href="signup.php">Register now</a></p>
								<hr>
								
								<form method="POST" action="backend/signin.php">
									<div class="top-margin">
										<label>Email <span class="text-danger">*</span></label>
										<input type="text" class="form-control" id="email" name="email">
									</div>
									<div class="top-margin">
										<label>Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" id="password" name="password" >
									</div>
									<div id="errmsg"></div>
									<hr>

									<div class="row">
										<div class="col-lg-8">
											<b><a href="">Forgot password?</a></b>
										</div>
										<div class="col-lg-4 text-right">
											<!--<button id="login" class="btn btn-action" type="submit" onclick="rm()">Sign in</button>-->
											<input type="submit" class="btn btn-action" value="Sign in">
										</div>
									</div>
								</form>

							</div>
						</div>
					</div>
					
				</article>  <!-- /Article -->
			</div>  <!--/row -->
		</div>	<!-- /container -->
		
		<?php include("template/footers.php");
		      include("template/scripts.php"); ?>
	<!--	<script src="assets/js/signin.js"></script> -->
		<script>
/*
			function rm()
			{
				var ajax = new XMLHttpRequest();
				ajax.onreadystatechange = function ()
				{
					document.getElementById("errmsg").innerHTML=ajax.responseText;
				}
				ajax.open("POST", "login.php", true);
				ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				ajax.send("email="+document.getElementById("email").value + "&password=" + document.getElementById("password").value);

			}
*/
		</script>
	</body>
</html>

<?php
	if (isset($_SESSION["errmsg"])) {
		echo "alert(\"please log in first\")";
	}
?>