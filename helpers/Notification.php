<?php
/**
 * Written by: Emanuel Alenius
 * Description: Handles notifications you might want to pass with a redirect, and useful semantic methods
 */
class Notification {
	/**
	 * Handles notifications, set and get
	 */
	
	public static function set($key, $value = true) {
		# Set a Session with the key provided, and the optional second argument
		Session::set($key, $value);
	}

	public static function get($key) {
		# Get the Session with the key provided
		$value = Session::get($key);

		# Clear the session since the notification is read
		Session::clear($key);

		return $value;
	}

	public static function error($value = false) {
		# Check if value is false
		if($value != false) {
			# Set the value
			return self::set('error', $value);
		}else {
			# Get the value
			return self::get('error');
		}
	}

	public static function success($value = false) {
		# Check if value is false
		if($value != false) {
			# Set the value
			return self::set('success', $value);
		}else {
			# Get the value
			return self::get('success');
		}
	}
}