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
		 <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
				<div class="col-md-4 col-md-offset-4 view_box">
                            <div class="card-box ">

                                <div class="row">
                                    <div class="col-md-12 text-center bottom_line">
                                         <h1> <?php echo $vendor[0]['vendor_name'] ?></h1>   
									</div>
									<div style="clear:both"> </div>
                                    <div class="col-md-12">
										<div class="col-md-3"> <?php echo lang('vendor_address') . ' : '; ?></div>
										<div class="col-md-9"> <?php echo $vendor[0]['vendor_address1'] . ' ' . $vendor[0]['vendor_address2']; ?></div>
									</div>
									<div style="clear:both"> </div>
                                    <div class="col-md-12">
										<div class="col-md-3"> <?php echo lang('city') . ' : ';  ?></div>
										<div class="col-md-9"> <?php echo $vendor[0]['vendor_city']; ?></div>
                                    </div> 
                                    <div class="col-md-12">
										<div class="col-md-3"> <?php echo lang('zipcode') . ' : ';  ?></div>
										<div class="col-md-9"> <?php echo $vendor[0]['vendor_zipcode']; ?></div>
                                    </div> 
									<div style="clear:both"> </div>
                                    <div class="col-md-12">
										<div class="col-md-3"> <?php echo lang('state') . ' : ';  ?></div>
										<div class="col-md-9"> <?php echo $vendor[0]['vendor_state']; ?></div>
                                    </div> 
                                    <div class="col-md-12">
										<div class="col-md-3"> <?php echo lang('country') . ' : ';  ?></div>
										<div class="col-md-9"> <?php echo $vendor[0]['vendor_country']; ?></div>
                                    </div> 
									<div class="col-md-12">
										<div class="col-md-3"> <?php echo lang('branch') . ' : ';  ?></div>
										<div class="col-md-9"> <?php echo $vendor[0]['vendor_branch']; ?></div>
                                    </div> 
									<div style="clear:both"> </div>
									 <div class="col-md-12">
										<div class="col-md-3"> <?php echo lang('email') . ' : ';  ?></div>
										<div class="col-md-9"> <?php echo $vendor[0]['vendor_email']; ?></div>
                                    </div> 
									<div class="col-md-12">
										<div class="col-md-3"> <?php echo lang('phone_no') . ' : ';  ?></div>
										<div class="col-md-9"> <?php echo $vendor[0]['vendor_phone']; ?></div>
                                    </div> 
									<div style="clear:both"> </div>
									<div class="col-md-12">
										<div class="col-md-3"> <?php echo lang('description') . ':';  ?></div>
										<div class="col-md-9"> <?php echo $vendor[0]['vendor_description']; ?></div>
                                    </div> 
									<hr>
                                </div>
                            </div>
                        </div><!-- end col -->
             
           
        </div>
        <!-- end row -->


    </div> <!-- container -->

</div> <!-- content -->

<style>
			.divider{
			border: 1px solid #000;
			}
		.purple_dot{
			width:30px;
			height:30px;
			border-radius:50%;
			background-color:purple;
			float:left;
			margin-right:6px
		}
		.blue_dot{
			width:30px;
			height:30px;
			border-radius:50%;
			background-color:blue;
			float:left;
			margin-right:6px;
		}
		.text-center{
			margin:20px 0px;
		}
		.bottom_line{
			border-bottom:1px solid #000;;
		}
		.view_box{
			font-size:18px;
		}
</style>