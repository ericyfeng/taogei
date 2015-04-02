<html lang="en">
<head>
	<?php include("template/base.php"); ?>
	<title>Sign up</title>
</head>

<body>
	<?php include("template/navbar.php"); ?>
	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Registration</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Registration</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Register a new account</h3>
							<p class="text-center text-muted">Already have an account? <a href="signin.html">Login now</a></p>
							<hr>

							<form method="POST">
								<div class="top-margin">
									<label>First Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="fname" name="fname">
								</div>
								<div class="top-margin">
									<label>Last Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control" id="lname" name="lname">
								</div>
								<div class="top-margin">
									<label>Email <span class="text-danger">*</span></label>
									<input type="email" class="form-control" id="email" name="email">
								</div>

								<div class="row top-margin">
									<div class="col-sm-6">
										<label>Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" id="password" name="password">
									</div>
									<div class="col-sm-6">
										<label>Confirm Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" id="confirm" name="confirm">
									</div>
								</div>
								<div id="errmsg"></div>
								<hr>

								<div class="row">
									<div class="col-lg-8">
										<label class="checkbox">
											<input type="checkbox"> 
											I've read the <a href="#terms" data-toggle="modal">Terms and Conditions</a>
										</label>                        
									</div>
									<div class="col-lg-4 text-right">
										<button id="register" class="btn btn-action" type="button">Register</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				
			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->
	

	<div class="modal fade" id="terms" tabindex="-1" role= "dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4>Terms and Conditions</h4>
				</div>
				<div class="modal-body">
					<p> Here's some terms and conditions about using TaoGei a very very detailed paragraph and strict rules about using taogei. This will include all the stuff that the user should know about the website</p>
				</div>

			</div>
		</div>
	</div>
	
	<?php include("template/footers.php");
		  include("template/scripts.php"); ?>

	<script src="assets/js/signup.js"></script>
</body>
</html>

