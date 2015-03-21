<?php
/**
 * Written by: Emanuel Alenius
 * Description: Defines all routes
 */

# Available routes for authenticated users
if(Session::get("user")) {

}

# Catch-all-route
Route::get('*', function() {
	# Redirect to the login page
	return View::make("/index");
});

