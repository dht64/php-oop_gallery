<?php include("includes/header.php"); ?>

<?php 

$photos = Photo::find_all();

?>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include("includes/nav.php"); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Photos</h1>
                    <p class="bg-success">
                        <?= $message; ?>
                    </p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <!-- Content -->
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Id</th>
                            <th>File Name</th>
                            <th>Title</th>
                            <th>Size</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($photos as $photo) : ?>
                        <tr>
                            <td>
                                <img height="150" src="<?= $photo->picture_path(); ?>" alt="">
                                <div class="action_links">
                                    <a href="delete_photo.php?id=<?= $photo->id ?>" class="btn btn-xs btn-danger delete-link">Delete</a>
                                    <a href="edit_photo.php?id=<?= $photo->id ?>" class="btn btn-xs btn-info">Edit</a>
                                    <a href="../photo.php?id=<?=$photo->id; ?>" class="btn btn-xs btn-success">View</a>
                                </div>
                            </td>
                            <td><?= $photo->id ?></td>
                            <td><?= $photo->filename ?></td>
                            <td><?= $photo->title ?></td>
                            <td><?= $photo->size ?></td>
                            <td>
                                <?php 
                                $comments = Comment::find_the_comments($photo->id);
                                echo "<a href='comment_photo.php?id={$photo->id}'>". count($comments). "</a>";
                                ?>
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
