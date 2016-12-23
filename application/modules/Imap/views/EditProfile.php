<script>
    var view_name = 'Edit';
</script>
<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-sm-8">
                <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-horizontal" role="form" id="ClientForm" name="ClientForm" method="post" action="<?php echo base_url('Client/UpdateData'); ?>">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" name="firstname"  maxlength="25" id="firstname" class="form-control" value="<?php echo $client[0]['firstname']; ?>" required placeholder="<?php echo lang('firstname'); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="lastname"  maxlength="25" id="lastname" class="form-control" value="<?php echo $client[0]['lastname']; ?>" required placeholder="<?php echo lang('lastname'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" id="company"  maxlength="50" name="company" value="<?php echo $client[0]['company']; ?>" class="form-control" required placeholder="<?php echo lang('company'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="email"  maxlength="50" id="email" class="form-control" value="<?php echo $client[0]['email']; ?>" placeholder="<?php echo lang('email'); ?>" required parsley-type="email">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="phone" id="phone" value="<?php echo $client[0]['phone']; ?>" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="25" required class="form-control" placeholder="<?php echo lang('phone_no'); ?>">
                                    </div>
                                </div>
                                <h4 class="page-header header-title"></h4>
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input type="text" id="address" name="address" placeholder="<?php echo lang('ADDRESS_1'); ?>" value="<?php echo $client[0]['address']; ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div  class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="zipcode" id="zipcode" class="form-control" value="<?php echo $client[0]['zipcode']; ?>"  maxlength="10" required placeholder="<?php echo lang('zipcode'); ?>"  >
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="city" required id="city" class="form-control" value="<?php echo $client[0]['city']; ?>"  maxlength="25" placeholder="<?php echo lang('city'); ?>">
                                    </div>
                                </div>

                                <div  class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="state" id="state" class="form-control" value="<?php echo $client[0]['state']; ?>"  maxlength="25" required placeholder="<?php echo lang('state'); ?>" >
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="country" required id="country" class="form-control" value="<?php echo $client[0]['country']; ?>"  maxlength="25" placeholder="<?php echo lang('country'); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <input type="hidden" name="_id"  id="_id" value="<?php echo $client[0]['_id']; ?>"  >
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('update_client'); ?>
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