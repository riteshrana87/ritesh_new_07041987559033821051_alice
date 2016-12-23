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
			<div class="col-sm-2"></div>
			
			
            <div class="col-sm-8">
                <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
                <div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">

                            <form class="form-horizontal" role="form" id="PaypalForm" name="PaypalForm" method="post" action="<?php echo base_url('Paypal/InsertData'); ?>">
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input type="email" name="email"  maxlength="50" id="email" class="form-control" placeholder="<?php echo lang('email'); ?>" required parsley-type="email" value="<?php if(isset($paypal[0]['email'])){ echo $paypal[0]['email'];}?>">
                                        
                                    </div>
                                    
                                </div>
                               
                               <div class="form-group">
                                    <div class="col-sm-offset-5	 col-sm-12">
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('save'); ?>
                                        </button>
                                       <!--<button class="btn btn-default waves-effect waves-light m-l-5" type="reset">
                                            Cancel
                                        </button>-->
                                    </div>
                                </div> 
                           
                              
                            </form>
                        </div><!-- end col -->



                    </div><!-- end row -->
                </div>

            </div><!-- end col -->
            <div class="col-sm-2"></div>
          
        </div>
        <!-- end row -->


    </div> <!-- container -->

</div> <!-- content -->
