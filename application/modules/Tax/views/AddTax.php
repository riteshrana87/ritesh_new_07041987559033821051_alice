<script>
    var view_name = 'Add';
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
                        <form class="form-horizontal" role="form" id="TaxForm" name="TaxForm" method="post" action="<?php echo base_url('Tax/InsertData'); ?>">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="tax_name" name="tax_name" class="form-control" required placeholder="<?php echo lang('SETTING_LABEL_TAX_NAME');?> *" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="tax" name="tax" class="form-control" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' required maxlength="10" placeholder="<?php echo lang('tax');?> *" type="text">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button name="submit" id="submit" class="btn btn-success btn-lg waves-effect waves-light" type="submit"><?php echo lang('create_tax'); ?></button>
                                    <button class="btn btn-default btn-lg waves-effect waves-light m-l-5" onclick="goBack()" type="reset"><?php echo lang('COMMON_LABEL_CANCEL'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
