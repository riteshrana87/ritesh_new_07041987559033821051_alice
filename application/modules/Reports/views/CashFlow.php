<script>
    var view_name = 'Add';
    var delete_confirmation_product_line = "<?php echo lang('delete_confirmation_product_line'); ?>";
    var recurring_url = "<?php echo base_url(); ?>";
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
            <div class="col-sm-8">
                <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
                <div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-group cash-flow">
                            <li class="list-group-item active ">Cash Flow from Operating Activities:</li>
                            <li class="list-group-item">Invoices Income(EBIT) <span class="badge"><?php echo $currency.' '.$total_invoice;?></span></li>
                            <?php foreach($all_expenses as $expense){?>
                            <li class="list-group-item"><?php echo $expense['category']?> <span class="badge">-<?php echo $currency.' '.$expense['excluding_tax'];?></span></li>
                           <?php }?>
                             <li class="list-group-item">Net Cash Flow from Operating Activities: <span class="badge"><?php echo $currency.' '.$net_cash;?></span></li>
                            </ul>
                            <!-- <ul class="list-group cash-flow">
                            <li class="list-group-item active ">Cash Flow from Investing Activities:</li>
                            <li class="list-group-item">Operating Income(EBIT) <span class="badge">$489,000</span></li>
                            <li class="list-group-item">Depreciation Expense <span class="badge">$112,400</span></li>
                           </ul>
                             <ul class="list-group cash-flow">
                            <li class="list-group-item active ">Cash Flow from Financing Activities:</li>
                            <li class="list-group-item">Operating Income(EBIT) <span class="badge">$489,000</span></li>
                            <li class="list-group-item">Depreciation Expense <span class="badge">$112,400</span></li>
                           </ul>-->
                        </div><!-- end col -->



                    </div><!-- end row -->
                </div>

            </div><!-- end col -->
           
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
                                        <textarea name="product_description" id="product_description" placeholder="<?php echo lang('description');?>"></textarea>
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