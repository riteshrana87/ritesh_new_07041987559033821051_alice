<script>
    var delete_client = '<?php echo lang('delete_confirmation_product'); ?>';
    var view_name = 'grid';
</script>

<div class="col-lg-1"></div>
<div class="col-lg-10">
    <div class="row">
        <div class="row head_page">
            <div class="col-sm-7 col-sm-offset-2">
                <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h1>
                <div class="insdie_tag">
                    <ul class="nav nav-pills">
                        <li class=""><a href="<?php echo base_url('Product'); ?>"><?php echo lang('product'); ?></a></li>
                        <li class=""><a href="<?php echo base_url('Vendor'); ?>"><?php echo lang('vendor'); ?></a></li>
                        <li class="active"><a href="javascript:void(0)"><?php echo lang('archive'); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <a class="btn btn-success btn-bordred page-header-btn" title="<?php echo lang('addvendor'); ?>" href="<?php echo base_url('Product/Add'); ?>" type="button"><i class="fa fa-plus"></i> <?php echo lang('create_new_product'); ?></a>
            </div>
        </div>
    </div>
    <div class="page_inside mT30">
        <h1 class="page-title">
            <a class="sidebar-toggle-btn trigger-toggle-sidebar"><span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line line-angle1"></span>
                <span class="line line-angle2"></span>
            </a>
        </h1>
        <div class="action-bar">
            <ul class="list-inline m-b-0">
                <li><h3 class="title_head1"><?php echo lang('recently_updated'); ?></h3></li>
                <li><a href="<?php echo base_url('Vendor/grid'); ?>"> <i title='<?php echo lang('gridview'); ?>' class="fa fa-file-o fa-2x cursor"></i></a></li>
                <li><a href="<?php echo base_url('Vendor/list'); ?>"> <i title='<?php echo lang('listview'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php
    //if (isset($_GET['view'])){

    ?>
    <div id="replacementdiv">

        <?php //echo $this->load->view('GridView');
        if ($view == 'list') {
            //echo $this->input->get('view');
            $this->load->view('ListView');
        }
        else{
            echo $this->load->view('GridView');
        }
        ?>
    </div>
</div>
<div class="col-lg-1"></div>

<div id="myModal" class="modal fade col-lg-12 col-md-12" role="dialog">
    <div class="modal-dialog" style="width:54%;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="form-horizontal" role="form" id="ProductForm" name="ProductForm" method="post" action="<?php echo base_url('Product/Excel_upload'); ?>" enctype='multipart/form-data'>
                                <input type="file" name="upload" id="upload">
                                <input type="submit" name="excel_btn" id="excel_btn" value="Upload">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>