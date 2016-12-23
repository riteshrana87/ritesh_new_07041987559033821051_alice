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
                            <div id="validate" style="display:none;color: red;"></div>
                            <form class="form-horizontal" role="form" id="ExpenseForm" name="JournalForm" method="post" action="<?php echo base_url('Journals/InsertJournal'); ?>">
                                <div class="form-group">                                  
                                    <div class="col-md-6 align-right">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="input-group">
                                                    <input type="text" name="startdate" required id="startdate" placeholder=" / / " class="form-control" value="<?php echo date('m/d/Y');?>">
                                                    <span class="input-group-addon bg-primary b-0 text-white" ><i class="ti-calendar"></i></span>
                                         
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 align-right">
                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                   <button name="add_account" id="add_account" value="Add Account" class="btn btn-primary waves-effect waves-light" type="">
                                                        <?php echo lang('add_account'); ?>
                                                   </button>
                                         
                                                </div><!-- input-group -->
                                            </div>
                                               <div class="col-sm-6">
                                                <div class="input-group">
                                                  <div class="plat1"><span class="plat1_invoice">Journal Number:</span></div>
                                                    <div class="plat2"><input type="text" name="journal_auto_id1" class="form-control journal-number" id="journal_auto_id1" placeholder="*" value="<?= $journal_auto_id; ?>" readonly/></div>
                                                     <div class="plat2"><input type="hidden" name="journal_auto_id" class="form-control journal-number" id="journal_auto_id" placeholder="*" value="<?= $journal_auto_id; ?>" /></div>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="page-header header-title"></h4>

                                <div class="form-group pdiv" id="productDiv_<?php echo $i;?>">
    
    <div class="col-md-2">
        <select class="select2 form-control get_type" name="journal_category[]" id="journal_category<?php echo $i;?>" onchange="get_type(this)" placeholder="<?php echo lang('category'); ?>" required="">
            <option value="" selected="">Select</option>
             <?php
            if (count($journal_accounts) > 0) {
                foreach ($journal_accounts as $journal_account) {
                    ?>
                    <option data-type="journal" value="<?php echo $journal_account['_id']; ?>"><?php echo $journal_account['account_name']; ?></option>

                <?php } ?>
            <?php } ?>
             <?php
            if (count($clients) > 0) {
                foreach ($clients as $client_data) {
                    ?>
                    <option data-type="client" value="<?php echo $client_data['_id']; ?>"><?php echo $client_data['firstname'] . ' ' . $client_data['lastname']; ?></option>

                <?php } ?>
            <?php } ?>
                <?php
            if (count($categories) > 0) {
                foreach ($categories as $category) {
                    ?>
                    <option data-type="category" value="<?php echo $category['_id']; ?>"><?php echo $category['categoryname']; ?></option>

                <?php } ?>
            <?php } ?>
             <?php
            if (count($vendors) > 0) {
                foreach ($vendors as $vendor) {
                    ?>
                    <option data-type="vendor" value="<?php echo $vendor; ?>"><?php echo $vendor; ?></option>

                <?php } ?>
            <?php } ?>
             <?php
            if (count($payment_with) > 0) {
                foreach ($payment_with as $payment) {
                    ?>
                    <option data-type="bank" value="<?php echo $payment; ?>"><?php echo $payment; ?></option>

                <?php } ?>
            <?php } ?>
               <option data-type="sales" value="sales">Sales</option>
               <option data-type="purchases" value="purchases">Purchases</option>
        </select>  
        <input type="hidden" class="selected_cat_type" name="category_type[]" id="category_type<?php echo $i;?>" value="">
    </div>
     <div class="col-md-2">
        <input type="text" name="description[]"  id="description<?php echo $i;?>" class="form-control"  placeholder="Description"   >
    </div>                               
    <div class="col-md-2">
                <input type="text" name="debit[]" min="0" maxlength="6" id="debit<?php echo $i;?>" class="form-control debit" onkeypress="return numericDecimal(event)" onkeyup="calculate_subtotal()" data-inc="<?php echo $i;?>" placeholder="<?php echo lang('debit'); ?>" data-parsley-pattern="/^\d{0,8}(\.\d{0,2})?$/" required >                      
    </div>
    <div class="col-md-2">
        <input type="text" name="credit[]" min="0" maxlength="6" id="credit<?php echo $i;?>" class="form-control credit" onkeypress="return numericDecimal(event)" onkeyup="calculate_subtotal()" data-inc="<?php echo $i;?>" placeholder="<?php echo lang('credit'); ?>" data-parsley-pattern="/^\d{0,8}(\.\d{0,2})?$/" required >
    </div>
    <?php 
    if($i>0){?>
    <div class="col-md-1">
        <a href="javascript:;" class="btn btn-danger" onclick="deleteItem('productDiv_<?php echo $i;?>');"><i class="fa fa-trash"></i></a>
    </div>
    <?php }?>
