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
        <div class="">
            <h1 class="page-title"><a class="sidebar-toggle-btn trigger-toggle-sidebar"><span class="line"></span><span class="line"></span><span class="line"></span><span class="line line-angle1"></span><span class="line line-angle2"></span></a></h1>
          <?php /*?>  <div class="action-bar pull-left">
                <ul class="list-inline m-b-0">
                    <li>
                        <h3 class=""><?php echo lang('recently_updated'); ?></h3>
                    </li>
                    <li>
<!--                        <i title='<?php echo lang('gridview'); ?>' onclick="loadView('grid', '<?php echo base_url('Expenses'); ?>')" class="fa fa-file-o fa-2x cursor"></i>&nbsp;-->
                        <a href="<?php echo base_url('Expenses?view=grid');?>"><i title='<?php echo lang('gridview'); ?>' class="fa fa-file-o fa-2x cursor"></i></a>
                    </li>
                    <li>
<!--                        <i title='<?php echo lang('listview'); ?>' onclick="loadView('list', '<?php echo base_url('Expenses/'); ?>')"  class="fa fa-align-justify fa-2x cursor"></i>-->
                             <a href="<?php echo base_url('Expenses?view=list');?>"><i title='<?php echo lang('gridview'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a>
                    </li>

                </ul>
            </div><?php */ ?>

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
                    <table id="tech-companies-1" class="table  table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('vendor_name');?></th>
                                <th><?php echo lang('category_name');?></th>
                                <th data-priority="1"><?php echo lang('excluding_tax');?></th>
                                <th data-priority="1"><?php echo lang('total');?></th>
                                <th data-priority="4">Created Date</th>
                               

                            </tr>
                        </thead>

                        <tbody>
<?php
$i=1;
if (count($expenses) > 0) {
    foreach ($expenses as $expense) {
        ?>
                                    <tr>
										
											<td class="cursor_<?php echo $i;?> cursor" onclick="view('<?php echo $expense['_id'];?>');"><?php echo $i; ?></td>
											<td class="cursor_<?php echo $i;?> cursor" onclick="view('<?php echo $expense['_id'];?>');"><?php echo $expense['vendorname']; ?></td>
                                                                                        <td class="cursor_<?php echo $i;?> cursor" onclick="view('<?php echo $expense['_id'];?>');"><?php echo $expense['category_name']; ?></td>
											<td class="cursor_<?php echo $i;?> cursor" onclick="view('<?php echo $expense['_id'];?>');"><?php echo $expense['excluding_tax']; ?></td>
                                                                                        <td class="cursor_<?php echo $i;?> cursor" onclick="view('<?php echo $expense['_id'];?>');"><?php echo $expense['total']; ?></td>
											<td class="cursor_<?php echo $i;?> cursor" onclick="view('<?php echo $expense['_id'];?>');"><?php echo $expense['created_at']; ?></td>
										
                      
                                    </tr>
    <?php $i++; } ?>

                            <?php } else { ?>
                                <tr>
                                    <td colspan="4"><?php echo lang('NO_RECORD_FOUND'); ?></td>
                                </tr>
<?php } ?>
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

