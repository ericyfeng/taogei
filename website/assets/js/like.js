$(document).ready(function() {
	$("#like").click(function() {
		var values = {
			"fname": $("#fname").val(),
			"lname": $("#lname").val(),
			"email": $("#email").val(),
			"password": $("#password").val(),
			"confirm": $("#confirm").val()
		};
		$.ajax({
			url: "backend/like.php",
			type: "POST",
			data: values,
			success: function(result) {
				if (result == 0) {
					$("#errmsg").text("please fill all information");
					$("#errmsg").css("color", "red");
					$("#errmsg").css("margin-top", "10px");
				}
				if (result == 1) {
					$("#errmsg").text("passwords don't match");
					$("#errmsg").css("color", "red");
					$("#errmsg").css("margin-top", "10px");
				} 
				if (result == 2) {
					window.location.href="signin.php";
				}
				if (result == 3) {
					$("#errmsg").text("Email taken");
					$("#errmsg").css("color", "red");
					$("#errmsg").css("margin-top", "10px");
				}
			}
		});
	});


} 	);