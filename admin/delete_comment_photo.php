<?php include("includes/header.php"); ?>

<?php 

if (empty($_GET['id'])) {
	redirect("comments.php");
} else {
	$comment = Comment::find_by_id($_GET['id']);

	if ($comment) {
		$comment->delete();
		$session->message("The comment has been deleted!");
		redirect("comment_photo.php?id={$comment->photo_id}");
	} else {
		redirect("comment_photo.php?id={$comment->photo_id}");
	}
}

?>