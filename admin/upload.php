<?php include("includes/header.php"); ?>

<?php 

$message = "";
if (isset($_FILES['file'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file']);
    $photo->create();
    if ($photo->upload_photo()) {
        $message = "<div class='alert alert-success'>User was updated successfully!</div>";
    } else {
        $message = "<div class='alert alert-warning'>". join("<br>", $photo->errors). "</div>";
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
                    <h1 class="page-header">Upload</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- Content -->
            <div class="row">
                <div class="col-md-6">
                    <?= $message; ?>
                    <form method="POST" action="upload.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="file" name="file">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div> <!-- /.row -->
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <form action="upload.php" class="dropzone">
                        
                    </form>
                </div>
            </div>
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- footer/scripts -->
    <?php include("includes/footer.php") ?>

</body>

</html>
