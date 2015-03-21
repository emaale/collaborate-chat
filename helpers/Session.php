<?php
/**
 * Written by: Emanuel Alenius
 * Description: Makes session handling a lot easier
 */
class Session {

	public static function get($sessionId) {
		# Gets the session asked for
		self::start();

		if(self::status($sessionId)) {
			return $_SESSION[$sessionId];
		}else {
			return "";
		}
	}

	public static function set($sessionId, $value) {
		# Sets a session with the specified sessionId, and gives it the value provided
		self::start();

		$_SESSION[$sessionId] = $value;
	}

	public static function clear($sessionId) {
		# Sets a session with the specified sessionId, and gives it the value provided
		self::start();

		unset($_SESSION[$sessionId]);
	}

	public static function status($sessionId) {
		# Returns true or false, depending on if the sessionId provided is set
		self::start();

		if(isset($_SESSION[$sessionId])) {
			return true;
		}else {
			return false;
		}
	}

	protected static function start() {
		# Checks the status of the session_start, and if it's not set, sets it
		if(session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}
}