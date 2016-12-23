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
        <div class="col-md-8">
            <div class="add_client_header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></div>
            <div class="card-box form_field">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-horizontal" role="form" id="TaskForm" name="TaskForm" method="post" action="<?php echo base_url('Task/InsertData'); ?>">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="text" name="taskname"  maxlength="25" id="taskname" class="form-control" required placeholder="<?php echo lang('task_name'); ?> *">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4"><?php echo lang('start_date'); ?></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" required name="startdate" id="startdate" placeholder=" / / *" class="form-control">
                                                <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <select multiple="" class="select2" name="members[]" required maxlength="25" id="members" placeholder="<?php echo lang('teammembers'); ?> *">
                                        <option value="" ></option>
                                        <?php
                                        if (count($members) > 0) {
                                            foreach ($members as $member) {
                                                ?>
                                                <option value="<?php echo $member['_id']; ?>"><?php echo $member['firstname'] . " " . $member['lastname']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4"><?php echo lang('due_date'); ?></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" name="duedate" required id="duedate" placeholder=" / / *" class="form-control">
                                                <span class="input-group-addon bg-primary b-0 text-white" ><i class="ti-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <input type="hidden" name="projectid" value="<?php echo $project_id;?>">
                                    <button name="submit" id="submit" class="btn btn-success btn-lg waves-effect waves-light" type="submit">
                                        <?php echo lang('create_task'); ?>
                                    </button>
                                    <button class="btn btn-default btn-lg waves-effect waves-light m-l-5" onclick="goBack()" type="reset">
                                        <?php echo lang('COMMON_LABEL_CANCEL'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>
        </div><!-- end col -->
        <div class="col-md-4">
            <div class="card-box right_side_form">
                <h4 class="header-title m-t-0 m-b-30"><?php echo lang('client_settings_followup'); ?></h4>
                <div class="inbox-widget nicescroll">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default bx-shadow-none">
                            <div class="panel-heading" role="tab" id="headingSecond">
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

