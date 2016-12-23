<script>
    var delete_client = '<?php echo lang('delete_confirmation_client'); ?>';
    var view_name = 'List';
</script>
<div class="col-lg-1"></div>
<div class="col-lg-10">
    <div class="row head_page">
        <div class="col-sm-10">
            <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h1>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-success btn-bordred page-header-btn" title="<?php echo lang('addTitleClient'); ?>" href="<?php echo base_url('Client/Add'); ?>" type="button">
            <i class="fa fa-plus page-header-btn-icon"></i><?php echo lang('create_new_client'); ?></a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
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
                <div class="action-bar">
                    <ul class="list-inline m-b-0">
                        <li><h3 class="title_head1"><?php echo lang('recently_updated'); ?></h3></li>
                        <li>
                            <!--<i title='<?php echo lang('gridview'); ?>' onclick="loadView('grid', '<?php echo base_url('Client'); ?>')" class="fa fa-file-o fa-2x cursor"></i>&nbsp; -->
                            <a <?php if($view=='grid'){?>class="active" <?php }?> href="<?php echo base_url('Client/grid'); ?>"> <i title='<?php echo lang('Client'); ?>' class="fa fa-file-o fa-2x cursor"></i></a>
                        </li>
                        <li>
                            <!--<i title='<?php echo lang('listview'); ?>' onclick="loadView('list', '<?php echo base_url('Client/'); ?>')"  class="fa fa-align-justify fa-2x cursor"></i> -->
                            <a <?php if($view=='list'){?>class="active" <?php }?> href="<?php echo base_url('Client/list'); ?>"> <i title='<?php echo lang('Client'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="replacementdiv">
        <?php //echo $this->load->view('ListView');
        if ($view == 'list') {
            //echo $this->input->get('view');
            $this->load->view('ListView');
        } else {
            echo $this->load->view('GridView');
        }
        ?>
    </div>
</div>

