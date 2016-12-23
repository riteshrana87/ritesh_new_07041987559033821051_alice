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
                        <form class="form-horizontal" role="form" id="ProjectForm" name="ProjectForm" method="post" action="<?php echo base_url('Project/InsertData'); ?>">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="text" name="projectname"  maxlength="25" id="projectname" class="form-control" required placeholder="<?php echo lang('project_name'); ?> *">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4"><?php echo lang('start_date'); ?></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text"  name="startdate" required id="startdate" placeholder=" / / *" class="form-control">
                                                <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <select class="select2" name="clientid" style="border: 1px solid #d2d2d2; border-radius: 4px; width: 100%;" required maxlength="25" id="clientid" placeholder="<?php echo lang('client_name'); ?>">
                                        <option value="" selected=""></option>
                                        <?php if(count($clients)>0){
                                            foreach($clients as $client){
                                                ?>
                                                <option value="<?php echo $client['_id'];?>"><?php echo $client['firstname']." ".$client['lastname'];?></option>
                                            <?php }?>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4"><?php echo lang('due_date'); ?></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" name="duedate"  required id="duedate" placeholder=" / / *" class="form-control">
                                                <span class="input-group-addon bg-primary b-0 text-white" ><i class="ti-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea id="description" name="description" ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-2"><input type="text" name="hourlyprice"  maxlength="50" id="hourlyprice" class="form-control" placeholder="<?php echo lang('hourly_price'); ?>"></div>
                                <div class="col-md-1 text-center">or</div>
                                <div class="col-md-3"><input type="text" name="fixedprojectprice"  maxlength="50" id="fixedprojectprice" class="form-control" placeholder="<?php echo lang('fixed_project_price'); ?>"></div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button name="submit" id="submit" class="btn btn-success btn-lg waves-effect waves-light" type="submit"><?php echo lang('create_project'); ?></button>
                                    <button class="btn btn-default btn-lg waves-effect waves-light m-l-5" onclick="goBack()" type="reset"><?php echo lang('COMMON_LABEL_CANCEL');?></button>
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
                            <div class="panel-heading" role="tab" id="headingOne">
                                <div class="icon">
                                    <img src="<?php echo base_url(); ?>/uploads/assets/images/client_add/set-alarm.svg"/>
                                </div>
                                <div class="panel-title">
                                    <a class="" role="button" href="#"><?php echo lang('send_reminders'); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default bx-shadow-none">
                            <div class="panel-heading" role="tab" id="headingSecond">
                                <div class="icon">
                                    <img src="<?php echo base_url(); ?>/uploads/assets/images/client_add/atm.svg"/>
                                </div>
                                <div class="panel-title">
                                    <a class="" role="button" href="<?php echo base_url('TeamMember/Add');?>"><?php echo lang('add_teammembers_to_project'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
