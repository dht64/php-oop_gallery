<?php include("includes/header.php"); ?>

<?php 

if (empty($_GET['id'])) {
	redirect("users.php");
} else {
	$user = User::find_by_id($_GET['id']);

	if ($user) {
		$user->delete_user();
		$session->message("The user {$user->username} has been deleted");
		redirect("users.php");
	} else {
		redirect("users.php");
	}
}

?>