<script>
    var delete_client = '<?php echo lang('delete_confirmation_client'); ?>';
    var view_name = 'List';
    var recurring_url = "<?php echo base_url(); ?>";
    var company_name = "<?php echo $comp_info[0]['company'];?>";
    var company_address = "<?php echo $comp_info[0]['address'];?>";
    var company_logo = "<?php echo base_url().'uploads/company_logo/'.$comp_info[0]['company_logo'];?>";
    console.log(company_logo);
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
            <h1 class="page-title"><a class="sidebar-toggle-btn trigger-toggle-sidebar"><span class="line"></span><span class="line"></span><span class="line"></span><span class="line line-angle1"></span><span class="line line-angle2"></span></a></h1>
            <div class="action-bar">
             <div class="col-lg-12">
                 <div id="validate" style="display:none;color: red;"></div>
                                <div class=" m-t-30">
                                    <div class="select2-container form-control">
                                        <select class="form-control select2" id="client_id"  name="client_id" required data-parsley-trigger="change" onchange="get_ledger();">
                                            <option value="">Select</option>
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
                                    </div>
                                </div>
                            </div>
            </div>

        </div>
        <div class="col-lg-5">
            <div class="col-lg-8">
                <div class=" m-t-30">
                <input type="text" name="start_limit" class="form-control invoice-datepicket" style="width:50%;" placeholder="mm/dd/yyyy" id="start_limit" value="" data-parsley-id="10" >
                <input type="text" name="end_limit" class="form-control invoice-datepicket" style="width:50%;" placeholder="mm/dd/yyyy" id="end_limit" value="" data-parsley-id="10" >
                <a href="javascript:;" class="btn btn-primary waves-effect waves-light" onclick="get_ledger();"> <i class="fa fa-cloud m-r-5"></i>Search</a>
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
                             <table id="ledger_table" class="table  table-striped">
                                 <thead>
                                     <tr>
                                      
                                         <th>date<?php echo lang('date');?></th>
                                         <th><?php echo lang('account');?></th>
                                         <th><?php echo lang('description');?></th>
                                         <th data-priority="1"><?php echo lang('voucher_number');?></th>
                                         <th data-priority="1"><?php echo lang('type');?></th>
                                          <th data-priority="1"><?php echo lang('debit');?></th>
                                           <th data-priority="1"><?php echo lang('credit');?></th>


                                     </tr>
                                 </thead>

                                 <tbody id="ledger_data">
                                     
                                 </tbody>

                             </table>
                             
                             <table id="ledger_sales_table" class="table table-striped" style="display:none;">
                                 <thead>
                                     <tr>
                                      
                                         <th>date<?php echo lang('date');?></th>
                                         <th><?php echo lang('account');?></th>
                                        
                                         <th data-priority="1"><?php echo lang('voucher_number');?></th>
                                         <th data-priority="1"><?php echo lang('excluding_tax');?></th>
                                          <th data-priority="1"><?php echo lang('total_tax');?></th>
                                           <th data-priority="1"><?php echo lang('net_amount');?></th>


                                     </tr>
                                 </thead>

                                 <tbody id="ledger_sales_data">
                                     
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

