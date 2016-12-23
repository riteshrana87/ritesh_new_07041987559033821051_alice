<script>
    var view_name = 'Add';
</script>
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
        <div class="col-lg-8 col-lg-offset-2">
            <div class="add_client_header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></div>
            <div class="card-box form_field">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-horizontal" role="form" id="UserForm" name="UserForm" method="post" action="<?php echo base_url('TeamMember/InsertData'); ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="text" name="firstname"  maxlength="25" id="firstname" class="form-control" required placeholder="<?php echo lang('firstname'); ?> *">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="lastname"  maxlength="25" id="lastname" class="form-control" required placeholder="<?php echo lang('lastname'); ?> *">
                                </div>
                            </div>
                              <div class="form-group">
                                <div class="col-md-6">
                                    <input type="email" name="email"  maxlength="50" id="email" class="form-control" placeholder="<?php echo lang('email'); ?> *" required parsley-type="email">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="phone" id="phone" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="25" class="form-control" placeholder="<?php echo lang('phone_no'); ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="password" id="password"  maxlength="50" name="password" class="form-control" required placeholder="<?php echo lang('PASSWORD'); ?> *">
                                </div>
                                <div class="col-md-6">
                                    <input type="password" id="cpassword"  maxlength="50"  name="cpassword" class="form-control" data-parsley-equalto="#password" required="" placeholder="<?php echo lang('CONFIRM_PASSWORD'); ?> *">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="file" id="profile_image" name="profile_image"   data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/png">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button name="submit" id="submit" class="btn btn-success btn-lg waves-effect waves-light" type="submit"><?php echo lang('add_team_member'); ?></button>
                                    <button class="btn btn-default btn-lg waves-effect waves-light m-l-5" onclick="goBack()" type="reset">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>