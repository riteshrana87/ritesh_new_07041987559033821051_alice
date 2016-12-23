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
            <div class="col-lg-3 col-md-6 col-sm-12 filtr-item" data-category="1, 5" data-sort="<?php echo lang('addTitleClient'); ?>" title="<?php echo lang('addTitleClient'); ?>">
                <a href="<?php echo base_url('Client/Add/') ?>">
                    <div class="card-box alert alert-success fixedheightdiv_client add_new_box ">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title"><?php echo lang('new_client'); ?></h4>
                            </div>
                            <div class="col-md-12 ">
                                <i class="fa fa-plus fa-5x success"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
            <?php
            if (count($clients) > 0) {
                foreach ($clients as $client) {
                    ?>

                    <a href="<?php echo base_url('Client/View_page/') . $client['_id'] ?>">
                        <div class="col-lg-3 col-md-6 col-sm-12 filtr-item" data-category="1, 5" data-sort="<?php echo $client['firstname']; ?>">
                            <div class="card-box fixedheightdiv_client other_box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="full_name_plat">
                                            <div class="full_name"><?php echo $client['firstname'] . ' ' . $client['lastname']; ?></div>
                                            <div class="actions">
                                                <a class="on-default edit-row" href="<?php echo base_url('Client/Edit/' . $client['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                                <a class="on-default remove-row cursor" onclick="promptAlert('<?php echo base_url('Client/Delete/' . $client['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="address_detail"><?php echo $client['address']; ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="zip_detail"><?php echo $client['zipcode']; ?></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="city_detail"><?php echo $client['city']; ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="cont_detail">Contact: <?php if(isset($client['phone'])){ echo $client['phone'];} ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
