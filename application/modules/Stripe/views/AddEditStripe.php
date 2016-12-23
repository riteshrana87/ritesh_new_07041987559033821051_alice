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

                            <form class="form-horizontal" role="form" id="ClientForm" name="ClientForm" method="post" action="<?php echo base_url('Stripe/InsertData'); ?>">
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input type="text" name="sk_key"  maxlength="25" id="sk_key" class="form-control" required placeholder="<?php echo lang('SecretKey'); ?>" value="<?php if(isset($stripe[0]['sk_key'])){ echo $stripe[0]['sk_key'];}?>">
                                    </div>
                                    
                                </div>
                                <div class="form-group">

                                    
                                    <div class="col-md-12">
                                        <input type="text" name="pk_key"  maxlength="25" id="pk_key" class="form-control" required placeholder="<?php echo lang('PrivateKey'); ?>" value="<?php if(isset($stripe[0]['pk_key'])){ echo $stripe[0]['pk_key'];}?>">
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
