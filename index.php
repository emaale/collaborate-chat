<?php
/**
 * Written by: Emanuel Alenius
 * Description: Bootstraps the whole page, and loads in the routes, creates autoloader for the directories and executes the route
 */
	# Require the CONFIG file, which sets all the neccessary constants and globals
	require('config.php');

	# Require the composer autoloader - We need to add directories to the composer.json for them to be autoloaded - Use classmap
	require 'vendor/autoload.php'; 

	# Require the Eloquent database file
	require('database.php');

	# Require the ROUTES.PHP file, which sets the routes
	require('routes.php');
	
	# Check if current route is defined in ROUTES.PHP, if so, execute whatever is set to that route
	Route::fetch();
?>