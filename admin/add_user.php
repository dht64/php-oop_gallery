<?php include("includes/header.php"); ?>

<?php 

$user = new User();

/** Form submitted */
if (isset($_POST['create'])) {
    if ($user) {
        $user->username = $_POST['username'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->password = $_POST['password'];
        
        $user->set_file($_FILES['user_image']);
        $user->user_image = $user->filename;
        $user->upload_photo();
        $session->message("The user {$user->username} has been added");
        $user->create();
        
        redirect("users.php");
    }

    // if ($user) {
    //     $user->title = $_POST['title'];
    //     $user->caption = $_POST['caption'];
    //     $user->alternate_text = $_POST['alternate_text'];
    //     $user->description = $_POST['description'];

    //     $user->save();
    // }
}

?>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include("includes/nav.php"); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
            <!-- Content -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <input type="file" name="user_image">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <a class="picture" href=""><img src=""></a>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="create" value="Submit" class="btn btn-primary pull-right">
                    </div>
                </div>
            </form>
        </div> <!-- //End #page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- footer/scripts -->
    <?php include("includes/footer.php") ?>

</body>

</html>
