   <div class="col-sm-12">
            <div class="row">
                <div class="col-md-2" title="<?php echo lang('addTitleClient'); ?>">
                    <div class="card-box fixedheightdiv">

                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title m-t-0 m-b-30"><?php echo lang('new_client'); ?></h4>
                            </div>
                            <div class="col-md-12  ">
                                <i class="fa fa-plus fa-5x "></i>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
                <?php
                if (count($clients) > 0) {
                    foreach ($clients as $client) {
                        ?>
                        <div class="col-md-2">
                            <div class="card-box fixedheightdiv">

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h4 class="header-title m-t-0 m-b-30"><?php echo $client['firstname'] . ' ' . $client['lastname']; ?></h4>
                                    </div>
                                    <div class="col-md-12">
                                        <?php echo $client['address']; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $client['zipcode']; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $client['city']; ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    <?php } ?>
                <?php } else { ?>
                    <h3 class="text-center" ><?php echo lang('NO_RECORD_FOUND'); ?></h3>

                <?php } ?>


            </div>

        </div>