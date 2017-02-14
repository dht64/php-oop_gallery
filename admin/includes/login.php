<?php require_once("init.php") ?>

<?php 

if ($session->is_signed_in()) {
	redirect("index.php");
}

if (isset($_POST['submit'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['$password']);

	// Method to check database user
	$user_found = User::verify_user($username, $password);

	if ($user_found) {
		$session->login($user_found);
		redirect("index.php");
	} else {
		$the_message = "Your password or username are incorrect. Please try again";
	}
} else {
	$username = "";
	$password = "";
}

?>

<?php include("header") ?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="submit" class="btn btn-lg btn-success btn-block">Login</input>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer") ?>