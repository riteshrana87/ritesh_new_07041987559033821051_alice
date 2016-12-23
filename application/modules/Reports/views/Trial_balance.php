<script>
    var delete_client = '<?php echo lang('delete_confirmation_client'); ?>';
    var view_name = 'List';
    var recurring_url = "<?php echo base_url(); ?>";
    var company_name = "<?php echo $comp_info[0]['company'];?>";
    var company_address = "<?php echo $comp_info[0]['address'];?>";
    var company_logo = "<?php echo base_url().'uploads/company_logo/'.$comp_info[0]['company_logo'];?>";
    //console.log(company_logo);
</script>

<div class="col-lg-1"></div>
<div class="col-lg-10 ">
    <div class="row">
        <div class="row">
            <div class="col-sm-10">
                <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h1>
            </div>
           <!-- <div class="col-sm-2">
                <a class="btn btn-success btn-bordred waves-effect w-lg waves-light m-b-5 pull-right page-header" title="<?php echo lang('add_expense'); ?>"  href="<?php echo base_url('Expenses/Add'); ?>" type="button"><i class="fa fa-plus"></i> <?php echo lang('add_expense'); ?></a>
            </div>-->
        </div>
       
        <div class="col-lg-5">
            <div class="col-lg-8">
                <div class=" m-t-30">
                <input type="text" name="invoice_start" class="form-control invoice-datepicket" style="width:50%;" placeholder="mm/dd/yyyy" id="invoice_start" value="" data-parsley-id="10" >
                <a href="javascript:;" class="btn btn-primary waves-effect waves-light" onclick="get_trial_balance();"> <i class="fa fa-cloud m-r-5"></i>Search</a>
                </div>
            </div>
        </div>
        <!--        <div class="row">
                    <header class="header">
                        <div class="search-box pull-left">
                            <input placeholder="Search..."><span class="icon glyphicon glyphicon-search"></span>
                        </div>
        
                    </header>
                </div>-->
    </div>
    <div class="clearfix"></div>
    <div id="replacementdiv">
                <div class="col-sm-12">

             <div class="row">
                 <div class="card-box">

         <?php if ($this->session->flashdata('error')) {
             ?>
                         <?php echo $this->session->flashdata('error'); ?>
                     <?php } ?>
                     <?php if ($this->session->flashdata('message')) {
                         ?>
                         <?php echo $this->session->flashdata('message'); ?>
                     <?php } ?>         <div class="table-rep-plugin">
                         <div class="table-responsive" data-pattern="priority-columns">
                             <table id="trial_balance_table" class="table  table-striped">
                                 <thead>
                                     <tr>
                                         <th><?php echo lang('account');?></th>
                                         <th><?php echo lang('description');?></th>
                                          <th data-priority="1"><?php echo lang('debit');?></th>
                                           <th data-priority="1"><?php echo lang('credit');?></th>
                                     </tr>
                                 </thead>

                                 <tbody id="trial_balance_data">
                                      <?php 
                                        if(count($sales)>0){
                                      ?>
                                     <tr>
                                         <td><?php echo lang('sales');?></td>
                                         <td>-</td>
                                         <td>-</td>
                                         <td><?php echo $sales['currency'].' '.((isset($sales['total_sale']))?$sales['total_sale']:'0.00');?></td>
                                     </tr>
                                        <tr>
                                         <td><?php echo lang('tax_payable');?></td>
                                         <td>-</td>
                                         <td>-</td>
                                         <td><?php echo $sales['currency'].' '.((isset($sales['total_tax']))?$sales['total_tax']:'0.00');?></td>
                                     </tr>
                                     <?php  }?>
                                      <?php 
                                        if(count($purchase)>0){
                                      ?>
                                     <tr>
                                         <td><?php echo lang('purchase');?></td>
                                         <td>-</td>
                                         <td><?php echo $purchase['currency'].' '.((isset($purchase['total_purchase']))?$purchase['total_purchase']:'0.00');?></td>
                                         <td>-</td>
                                     </tr>
                                      <tr>
                                         <td><?php echo lang('tax_receivable');?></td>
                                         <td>-</td>
                                         <td><?php echo $sales['currency'].' '.((isset($sales['total_tax']))?$sales['total_tax']:'0.00');?></td>
                                         <td>-</td>
                                     </tr>
                                     <?php  }?>
                                     <?php 
                                        if(count($trial_bal)>0){
                                     foreach($trial_bal as $client_trial){
                                         if($client_trial['remaining_in'] !='Payable Amount'){
                                         ?>
                                     <tr>
                                         <td><?php echo $client_trial['client_name'];?></td>
                                         <td>-</td>
                                         <td><?php echo $client_trial['currency'].' '.((isset($client_trial['remaining_amount']))?$client_trial['remaining_amount']:'0.00');?></td>
                                         <td>-<?php //echo $client_trial['currency'].' '.((isset($client_trial['total_payment']))?$client_trial['total_payment']:'0.00');?></td>
                                     </tr>
                                         <?php }else{ ?>
                                                 <tr>
                                         <td><?php echo $client_trial['client_name'];?></td>
                                         <td>-</td>
                                         <td>-</td>
                                         <td><?php echo $client_trial['currency'].' '.((isset($client_trial['remaining_amount']))?$client_trial['remaining_amount']:'0.00');?></td>
                                     </tr>
                                         <?php }} }?>
                                      <?php 
                                        if(count($cat_expense_array)>0){
                                            foreach($cat_expense_array as $cat_expense){
                                      ?>
                                     <tr>
                                         <td><?php echo $cat_expense['category_name'];?></td>
                                         <td>-</td>
                                         <td><?php echo $cat_expense['currency'].' '.((isset($cat_expense['net_expense']))?$cat_expense['net_expense']:'0.00');?></td>
                                         <td>-</td>
                                     </tr>
                                     
                                            <?php } }?>
                                        <?php 
                                        if(count($banks)>0){
                                            foreach($banks as $bank){
                                      ?>
                                     <tr>
                                         <td><?php echo $bank['payment_with'];?></td>
                                         <td>-</td>
                                         <td><?php echo $bank['currency'].' '.((isset($bank['paid_amount']))?$bank['paid_amount']:'0.00');?></td>
                                         <td>-</td>
                                     </tr>
                                     
                                            <?php } }?>
                                             <?php 
                                        if(count($vendor_expense)>0){
                                            foreach($vendor_expense as $expense){
                                      ?>
                                     <tr>
                                         <td><?php echo $expense['vendorname'];?></td>
                                         <td>-</td>
                                         <td>-</td>
                                         <td><?php echo $expense['currency'].' '.((isset($expense['total']))?$expense['total']:'0.00');?></td>
                                     </tr>
                                     
                                            <?php } }?>
                                 </tbody>

                             </table>

                         </div>

                     </div>

                 </div>
             </div>
         </div>
           <input type="hidden" id="ïmage_url" value="">
    </div>
</div>
<!-- End row -->

</div> <!-- container -->
<div class="col-lg-1"></div>

