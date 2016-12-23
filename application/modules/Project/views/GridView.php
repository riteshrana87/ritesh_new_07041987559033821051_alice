<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="icon-addon addon-lg">
                <input type="text" placeholder="Search" class="form-control filtr-search" name="filtr-search" data-search>
                <label for="email" class="glyphicon glyphicon-search filtr-search-icon" rel="tooltip" title="email"></label>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="filtr-container">
            <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo lang('addTitleClient'); ?>" title="<?php echo lang('addTitleClient'); ?>">
                <a href="<?php echo base_url('Project/Add'); ?>">
                    <div class="card-box alert alert-success fixedheightdiv_project add_new_box">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h4>
                            </div>
                            <div class="col-md-12 ">
                                <i class="fa fa-plus fa-5x success"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
              <?php
        if (count($dataset) > 0) {
            foreach ($dataset as $data) {
                ?>
        
            <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo $data['projectname']; ?>">
                <a href="#">
                    <div class="card-box fixedheightdiv_project other_box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="full_name_plat">
                                    <div class="full_name">
                                        <div class="project_name">
                                            <a href="<?php echo base_url('Task/'.$data['_id']);?>"><?php echo $data['projectname']; ?></a>
                                        </div>
                                    </div>
                                    <div class="actions">
                                        <a class="on-default edit-row" href="<?php echo base_url('Project/Edit/'.$data['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                        <a class="on-default remove-row cursor" onclick="promptAlert('<?php echo base_url('Project/Delete/' . $data['_id']); ?>');"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <?php
                                if ($data['clientid'] != '') {
                                $clientdata = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($data['clientid'])));
                                ?>
                                <div class="client_name"><?php echo $clientdata[0]['firstname'] . ' ' . $clientdata[0]['lastname']; ?></div>
                                  <?php } ?>
                                <div class="du_date"><?php echo lang('due_date'); ?>: <?php echo $data['duedate']; ?></div>
                            </div>
                            <div class="col-md-12 text-center invoice_paid">
                                <h3 class="btn"><?php echo $data['status'];?></h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--<h3 class="text-center">NO_RECORD_FOUND'</h3>-->
            <?php }
		  }
            ?>
        </div>
    </div>
</div>

