   <div class="col-sm-12">
            <div class="row">
                <div class="col-md-2" title="<?php echo lang('addTitleClient'); ?>">
                    <div class="card-box  fixedheightdivproject">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title m-t-0 m-b-30"><?php echo lang('new_project'); ?></h4>
                            </div>
                            <div class="col-md-12  ">
                                <i class="fa fa-plus fa-5x success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- end col -->
                <?php
                if (count($dataset) > 0) {
                    foreach ($dataset as $data) {
                        ?>
                        <div class="col-md-2">
                            <div class="card-box fixedheightdivproject">

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h4 class="header-title m-t-0 m-b-30"><?php echo $data['projectname']; ?></h4>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <?php $clientdata=$this->mongo_db->get_where('Client', array('_id' =>new \MongoId( $data['clientid'])));?>
                                        <h4 class="header-title"><?php echo $clientdata[0]['firstname'].' '.$clientdata[0]['lastname']; ?></h4>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div><b><?php echo lang('due_date');?></b></div>
                                        <span><?php echo $data['duedate']; ?></span>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <a type="button"  class="btn btn-block btn-sm btn-success waves-effect waves-light">Completed</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                <!-- end col -->
                    <?php } ?>
                <?php } ?>


            </div>

        </div>