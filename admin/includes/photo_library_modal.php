<?php require_once("init.php"); ?>
<?php 

$photos = Photo::find_all();

?>

<div class="modal fade" tabindex="-1" role="dialog" id="photo-library">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Gallery System Library</h4>
      </div> <!-- /.modal-header -->

      <div class="modal-body">
        <div class="row">
          <div class="col-md-9">
              <div class="thumbnails">
          
                <!-- PHP Loop -->
                <?php foreach ($photos as $photo): ?>
                  <div class="thumbnail-photo">
                      <a href="#" role="checkbox" aria-checked="false" tabindex="0" id="" class="">
                          <img class="photo-sm" width="100" src="<?= $photo->picture_path(); ?>" data="">
                      </a>
                      <div class="photo-id hidden">
                      </div>
                  </div>
                <?php endforeach; ?>

              </div>
          </div> <!-- /.col-md-9 -->
          <div class="col-md-3">
              <div id="modal_sidebar"></div>
          </div>
        </div> <!-- /.row -->
      </div> <!-- /.modal-body -->

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="set_user_image" disabled="true">Save changes</button>
      </div> <!-- /.modal-footer -->
    </div> <!-- /.modal-content -->
  </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->