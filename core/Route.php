<?php 
/**
 * Written by: Emanuel Alenius
 * Description: Handles all routing
 */
class Route {
	# Array with all the routes, that have been set
	public static $routes = array();

	# Fetches the correct route
	public static function fetch() {
		# Get the URI
		$URI = $_SERVER['REQUEST_URI'];

		# Strip the slashes from the beginning and the end, then explode it into an array
		$URI = self::stripURI($URI);

		# Compare $URI to all set routes, if a match, it will execute the callback
		self::match($URI);
    }

    # Adds a GET route to the $routes property
    public static function get($route, $callback) {
    	# Push into array, and add the route, callback, method and the parts that the route is split into
        array_push(self::$routes, array('route' => $route, 'callback' => $callback, 'method' => 'GET', 'parts' => self::stripURI($route)));
    }

    # Adds a POST route to the $routes property
    public static function post($route, $callback) {
        # Push into array, and add the route, callback, method and the parts that the route is split into
        array_push(self::$routes, array('route' => $route, 'callback' => $callback, 'method' => 'POST', 'parts' => self::stripURI($route)));
    }

    # Checks if route matches the routes in the array
    public static function match($URI) {
    	# Check if the last part of the $URI is get data, if so remove that part, since we can reach the get data by using $_GET[''] anyway
    	if(strpos($URI[count($URI) - 1], '?') !== false && strpos($URI[count($URI) - 1], '?') === 0) {
    		# Remove this part from the array
    		array_splice($URI, count($URI) - 1);
    	}else if(strpos($URI[count($URI) - 1], '?') !== false && strpos($URI[count($URI) - 1], '?') > 0) {
            # Rewrite the last value in the array, so that the get data is removed, and we are left with the actual URI part
            $URI[count($URI) - 1] = substr($URI[count($URI) - 1], 0, strpos($URI[count($URI) - 1], '?') - strlen($URI[count($URI) - 1]));
        }
    	
    	foreach(self::$routes as $route) {
    		# Check if the length is the same, which should mean they could be correct, also allow for asterix route, route => '*'
    		if(count($route['parts']) == count($URI) || $route['parts'][0] == "*") {
    			$match = null; $data = array();

    			# Loop through the $route and $URI and compare the parts
    			for($i = 0; $i < count($URI); $i++) {
    				# First check for a static match, then check for a dynamic match
    				if($URI[$i] == $route['parts'][$i]) {
    					# Set $match to true
    					$match = true;
    				}else if(substr($route['parts'][$i], -1) == "}" && substr($route['parts'][$i], 0, !strlen($route['parts'][$i]) + 1) == "{") {
    					# Push the data to the $data array
    					array_push($data, $URI[$i]);

    					# Set $match to true
    					$match = true;
    				}else {
    					# Set $match to false
    					$match = false;

    					# Exit out of the loop
    					$i = count($URI);
    				}
    			}

    			# Check if it's an asterix route, that targets any route
    			if($route['parts'][0] == "*") {
    				# Set $match to true
    				$match = true;
    			}

    			# Check $match, and make sure the request is of the right method
    			if($match === true && $_SERVER['REQUEST_METHOD'] === $route['method']) {
                    # If the callback is an object, that means it's an anonymous function, otherwise it's a defined class and method
                    if(is_object($route['callback']) === false) {
                        # Get the class name from the callback string
                        $className = substr($route['callback'], 0, strlen($route['callback']) - (strlen($route['callback']) - strpos($route['callback'], '->')));

                        # Instantiate the class, and give $object the instance
                        $object = new $className;

                        # Get the method we want to call
                        $method = substr($route['callback'], strpos($route['callback'], '->') + 2);

                        # Create a ReflectionMethod class, that allows us to pass in the class object, and the method
                        $reflection = new ReflectionMethod($object, $method);

                        # Return with the $data arguments
                        return $reflection->invokeArgs($object, $data);
                    }else {
                        # Execute the callback of the route
                        return call_user_func_array($route['callback'], $data);
                    }
    				
    			}
    		}
    	}
    }

    # Strip slashes from the beginning and the end, if they are there
    public static function stripURI($URI) {
    	# Strip slash from end
        if(substr($URI, -1) == "/") { 
			$URI = substr($URI, 0, -1);
		}

		# Strip slash from beginning
		if(substr($URI, 0, !strlen($URI) + 1) == "/") { 
			$URI = substr($URI, 1);
		}

		# Divide the string into an array in parts, with specified divider
		$URI = explode('/', $URI);
		
        return $URI;
    }
}

/**
 * TODO: We could add an "any" method that targets any HTTP verb, and to do this we would add an OR at the if-statement
 * at line 78, which would check if the specified method is of ANY. We would set the routes http method to any in the
 * "any" method mentioned above.
 */