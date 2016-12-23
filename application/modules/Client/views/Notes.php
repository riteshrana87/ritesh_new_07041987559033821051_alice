

<?php
if (count($notes) > 0) {
    foreach ($notes as $note) {
        ?>

        <div class="row" id="<?php echo $note['_id']; ?>">
            <div class="col-lg-12 col-md-12">
                <div class="card-box widget-user">
                    <div>
                            <div  class="form-group">

                                <div class="col-md-8">
                                    <p><?php echo $note['notes'];?></p>
                                    <input type="hidden" name="noteid" id="noteid" value="<?php echo $note['_id']; ?>">
                                  
                                </div>
                                <div class="col-md-4"><a href="javascript:void(0);" onclick="deleteItem('<?php echo base_url('Client/DeleteNote/'.$note['_id']);?>');  "><i class="fa fa-trash red"></i></a></div>


                            </div>
                            <div  class="form-group text-right">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php
}?>
