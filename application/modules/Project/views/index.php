<script>
    var delete_client = '<?php echo lang('delete_confirmation_project'); ?>';
    var view_name = 'List';
</script>
<div class="col-lg-1"></div>
<div class="col-lg-10">
    <div class="row head_page">
        <div class="col-sm-10">
            <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h1>
            <div class="insdie_tag">
                <ul class="nav nav-pills">
                    <li <?php if($viewType=='Active'){?> class="active" <?php }?>><a href="<?php echo base_url('Project'); ?>"><?php echo lang('active_projects');?></a></li>
                    <li <?php if($viewType=='archive'){?> class="active" <?php }?>><a href="<?php echo base_url('Project/completedProject'); ?>"><?php echo lang('archive');?></a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-success btn-bordred page-header-btn" title="<?php echo lang('new_project'); ?>"  href="<?php echo base_url('Project/Add'); ?>" type="button">
                <i class="fa fa-plus"></i> <?php echo lang('new_project'); ?></a>
        </div>
    </div>
    <div class="row">
        <div class="tab-content inside_body">
            <div class="tab-pane fade active in" id="cardpills-1">
                <?php if ($viewType == 'Active'){?>
                <div class="col-md-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4 class="amount" id="overdue_price"><?php echo $overdue_count; ?></h4>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="amount_detail"><?php echo lang('overdue'); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4 class="amount" id="outstanding_price"><?php echo $inprogress_count; ?></h4>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="amount_detail"><?php echo lang('inprogress'); ?></h4>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4 class="amount" id="draft_price"><?php echo $onhold_count; ?></h4>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="amount_detail"><?php echo lang('onhold'); ?></h4>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h4 class="amount" id="draft_price"><?php echo $planned_count; ?></h4>
                            </div>
                            <div class="col-md-12 text-center">
                                <h4 class="amount_detail"><?php echo lang('planned'); ?></h4>
                            </div>

                        </div>
                    </div>
                </div>
                <?php } else {?>
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="amount" id="draft_price"><?php echo $completed_count; ?></h4>
                                </div>
                                <div class="col-md-12 text-center">
                                    <h4 class="amount_detail"><?php echo lang('completed'); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="tab-pane fade active in" id="cardpills-2">

            </div>
        </div>
    </div>
    <div class="clearfix"></div>
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
                <?php
                if($viewType == 'archive'){
                ?>
                <div class="action-bar">
                    <ul class="list-inline m-b-0">
                        <li><h3 class="title_head"><?php echo lang('recently_updated'); ?></h3></li>
                        <li>
                            <a <?php if($view=='grid'){?> class="active" <?php }?> href="<?php echo base_url('Project/completedProject/grid');?>"><i title='<?php echo lang('gridview'); ?>' class="fa fa-file-o fa-2x cursor"></i></a>
                        </li>
                        <li>
                            <a <?php if($view=='list'){?> class="active" <?php }?> href="<?php echo base_url('Project/completedProject/list');?>"><i title='<?php echo lang('listview'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a>
                        </li>
                    </ul>
                </div>
                <?php
				}
				else{
                ?>
                <div class="action-bar">
                    <ul class="list-inline m-b-0">
                        <li><h3 class="title_head"><?php echo lang('recently_updated'); ?></h3></li>
                        <li>
                            <a <?php if($view=='grid'){?> class="active" <?php }?> href="<?php echo base_url('project/grid');?>"><i title='<?php echo lang('gridview'); ?>' class="fa fa-file-o fa-2x cursor"></i></a>
                        </li>
                        <li>
                            <a <?php if($view=='list'){?> class="active" <?php }?> href="<?php echo base_url('project/list');?>"><i title='<?php echo lang('listview'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a>
                        </li>
                    </ul>
                
                <?php
			    }
                ?>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="replacementdiv">
        <?php //echo $this->load->view('ListView'); ?>
        <?php
        if($viewType=='archive'){
            if($view2)
            {
                if($view2 == 'grid')
                {
                    $this->load->view('completedgridview');
                }else{
                    $this->load->view('completedlistview');
                }
            }else
                {
                    echo $this->load->view('completedgridview');
                }
            }
            else{
            if($view2)
            {
                if($view2 == 'grid')
                {
                    $this->load->view('GridView');
                }else{
                    $this->load->view('ListView');
                }
            }else
                {
                    echo $this->load->view('GridView');
                }
            }
        ?>
    </div>
</div>





