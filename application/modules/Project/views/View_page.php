<div class="modal-dialog ">

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" title="<?=lang('close')?>" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><div class="modelTitle">Project View</div></h4>
        </div>

        <div class="content">
            <div class="container">

                <div class="pad-10">
                    <div class="col-xs-12 col-md-12 no-left-pad">
                        <div class = "form-group row">
                            <div class = "col-sm-6">
                                <label> <?php echo lang('project_name'); ?>  :</label>
                                <?=!empty($project['projectname'])?$project['projectname']:''?>
                            </div>

                            <div class = "col-sm-6">
                                <label><?php echo lang('start_date'); ?>:</label>
                                <?=!empty($project['startdate'])?$project['startdate']:''?>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 no-left-pad">
                        <div class = "form-group row">
                            <div class = "col-sm-6">
                                <label> <?php echo lang('client_name'); ?>  :</label>
                                <?php if(count($clients)>0){
                                    foreach($clients as $client){ ?>
                                        <?php echo (count($client_data)>0 && ($client_data[0]['_id']==$client['_id']))?$client['firstname']." ".$client['lastname']:'';?>
                                    <?php }?>
                                <?php }?>
                            </div>

                            <div class = "col-sm-6">
                                <label><?php echo lang('due_date'); ?>:</label>
                                <?=!empty($project['duedate'])?$project['duedate']:''?>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-md-12 no-left-pad">

                        <h4 class="page-header header-title"></h4>

                        <div class = "form-group row">
                            <div class = "col-sm-12">
                                <label> Description  :</label>
                                <?=!empty($project['description'])?$project['description']:''?>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 no-left-pad">
                        <div class = "form-group row">
                            <div class = "col-sm-6">
                                <label> <?php echo lang('hourly_price'); ?>  :</label>
                                <?=!empty($project['hourlyprice'])?$project['hourlyprice']:''?>
                            </div>

                            <div class = "col-sm-6">
                                <label><?php echo lang('fixed_project_price'); ?>:</label>
                                <?=!empty($project['fixedprojectprice'])?$project['fixedprojectprice']:''?>
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