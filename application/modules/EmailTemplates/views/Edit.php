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
            <div class="col-sm-12">
                <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
                <div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">

                            <form class="form-horizontal" role="form" id="EmailForm" name="EmailForm" method="post" action="<?php echo base_url('EmailTemplates/updateData'); ?>">
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input type="text" name="template_title"  maxlength="25" id="template_title" value="<?php echo $email[0]['template_title'];?>" class="form-control" required placeholder="<?php echo lang('title'); ?>">
                                    </div>
                                    
                                </div>
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <input type="text" name="subject"  maxlength="25" id="subject" value="<?php echo $email[0]['subject'];?>" class="form-control" required placeholder="<?php echo lang('subject'); ?>">
                                    </div>
                                    
                                </div>
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <textarea class="form-control" rows="5" disabled="" ><?php echo $email[0]['variables'];?></textarea>
                                    </div>
                                    
                                </div>
                                
                                  <h4 class="page-header header-title"></h4>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea id="body" name="body" ><?php echo $email[0]['body'];?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('emailTemplate_header_update'); ?>
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
            
        </div>
        <!-- end row -->


    </div> <!-- container -->

</div> <!-- content -->
