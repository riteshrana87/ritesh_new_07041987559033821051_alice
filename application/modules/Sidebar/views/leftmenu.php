<style>
    .img-thumbnail{
        height:90px;
    }
</style>
<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                <?php
                if (!empty($user_details[0]['profile_picture'])) {
                    $profile_img = base_url("/uploads/profile_images/" . $user_details[0]['profile_picture']);
                } else {
                    $profile_img = base_url("/uploads/profile_images/boy-512.png");
                }

                if (!empty($user_details[0]['firstname'])) {
                    $image_title = $this->session->userdata['alice_session']['firstname'] . ' ' . $this->session->userdata['alice_session']['lastname'];
                } else {
                    $image_title = '';
                }
                ?>

                <img src="<?php echo $profile_img ?>" alt="user-img" title="<?php echo $image_title ?>" class="img-circle img-thumbnail img-responsive">


                <div class="user-status offline">
                    <i class="zmdi zmdi-dot-circle"></i>
                </div>
            </div>
            <h5>
                <a href="#" class="profile_name">
                    <?php echo $this->session->userdata['alice_session']['firstname'] . ' ' . $this->session->userdata['alice_session']['lastname'] ?>
                </a>
            </h5>
            <ul class="list-inline">
                <li>
                    <a href="<?php echo base_url('Profile'); ?>">
                    <i class="zmdi zmdi-settings profile_icon"></i>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url('Logout'); ?>"class="text-custom">

                    <i class="zmdi zmdi-power profile_icon"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End User -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">Navigation</li>

                <li>
                    <a href="<?php echo base_url('Dashboard'); ?>" class="waves-effect <?php if($cur_viewname==lang('dashboard')){?>active<?php }?>"><i class="ti-home"></i> <span>  <?php echo lang('dashboard'); ?> </span> </a>
                </li>

                <li>
                    <a href="<?php echo base_url('Client'); ?>" class="waves-effect <?php if($cur_viewname=='Client'){?>active<?php }?>"><i class="ti-face-smile"></i> <span> <?php echo lang('clients'); ?> </span> </a>
                </li>
                <li>
                    <a href="<?php echo base_url('Invoice'); ?>" class="waves-effect <?php if($cur_viewname=='Invoice'){?>active<?php }?>"><i class="ti-file"></i> <span> <?php echo lang('invoices'); ?> </span> </a>
                </li>
                <li>
                    <a href="<?php echo base_url('Product'); ?>" class="waves-effect <?php if($cur_viewname=='Product'){?>active<?php }?>"><i class="ti-gift"></i> <span> <?php echo lang('products'); ?> </span> </a>
                </li>
                <li>
                    <a href="<?php echo base_url('Expenses'); ?>" class="waves-effect <?php if($cur_viewname==lang('expenses')){?>active<?php }?>"><i class="zmdi zmdi-money-box"></i> <span> <?php echo lang('expenses'); ?> </span> </a>
                </li>
                <li>
                    <a href="<?php echo base_url('Reports'); ?>" class="waves-effect <?php if($cur_viewname==lang('report')){?>active<?php }?>"><i class="ti-pie-chart"></i> <span> <?php echo lang('report'); ?> </span> </a>
                </li>
                
                 <li>
                    <a href="<?php echo base_url('Journals'); ?>" class="waves-effect <?php if($cur_viewname=='Journals'){?>active<?php }?>"><i class="ti-pie-chart"></i> <span> <?php echo lang('journal'); ?> </span> </a>
                </li>
                
                
                <li class="has_sub">
                    <a href="<?php echo base_url('Project'); ?>" class="waves-effect <?php if($cur_viewname=='project' || $cur_viewname=='Project'){?>active<?php }?>"><i class="zmdi zmdi-settings"></i> <span> <?php echo lang('projects'); ?> </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a class="<?php if($cur_viewname==lang('Task')){?>active<?php }?>" href="<?php echo base_url('Task'); ?>"><i class="ti-list"></i> <span> <?php echo lang('Task'); ?> </span></a></li>
                        <li><a class="<?php if($cur_viewname==lang('teammembers')){?>active<?php }?>" href="<?php echo base_url('TeamMember'); ?>"><i class="zmdi zmdi-accounts"></i> <span> <?php echo lang('teammembers'); ?> </span></a></li>
                    </ul>

                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-settings"></i> <span> <?php echo lang('settings'); ?> </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a class="waves-effect <?php if($cur_viewname==lang('TAX_SETTING_OPT')){?>active<?php }?>" href="<?php echo base_url('Tax'); ?>"><i class="zmdi zmdi-tv"></i> <span> <?php echo lang('TAX_SETTING_OPT'); ?> </span></a></li>
                        <li><a class="waves-effect <?php if($cur_viewname==lang('currency')){?>active<?php }?>" href="<?php echo base_url('Currency'); ?>"><i class="zmdi zmdi-tv"></i> <span> <?php echo lang('currency'); ?> </span></a></li>
                        <li><a class="waves-effect <?php if($cur_viewname==lang('category')){?>active<?php }?>" href="<?php echo base_url('Category'); ?>"><i class="zmdi zmdi-tv"></i> <span> <?php echo lang('category'); ?> </span></a></li>

                        <li><a class="waves-effect <?php if($cur_viewname==lang('CompanyInformation')){?>active<?php }?>" href="<?php echo base_url('CompanyInformation'); ?>"><i class="zmdi zmdi-tv"></i> <span> <?php echo lang('CompanyInformation'); ?> </span></a></li>
                    </ul>

                </li>
                <li>
                    <a href="<?php echo base_url('Logout'); ?>" class="waves-effect"><i class="zmdi zmdi-power"></i> <span> <?php echo lang('logout'); ?> </span> </a>
                </li>



            </ul>

            <div class="clearfix"></div>
        </div>
        <div style="float:left;">

            <div>
                <h3>
                    <center>
                        <?php echo lang('ask_frd'); ?>
                    </center>
                </h3>

                <div class="col-sm-offset-0 col-sm-12">
                    <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light left_click_btn" type="submit">
                        <?php echo lang('accoutant'); ?>
                    </button>
                    <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light left_click_btn" type="submit">
                        <?php echo lang('lawyer'); ?>
                    </button>
                    <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light left_click_btn" type="submit">
                        <?php echo lang('reclamation'); ?>
                    </button>
                    <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light left_click_btn" type="submit">
                        <?php echo lang('support'); ?>
                    </button>

                </div>
            </div>


        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
</div>
<!-- Left Sidebar End -->
