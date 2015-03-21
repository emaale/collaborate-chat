<?php
/**
 * Written by: Emanuel Alenius
 * Description: Redirects to provided location
 */
class Redirect {
	/**
	 * Redirects to provided path
	 */
	public static function to($path) {
		Header("Location: " . $path);
	}
}