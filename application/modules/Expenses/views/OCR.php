<script>
    var view_name = 'Add';
    var delete_confirmation_product_line = "<?php echo lang('delete_confirmation_product_line'); ?>";
    var recurring_url = "<?php echo base_url(); ?>";
</script>
<script src="<?php echo base_url('uploads/assets/plugins/switchery/switchery.min.js') ?>"></script>

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
            <div class="col-sm-8">
                <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-horizontal" role="form" id="ExpenseForm" name="ExpenseForm" method="post" action="<?php echo base_url('Expenses/InsertData'); ?>">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <select class="select2 form-control" name="category"  required  id="category" placeholder="<?php echo lang('categoryname'); ?>*">
                                            <option value="" selected=""></option>
                                            <?php
                                            if (count($categories) > 0) {
                                                foreach ($categories as $category) {
                                                    ?>
                                                    <option value="<?php echo $category['_id']; ?>"><?php echo $category['categoryname']; ?></option>
                                                <?php } ?>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="col-md-6 align-right">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="text" name="startdate" required id="startdate" placeholder=" / / " class="form-control" value="<?php echo date('m/d/Y'); ?>">
                                                    <span class="input-group-addon bg-primary b-0 text-white" ><i class="ti-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" id="vendorname" value="<?php echo $company_name;?>"  maxlength="50" name="vendorname" class="form-control" required placeholder="<?php echo lang('vendor_name'); ?>*">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea name="description" id="description" class="from-control"></textarea>
                                    </div>
                                </div>
                                <h4 class="page-header header-title"></h4>

                                <?php echo $this->load->view('productBoxOCR'); ?>
                                <div class="appendproductbox"></div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <a href="javascript:;" class="align-center" onclick="addNewProduct('<?php echo base_url('Expenses/getProductBox'); ?>',<?php echo $i; ?>);"><i class="fa fa-plus"></i><?php echo lang('add_new_line'); ?></a>
                                    </div>
                                </div>
                                <div class="clear:both"> </div>

                                <div class="form-group">
                                    <div class="col-md-4 pull-right"> 
                                        <div class="col-sm-6">
                                            Excluding tax: 
                                        </div>
                                        <div class="col-sm-6">
                                            $<span id="excluding_tax" name="excluding_tax">0</span>
                                        </div>

                                        <div class="col-sm-6">
                                            Tax Amount: 
                                        </div>
                                        <div class="col-sm-6">
                                            $<span id="amount_tax" name="amount_tax">0</span>
                                        </div>

                                        <div class="included_tax_description">

                                        </div>
                                    </div>


                                </div>
                                <!-- <h4 class="page-header header-title"></h4> -->
                                <?php //echo $this->load->view('taxBox'); ?>
                                <!-- <div class="appendtaxbox"></div> -->
                                <!-- <div class="form-group">

                                    <div class="col-md-12">
                                        <a href="javascript:;" class="align-center" onclick="getTaxBox('<?php echo base_url('Expenses/getTaxBox'); ?>',<?php echo $tax_inc; ?>);"><i class="fa fa-plus"></i><?php echo lang('add_new_tax'); ?></a>
                                    </div>

                                </div> -->
                                <h4 class="page-header header-title"></h4>
                                <div class="form-group">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6 text-right">
                                        <h2 >$<span id="total_text">0</span></h2>
                                        <div class="col-sm-8">

                                            <input  type="hidden" class="form-control" readonly="" id="total_tax" name="total_tax">
                                            <input  type="hidden" class="form-control" readonly="" id="total" name="total">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('save_expense'); ?>
                                        </button>
                                        <!-- <button class="btn btn-default waves-effect waves-light m-l-5" type="reset">
                                        <?php echo lang('cancel'); ?>
                                        </button> -->
                                        <a href="<?php echo base_url('Expenses'); ?>" class="btn btn-default waves-effect waves-light m-l-5" onclick="goBack()" >  <?php echo lang('cancel'); ?> </a>
                                    </div>
                                </div> 
                            </form>
                        </div><!-- end col -->

                    </div><!-- end row -->
                </div>

            </div><!-- end col -->
            <div class="col-sm-4">
                <div class="col-lg-12">
                    <h4 class="page-header header-title"><?php echo lang('client_settings_followup'); ?></h4>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="widget-user">
                                <div class="col-lg-10">
                                    <div class="wid-u-info">
                                     
                                        <form method="post" id="formUpload" action="<?php echo base_url('Expenses/initInvoice');?>" enctype='multipart/form-data'>
                                            <input type="file" class="dropify" name="invimg"  placeholder="<?php echo lang('drag_reciept'); ?>" />
                                        </form>
                                        </h4>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div><!-- end col -->
            </div>
        </div>
        <!-- end row -->


    </div> <!-- container -->

</div> <!-- content -->

<!-- Modal -->
<div id="myModal" class="modal fade col-lg-12 col-md-12" role="dialog">
    <div class="modal-dialog" style="width:54%;">

        <!-- Modal content-->
        <div class="modal-content">
            <!--<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Create Product</h4>
            </div>-->
            <div class="modal-body">
                <!--<div class="content">-->
                <div class="container">

                    <div class="row">
                        <div class="col-sm-12 ">
                            <h3 class="text-center">Create Product</h3>
                            <div class="card-box">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="validation_msg"></div>
                                        <div id="validate" class="alert-danger"></div>
                                        <form class="form-horizontal" role="form" id="ProductForm" name="ProductForm" method="post" action="<?php echo base_url('Product/InsertData'); ?>">
                                            <div class="form-group">

                                                <div class="col-md-6">
                                                    <input type="text" name="add_product_name"  maxlength="25" id="add_product_name" class="form-control" required placeholder="<?php echo lang('product_name'); ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="sku"  maxlength="25" id="sku" class="form-control" required placeholder="<?php echo lang('sku'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <textarea name="product_description" id="product_description" placeholder="<?php echo lang('description'); ?>"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <div class="col-md-3">
                                                    <input type="opening_stock" name="opening_stock" onkeypress="return numericDecimal(event)" maxlength="50" id="opening_stock" class="form-control" placeholder="<?php echo lang('opening_stock'); ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="purchases" id="purchases"  onkeypress="return numericDecimal(event)" class="form-control" placeholder="<?php echo lang('purchases'); ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="sales" onkeypress="return numericDecimal(event)" id="sales" class="form-control" placeholder="<?php echo lang('sales'); ?>">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" name="closing_stock" onkeypress="return numericDecimal(event)" id="closing_stock" class="form-control" placeholder="<?php echo lang('closing_stock'); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <div class="col-md-3">
                                                    <input type="text" id="minimum_in_stock" name="minimum_in_stock" onkeypress="return numericDecimal(event)" placeholder="<?php echo lang('minimum_in_stock'); ?>" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <!-- <input type="text" id="minimum_in_stock" name="minimum_in_stock" placeholder="<?php echo lang('minimum_in_stock'); ?>" class="form-control"> -->
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="switchery-demo col-md-4" style="float:left">
                                                        <input type="checkbox" name="perishable" id="perishable" checked data-plugin="switchery" data-color="#00b19d"/>
                                                    </div>
                                                    <div class="switchery-demo col-md-8" style="float:left">
                                                        <label> <?php echo lang('perishable_only'); ?></label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div id="useble_div">
                                                        <label style="float:left"> Useable up to </label> <input type="text" onkeypress="return numericDecimal(event)" style="width:20%; float:left; margin:0px 10px;" id="useable_days" name="useable_days" class="form-control"> <label style="float:left"> Days </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--                                
                                       <div  class="form-group">

                <div class="col-md-6">
                    <input type="text" name="zipcode" id="zipcode" class="form-control"  maxlength="10" required placeholder="<?php echo lang('zipcode'); ?>"  >
                </div>
                <div class="col-md-6">
                    <input type="text" name="city" required id="city" class="form-control"  maxlength="25" placeholder="<?php echo lang('city'); ?>">
                </div>
            </div>

            <div  class="form-group">

                <div class="col-md-6">
                    <input type="text" name="state" id="state" class="form-control"  maxlength="25" required placeholder="<?php echo lang('state'); ?>" >
                </div>
                <div class="col-md-6">
                    <input type="text" name="country" required id="country" class="form-control"  maxlength="25" placeholder="<?php echo lang('country'); ?>">
                </div>
            </div> -->

                                            <div class="form-group">
                                                <div class="col-sm-offset-4 col-sm-8">
                                                    <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" onclick="add_product()" type="button">
                                                        <?php echo lang('product_add'); ?>
                                                    </button>
                                                    <button class="btn btn-default waves-effect waves-light m-l-5" data-dismiss="modal" type="reset">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div> 
                                        </form>
                                    </div><!-- end col -->



                                </div><!-- end row -->
                            </div>

                        </div><!-- end col -->




                    </div>
                    <!-- end row -->


                </div> <!-- container -->

                <!--</div>--> <!-- content -->

            </div>
            <!--<div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>-->
        </div>

    </div>
</div>
