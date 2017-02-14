<?php

class Database {

	public $connection;

	function __construct() {
		$this->open_db_connection();
	}

	public function open_db_connection() {

		// $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		$this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		/*if (mysqli_connect_errno()) {
			die("Database connection failed! " . mysqli_error());
		}*/

		if ($this->connection->connect_errno) {
			die("Database connection failed! " . $this->connection->connect_error);
		}

	}

	public function query($sql)
	{
		// $result = mysqli_query($this->connection, $sql);
		$result = $this->connection->query($sql);

		if (!$result) {
			die("Query failed!");
		}

		return $result;
	}

	private function confirm_query($result)
	{
		if (!$result) {
			die("Query failed!");
		}
	}

	public function escape_string($string)
	{
		$escaped_string = mysqli_real_escape_string($this->connection, $string);

		return $escaped_string;
	}

	public function the_insert_id()
	{
		return mysqli_insert_id($this->connection);
	}

}

$database = new Database();

?>