<script>
    var view_name = 'Edit';
</script>
<div class="container">
    <?php if ($this->session->flashdata('error')) {
        ?>
        <?php echo $this->session->flashdata('error'); ?>
    <?php } ?>
    <?php if ($this->session->flashdata('message')) {
        ?>
        <?php echo $this->session->flashdata('message'); ?>
    <?php } ?>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="add_client_header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></div>
            <div class="card-box form_field">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-horizontal" role="form" id="CategoryForm" name="CategoryForm" method="post" action="<?php echo base_url('Category/UpdateData'); ?>">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" name="categoryname" maxlength="25" id="categoryname" class="form-control" required placeholder="<?php echo lang('category_name'); ?>" value="<?php echo $dataset[0]['categoryname']; ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="hidden" name="_id" value="<?php echo $dataset[0]['_id']; ?>">
                                    <button name="submit" id="submit" class="btn btn-success btn-lg waves-effect waves-light" type="submit"><?php echo lang('edit_category'); ?></button>
                                    <button class="btn btn-default btn-lg waves-effect waves-light m-l-5" onclick="goBack()" type="reset">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

