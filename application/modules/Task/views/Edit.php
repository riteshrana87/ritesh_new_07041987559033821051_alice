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
        <div class="col-sm-8">
            <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
            <div class="card-box">

                <div class="row">
                    <div class="col-lg-12">

                        <form class="form-horizontal" role="form" id="TaskForm" name="TaskForm" method="post" action="<?php echo base_url('Task/UpdateData'); ?>">
                            <div class="form-group">

                                <div class="col-md-6">
                                    <input type="text" name="taskname"  maxlength="25" id="taskname" class="form-control" required placeholder="<?php echo lang('task_name'); ?> *" value="<?php echo $data[0]['taskname']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4"><?php echo lang('start_date'); ?></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text"  name="startdate" required value="<?php echo $data[0]['start_date']; ?>"  id="startdate" placeholder=" / / *" class="form-control">
                                                <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <select multiple="" class="select2" name="members[]"  required maxlength="25" id="members" placeholder="<?php echo lang('teammembers'); ?> *">
                                        <option value="" ></option>
                                        <?php
                                        if (count($members) > 0) {
                                            foreach ($members as $member) {
                                                ?>
                                                <option value="<?php echo $member['_id']; ?>" <?php echo (in_array($member['_id'], $dbmembers)) ? 'selected' : 'x'; ?>><?php echo $member['firstname'] . " " . $member['lastname']; ?></option>
                                            <?php } ?>
                                        <?php } ?>

                                    </select>


                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="control-label col-sm-4"><?php echo lang('due_date'); ?></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" name="duedate" required value="<?php echo $data[0]['due_date']; ?>"   id="duedate" placeholder=" / / *" class="form-control">
                                                <span class="input-group-addon bg-primary b-0 text-white" ><i class="ti-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="hidden" name="_id" value="<?php echo $data[0]['_id']; ?>">
                                    <input type="hidden" name="projectid" value="<?php echo $this->input->get('project'); ?>">

                                    <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                        <?php echo lang('update_task'); ?>
                                    </button>
                                    <button class="btn btn-default waves-effect waves-light m-l-5" onclick="goBack()" type="reset">
                                        <?php echo lang('COMMON_LABEL_CANCEL'); ?>
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
            </div>
        </div>
    </div>
</div>

