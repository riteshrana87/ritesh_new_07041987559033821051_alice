<script>
    var view_name = 'Add';
</script>
<div class="content">
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
            <div class="col-lg-12">
                <div class="card-box">
                    <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>

                        <form class="form-horizontal" role="form" id="TaxForm" name="TaxForm" method="post" action="<?php echo base_url('Tax/InsertData'); ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="example-input-small"><?php echo lang('tax_name');?></label>
                            <div class="col-sm-6">
                                <input id="tax_name" name="tax_name" class="form-control input-sm" required placeholder="<?php echo lang('tax_name');?>" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="example-input-normal"><?php echo lang('tax');?></label>
                            <div class="col-sm-6">
                                <input id="tax" name="tax" class="form-control" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="10" placeholder="Tax" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                    <?php echo lang('create_tax'); ?>
                                </button>
                                <button class="btn btn-default waves-effect waves-light m-l-5" onclick="goBack()" type="reset">
                                    <?php echo lang('COMMON_LABEL_CANCEL');?>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
        <!-- end row -->


    </div> <!-- container -->

</div> <!-- content -->
