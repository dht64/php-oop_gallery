<?php include("includes/header.php"); ?>

<?php 

if (empty($_GET['id'])) {
	redirect("comments.php");
} else {
	$comment = Comment::find_by_id($_GET['id']);

	if ($comment) {
		$comment->delete();
		redirect("comments.php");
	} else {
		redirect("comments.php");
	}
}

?>