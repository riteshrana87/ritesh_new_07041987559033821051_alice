   <div class="col-sm-12">
            <div class="row">
                <div class="col-md-2" title="<?php echo lang('addTitleClient'); ?>">
                    <div class="card-box fixedheightdiv">
                <a href="<?php echo base_url('Invoice/Add'); ?>">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title m-t-0 m-b-30"><?php echo lang('invoice'); ?></h4>
                            </div>
                            <div class="col-md-12  ">
                                <i class="fa fa-plus fa-5x "></i>
                            </div>
                        </div>
                </a>
                    </div>
                </div><!-- end col -->
                <?php
                if (count($invoices) > 0) {
                    foreach ($invoices as $invoice) {
                        ?>
                        <div class="col-md-2">
                            <div class="card-box fixedheightdiv">

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        Invoice No : <?php echo $invoice['invoice_code']; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?php echo $invoice['created_date']; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?php
                                        $data_client = $this->mongo_db->get_where('Client',array('_id' => new \MongoId($invoice['client_id'])));
                                        if(count($data_client)>0)
                                        {
                                            echo $data_client[0]['firstname'] . ' ' . $data_client[0]['lastname'];
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?php echo $invoice['total_payment'];?>
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