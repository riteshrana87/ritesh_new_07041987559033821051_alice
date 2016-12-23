<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title><?php echo $title;?></title>

        <!-- App CSS -->
        <link href="<?php echo base_url('uploads/assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('uploads/assets/css/core.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('uploads/assets/css/components.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('uploads/assets/css/icons.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('uploads/assets/css/pages.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('uploads/assets/css/menu.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('uploads/assets/css/responsive.css');?>" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="<?php echo base_url('uploads/assets/js/modernizr.min.js');?>"></script>
        
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
            <div class="text-center">
                <a href="<?php echo base_url();?>" class="logo">
					
					<img src="<?= base_url() ?>uploads/company_logo/Simply_smart_bookkeeping.png" alt="" style="width: 146px;"/>
                
                </a>
                <!--<h5 class="text-muted m-t-0 font-600">Responsive Admin Dashboard</h5> -->
            </div>
        	<div class="m-t-40 card-box" style="margin-top:20px !important;">
                <div class="text-center">
				 <?php if($this->session->flashdata('error'))
					{ ?>
      <?php echo $this->session->flashdata('error'); ?>
      <?php 	} ?>
                    <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
                </div>
                <div class="panel-body">
				
				
                    <form id='LoginForm' data-parsley-validate="" class="form-horizontal m-t-20" action="<?php echo base_url('Login/Validate');?>" method="post">

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" required parsley-type="email"  placeholder="Email" name="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" placeholder="Password" name="password">
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-xs-12">
                                <div class="checkbox checkbox-custom">
                                    <input name="remember_me" id="remember_me" type="checkbox">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
							<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">Log In</button>
                               
                            </div>
                        </div>

                        <div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12">
                                <a href="<?php echo base_url('Login/forgotpassword');?>" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- end card-box-->

            <div class="row">
                <div class="col-sm-12 text-center">
                  <!--   <p class="text-muted">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p> -->
                </div>
            </div>
            
        </div>
        <!-- end wrapper page -->
        

        
    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url('uploads/assets/js/jquery.min.js');?>"></script>
        <script src="<?php echo base_url('uploads/assets/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('uploads/assets/js/detect.js');?>"></script>
        <script src="<?php echo base_url('uploads/assets/js/fastclick.js');?>"></script>
        <script src="<?php echo base_url('uploads/assets/js/jquery.slimscroll.js');?>"></script>
        <script src="<?php echo base_url('uploads/assets/js/jquery.blockUI.js');?>"></script>
        <script src="<?php echo base_url('uploads/assets/js/waves.js');?>"></script>
        <script src="<?php echo base_url('uploads/assets/js/wow.min.js');?>"></script>
        <script src="<?php echo base_url('uploads/assets/js/jquery.nicescroll.js');?>"></script>
        <script src="<?php echo base_url('uploads/assets/js/jquery.scrollTo.min.js');?>"></script>

        <!-- App js  -->
        <script src="<?php echo base_url('uploads/assets/js/jquery.core.js');?>"></script>
              <script type="text/javascript" src="<?php echo base_url('uploads/assets/plugins/parsleyjs/dist/parsley.min.js');?>"></script>
	<script>
	$('document').ready(function(){
	$('#LoginForm').parsley();
	});
	</script>
	</body>
</html>
