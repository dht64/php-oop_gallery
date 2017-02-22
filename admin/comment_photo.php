<?php include("includes/header.php"); ?>

<?php 

if (empty($_GET['id'])) {
    redirect("photos.php");
}

$comments = Comment::find_the_comments($_GET['id']);

?>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include("includes/nav.php"); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Comments of the Photo</h1>
                    <p class="bg-success"><?= $message; ?></p>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- Content -->
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Body</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment) : ?>
                        <tr>
                            <td><?= $comment->id ?></td>
                            <td><?= $comment->author ?></td>
                            <td><?= $comment->body ?></td>
                            <td>
                                <div class="action_links">
                                    <a href="delete_comment_photo.php?id=<?= $comment->id ?>" class="btn btn-xs btn-danger">Delete</a>
                                </div>
                            </td>
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