</div>

                                <div class="appendproductbox"></div>
                                 <div class="form-group">
                                    <div class="col-md-6">
                                        <a href="javascript:;" class="align-center" onclick="addNewProduct('<?php echo base_url('Journals/getProductBox'); ?>',<?php echo $i; ?>);"><i class="fa fa-plus"></i><?php echo lang('add_new_line'); ?></a>
                                    </div>
                                </div>
								<div class="clear:both"> </div>
								
								 <div class="form-group">
                                    <div class="col-md-8 pull-right"> 
										<div class="col-sm-3">
											Total Debit: 
                                                                                         <div class="col-sm-12">
                                                                                          $<span id="total_debit_span" name="total_debit_span">0</span>
											<input type="hidden"   id="total_debit" name="total_debit" value="">
                                                                                   </div>
										</div>
                                   
                                    
										<div class="col-sm-3">
											Total Credit: 
                                                                                         <div class="col-sm-12">
                                                                                            $<span id="total_credit_span" name="total_credit_span">0</span>
                                                                                            <input type="hidden" id="total_credit" name="total_credit" value="">
                                                                                        </div>
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
                                        <a href="javascript:;" class="align-center" onclick="getTaxBox('<?php echo base_url('Journals/getTaxBox'); ?>',<?php echo $tax_inc; ?>);"><i class="fa fa-plus"></i><?php echo lang('add_new_tax'); ?></a>
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
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit" onclick="return validate()">
                                            <?php echo lang('save_journal'); ?>
                                        </button>
                                        <!-- <button class="btn btn-default waves-effect waves-light m-l-5" type="reset">
                                            <?php echo lang('cancel'); ?>
                                        </button> -->
										<a href="<?php echo base_url('Journals'); ?>" class="btn btn-default waves-effect waves-light m-l-5" onclick="goBack()" >  <?php echo lang('cancel'); ?> </a>
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
                            <div class="card-box widget-user">
                                <div class="col-lg-10">
                                    <div class="wid-u-info">
                                           <!--<form method="post" id="formUpload" action="<?php echo base_url('Expenses/initInvoice');?>" enctype='multipart/form-data'>
                                            <input type="file" class="dropify" name="invimg"  placeholder="<?php echo lang('drag_reciept'); ?>" />
                                        </form>-->
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
                <h3 class="text-center">Create Account</h3>
                <div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">
                            <div id="validation_msg"></div>
                             <div id="validate" class="alert-danger"></div>
                            <form class="form-horizontal" role="form" id="ProductForm" name="AccountForm" method="post" action="<?php echo base_url('Journals/InsertAccount'); ?>">
                                <div class="form-group">

                                    <div class="col-md-6">
                                         <select class="form-control select2" id="account_type"  name="account_type" >
                                            <option value="">Select</option>
                                            <option value="Account Receivable (A/R)">Account Receivable (A/R)</option>
                                            <option value="Other Current Assets">Other Current Assets</option>
                                            <option value="Bank">Bank</option>
                                            <option value="Fixed Assets">Fixed Assets</option>
                                            <option value="Other Assets">Other Assets</option>
                                            <option value="Account payable (A/P)">Account payable (A/P)</option>
                                            <option value="Credit Card">Credit Card</option>
                                            <option value="Other Current Liabilities">Other Current Liabilities</option>
                                            <option value="Long Term Liabilities">Long Term Liabilities</option>
                                            <option value="Equity">Equity</option>
                                            <option value="Income">Income</option>
                                            <option value="Other Income">Other Income</option>
                                            <option value="Cost of Goods Sold">Cost of Goods Sold</option>
                                             <option value="Expanses">Expanses</option>
                                            <option value="Other Expanse">Other Expanse</option>
                                         </select>
                                    </div>
                                     <div class="col-md-3">
                                          <input type="text" name="startdate1" required id="startdate1" placeholder=" / / " class="form-control" value="<?php echo date('m/d/Y');?>">
                                          <span class="input-group-addon bg-primary b-0 text-white" ><i class="ti-calendar"></i></span>
                                         
                                       </div><!-- input-group -->
                                    
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea name="account_description" id="account_description" placeholder="<?php echo lang('description');?>"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" name="account_name"  maxlength="25" id="account_name" class="form-control" required placeholder="<?php echo lang('name'); ?>">
                                    </div>
                                    <div class="col-md-3">
                                             <select class="form-control select2" id="type"  name="type" >
                                            <option value="">Select</option>
                                            <option value="Debit">Debit</option>
                                            <option value="Credit">Credit</option>
                                         </select>
                                    </div>
                                    <div class="col-md-3">                                       
                                        <input type="text" name="amount" id="amount"  onkeypress="return numericDecimal(event)" class="form-control" placeholder="<?php echo lang('amount'); ?>">
                                        <span class="input-group-addon bg-primary b-0 text-white" >Opening Balance</span>
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
                                        <input name="submit" id="submit" class="btn btn-primary waves-effect waves-light" value="<?php echo lang('add_account'); ?>" type="submit">
                                          
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
