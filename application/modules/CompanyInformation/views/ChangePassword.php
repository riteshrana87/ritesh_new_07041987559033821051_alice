<script>
    var view_name = 'ChangePassword';
</script>
<style>
.file_upload_label{
	text-align:left !important;
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
                <div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">

                            <form class="form-horizontal" enctype='multipart/form-data' role="form" id="ChangePasswordForm" name="ChangePasswordForm" method="post" action="<?php echo base_url('Profile/Change'); ?>">
                                        <div class="form-group">
                                            <label for="userName"><?php echo lang('current_password');?></label>
                                            <input type="text" id="current_password" name="current_password" class="form-control" placeholder="<?php echo lang('current_passwotd_placeholder');?>" required="" parsley-trigger="change" name="nick" data-parsley-id="4">
                                        </div>
                                        <div class="form-group">
                                            <label for="pass1"><?php echo lang('COMMON_LABEL_PASSWORD');?>*</label>
                                            <input type="password" class="form-control parsley-success" required="" placeholder="<?php echo lang('COMMON_LABEL_PASSWORD');?>" id="pass1" name="pass1" data-parsley-id="8">
                                        </div>
                                        <div class="form-group">
                                            <label for="passWord2"><?php echo lang('CONFIRM_PASSWORD');?> *</label>
                                            <input type="password" id="passWord2" name="passWord2" class="form-control" placeholder="<?php echo lang('CONFIRM_PASSWORD');?>" required="" data-parsley-equalto="#pass1" data-parsley-id="10"><ul class="parsley-errors-list filled" id="parsley-id-10"></ul>
                                        </div>
                                       
                                        <div class="form-group text-right m-b-0">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                <?php echo lang('submit');?>
                                            </button>
                                            <button class="btn btn-default waves-effect waves-light m-l-5" type="reset">
                                                <?php echo lang('COMMON_LABEL_CANCEL');?>
                                            </button>
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
