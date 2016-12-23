<script>
    var view_name = 'Edit';
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
            <div class="col-sm-12">
                <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
                <div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">
<?php echo form_open_multipart(base_url('TeamMember/UpdateData'),array('class'=>'form-horizontal','role'=>'form','id'=>'UserForm','name'=>'UserForm','method'=>'post'));?>
                                <div class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="firstname"  maxlength="25" id="firstname" class="form-control" required placeholder="<?php echo lang('firstname'); ?> *" value="<?php echo $dataset[0]['firstname'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="lastname"  maxlength="25" id="lastname" class="form-control" required placeholder="<?php echo lang('lastname'); ?> *" value="<?php echo $dataset[0]['lastname'];?>">
                                    </div>
                                </div>
                                  <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="email" name="email"  maxlength="50" id="email" class="form-control" placeholder="<?php echo lang('email'); ?> *" required parsley-type="email" value="<?php echo $dataset[0]['email'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="contact_no" id="contact_no" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="25" class="form-control" placeholder="<?php echo lang('phone_no'); ?>" value="<?php echo $dataset[0]['contact_no'];?>"> 
                                    </div>
                                </div>
                                 <h4 class="page-header header-title"></h4>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="password" id="password"  maxlength="50" name="password" class="form-control" data-parsley-trigger="change" placeholder="<?php echo lang('PASSWORD'); ?>" >
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" id="cpassword"  maxlength="50"  name="cpassword" class="form-control" data-parsley-equalto="#password" data-parsley-trigger="change" placeholder="<?php echo lang('CONFIRM_PASSWORD'); ?>" >
                                    </div>
                                </div>

                              
                                <h4 class="page-header header-title"></h4>
                                <div class="form-group">

                                    <div class="col-md-6">
                                        <input type="file" id="profile_image" name="profile_image"   data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/png">
                                    </div>
                                        <?php 
                                        if($dataset[0]['profile_picture']!='' && file_exists($this->config->item('profile_image_root_url').$dataset[0]['profile_picture']))
                                             {?>
                                         <div class="col-md-6">
                                             <img src="<?php echo $this->config->item('profile_image_base_url').$dataset[0]['profile_picture'];?>" class="img-responsive"> 
                                         </div>
                                      <?php }?>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <input type="hidden" value="<?php echo $dataset[0]['profile_picture'];?>" name="old_image">
                                        <input type="hidden" value="<?php echo $dataset[0]['_id'];?>" name="_id">
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('update_team_member'); ?>
                                        </button>
                                        <button class="btn btn-default waves-effect waves-light m-l-5" onclick="goBack()" type="reset">
                                            Cancel
                                        </button>
                                    </div>
                                </div> 
                            </form>
                        </div><!-- end col -->



                    </div><!-- end row -->
                </div>

            </div><!-- end col -->
   
        </div>
        <!-- end row -->


    </div> <!-- container -->

</div> <!-- content -->
