<?php
/**
 * Written by: Emanuel Alenius
 * Description: Templating engine to make the markup more semantic and readable
 */
class View {

	/** 
	 * TODO:
	 * - AJAX mode, that hinders importing files, and only fetches the main page
	 */

	public static function make($path, $data = null) {
		# Extract data from $data array, so we can use the keys as variables
		if($data !== null) extract($data);

		# Call renderHTML, which renders and gives us the path to the temporary file
		$tempPath = self::render('views/' . $path . '.php');

		# Include the temporary file
		include $tempPath;
		
		# Delete the temporary file we set, uncomment this to debug
		unlink($tempPath);
	}

	public static function render($templateURL) {
		$sections = array();

		# Load in the file
		$input = file_get_contents($templateURL);

		# Replace all @extend with the contents of that file
		$input = preg_replace_callback('|@extend\(\'(.*?)\'\)|', function($matches) {
			return $tempFile = file_get_contents('views/' . $matches[1] . '.php');
		}, $input);

		# Search the file for @section('') and get the content until @stop
		$input = preg_replace_callback('|@section\(\'(.*?)\'\)(.*?)@stop|s', function($matches) use (&$sections) {
			# Push the value to the array with the sections name as a key, append if already set
			if(isset($sections[$matches[1]])) {
				$sections[$matches[1]] .= $matches[2];
			}else {
				$sections[$matches[1]] = $matches[2];
			}

			return "";
		}, $input);

		# Replace all @yield with the contents of the corresponding @section (if exists)
		$input = preg_replace_callback('|@yield\(\'(.*)\'\)|', function($matches) use ($sections) {
			# Check through the array of sections for the correct key, and if it's set, return the value
			if(isset($sections[$matches[1]])) {
				return $sections[$matches[1]];
			}
		}, $input);

		# Define what we want to replace in the template
		$needles = array(
			'/{{/', 
			'/}}/',
			'/@import\(\'(.*)\'\)\s*[\n\r]/', // @import('foo/bar') - Single Quotation Marks
			'/@import\(\"(.*)\"\)\s*[\n\r]/', // @import("foo/bar") - Double Quotation Marks
			'/@import\(\'([^,\)]*)\',\s*(.*)?\)\s*[\n\r]/', // @import('foo/bar', array()) - Single Quotation Marks
			'/@import\(\"([^,\)]*)\",\s*(.*)?\)\s*[\n\r]/', // @import("foo/bar", array()) - Double Quotation Marks
			'/\)\s*(\n|\r)/', // Replace all right parenthesis and potential whitespace as well as any form of line break, tags that don't need this should be replaced before
			'/@(foreach|for|if)/', // Start tags
			'/@elseif/',
			'/@else/',
			'/@end(foreach|for|if)/', // End tags
		);

		# Define what we want to replace it with
		$replacements = array(
			'<?php echo ', 
			' ?>',
			'<?php $temp = "$1"; $tempPath = self::render("views/" . $temp . ".php"); include($tempPath); ?>',
			'<?php $temp = \'$1\'; $tempPath = self::render("views/" . $temp . ".php"); include($tempPath); ?>',
			'<?php $temp = "$2"; $temp2 = "$1"; if($temp != null) { extract($2); } if(substr($temp2, -1) == "\'" || substr($temp2, -1) == "\"") {$temp2 = substr($temp2, 0, -1);} $tempPath = self::render("views/" . $temp2 . ".php"); include($tempPath); ?>', // Extract the array that we target, include the path that we used
			'<?php $temp = \'$2\'; $temp2 = \'$1\'; if($temp != null) { extract($2); } if(substr($temp2, -1) == "\'" || substr($temp2, -1) == "\"") {$temp2 = substr($temp2, 0, -1);} $tempPath = self::render("views/" . $temp2 . ".php"); include($tempPath); ?>',
			') { ?>',
			'<?php $1',
			'<?php }elseif',
			'<?php }else { ?>',
			'<?php } ?>',
		); 

		# Make changes to the input, with our definitions
		$output = preg_replace($needles, $replacements, $input);
		
		# Write changes to a temporary file
		file_put_contents('views/temp.txt', $output) or print_r(error_get_last());;

		# Return the path to the temporary file
		return 'views/temp.txt';
	}
}

/**
 * For the @section part, maybe we can use @extend and instead add the text from the source, instead of just including it. We will then
 * search for @yield and use a replace function with a callback, where we can do a search and replace for that specific section,
 * which we then remove, and instead insert where @yield would be 
 *
 * We will have to do two of these, one for @extend and another for @yield (which will be replaced with the content in @section, with 
 * the same name)
 * 
 * We want to do this before we do the rest of the search and replace
 */