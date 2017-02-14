<?php include("includes/header.php"); ?>

<?php 

if (empty($_GET['id'])) {
    redirect("photos.php");
} else {
    $photo = Photo::find_by_id($_GET['id']);

    /** Form submitted */
    if (isset($_POST['update'])) {
        if ($photo) {
            $photo->title = $_POST['title'];
            $photo->caption = $_POST['caption'];
            $photo->alternate_text = $_POST['alternate_text'];
            $photo->description = $_POST['description'];

            $photo->save();
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
                    <h1 class="page-header">Edit Photo</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        
            <!-- Content -->
            <form action="" method="post">
                <div class="col-md-8">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" value="<?= $photo->title ?>">
                    </div>
                    <div class="form-group">
                        <a class="" href=""><img height="200" src="<?= $photo->picture_path(); ?>"></a>
                    </div>
                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <input type="text" name="caption" class="form-control" value="<?= $photo->caption ?>">
                    </div>
                    <div class="form-group">
                        <label for="caption">Alternate Text</label>
                        <input type="text" name="alternate_text" class="form-control" value="<?= $photo->alternate_text ?>">
                    </div>
                    <div class="form-group">
                        <label for="caption">Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control"><?= $photo->description; ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="photo-info-box">
                        <div class="info-box-header">
                            <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                        </div>
                        <div class="inside">
                            <div class="box-inner">
                                <p class="text">
                                    <span class="glyphicon glyphicon-calendar"></span> Uploaded on: Feb 14, 2017 @ 5:00
                                </p>
                                <p class="text">
                                    Photo Id: <span class="data photo_id_box">34</span>
                                </p>
                                <p class="text">
                                    Filename: <span class="data">image.jpg</span>
                                </p>
                                <p class="text">
                                    File type: <span class="data">JPG</span>
                                </p>
                                <p class="text">
                                    File size: <span class="data">12345</span>
                                </p>
                            </div>
                            <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a href="delete_photo.php?id=<?= $photo->id; ?>" class="btn btn-danger">Delete</a>
                                </div>
                                <div class="info-box-update pull-right">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary">
                                </div>
                            </div> <!-- //End .info-box-footer -->
                        </div> <!-- //End .inside -->
                    </div> <!-- //End .photo-info-box -->
                </div> <!-- //End .col-md-4 -->
            </form>
        </div> <!-- //End #page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- footer/scripts -->
    <?php include("includes/footer.php") ?>

</body>

</html>
