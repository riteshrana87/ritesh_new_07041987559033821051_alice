<script>
    var view_name = 'Add';
</script>
<style>
.file_upload_label{
	text-align:left !important;
}
.checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"], .radio input[type="radio"], .radio-inline input[type="radio"] {
  margin-left: 20px;
  position: relative;
}
</style>
<div class="content">
    <div class="container">

        <?php if ($this->session->flashdata('error')) {
            ?>
            <?php echo $this->session->flashdata('error'); ?>
        <?php } ?>
        <?php if ($this->session->flashdata('message')) {
            ?>
            <?php echo $this->session->flashdata('message'); ?>
        <?php } ?>
        <div class="row">
            <div class="col-sm-8">
                <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
                <?php
				if(!empty($useremailsettings[0])){
					$base = base_url('EmailSettings/UpdateData') ; 
					$user_id = $useremailsettings[0]['_id'];
				}
				else{
					$base =  base_url('EmailSettings/InsertData') ;
					$user_id = '';
				}
				?>
				<div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">
							
                            <form class="form-horizontal" enctype='multipart/form-data' role="form" id="ClientForm" name="ClientForm" method="post" action="<?php echo $base; ?>">
								
								<?php //print_r(!empty($useremailsettings[0]));
								//die(); ?>
								<h4 class="page-header header-title"> <?php echo lang('smtpsettings'); ?>: </h4>
							   <div class="form-group">
                                    
									<input type="hidden" name="_id" id="_id" value="<?php echo $user_id ?>" />
									
									<div class="col-md-6">
                                        <input type="text" name="smtpfromemail"  maxlength="25" id="smtpfromemail" class="form-control" required placeholder="<?php echo lang('fromemail'); ?>" 
										 value="<?php if(!empty($useremailsettings[0]['smtpfromemail'])){ echo $useremailsettings[0]['smtpfromemail']; } ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="smtpfromname"  maxlength="25" id="smtpfromname" class="form-control" required placeholder="<?php echo lang('fromname'); ?>" 
										value="<?php if(!empty($useremailsettings[0]['smtpfromname'])){ echo $useremailsettings[0]['smtpfromname']; } ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                   
									 <div class="col-md-6">
                                        <input type="text" name="smtphost"  maxlength="25" id="smtphost" class="form-control" required placeholder="<?php echo lang('smtphost'); ?>" 
										value="<?php if(!empty($useremailsettings[0]['smtphost'])){ echo $useremailsettings[0]['smtphost']; }?>">
									</div>
                                    
                                </div>
									
								 <div class="form-group">
                                    <div class="col-md-12">
                                    <label class="col-md-3 control-label file_upload_label"><?php echo lang('typeofencryption') ?></label>
									<div class="radio radio-primary">
                                                <input type="radio" value="none" id="smtptypeofencryption" name="smtptypeofencryption" <?php if(!empty($useremailsettings[0]['smtptypeofencryption'])){ 
												if($useremailsettings[0]['smtptypeofencryption'] == 'none'){ echo 'checked=""'; } } else { echo 'checked=""'; }  ?> >
                                                <label for="radio3"> None </label> 
												<input type="radio" value="SSL" id="smtptypeofencryption" name="smtptypeofencryption" <?php if(!empty($useremailsettings[0]['smtptypeofencryption'])){ 
												if($useremailsettings[0]['smtptypeofencryption'] == 'SSL'){ echo 'checked=""'; } } ?> >
                                                <label for="radio3"> SSL </label> 
												<input type="radio" value="TLS" id="smtptypeofencryption" name="smtptypeofencryption" <?php if(!empty($useremailsettings[0]['smtptypeofencryption'])){ 
												if($useremailsettings[0]['smtptypeofencryption'] == 'TLS'){ echo 'checked=""'; } } ?>>
                                                <label for="radio3"> TLS </label>
                                            </div>
									</div>
                                </div> 
								
                                <div class="form-group">
									<div class="col-md-6">
											<input type="text" onkeypress="return isNumber(event)" name="smtpport" id="smtpport" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="5" required class="form-control" placeholder="<?php echo lang('smtpport'); ?> - 1" value="<?php if(!empty($useremailsettings[0]['smtpport'])){ echo $useremailsettings[0]['smtpport']; }?>"> 
									</div>
									
                                </div>
								
								 <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="col-md-3 control-label file_upload_label"><?php echo lang('smtpauthentication') ?></label>
									<div class="radio radio-primary">
                                                <input type="radio" value="no" checked="" id="smtpauthentication" name="smtpauthentication" <?php if(!empty($useremailsettings[0]['smtpauthentication'])){ if($useremailsettings[0]['smtpauthentication'] == 'no'){ echo 'checked=""'; } } else { echo 'checked=""'; }  ?>>
                                                <label for="radio3"> No </label> 
												<input type="radio" value="yes" id="smtpauthentication" name="smtpauthentication" <?php if(!empty($useremailsettings[0]['smtpauthentication'])){ if($useremailsettings[0]['smtpauthentication'] == 'yes'){ echo 'checked=""'; } } ?> >
                                                <label for="radio3"> Yes </label>
                                            </div>
									</div>
                                </div>
								
                                <div  class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="smtpusername" id="smtpusername" class="form-control"  maxlength="10" value="<?php if(!empty($useremailsettings[0]['smtpusername'])){ echo $useremailsettings[0]['smtpusername']; } ?>" required placeholder="<?php echo lang('smtpusername'); ?>"  >
                                    </div>
                                     <div class="col-md-6">
                                      <input type="password" name="smtpupassword" required id="smtpupassword" class="form-control"  maxlength="25" value="<?php if(!empty($useremailsettings[0]['smtpupassword'])){ echo $useremailsettings[0]['smtpupassword']; }?>" placeholder="<?php echo lang('smtpupassword'); ?>">
                                    </div>
                                </div>
								
								<h4 class="page-header header-title"> <?php echo lang('imapsettings'); ?>: </h4>
								
								<div class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" name="imapfromemail"  maxlength="25" id="imapfromemail" class="form-control" required placeholder="<?php echo lang('imapfromemail'); ?>" 
										 value="<?php if(!empty($useremailsettings[0]['imapfromemail'])){ echo $useremailsettings[0]['imapfromemail']; } ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="imapfromname"  maxlength="25" id="imapfromname" class="form-control" required placeholder="<?php echo lang('imapfromname'); ?>" 
										value="<?php if(!empty($useremailsettings[0]['imapfromname'])){ echo $useremailsettings[0]['imapfromname']; } ?>">
                                    </div>
                                </div>

                                <div class="form-group">
									 <div class="col-md-6">
                                        <input type="text" name="imaphost"  maxlength="25" id="imaphost" class="form-control" required placeholder="<?php echo lang('imaphost'); ?>" 
										value="<?php if(!empty($useremailsettings[0]['imaphost'])){ echo $useremailsettings[0]['imaphost']; }?>">
									</div>
                                    
                                </div>
									
								<!-- <div class="form-group">
									<div class="radio radio-primary">
                                                <input type="radio" value="none" checked="" id="smtptypeofencryption" name="smtptypeofencryption">
                                                <label for="radio3"> None </label> 
												<input type="radio" value="SSL" id="smtptypeofencryption" name="smtptypeofencryption">
                                                <label for="radio3"> SSL </label> 
												<input type="radio" value="TLS" id="smtptypeofencryption" name="smtptypeofencryption">
                                                <label for="radio3"> TLS </label>
                                    </div>
								</div> -->
								
                                <div class="form-group">
									<div class="col-md-6">
										<input type="text" onkeypress="return isNumber(event)" name="imapport" id="imapport" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="5" required class="form-control" placeholder="<?php echo lang('imapport'); ?> - 1" value="<?php if(!empty($useremailsettings[0]['imapport'])){ echo $useremailsettings[0]['imapport']; }?>"> 
									</div>
									
                                </div>
								
								 <!-- <div class="form-group">
                                    <div class="col-md-12">
                                    
									<div class="radio radio-primary">
                                                <input type="radio" value="no" checked="" id="smtpauthentication" name="smtpauthentication">
                                                <label for="radio3"> No </label> 
												<input type="radio" value="yes" id="smtpauthentication" name="smtpauthentication">
                                                <label for="radio3"> Yes </label>
                                            </div>
									</div>
                                </div> -->
								
                                <div  class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="imapusername" id="imapusername" class="form-control"  maxlength="10" value="<?php if(!empty($useremailsettings[0]['imapusername'])){ echo $useremailsettings[0]['imapusername']; } ?>" required placeholder="<?php echo lang('imapusername'); ?>"  >
                                    </div>
                                     <div class="col-md-6">
                                      <input type="password" name="imappassword" required id="imappassword" class="form-control"  maxlength="25" value="<?php if(!empty($useremailsettings[0]['imappassword'])){ echo $useremailsettings[0]['imappassword']; }?>" placeholder="<?php echo lang('imappassword'); ?>">
                                    </div>
                                </div>
								
								
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('save_settings'); ?>
                                        </button>
                                        <button class="btn btn-default waves-effect waves-light m-l-5" type="reset">
                                            Cancel
                                        </button>
                                    </div>
                                </div> 
                            </form>
                        </div><!-- end col -->



                    </div><!-- end row -->
                </div>

            </div><!-- end col -->
            <div class="col-sm-4">
                <div class="col-lg-12">
                    <h4 class="page-header header-title"><?php echo lang('client_settings_followup'); ?></h4>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card-box widget-user">
                                <div class="col-lg-10">
                                    <i  class="ti-timer"></i>
                                    <div class="wid-u-info">
                                        <h4 class="m-t-0 m-b-5"><?php echo lang('send_reminders'); ?></h4>
                                        <p class="text-muted m-b-5 font-13"><?php echo lang('send_reminders_text'); ?></p>

                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <i class="ti-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card-box widget-user">
                                <div>
                                    <img alt="user" class="img-responsive img-circle" src="assets/images/users/avatar-3.jpg">
                                    <div class="wid-u-info">
                                        <h4 class="m-t-0 m-b-5">Chadengle</h4>
                                        <p class="text-muted m-b-5 font-13">coderthemes@gmail.com</p>
                                        <small class="text-warning"><b>Admin</b></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card-box widget-user">
                                <div>
                                    <img alt="user" class="img-responsive img-circle" src="assets/images/users/avatar-3.jpg">
                                    <div class="wid-u-info">
                                        <h4 class="m-t-0 m-b-5">Chadengle</h4>
                                        <p class="text-muted m-b-5 font-13">coderthemes@gmail.com</p>
                                        <small class="text-warning"><b>Admin</b></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div>
        </div>
        <!-- end row -->


    </div> <!-- container -->

</div> <!-- content -->
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>