<style type="text/css">
    .box{
        float:right;
        overflow: hidden;
        background: #f0e68c;
        position: fixed;
		top: 498px;
		width:130px;
    }
    /* Add padding and border to inner content
    for better animation effect */
    .box-inner{
        //width: 400px;
        padding: 10px;
        border: 1px solid #a29415;
    }
    .imagelarge{
		height:200px;
		width:200px;
		}
		
	
</style>
<!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="<?php echo base_url();?>" class="logo">
                    
						<img src="<?= base_url() ?>uploads/company_logo/Simply_smart_bookkeeping.png" alt="" style="width: 146px;"/>
                    
                    </a>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Page title -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                            </li>
                            <li>
                                <h4 class="page-title"><?php echo(isset($title))?$title:'';?></h4>
                            </li>
                        </ul>

                        <!-- Right(Notification and Searchbox -->
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <!-- Notification -->
                                <div class="notification-box">
                                    <ul class="list-inline m-b-0">
                                        <li>
                                            <a href="javascript:void(0);" class="right-bar-toggle">
                                                <i class="zmdi zmdi-notifications-none"></i>
                                            </a>
                                            <div class="noti-dot">
                                                <span class="dot"></span>
                                                <span class="pulse"></span>
                                              
                                            </div>
                                            
                                        </li>
                                    </ul>
                                    
                                </div>
                                <div style="clear:both;"></div>
                               
                                <!-- End Notification bar -->
                            </li>
                            <li class="hidden-xs">
                                <form role="search" class="app-search">
                                    <input type="text" placeholder="Search..."
                                           class="form-control">
                                    <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>
                        </ul>
 
                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>
            <!-- Top Bar End -->
            <div class="side-bar right-bar">
                <a href="javascript:void(0);" class="right-bar-toggle">
                    <i class="zmdi zmdi-close-circle-o"></i>
                </a>
                <h4 class="">Notifications</h4>
                <div class="notification-list nicescroll">
                    <ul class="list-group list-no-border user-list">
                        <?php 
                            foreach($notification_Arr as $notification){
                               ?>
                                      <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-2.jpg" alt="">
                                </div>
                                <div class="user-desc">
                                    <span class="name"><?php echo $notification['invoice']['invoice_code'];?></span>
                                    <span class="desc"><?php echo $notification['invoice']['total_payment'];?></span>
                                    <span class="time"><?php echo $notification['status'];?></span>
                                    <?php if($notification['net_payment_paid'] > 0){ ?>
                                     <span class="desc">paid-<?php echo $notification['currency'].' '.$notification['net_payment_paid'];?></span>
                                     <span class="desc">due-<?php echo $notification['currency'].' '.$notification['net_due'];?></span>
                            <?php }?>
                                </div>
                            </a>
                        </li>
                      <?php  } ?>
                      
                    </ul>
                </div>
            </div>


<div class="alice_main_class">
    <span class="name-alice panel_title">ALICE</span>
    
    <img  id="imgtab" class='slide-toggle cursor'  src="<?php echo base_url('/uploads/assets/images/users/avatar-1.png');?>"/>
    
    <div class="box">
        <div class="box-inner"><?php echo lang('alice_msg1');?>&nbsp;<?php echo $view;?>&nbsp;<?php echo lang('alice_msg2');?>
		<button class="thanks">Thanks</button>
		<button class="help">I need Help</button>
         </div>
    </div>
</div>
