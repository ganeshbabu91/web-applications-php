<div id="artworkImgModal" class="modal fade img-modal-lg" tabindex="-1" role="dialog" aria-labelledby="imageLargeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title"><?php echo $artwork['Title']." by ".$artwork['FirstName']." ".$artwork['LastName']."<h4>"; ?>
        </div>
        <div class="modal-body">
            <?php echo "<img data-toggle='modal' data-target='.img-modal-lg' src='/project3_thavasimuthu/images/art/works/medium/".$artwork['ImageFileName'].".jpg' width='500' height='500' class='img-responsive' alt='Art Work Image'>"; ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>



