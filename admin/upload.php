<?php include("includes/header.php"); ?>

<?php 

$message = "";
if (isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file_upload']);

    if ($photo->save()) {
        $message = "Photo was uploaded successfully!";
    } else {
        $message = join("<br>", $photo->errors);
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
            <div class="col-md-6">
                <?php echo $message; ?>
                <form method="POST" action="upload.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="file" name="file_upload">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- footer/scripts -->
    <?php include("includes/footer.php") ?>

</body>

</html>
