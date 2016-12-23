<script>
    var view_name = 'Add';
</script>
<style>
.file_upload_label{
	text-align:left !important;
}
 .img-thumbnail{
	 height:90px;
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
				$countries
				?>
				<div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">
                            
                            <form class="form-horizontal" enctype='multipart/form-data' role="form" id="ClientForm" name="ClientForm" method="post" action="<?php echo base_url('Profile/InsertData'); ?>">
								
								<?php //print_r($profile[0]);
								//die(); ?>
								<h4 class="page-header header-title"> <?php echo lang('personal_info'); ?>: </h4>
							   <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" name="firstname"  maxlength="25" id="firstname" class="form-control" required placeholder="<?php echo lang('firstname'); ?>" 
										 value="<?php if(!empty($profile[0]['firstname'])){ echo $profile[0]['firstname']; } ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="lastname"  maxlength="25" id="lastname" class="form-control" required placeholder="<?php echo lang('lastname'); ?>" 
										value="<?php if(!empty($profile[0]['lastname'])){ echo $profile[0]['lastname']; } ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!--<div class="col-md-6">
                                        <input type="text" name="email"  maxlength="50" id="email" class="form-control" placeholder="<?php echo lang('email'); ?>" required parsley-type="email">
                                    </div> -->
									 <div class="col-md-6">
                                        <input type="text" name="username"  maxlength="25" id="username" class="form-control" required placeholder="<?php echo lang('username'); ?>" 
										value="<?php if(!empty($profile[0]['username'])){ echo $profile[0]['username']; }?>">
									</div>
                                    <!--<div class="col-md-6">
											<input type="text" name="phone" id="phone" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="25" required class="form-control" placeholder="<?php echo lang('phone_no'); ?>"> 
										 </div>
										-->
										<!--<div class="col-md-6">
											<input type="password" name="password"  maxlength="25" id="password" class="form-control" required placeholder="<?php echo lang('COMMON_LABEL_PASSWORD'); ?>" value="<?php echo $profile[0]['password']; ?>">
										</div> -->
										<div class="col-md-6">
											<label class="col-md-6 control-label file_upload_label">Email: </label>
											<label class="col-md-6 control-label file_upload_label"><?php if(!empty($profile[0]['email'])){  echo $profile[0]['email']; }?></label>
										</div>
                                   
                                </div>
								
								 <!--<div class="form-group">
                                    <div class="col-md-6">
                                        <input type="password" name="password"  maxlength="25" id="password" class="form-control" required placeholder="<?php echo lang('COMMON_LABEL_PASSWORD'); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" name="repeat_password"  maxlength="25" id="repeat_password" class="form-control" required placeholder="<?php echo lang('repeat_password'); ?>">
                                    </div>
                                </div> -->
								
								 <div class="form-group">
                                    <div class="col-md-6">
                                       <label class="col-md-4 control-label file_upload_label">Profile Picture: </label>
									   <input type="file" name="profile_picture" value="profile_picture" id="profile_picture" value="./uploads/profile_images/<?php if(!empty($profile[0]['profile_picture'])) {echo $profile[0]['profile_picture']; } ?>" >
                                    </div> 
									<?php 
										/* if(!empty($profile[0]['profile_picture'])){
										if(file_exists('./uploads/profile_images/'. $profile[0]['profile_picture'])){
											echo  '<div class="col-md-6">
											  <img style="height:100px;" src="./uploads/profile_images/'. $profile[0]['profile_picture'] .'" />
											</div>';
									   }
										} */
									   ?>
									    <div class="user-img">
									   <?php
										   if(!empty($profile[0]['profile_picture'])){
												$profile_img = base_url("/uploads/profile_images/" . $profile[0]['profile_picture']);
											}
											else{
												$profile_img = base_url("/uploads/profile_images/boy-512.png");
											}
										?>
										
										<img src="<?php echo $profile_img ?>" alt="user-img" class="img-circle img-thumbnail img-responsive">
										
										
									</div>
									
                                </div>
								
								 <div class="form-group">
									Change Password ? <a href="<?php echo base_url('Profile/ChangePassword'); ?>" > Click Here. </a>
								 
                                </div>
								
								
                                <h4 class="page-header header-title"> <?php echo lang('company_info'); ?>: </h4>
								 <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" id="company"  maxlength="50" name="company" class="form-control" required placeholder="<?php echo lang('company'); ?>" 
										value="<?php if(!empty($profile[0]['company'])){ echo $profile[0]['company']; } ?>">
                                    </div>
                                </div> 
								<div class="form-group">
									<div class="col-md-6">
                                       <label class="col-md-4 control-label file_upload_label">Company Logo: </label>
									   <input type="file" name="company_logo" value="company_logo" id="company_logo" value="./uploads/company_logo/<?php if(!empty($profile[0]['company_logo'])) { echo $profile[0]['company_logo']; } ?>">
									</div>
									   <?php 
									  /*  if(!empty($profile[0]['company_logo'])){
										   if(file_exists('./uploads/profile_images/'. $profile[0]['company_logo'])){
											echo  '<img style="height:60px;" src="./uploads/company_logo/'.$profile[0]['company_logo'].'" />';
									   }
									   } */
									   ?>
									   <div class="user-img">
									   <?php
										   if(!empty($profile[0]['company_logo'])){
												$profile_img = base_url("/uploads/company_logo/" . $profile[0]['company_logo']);
											}
											else{
												$profile_img = base_url("/uploads/company_logo/boy-512.png");
											}
										?>
										
										<img src="<?php echo $profile_img ?>" alt="user-img" class="img-thumbnail img-responsive">
										
									</div>
                                  
                                </div>
								
                                <div class="form-group">
									<div class="col-md-6">
											<input type="text" onkeypress="return isNumber(event)" name="phone" id="phone" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="25" required class="form-control" placeholder="<?php echo lang('phone_no'); ?> - 1" value="<?php if(!empty($profile[0]['phone'])){ echo $profile[0]['phone']; }?>"> 
									</div>
										
									<div class="col-md-6">
											<input type="text" onkeypress="return isNumber(event)" name="phone-2" id="phone-2" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="25" required class="form-control" placeholder="<?php echo lang('phone_no'); ?> - 2" value="<?php if(!empty($profile[0]['phone-2'])){ echo $profile[0]['phone-2']; } ?>"> 
									</div>
                                </div>
								
								
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" id="address" name="address" placeholder="<?php echo lang('ADDRESS_1'); ?>" value="<?php if(!empty($profile[0]['address'])){ echo $profile[0]['address']; } ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div  class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="zipcode" id="zipcode" class="form-control"  maxlength="10" value="<?php if(!empty($profile[0]['zipcode'])){ echo $profile[0]['zipcode']; } ?>" required placeholder="<?php echo lang('zipcode'); ?>"  >
                                    </div>
                                     <div class="col-md-6">
                                        <!-- <input type="text" name="country" required id="country" class="form-control"  maxlength="25" value="<?php if(!empty($profile[0]['country'])){ echo $profile[0]['country']; } ?>" placeholder="<?php echo lang('country'); ?>"> -->
										
																	
											<select name="country" required id="country" class="form-control select2">
											  <?php
											  if(!empty($profile[0]['country'])){
												  $selected_country = $profile[0]['country'];
											  }
											  else{
												$selected_country = '';
											  }
												foreach($countries as $country){
											  ?>
											  <option value="<?php echo $country['country_name'] ?>"  <?php if(!empty($selected_country)){ if($selected_country == $country['country_name']) { echo "selected"; } } ?>  ><?php echo $country['country_name'] ?></option>
											  <?php
												}
											  ?>
											</select> 
									
										 
										
                                    </div>
                                </div>

                                <div  class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="state" id="state" class="form-control"  maxlength="25" required value="<?php if(!empty($profile[0]['state'])){ echo $profile[0]['state']; } ?>" placeholder="<?php echo lang('state'); ?>" >
									</div>
									<div class="col-md-6">
                                        <input type="text" name="city" required id="city" class="form-control"  maxlength="25" value="<?php if(!empty($profile[0]['city'])){ echo $profile[0]['city']; }?>" placeholder="<?php echo lang('city'); ?>">
                                    </div>
                                   
                                   
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('save_profile'); ?>
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
