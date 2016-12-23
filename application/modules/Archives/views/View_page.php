
<div class="modal-dialog ">

    <div class="modal-content"> 
        <div class="modal-header">
            <button type="button" class="close" title="<?=lang('close')?>" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><div class="modelTitle">Client View</div></h4>
        </div>
            
        <div class="content">
    <div class="container">

        <div class="pad-10">
            <div class="col-xs-12 col-md-12 no-left-pad">
                <div class = "form-group row">
                    <div class = "col-sm-6">
                       <label> <?php echo lang('firstname'); ?>  :</label>  
                        <?=!empty($client[0]['firstname'])?$client[0]['firstname']:''?>
                    </div>

                    <div class = "col-sm-6">
                        <label><?php echo lang('lastname'); ?>:</label>
                       <?=!empty($client[0]['lastname'])?$client[0]['lastname']:''?>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-12 no-left-pad">
                <div class = "form-group row">
                    <div class = "col-sm-12">
                       <label> <?php echo lang('company'); ?>  :</label>
                       <?=!empty($client[0]['company'])?$client[0]['company']:''?>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 no-left-pad">
                <div class = "form-group row">
                    <div class = "col-sm-6">
                      <label> <?php echo lang('email'); ?>  :</label>
                        <?=!empty($client[0]['email'])?$client[0]['email']:''?>
                    </div>

                    <div class = "col-sm-6">
                        <label><?php echo lang('phone_no'); ?>:</label>
                      <?=!empty($client[0]['phone'])?$client[0]['phone']:''?>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-12 no-left-pad">
                 <h4 class="page-header header-title"></h4>
                <div class = "form-group row">
                    <div class = "col-sm-12">
                      <label> <?php echo lang('ADDRESS_1'); ?>  :</label>
                        <?=!empty($client[0]['address'])?$client[0]['address']:''?>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-12 no-left-pad">
                <div class = "form-group row">
                    <div class = "col-sm-6">
                      <label> <?php echo lang('zipcode'); ?> :</label>
                        <?=!empty($client[0]['zipcode'])?$client[0]['zipcode']:''?>
                    </div>

                    <div class = "col-sm-6">
                        <label><?php echo lang('city'); ?>:</label>
                      <?=!empty($client[0]['city'])?$client[0]['city']:''?>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12 col-md-12 no-left-pad">
                <div class = "form-group row">
                    <div class = "col-sm-6">
                      <label><?php echo lang('state'); ?>:</label>
                      <?=!empty($client[0]['state'])?$client[0]['state']:''?>
                    </div>

                    <div class = "col-sm-6">
                        <label><?php echo lang('country'); ?>:</label>
                      <?=!empty($client[0]['country'])?$client[0]['country']:''?>
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