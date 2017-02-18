<?php include 'includes/header.php'; ?>

<?php 

// Pagination
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 4;
$items_total_count = Photo::count_all();

// $photos = Photo::find_all();

// for chunk & grid
$count = 0;

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";

$photos = Photo::find_by_query($sql);

?>

<body>
    <?php include("includes/nav.php"); ?>

    <!-- Page Content -->
    <div class="container">     
        
        <!-- Blog Entries Column -->
        <h1 class="page-header">
            Gallery
            <small>Awesome</small>
        </h1>
       
        <?php foreach ($photos as $photo): ?>
        <?php 
        $count++;  
        if (($count % 2) == 1) {
            echo "<div class='row'>";
        }
        ?>

        <div class="col-md-6">
            <!-- Blog Post -->
            <h2>
                <a href="#"><?= $photo->title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php">Gallery</a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on January 28, 2017 at 10:00 PM</p>
            <div class="">
                <a href="photo.php?id=<?= $photo->id; ?>">
                    <img height="200" src="admin/<?= $photo->picture_path(); ?>" alt="">
                </a>
            </div>
            <p><?= $photo->description; ?></p>

        </div> <!-- /Blog Entries Column -->

        <?php 
        if (($count % 2) == 0) { echo "</div><hr>"; }
        ?>
        <?php endforeach; ?>
        <?php 
        if (($count % 2) != 0) { echo "</div><hr>"; }
        ?>
            
        <!-- Pager -->
        
        <div class="row">
            <div class="col-md-12">
                <ul class="pagination">
                    <?php 
                    if ($paginate->page_total() > 1) {
                        if ($paginate->has_next()) {
                            echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Newer &rarr;</a></li>";
                        }

                        // Number the pages
                        for ($i=1; $i <= $paginate->page_total() ; $i++) {
                            if ($i == $paginate->current_page) {
                                echo "<li class='active'><a>{$i}</a></li>";
                            } else {
                                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                            }
                        }

                        if ($paginate->has_previous()) {
                            echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>&larr; Older</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
            
            <!-- Blog Sidebar Widgets Column -->

    </div> <!-- /.container -->

    <!-- Footer -->
    <?php include_once 'includes/footer.php'; ?>

</body>

</html>
