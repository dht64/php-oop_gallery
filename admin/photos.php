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
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($photos as $photo) : ?>
                        <tr>
                            <td>
                                <img height="200" src="<?= $photo->picture_path(); ?>" alt="">
                                <div class="pictures_link">
                                    <a href="delete_photo.php/?id=<?= $photo->photo_id; ?>">Delete</a>
                                    <a href="#">Edit</a>
                                    <a href="#">View</a>
                                </div>
                            </td>
                            <td><?= $photo->photo_id ?></td>
                            <td><?= $photo->filename ?></td>
                            <td><?= $photo->title ?></td>
                            <td><?= $photo->size ?></td>
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
