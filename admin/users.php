<?php include("includes/header.php"); ?>

<?php 

$users = User::find_all();

?>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include("includes/nav.php"); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                    <p class="bg-success">
                        <?= $message; ?>
                    </p>
                    <a href="add_user.php" class="btn btn-primary">Add User</a>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- Content -->
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Photo</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td>
                                <img class="user-image" src="<?= $user->user_image_path(); ?>" alt="">
                            </td>
                            <td>
                                <?= $user->username ?>
                                <div class="action_links">
                                    <a href="delete_user.php?id=<?= $user->id ?>" class="btn btn-xs btn-danger">Delete</a>
                                    <a href="edit_user.php?id=<?= $user->id ?>" class="btn btn-xs btn-info">Edit</a>
                                </div>
                            </td>
                            <td><?= $user->first_name ?></td>
                            <td><?= $user->last_name ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- footer/scripts -->
    <?php include("includes/footer.php") ?>

</body>

</html>
