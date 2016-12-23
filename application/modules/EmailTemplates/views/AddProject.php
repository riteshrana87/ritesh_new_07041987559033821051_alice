<script>
    var view_name = 'Add';
</script>
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

                            <form class="form-horizontal" role="form" id="ProjectForm" name="ProjectForm" method="post" action="<?php echo base_url('Project/InsertData'); ?>">
                                <div class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="projectname"  maxlength="25" id="projectname" class="form-control" required placeholder="<?php echo lang('project_name'); ?>">
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="control-label col-sm-4"><?php echo lang('start_date'); ?></label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text"  name="startdate"  id="startdate" placeholder=" / / " class="form-control">
                                                    <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-md-6">
                                        <select multiple="multiple" class="select2" name="clientid"  required maxlength="25" id="clientid" placeholder="<?php echo lang('client_name'); ?>">
                                         
                                             <?php if(count($clients)>0){
                                                foreach($clients as $client){
                                                    
                                                ?>
                                            <option <?php echo $client['_id'];?>><?php echo $client['firstname']." ".$client['lastname'];?></option>
                                            <?php }?>
                                            <?php }?>
                                                
                                        </select>

                                   
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="control-label col-sm-4"><?php echo lang('due_date'); ?></label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" name="duedate"   id="duedate" placeholder=" / / " class="form-control">
                                                    <span class="input-group-addon bg-primary b-0 text-white" ><i class="ti-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                  <h4 class="page-header header-title"></h4>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea id="description" name="description" ></textarea>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-4">
                                        <input type="text" name="hourlyprice"  maxlength="50" id="hourlyprice" class="form-control" placeholder="<?php echo lang('hourly_price'); ?>"  >
                                    </div>
                                    <div class="col-md-2 text-center">
                                        or
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="fixedprojectprice"  maxlength="50" id="fixedprojectprice" class="form-control" placeholder="<?php echo lang('fixed_project_price'); ?>"  >
                                    </div>
                                </div>
                            
                               

                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('create_project'); ?>
                                        </button>
                                        <button class="btn btn-default waves-effect waves-light m-l-5" onclick="goBack()" type="reset">
                                            <?php echo lang('COMMON_LABEL_CANCEL');?>
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
