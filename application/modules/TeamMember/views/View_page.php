
<div class="modal-dialog ">

    <div class="modal-content"> 
        <div class="modal-header">
            <button type="button" class="close" title="<?=lang('close')?>" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><div class="modelTitle">Team Members View</div></h4>
        </div>
            
        <div class="content">
    <div class="container">

        <div class="pad-10">
            <div class="col-xs-12 col-md-12 no-left-pad">
                <div class = "form-group row">
                    <div class = "col-sm-6">
                       <label> <?php echo lang('firstname'); ?>  :</label>
                        <?=!empty($dataset[0]['firstname'])?$dataset[0]['firstname']:''?>
                    </div>

                    <div class = "col-sm-6">
                        <label><?php echo lang('lastname'); ?>:</label>
                        <?=!empty($dataset[0]['lastname'])?$dataset[0]['lastname']:''?>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-12 no-left-pad">
                <div class = "form-group row">
                    <div class = "col-sm-6">
                       <label><?php echo lang('email'); ?>:</label>
                        <?=!empty($dataset[0]['email'])?$dataset[0]['email']:''?>
                       
                    </div>

                    <div class = "col-sm-6">
                        <label><?php echo lang('phone_no'); ?>:</label>
                       <?=!empty($project['contact_no'])?$project['contact_no']:''?>
                    </div>
                </div>
            </div>
            
            
            <div class="col-xs-12 col-md-12 no-left-pad">
                
                <h4 class="page-header header-title"></h4>
                
                <div class = "form-group row">
                    <div class = "col-sm-2">
                       <label> Image  :</label>
                     
                    </div>
                    <div class = "col-sm-10">
                      <?php 
                                        if($dataset[0]['profile_picture']!='' && file_exists($this->config->item('profile_image_root_url').$dataset[0]['profile_picture']))
                                             {?>
                                         <div class="col-md-6">
                                             <img src="<?php echo $this->config->item('profile_image_base_url').$dataset[0]['profile_picture'];?>" class="img-responsive"> 
                                         </div>
                                      <?php }?>
                    </div>
                </div>
            </div>
            
        </div>
        
        

    </div> <!-- container -->

</div> <!-- content -->
        <div class="clr"> </div><br/>
    </div>

</div>
<!--</div>-->