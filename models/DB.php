<?php
/**
 * Written by: Emanuel Alenius
 * Description: Handles database connections
 */
class DB {
	protected $connection;
	public $query;
	protected $table;

	function __construct($table = "") {
		$this->connection = new PDO("mysql:host=" . $GLOBALS['DB_CONNECTION']['host'] . ";dbname=" . $GLOBALS['DB_CONNECTION']['db'], $GLOBALS['DB_CONNECTION']['user'], $GLOBALS['DB_CONNECTION']['pass']);	
		
		if($table != null) {
			$this->table = strtolower($table);
		}else {
			$this->table = strtolower(get_class($this));
		}
		
	}

	public function all() {
		$this->query = "SELECT * FROM " . strtolower($this->table);
		
		# Return this instance of the class, so we can chain methods
		return $this;
	}

	public function find($id) {
		# Set the query that gets data with specified id
		$this->query = "SELECT * FROM " . strtolower($this->table) . " WHERE id=" . $id;

		# Make the query
		$result = $this->connection->query($this->query) or die("Query could not be made. find()");

		# Fetch the data
		$result = $result->FetchAll();

		/*# Convert array to object, so we can use -> instead of ['']
		$result = json_decode(json_encode($result), FALSE);*/

		# Return this instance of the class, so we can chain methods
		return $result;
	}

	public function where($condition1, $operator, $condition2) {
		# Append our WHERE condition to the query
		$this->query .= " WHERE " . $condition1 . $operator . "'" . $condition2 . "'";

		# Return this instance of the class, so we can chain methods
		return $this;
	}

	public function limit($limit) {
		# Append our LIMIT to the query
		$this->query .= " LIMIT " . $limit;

		# Return this instance of the class, so we can chain methods
		return $this;
	}

	public function offset($offset) {
		# Append our OFFSET to the query
		$this->query .= " OFFSET " . $offset;

		# Return this instance of the class, so we can chain methods
		return $this;
	}

	public function sort($column, $direction) {
		# Append our ORDER BY to the query
		$this->query .= " ORDER BY " . $column . " " . $direction;

		# Return this instance of the class, so we can chain methods
		return $this;
	}

	public function get() {
		# Make the query
		$result = $this->connection->query($this->query) or die("Query could not be made. get()");

		# Fetch the data
		$result = $result->FetchAll();

		/*# Convert array to object, so we can use -> instead of ['']
		$result = json_decode(json_encode($result), FALSE);*/

		# Return the result
		return $result;
	}

	public function insert($columns, $data) {
		# Insert data into database
		$this->query = "INSERT INTO " . $this->table . " (";

		# Loop through the $columns array and concatenate to $this->query
		for($i = 0; $i < count($columns); $i++) {
			# Do this until the last one
			if($i < count($columns) - 1) {
				$this->query .= $columns[$i] . ', ';
			}else {
				$this->query .= $columns[$i] . ')';
			}
		}

		# Add some stuff inbetween
		$this->query .= " VALUES (";

		# Loop through the $data array and concatenate to $this->query
		for($i = 0; $i < count($data); $i++) {
			# Do this until the last one
			if($i < count($data) - 1) {
				$this->query .= "'" . $data[$i] . "', ";
			}else {
				$this->query .= "'" . $data[$i] . "')";
			}
		}

		# Make the query
		$result = $this->connection->query($this->query) or die("Query could not be made. insert()");

		return $result;
	}

	public function delete($column, $condition, $value) {
		# Delete row in DB
		$this->query = "DELETE FROM " . $this->table . " WHERE " . $column . " " . $condition . " " . $value;

		# Make the query
		$result = $this->connection->query($this->query) or die("Query could not be made. delete()");

		return $result;
	}

	public function update($columns, $data, $column, $condition, $value) {
		# Delete row in DB
		$this->query = "UPDATE " . $this->table . " SET ";

		# Loop through 
		for($i = 0; $i < count($columns); $i++) {
			# Do this for all but the last
			if($i < count($columns) - 1) {
				$this->query .= $columns[$i] . "='" . $data[$i] . "',";
			}else {
				$this->query .= $columns[$i] . "='" . $data[$i] . "'";
			}
			
		}

		# Add the rest
		$this->query .= " WHERE " . $column . "=" . $value;

		# Make the query
		$result = $this->connection->query($this->query) or die("Query could not be made. update()");

		return $result;
	}

	public function query($query) {
		$result = $this->connection->query($query) or die("Query could not be made. query()");

		# Fetch the data
		$result = $result->FetchAll();

		return $result;
	}
}
