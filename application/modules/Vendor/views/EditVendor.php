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

		<?php
			/*  echo "<pre>";
			print_r($vendors);
			echo "</pre>"; */
		?>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
                <div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">

                            <form class="form-horizontal" role="form" id="VendorForm" name="VendorForm" method="post" action="<?php echo base_url('Vendor/UpdateData'); ?>">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="hidden" name="vendor_id"  maxlength="25" id="vendor_id" class="form-control" value="<?php echo $vendors[0]['_id'] ?>" >
										<input type="text" name="vendor_name"  maxlength="25" id="vendor_name" class="form-control" required placeholder="<?php echo lang('vendor_name'); ?> *" value="<?php echo $vendors[0]['vendor_name'] ?>" >
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" name="vendor_country"  maxlength="25" id="vendor_country" class="form-control" required placeholder="<?php echo lang('country_name'); ?> *" value="<?php echo $vendors[0]['vendor_country'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="vendor_company_name"  maxlength="25" id="vendor_company_name" class="form-control" required placeholder="<?php echo lang('company_name'); ?> *" value="<?php echo $vendors[0]['vendor_company_name'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" name="vendor_address1"  maxlength="50" id="vendor_address1" class="form-control" required placeholder="<?php echo lang('vendor_address1'); ?> *" value="<?php echo $vendors[0]['vendor_address1'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="vendor_address2"  maxlength="50" id="vendor_address2" class="form-control" placeholder="<?php echo lang('vendor_address2'); ?>" value="<?php echo $vendors[0]['vendor_address2'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" name="vendor_zipcode"  maxlength="50" id="vendor_zipcode" class="form-control" placeholder="<?php echo lang('zipcode'); ?>" value="<?php echo $vendors[0]['vendor_zipcode'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="vendor_city"  maxlength="50" id="vendor_city" class="form-control" placeholder="<?php echo lang('city'); ?>" value="<?php echo $vendors[0]['vendor_city'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" name="vendor_state"  maxlength="50" id="vendor_state" class="form-control" placeholder="<?php echo lang('state'); ?>" value="<?php echo $vendors[0]['vendor_state'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="vendor_branch"  maxlength="50" id="vendor_branch" class="form-control" placeholder="<?php echo lang('branch'); ?>" value="<?php echo $vendors[0]['vendor_branch'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <input type="email" name="vendor_email"  maxlength="50" id="vendor_email" class="form-control" placeholder="<?php echo lang('email'); ?>" value="<?php echo $vendors[0]['vendor_email'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="vendor_phone" onkeypress="return numericDecimal(event)" maxlength="10" id="vendor_phone" class="form-control" placeholder="<?php echo lang('phone_no'); ?>" value="<?php echo $vendors[0]['vendor_phone'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea name="vendor_description" id="vendor_description" placeholder="<?php echo lang('description');?>"><?php echo $vendors[0]['vendor_description'] ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('vendor_edit'); ?>
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
