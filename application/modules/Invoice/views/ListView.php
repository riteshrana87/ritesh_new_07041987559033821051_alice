<?php
if ($sortOrder == 'asc') {
    $sortOrder = 'desc';
} else {
    $sortOrder = 'asc';
}
?>
<div class="col-sm-1"></div>
<div class="col-sm-10">
    <div class="row">
        <div class="card-box">

            <?php if ($this->session->flashdata('error')) {
                ?>
                <?php echo $this->session->flashdata('error'); ?>
            <?php } ?>
            <?php if ($this->session->flashdata('message')) {
                ?>
                <?php echo $this->session->flashdata('message'); ?>
            <?php } ?>
            <div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table table-striped">
                        <thead>
                        <tr>
                            <th><?php echo lang('client_name'); ?></th>
                            <th data-priority="1"><?php echo lang('invoice_number'); ?></a></th>
                            <th data-priority="5"><?php echo lang('invoice_amount'); ?></th>
                            <th data-priority="6"><?php echo lang('creation_date'); ?></th>
                            <th data-priority="7"><?php echo lang('due_date'); ?></th>
                            <th data-priority="8"><?php echo lang('status'); ?></th>
                            <th data-priority="9"><?php echo lang('actions'); ?></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php

                        $today_date = strtotime(date('F d, Y'));
                        $i = 1;
                        if (count($invoices) > 0) {
                            foreach ($invoices as $invoice) {

                                /* to check Invoice Status by Dishit */

                                $rt = strtotime($invoice['due_date']);
                                if ($invoice['save_type'] != 'save') {
                                    if (!empty($invoice['payment_status'])) {

                                        if ($invoice['payment_status'] == 'full') {
                                            $cl = 'label-success';
                                            $tx = 'Paid';
                                        } else if ($invoice['payment_status'] == 'partial') {
                                            if ($today_date > $rt) {
                                                $cl = 'label-danger';
                                                $tx = 'Overdue';
                                            } else if ($today_date <= $rt) {
                                                $cl = 'label-warning';
                                                $tx = 'Outstanding';
                                            }
                                        }

                                    } else {
                                        if ($today_date > $rt) {
                                            $cl = 'label-danger';
                                            $tx = 'Overdue';
                                        } else if ($today_date <= $rt) {
                                            $cl = 'label-warning';
                                            $tx = 'Outstanding';
                                        }
                                    }
                                } else if ($invoice['save_type'] == 'save' && $invoice['payment_status'] == '') {
                                    $cl = 'label-primary';
                                    $tx = 'Draft';
                                } else {
                                    if (!empty($invoice['payment_status'])) {

                                        if ($invoice['payment_status'] == 'full') {
                                            $cl = 'label-success';
                                            $tx = 'Paid';
                                        } else if ($invoice['payment_status'] == 'partial') {
                                            if ($today_date > $rt) {
                                                $cl = 'label-danger';
                                                $tx = 'Overdue';
                                            } else if ($today_date <= $rt) {
                                                $cl = 'label-warning';
                                                $tx = 'Outstanding';
                                            }
                                        }

                                    } else {
                                        if ($today_date > $rt) {
                                            $cl = 'label-danger';
                                            $tx = 'Overdue';
                                        } else if ($today_date <= $rt) {
                                            $cl = 'label-warning';
                                            $tx = 'Outstanding';
                                        }
                                    }
                                }


                                ?>


                                <tr>
                                    <td class="cursor_<?php echo $i; ?> cursor"
                                        onclick="view('<?php echo $invoice['_id']; ?>');"><?php
                                        $data_client = $this->mongo_db->get_where('Client', array('_id' => new \MongoId($invoice['client_id'])));
                                        if (count($data_client) > 0) {
                                            echo $data_client[0]['firstname'] . ' ' . $data_client[0]['lastname'];
                                        }
                                        ?></td>
                                    <td class="cursor_<?php echo $i; ?> cursor"
                                        onclick="view('<?php echo $invoice['_id']; ?>');"><?php echo $invoice['invoice_code']; ?></td>

                                    <?php /* ?><td><?php echo $invoice['total_tax']; ?></td>
                                        <td><?php echo $invoice['discount']; ?></td>
                                        <?php */ ?>
                                    <td class="cursor_<?php echo $i; ?> cursor"
                                        onclick="view('<?php echo $invoice['_id']; ?>');"><?php echo $invoice['total_payment']; ?></td>
                                    <td class="cursor_<?php echo $i; ?> cursor"
                                        onclick="view('<?php echo $invoice['_id']; ?>');"><?php echo $invoice['created_date']; ?></td>
                                    <td class="cursor_<?php echo $i; ?> cursor"
                                        onclick="view('<?php echo $invoice['_id']; ?>');"><?php echo $invoice['due_date']; ?></td>
                                    <td class="cursor_<?php echo $i; ?> cursor"
                                        onclick="view('<?php echo $invoice['_id']; ?>');"><span
                                                class="label <?php echo $cl ?>"><?php echo $tx; ?></span></td>
                                    <td class="actions cursor_<?php echo $i; ?> cursor"
                                        onclick="view('<?php echo $invoice['_id']; ?>');">
                                        <a class="on-default edit-row"
                                           href="<?php echo base_url('Invoice/Edit/' . $invoice['_id']); ?>"><i
                                                    class="fa fa-pencil"></i></a>
                                        <a class="on-default remove-row"
                                           onclick="promptAlert('<?php echo base_url('Invoice/Delete/' . $invoice['_id']); ?>');"><i
                                                    class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>

                                <?php $i++;

                            } ?>

                        <?php } else { ?>
                            <tr>
                                <td colspan="4"><?php echo lang('NO_RECORD_FOUND'); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                    <?php if (count($invoices) > 0) { ?>
                        <?php
                        echo $pagination['links'];
                    }
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>
<div class="col-sm-1"></div>
<script>

    var view_url = "<?php echo base_url('Invoice/View'); ?>";

</script>
