<script>
    var delete_client = '<?php echo lang('delete_confirmation_client'); ?>';
    var view_name = 'List';
</script>

<div class="col-lg-1"></div>
<div class="col-lg-10 ">
    <div class="row">
        <div class="row">
            <div class="col-sm-12">
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
        <?php //echo $this->load->view('GridView'); ?>
        <?php 
        if(isset($_GET['view']))
        {
            if($this->input->get('view') == 'grid')
            {
                $this->load->view('GridView');
            }else{
                $this->load->view('ListView');
            }
        }else{
        
            echo $this->load->view('ListView');
        }
    ?>
    </div>
</div>
<!-- End row -->

</div> <!-- container -->
<div class="col-lg-1"></div>

