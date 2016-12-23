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

                            <form class="form-horizontal" role="form" id="PaypalForm" name="PaypalForm" method="post" action="<?php echo base_url('Ideal/InsertData'); ?>">
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input type="text" name="marchangeid"  maxlength="50" id="marchangeid" class="form-control" placeholder="<?php echo lang('marchangeid'); ?>" required  value="<?php if(isset($ideal[0]['marchangeid'])){ echo $ideal[0]['marchangeid'];}?>">
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input type="text" name="key"  maxlength="50" id="key" class="form-control" placeholder="<?php echo lang('key'); ?>" required  value="<?php if(isset($ideal[0]['key'])){ echo $ideal[0]['key'];}?>">
                                        
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input type="text" name="kerversion"  maxlength="50" id="kerversion" class="form-control" placeholder="<?php echo lang('kerversion'); ?>" required  value="<?php if(isset($ideal[0]['kerversion'])){ echo $ideal[0]['kerversion'];}?>">
                                        
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
