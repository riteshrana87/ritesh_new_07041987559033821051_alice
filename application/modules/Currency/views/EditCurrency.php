<script>
    var view_name = 'Edit';
</script>
<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="card-box">
                    <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>

                    <form class="form-horizontal" role="form" id="TaxForm" name="TaxForm" method="post" action="<?php echo base_url('Tax/UpdateData'); ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="example-input-small"><?php echo lang('tax_name');?></label>
                            <div class="col-sm-6">
                                <input id="tax_name" name="tax_name" class="form-control input-sm" value="<?php echo $taxs[0]['tax_name']; ?>" required placeholder="<?php echo lang('tax_name');?>" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="example-input-normal"><?php echo lang('tax');?></label>
                            <div class="col-sm-6">
                                <input id="tax" name="tax" class="form-control" value="<?php echo $taxs[0]['tax']; ?>" required data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="10" placeholder="Tax" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <input type="hidden" name="_id"  id="_id" value="<?php echo $taxs[0]['_id']; ?>"  >
                                <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                    <?php echo lang('update_tax'); ?>
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
