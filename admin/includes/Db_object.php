<?php 

/**
*
*/
class Db_object
{
	protected static $db_table;
	
	public $id;
	public $filename;
	public $tmp_path;
	public $type;
	public $size;
	public $upload_directory = "uploads";
	public $errors = array();
	public $upload_errors_array = array(
		UPLOAD_ERR_OK			=> "There is no error.",
		UPLOAD_ERR_INI_SIZE 	=> "The uploaded file exceeds the upload_max_file_size directive.",
		UPLOAD_ERR_FORM_SIZE	=> "The uploaded file exceeds the MAX_FILE_SIZE directive.",
		UPLOAD_ERR_PARTIAL		=> "The uploaded file was only partially uploaded.",
		UPLOAD_ERR_NO_FILE		=> "No file was uploaded.",
		UPLOAD_ERR_NO_TMP_DIR	=> "Missing a temporary folder.",
		UPLOAD_ERR_CANT_WRITE	=> "Failed to write file to disk.",
		UPLOAD_ERR_EXTENSION	=> "A PHP extension stopped the file upload"
	);

	public static function find_all()
	{
		return static::find_by_query("SELECT * FROM ". static::$db_table);
		/*
		global $database;
		$result_set = $database->query("SELECT * FROM users");
		return $result_set;
		*/
	}

	public static function find_by_id($id)
	{
		$the_result_array = static::find_by_query("SELECT * FROM ". static::$db_table ." WHERE id = $id LIMIT 1");

		return !empty($the_result_array) ? array_shift($the_result_array) : false;

		// return static::find_by_query("SELECT * FROM users WHERE id = $id LIMIT 1")->fetch_object();
	}

	public static function find_by_query($sql)
	{
		global $database;

		$result_set = $database->query($sql);

		$the_object_array = array();
		while ($row = mysqli_fetch_assoc($result_set)) {
			$the_object_array[] = static::instantiation($row);
		}

		return $the_object_array;
	}

	/**
	*	Return Object from Array result
	*/
	public static function instantiation($the_record)
	{	
		$calling_class = get_called_class(); // late static binding

		$the_object = new $calling_class;
		// $the_object->id = $found_user['id']; 

		foreach ($the_record as $the_attribute => $value) {
			if ($the_object->has_the_attribute($the_attribute)) {
				$the_object->$the_attribute = $value;
			} 	
		} 
	
		return $the_object;
	}

	private function has_the_attribute($the_attribute)
	{
		$object_properties = get_object_vars($this);
		return array_key_exists($the_attribute, $object_properties);
	}

	protected function properties()
	{
		/** 
		*	If not using $db_table_fields 
		*/
		// return get_object_vars($this);

		$properties = array();

		foreach (static::$db_table_fields as $db_field) {
			if (property_exists($this, $db_field)) {
				$properties[$db_field] = $this->$db_field;
			}
		}

		return $properties;
	}

	protected function clean_properties()
	{
		global $database;

		$clean_properties = array();

		foreach ($this->properties() as $key => $value) {
			$clean_properties[$key] = $database->escape_string($value);
		}

		return $clean_properties;
	}

	public function save()
	{
		return isset($this->id) ? $this->update() : $this->create();
	}

	public function create()
	{
		global $database;

		$properties = $this->clean_properties();

		$sql = "INSERT INTO ". static::$db_table ." (". implode(',', array_keys($properties)) .")
				VALUES ('". implode("','", array_values($properties)) . "')";

		if ($database->query($sql)) {
			$this->id = $database->the_insert_id();
			return true;
		} else {
			return false;
		}
		
	}

	public function update()
	{
		global $database;
		
		$properties = $this->clean_properties();
		$properties_pairs = array();

		foreach ($properties as $key => $value) {
			$properties_pairs[] = "{$key}='{$value}'";
		}

		$sql = "UPDATE ". static::$db_table ." SET ";
		$sql .= implode(",", $properties_pairs);
		$sql .=	" WHERE id = {$database->escape_string($this->id)}";

		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}

	public function delete()
	{
		global $database;

		$sql = "DELETE FROM ". static::$db_table ." 
				WHERE id = {$database->escape_string($this->id)}
				LIMIT 1";

		$database->query($sql);

		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
	}

	public static function count_all()
	{
		global $database;

		$sql = "SELECT COUNT(*) FROM ". static::$db_table;
		$result_set = $database->query($sql);
		$row = mysqli_fetch_assoc($result_set);

		return array_shift($row);
	}

	public function set_file($file)
	{
		if (empty($file) || !$file || !is_array($file)) {
			$this->errors[] = "There was no file uploaded here";
			return false;
		} elseif ($file['error'] != 0) {
			$this->errors[] = $this->upload_errors_array[$file['error']];
			return false;
		} else {
			$this->filename = basename($file['name']);
			$this->tmp_path = $file['tmp_name'];
			$this->type = $file['type'];
			$this->size = $file['size'];
			return true;
		}
	}

	public function upload_photo()
	{
		if (!empty($this->errors)) {
			return false;
		} elseif (empty($this->filename) || empty($this->tmp_path)) {
			$this->errors[] = "the file was not available";
			return false;
		} else {
			$target_path = SITE_ROOT .'/admin/uploads/'. $this->filename; 
	
			if (file_exists($target_path)) {
				$this->errors[] = "The file {$this->filename} already exists";
				return false;
			}
			if (move_uploaded_file($this->tmp_path, $target_path)) {
				unset($this->tmp_path);
				unset($this->filename);
				return true; // The upload is successful!
				} else {
					$this->errors[] = "The file directory probably does not have permission";
					return false;
				}
		}
	}
}

?>