<script>
    var view_name = 'Edit';
</script>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="add_client_header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></div>
            <div class="card-box form_field">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-horizontal" role="form" id="TaxForm" name="TaxForm" method="post" action="<?php echo base_url('Tax/UpdateData'); ?>">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input id="tax_name" name="tax_name" class="form-control" value="<?php echo $taxs[0]['tax_name']; ?>" required placeholder="<?php echo lang('SETTING_LABEL_TAX_NAME');?> *" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input id="tax" name="tax" class="form-control" value="<?php echo $taxs[0]['tax']; ?>" required data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="10" placeholder="<?php echo lang('tax');?> *" type="text">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="hidden" name="_id"  id="_id" value="<?php echo $taxs[0]['_id']; ?>"  >
                                    <button name="submit" id="submit" class="btn btn-success btn-lg waves-effect waves-light" type="submit"><?php echo lang('update_tax'); ?></button>
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

