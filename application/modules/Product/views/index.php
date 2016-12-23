<script>
    var delete_client = '<?php echo lang('delete_confirmation_product'); ?>';
    var view_name = 'grid';
</script>

<div class="col-lg-1"></div>
<div class="col-lg-10 ">
    <div class="row">
        <div class="row head_page">
            <div class="col-sm-7 col-sm-offset-2">
                <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h1>
                <div class="insdie_tag">
                    <ul class="nav nav-pills">
                        <li class="active"><a aria-expanded="false" data-toggle="tab" href="javascript:void(0)"><?php echo lang('product'); ?></a></li>
                        <li class=""><a href="<?php echo base_url('Vendor'); ?>"><?php echo lang('vendor'); ?></a></li>
                        <li class=""><a href="<?php echo base_url('Archives'); ?>"><?php echo lang('archive'); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <a class="btn btn-success btn-bordred page-header-btn" title="<?php echo lang('addproject'); ?>" href="<?php echo base_url('Product/Add'); ?>" type="button"><i class="fa fa-plus"></i> <?php echo lang('create_new_product'); ?></a>
                <a class="btn btn-success btn-bordred page-header-btn" style="margin-right: 10px;" title="<?php echo lang('importproject'); ?>" href="javascript:void(0)" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <?php echo lang('import_product'); ?></a>
            </div>
        </div>
        <div class="page_inside">
            <h1 class="page-title">
                <a class="sidebar-toggle-btn trigger-toggle-sidebar"><span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line line-angle1"></span>
                    <span class="line line-angle2"></span>
                </a>
            </h1>
            <div class="action-bar" style=" position: relative; top: 48px; left: 9px;">
                <ul class="list-inline m-b-0">
                    <li><h3 class="title_head1"><?php echo lang('recently_updated'); ?></h3></li>
                    <li><a class="active" href="<?php echo base_url('Product/grid'); ?>"> <i title='<?php echo lang('gridview'); ?>' class="fa fa-file-o fa-2x cursor"></i></a></li>
                    <li><a href="<?php echo base_url('Product/list'); ?>"> <i title='<?php echo lang('gridview'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a></li>
                </ul>
            </div>
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
        } else {
            echo $this->load->view('GridView');
        }
        ?>
    </div>
</div>
<div class="col-lg-1"></div>

<!-- Modal -->
<div id="myModal" class="modal fade col-lg-12 col-md-12" role="dialog">
    <div class="modal-dialog" style="width:54%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Import Product</h4>
            </div>
            <div class="modal-body">
                <!--<div class="content">-->
                <div class="container">
                    <div class="row">
                       <div class="col-sm-12 ">
                            <div id="validate" style="color:red">
                            </div>
                            <form class="form-horizontal" role="form" id="ProductuploadForm" name="ProductuploadForm" method="post" required action="<?php echo base_url('Product/Excel_upload'); ?>" enctype='multipart/form-data'>
                                <!-- <input type="file" name="upload" id="upload" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="upload">
                                <input type="submit" name="excel_btn" id="excel_btn" value="Upload" class="btn btn-primary"> -->
        
        
        <div class="fileUpload btn btn-primary">
         <span>+ Choose File</span>
         <input type="file" name="upload" id="upload" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="upload">
        </div>
        
                            </form>
       
       <a class="btn btn-success btn-bordred page-header-btn" title="<?php echo lang('addproject'); ?>" href="uploads/sample_files/sample_bulk_product_import.xlsx" type="button"><i class="fa fa-plus"></i> Download Demo Excel</a>
       <a class="btn btn-success btn-bordred page-header-btn" title="<?php echo lang('addproject'); ?>" href="uploads/sample_files/sample_bulk_product_import.csv" type="button"><i class="fa fa-plus"></i> Download Demo CSV</a>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

</div>

<style>
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>


