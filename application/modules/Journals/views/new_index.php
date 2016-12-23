<script>
    var delete_client = '<?php echo lang('delete_confirmation_client'); ?>';
    var view_name = 'List';
</script>

<div class="col-lg-1"></div>
<div class="col-lg-10 ">
    <div class="row">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center page-header invoice_dashboard"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?>
                
                </h1>
                <div style="clear:both;"></div>
                 <div class="col-sm-0">
                <a class="btn btn-success btn-bordred waves-effect w-lg waves-light m-b-5 pull-right" title="<?php echo lang('addTitleClient'); ?>"  href="<?php echo base_url('Invoice/Add'); ?>" type="button"><i class="fa fa-plus"></i> <?php echo lang('new_invoice'); ?></a>
            </div>
            </div>
           
        </div>
        <div class="">
            <h1 class="page-title"><a class="sidebar-toggle-btn trigger-toggle-sidebar"><span class="line"></span><span class="line"></span><span class="line"></span><span class="line line-angle1"></span><span class="line line-angle2"></span></a></h1>
            <div class="action-bar pull-left">
                <ul class="list-inline m-b-0">
                    <li>
                        <h3 class=""><?php echo lang('recently_updated'); ?></h3>
                    </li>
                    <li>
                        <i title='<?php echo lang('gridview'); ?>' onclick="loadView('grid', '<?php echo base_url('Invoice'); ?>')" class="fa fa-file-o fa-2x cursor"></i>&nbsp;
                    </li>
                    <li>
                        <i title='<?php echo lang('listview'); ?>' onclick="loadView('list', '<?php echo base_url('Invoice/'); ?>')"  class="fa fa-align-justify fa-2x cursor"></i>
                    </li>

                </ul>
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
        <?php echo $this->load->view('ListView'); ?>
    </div>
</div>
<!-- End row -->

</div> <!-- container -->
<div class="col-lg-1"></div>

