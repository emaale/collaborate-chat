<?php
/**
 * Written by: Emanuel Alenius
 * Description: Returns a response
 */
class Response {
	/**
	 * Echoes out a response
	 */
	public static function make($response) {
		echo $response;
	}

	/**
	 * Takes an array and turns it into JSON and echoes out the response
	 */
	public static function json($array) {
		echo json_encode($array);
	}

}