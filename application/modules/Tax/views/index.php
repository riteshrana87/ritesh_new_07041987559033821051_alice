<script>
    var delete_client = '<?php echo lang('delete_confirmation_Tax'); ?>';
    var view_name = 'List';
</script>
<div class="col-lg-1"></div>
<div class="col-lg-10">
    <div class="row">
        <div class="row head_page">
            <div class="col-sm-10">
                <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h1>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-success btn-bordred page-header-btn" title="<?php echo lang('addTitleClient'); ?>"  href="<?php echo base_url('Tax/Add'); ?>" type="button">
                    <i class="fa fa-plus page-header-btn-icon"></i><?php echo lang('add_tax'); ?></a>
            </div>
        </div>
        <div class="page_inside">
            <h1 class="page-title">
                <a class="sidebar-toggle-btn trigger-toggle-sidebar">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line line-angle1"></span>
                    <span class="line line-angle2"></span>
                </a>
            </h1>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="replacementdiv">
        <?php echo $this->load->view('ListView'); ?>
    </div>
</div>
<div class="col-lg-1"></div>

