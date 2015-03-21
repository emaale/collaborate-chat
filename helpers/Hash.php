<?php
/**
 * Written by: Emanuel Alenius
 * Description: Hashes and unhashes strings
 */
class Hash {
	/**
	 * Hashes and unhashes passwords
	 */
	public static function make($input) {
		return password_hash($input, PASSWORD_DEFAULT);
	}
	public static function check($unhashed, $hashed) {
		return password_verify($unhashed, $hashed);
	}
}