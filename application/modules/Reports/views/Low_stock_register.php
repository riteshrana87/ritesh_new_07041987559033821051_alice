<script>
    var delete_client = '<?php echo lang('delete_confirmation_client'); ?>';
    var view_name = 'List';
    var recurring_url = "<?php echo base_url(); ?>";
     var company_name = "<?php echo $comp_info[0]['company'];?>";
    var company_address = "<?php echo $comp_info[0]['address'];?>";
    var company_logo = "<?php echo base_url().'uploads/company_logo/'.$comp_info[0]['company_logo'];?>";
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
                             <table id="low_stock_register_table" class="table  table-striped">
                                 <thead>
                                     <tr>
                                         <th><?php echo lang('product');?></th>
                                        
                                          <th data-priority="1"><?php echo lang('closing_stock');?></th>
                                           <th data-priority="1"><?php echo lang('minimum_in_stock');?></th>
                                     </tr>
                                 </thead>

                                 <tbody id="low_stock_register_data">
                                     <?php 
                                        if(count($products)>0){
                                     foreach($products as $product){ ?>
                                     <tr>
                                         <td><?php echo $product['product_name'];?></td>
                                        
                                         <td><?php echo $product['closing_stock'];?></td>
                                         <td><?php echo $product['minimum_in_stock'];?></td>
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

