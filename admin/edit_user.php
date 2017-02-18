<?php include("includes/header.php"); ?>
<?php include("includes/photo_library_modal.php"); ?>

<?php 

$message = "";
/** Form submitted */
if (empty($_GET['id'])) {
    redirect("users.php");
} else {
    $user = User::find_by_id($_GET['id']);

    $user_id = $user->id;

    if (isset($_POST['update'])) {
        if ($user) {
            $user->username = $_POST['username'];
            $user->first_name = $_POST['first_name'];
            $user->last_name = $_POST['last_name'];
            $user->password = $_POST['password'];
            if ($user->set_file($_FILES['user_image'])) {
                $user->user_image = $user->filename;
            }
            $user->save();
            if ($user->upload_photo()) {
                $message = "<div class='alert alert-success'>User was updated successfully!</div>";
            } else {
                $message = "<div class='alert alert-warning'>". join("<br>", $user->errors). "</div>";
            }
        }
    }
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
            <div class="col-md-3">
                <div class="thumbnail">
                    <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?= $user->user_image_path(); ?>"></a>
                </div>
            </div>
            <div class="col-md-9">
                <?= $message; ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="user_image">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $user->username; ?>">
                    </div>
                    <div class="form-group">
                        <a class="picture" href=""><img src=""></a>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?= $user->first_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?= $user->last_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" value="<?= $user->password; ?>">
                    </div>
                    <div class="form-group">
                        <a href="delete_user.php?id=<?= $user->id ?>" class="btn btn-danger user-id">Delete</a>
                        <input type="submit" name="update" value="Update" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div> <!-- //End #page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- footer/scripts -->
    <?php include("includes/footer.php") ?>

</body>

</html>
