<?php
/* echo "<pre>";
print_r($invoices);
echo "</pre>"; */
?>
<script>
    var view_name = 'gridview';
</script>
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
                <a href="<?php echo base_url('Invoice/Add/') . $client_id; ?>">
                    <div class="card-box alert alert-success fixedheightdiv_invoice add_new_box">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title"><?php echo lang('invoice'); ?></h4>
                            </div>
                            <div class="col-md-12 ">
                                <i class="fa fa-plus fa-5x success"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
            <?php
            if (count($invoices) > 0) {
                foreach ($invoices as $invoice) {
                    ?>
                    <a href="<?php echo base_url('Invoice/View/') . $invoice['_id']; ?>">
                        <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo $invoice['invoice_code']; ?>">
                            <div class="card-box fixedheightdiv_invoice other_box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="invoice_no">Invoice No : <?php echo $invoice['invoice_code']; ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="invoice_date"><?php echo $invoice['created_date']; ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <?php
                                        $data_client = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($invoice['client_id'])));
                                        if (count($data_client) > 0) {
                                            echo '<div class="client_name">' . $data_client[0]['firstname'] . ' ' . $data_client[0]['lastname'] . '</div>';
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if(!empty($data_client[0]['currency'])){
                                        ?>
                                        <div class="col-md-12 text-right">
                                            <?php echo '<div class="total_payment">'. $data_client[0]['currency'] .' '. $invoice['total_payment'].'</div>'; ?>
                                        </div>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <div class="col-md-12 text-right">
                                            <?php echo '<div class="total_payment"> $'. $invoice['total_payment'].'</div>';?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    $rt = strtotime($invoice['due_date']);
                                    if ($invoice['save_type'] != 'save') {
                                        if (!empty($invoice['payment_status'])) {

                                            if ($invoice['payment_status'] == 'full') {
                                                $cl = 'invoice_paid';
                                                $tx = 'Paid';
                                            } else if ($invoice['payment_status'] == 'partial') {
                                                if ($today_date > $rt) {
                                                    $cl = 'overdue_invoice';
                                                    $tx = 'Overdue';
                                                } else if ($today_date <= $rt) {
                                                    $cl = 'outstanding_invoice';
                                                    $tx = 'Outstanding';
                                                }
                                            }

                                        } else {
                                            if ($today_date > $rt) {
                                                $cl = 'invoice_overdue';
                                                $tx = 'Overdue';
                                            } else if ($today_date <= $rt) {
                                                $cl = 'outstanding_invoice';
                                                $tx = 'Outstanding';
                                            }
                                        }
                                    }

                                    if ($invoice['save_type'] == 'save') {
                                        $cl = 'invoice_draft';
                                        $tx = 'Draft';
                                    }


                                    ?>
                                    <div class="col-md-12 text-center <?php echo $cl ?>">
                                        <?php echo '<h3 class="btn">'.$tx.'</h3>';?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <h3 class="text-center"><?php echo lang('NO_RECORD_FOUND'); ?></h3>
            <?php } ?>
        </div>
    </div>
</div>

<!--
<style>
    .header-title.m-t-0.m-b-30.amount {
        color: orange;
        font-size: 40px;
    }

    #overdue_price {
        color: red
    }

    #outstanding_price {
        color: orange
    }

    #draft_price {
        color: #71b6f9
    }

    .overdue_invoice {
        background-color: red;
    }

    .client_name {
        border-bottom: 1px solid #000;
    }

    .invoice_paid {
        background-color: #10c469;
    }

    .invoice_overdue {
        background-color: red;
    }

    .invoice_draft {
        background-color: #71b6f9;
    }

    .outstanding_invoice {
        background-color: orange;
    }

    .invoice_paid h3, .overdue_invoice h3, .invoice_overdue h3, .invoice_draft h3, .outstanding_invoice h3 {
        color: #fff;
    }
</style>-->