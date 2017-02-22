<?php 

require_once("init.php");

if (isset($_POST['image_name']) && isset($_POST['user_id'])) {
	$user = User::find_by_id($_POST['user_id']);

	$user->ajax_save_user_image($_POST['image_name'], $_POST['user_id']);
}

if (isset($_POST['photo_id'])) {
	$photo = Photo::display_sidebar($_POST['photo_id']);
}

?>