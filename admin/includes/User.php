<?php 

class User extends Db_object {
	
	protected static $db_table = "users";
	protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $user_image;
	public $image_placeholder = "http://placehold.it/200x200&text=image";

	public function user_image_path()
	{
		return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory. '/' .$this->user_image;
	}

	public static function verify_user($username, $password)
	{
		global $database;

		$username = $database->escape_string($username);
		$password = $database->escape_string($password);

		$sql = "SELECT * FROM users 
				WHERE username = '{$username}'
				AND password = '{$password}' LIMIT 1";

		$the_result_array = self::find_by_query($sql);

		return !(empty($the_result_array)) ? array_shift($the_result_array) : false;
	}

	public function ajax_save_user_image($user_image, $user_id)
	{
		global $database;

		$this->user_image = $database->escape_string($user_image);
		$this->id = $database->escape_string($user_id);

		$this->save();
		echo $this->user_image_path();
	}

	public function delete_user() 
	{
		if ($this->delete()) {
			$target_path = SITE_ROOT .'/admin/uploads/'. $this->user_image;

			return unlink($target_path) ? true : false;
		} else {
			return false;
		}
	}

} // End of User class

?>