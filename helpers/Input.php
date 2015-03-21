<?php
/**
 * Written by: Emanuel Alenius
 * Description: Merges the $_GET and $_POST arrays, and provides useful methods to extract it
 */
class Input {
	/**
	 * Class that handles POST and GET input
	 */
	
	public static function all() {
		# Return array with data from $_POST and $_GET
		return self::merge();
	}

	public static function get($key) {
		# Get array with data from $_POST and $_GET
		$input = self::merge();

		# Return the item if it's set
		if(isset($input[$key])) {
			return $input[$key];
		}else {
			return false;
		}
	}

	private static function merge() {
		# Merge the two arrays
		return array_merge($_POST, $_GET);
	}
}