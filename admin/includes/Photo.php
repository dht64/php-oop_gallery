<?php 

class Photo extends Db_object {

	protected static $db_table = "photos";
	protected static $db_table_fields = array('id', 'title', 'caption', 'description', 'filename', 'alternate_text', 'type', 'size');
	public $title;
	public $caption;
	public $description;
	public $alternate_text;

	public function picture_path()
	{
		return $this->upload_directory. '/' .$this->filename;
	}

	public function delete_photo()
	{
		if ($this->delete()) {
			$target_path = SITE_ROOT .'/admin/'. $this->picture_path();

			return unlink($target_path) ? true : false;
		} else {
			return false;
		}
	}

}

?>