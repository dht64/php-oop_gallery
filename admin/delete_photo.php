<?php include("includes/header.php"); ?>

<?php 

if (empty($_GET['id'])) {
	redirect("photos.php");
} else {
	$photo = Photo::find_by_id($_GET['id']);
	if ($photo) {
		$photo->delete_photo();
		redirect("photos.php");
	} else {
		redirect("photos.php");
	}
}

?>