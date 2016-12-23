<script>
    var delete_client = '<?php echo lang('delete_confirmation_project'); ?>';
    var view_name = 'List';
</script>
<div class="col-lg-1"></div>
<div class="col-lg-10">
    <div class="row head_page">
        <div class="col-sm-2">
            <div class="col-sm-12">
                <div class="row">
                    <h3 class="text-center"><?php echo $clients['firstname'] . ' ' . $clients['lastname']; ?></h3>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="text-center">
                            <div><?php echo lang('start_date'); ?></div>
                            <div><?php echo "&nbsp;&nbsp;" . $projectDetails['startdate']; ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-center">
                            <div><?php echo lang('due_date'); ?></div>
                            <div><?php echo "&nbsp;&nbsp;" . $projectDetails['duedate']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h1>
            <div class="insdie_tag">
                <ul class="nav nav-pills">
                    <li <?php if($viewType=='Active'){?> class="active" <?php }?>><a href="<?php echo base_url('Project'); ?>"><?php echo lang('active_task');?></a></li>
                    <li <?php if($viewType=='archive'){?> class="active" <?php }?>><a href="<?php echo base_url('Project/completedProject'); ?>"><?php echo lang('completed_task');?></a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-success btn-bordred page-header-btn" title="<?php echo lang('create_task'); ?>"  href="<?php echo base_url('Task/Add/' . $projectId); ?>" type="button"><i class="fa fa-plus"></i> <?php echo lang('add_task'); ?></a>
        </div>
    </div>
    <div class="row">
        <div class="tab-content inside_body">
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
    </div>
    <div class="row">
        <div class="col-sm-6">
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
                        <li><a <?php if($view=='list'){?> class="active" <?php }?> href="<?php echo base_url('Project/completedProject/list');?>"><i title='<?php echo lang('listview'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a></li>
                    </ul>
                </div>
                <?php
                }
                else{
                ?>
                <div class="action-bar">
                    <ul class="list-inline m-b-0">
                        <li><h3 class="title_head"><?php echo lang('recently_updated'); ?></h3></li>
                        <li><a <?php if($view=='list'){?> class="active" <?php }?> href="<?php echo base_url('project/list');?>"><i title='<?php echo lang('listview'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a></li>
                    </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-right mT15">
            <form method="post" action="<?php echo $url; ?>" id="form-search">
                <ul class="list-inline m-b-0">
                    <li>
                        <div class="input-group">
                            <select class="form-control" name="members" onchange="addFilter();"   required maxlength="25" id="members" placeholder="<?php echo lang('teammembers'); ?>">
                                <option value="" ><?php echo lang('teammembers'); ?></option>
                                <?php
                                if (count($members) > 0) {
                                    foreach ($members as $member) {
                                        ?>
                                        <option value="<?php echo $member['_id']; ?>" id="elm_<?php echo $member['_id']; ?>"><?php echo $member['firstname'] . " " . $member['lastname']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div><!-- input-group -->
                    </li>
                    <li>
                        <div class="input-group">
                            <input type="text" name="duedate"   id="duedate" value="<?php echo isset($duedate) ? $duedate : ''; ?>" onchange="addFilter();" placeholder="<?php echo lang('due_date'); ?>" class="form-control">
                        </div><!-- input-group -->
                    </li>
                    <li>
                        <div class="input-group">
                            <select class="form-control" name="status"  onchange="addFilter();" required maxlength="25" id="status" placeholder="<?php echo lang('status'); ?>">
                                <option value="" ><?php echo lang('status'); ?></option>
                                <option value="0" ><?php echo lang('planned'); ?></option>
                                <option value="1" ><?php echo lang('inprogress'); ?></option>
                                <option value="2" ><?php echo lang('onhold'); ?></option>
                                <option value="3" ><?php echo lang('completed'); ?></option>
                                <option value="4" ><?php echo lang('overdue'); ?></option>
                            </select>
                        </div><!-- input-group -->
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
    <div id="replacementdiv">
        <?php echo $this->load->view('ListView'); ?>
    </div>
</div>


