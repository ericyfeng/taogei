$(document).ready(function() {
	$("#login").click(function() {
		var values = {
			"email": $("#email").val(),
			"password": $("#password").val()
		};
		$.ajax({
			url: "login.php",
			type: "POST",
			data: values,
			success: function(result) {
				console.log(result);
				if (result == 1) {
					$("#errmsg").text("password don't match");
					$("#errmsg").css("color", "red");
					$("#errmsg").css("margin-top", "10px");
				} 
				if (result == 2) {
					window.location.href="index.php";
				}
				if (result == 3) {
					$("#errmsg").text("retry");
					$("#errmsg").css("color", "red");
					$("#errmsg").css("margin-top", "10px");
				}
			}
		});
	}); 
} 	);