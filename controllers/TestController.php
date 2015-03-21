<?php
/**
 * Written by: Emanuel Alenius
 * Description: Example of a controller that catches routes
 */
class TestController {
	
	public function out($age) {
		echo "TestController->out - Age: " . $age;
	}	
}