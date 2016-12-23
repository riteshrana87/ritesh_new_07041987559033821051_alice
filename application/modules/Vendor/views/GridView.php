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
        <div class="filtr-containerx">
            <div class="col-lg-3 col-md-6 col-sm-12 filtr-item" data-category="1, 5" data-sort="<?php echo lang('addTitleClient'); ?>" title="<?php echo lang('addTitleClient'); ?>">
                <a href="<?php echo base_url('Vendor/Add/') ?>">
                    <div class="card-box alert alert-success fixedheightdiv_client add_new_box ">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title"><?php echo lang('vendor_add'); ?></h4>
                            </div>
                            <div class="col-md-12">
                                <i class="fa fa-plus fa-5x success"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
            <?php
            if (count($vendors) > 0) {
                foreach ($vendors as $vendor) {
                    ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 filtr-item" data-category="1, 5" data-sort="<?php echo $vendor['vendor_name']; ?>">
                             <a href="<?php echo base_url('Vendor/Edit/').$vendor['_id']; ?>">
							<div class="card-box fixedheightdiv_client other_box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3><?php echo $vendor['vendor_name'] ?></h3>
                                    </div>
									<div class="actions">
                                                <a class="on-default edit-row" href="<?php echo base_url('Client/Edit/' . $client['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                                <a class="on-default remove-row cursor" onclick="promptAlert('<?php echo base_url('Client/Delete/' . $client['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
                                            </div>
                                    <div class="col-md-12">
                                        <div class="col-md-12"> <?php echo $vendor['vendor_address1']; ?></div>
                                        <div class="col-md-12"> <?php echo $vendor['vendor_address2']; ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6"> <?php echo $vendor['vendor_zipcode'];  ?></div>
                                        <div class="col-md-6"> <?php echo $vendor['vendor_city']; ?></div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
							</a>
                        </div><!-- end col -->
                    
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
