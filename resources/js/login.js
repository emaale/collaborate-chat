$(document).ready(function() {
	
	// Click event for the login form
	$("#login-form").submit(function(e) {
		// Prevent form from firing
		e.preventDefault();

		// Make ajax request
		$.ajax({
			type: "POST",
			url: "/user/login",
			data: {"username": $('[name=\'username\']').val(), "password": $('[name=\'password\']').val()},
			success: function(response) {
                // Parse JSON
                var res = JSON.parse(response);
                
                if(!res.error) {
                    // Navigate to /
                    window.location.href = "/";
                }else {
                	// Set error message and display it
                	$(".form-wrapper span.error").html(res.error_message).css("display", "inline-block");
                }
            }
        });
	});

	// Click event for the register form
	$("#register-form").submit(function(e) {
		// Prevent form from firing
		e.preventDefault();
		
		// Make ajax request
		$.ajax({
			type: "POST",
			url: "/user/register",
			data: {"username": $('[name=\'username\']').val(), "password": $('[name=\'password\']').val(), "password_repeat": $('[name=\'password_repeat\']').val()},
			success: function(response) {
                // Parse JSON
                var res = JSON.parse(response);
                
                if(!res.error) {
                	// Navigate to /
                    window.location.href = "/";
                }else {
                	// Set error message and display it
                	$(".form-wrapper span.error").html(res.error_message).css("display", "inline-block");
                }
            }
        });
	});
});