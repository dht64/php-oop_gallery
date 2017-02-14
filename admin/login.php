<?php include("includes/header.php") ?>

<?php 

if ($session->is_signed_in()) {
	redirect("index.php");
}

if (isset($_POST['submit'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	// Method to check database user
	$user_found = User::verify_user($username, $password);

	if ($user_found) {
		$session->login($user_found);
		redirect("index.php");
	} else {
		$the_message = "Your password or username are incorrect. Please try again!";
	}
} else {
    $the_message = "";
	$username = "";
	$password = "";
}

?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <p class="bg-danger <?= $the_message ? 'alert alert-danger' : ''; ?>"><?= $the_message; ?></p>
                        <form role="form" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" value="<?= htmlentities($username); ?>" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="<?= htmlentities($password); ?>">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>	
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" value="Submit" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include("includes/footer.php") ?>