<?php
if ($sortOrder == 'asc') {
    $sortOrder = 'desc';
} else {
    $sortOrder = 'asc';
}
?>

<div class="col-sm-12">

    <div class="row">
        <div class="card-box">

<?php if ($this->session->flashdata('error')) {
    ?>
                <?php echo $this->session->flashdata('error'); ?>
            <?php } ?>
            <?php if ($this->session->flashdata('message')) {
                ?>
                <?php echo $this->session->flashdata('message'); ?>
            <?php } ?>         <div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table  table-striped">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th data-priority="1">Invoice Code</a></th>
                                <th data-priority="2">Amount</a></th>
                                <!--<th data-priority="3">total_tax</th>
                                <th data-priority="4">discount</th>-->
                                <th data-priority="5">Total Payment</th>
                                <th data-priority="6">Created Date</th>
                                <th data-priority="7">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
<?php
if (count($invoices) > 0) {
    foreach ($invoices as $invoice) {
        ?>
                                    <tr>
                                        <td><?php
                                            $data_client = $this->mongo_db->get_where('Client',array('_id' => new \MongoId($invoice['client_id'])));
                                                if(count($data_client)>0)
                                                {
                                                    echo $data_client[0]['firstname'] . ' ' . $data_client[0]['lastname'];
                                                }
                                            ?></td>
                                        <td><?php echo $invoice['invoice_code']; ?></td>
                                        <td><?php echo $invoice['amount']; ?></td>
                                        <?php /* ?><td><?php echo $invoice['total_tax']; ?></td>
                                        <td><?php echo $invoice['discount']; ?></td>
                                        <?php */ ?>
                                        <td><?php echo $invoice['total_payment']; ?></td>
                                        <td><?php echo $invoice['created_date']; ?></td>
                                        <td class="actions">
                                            <a class="on-default edit-row" href="<?php echo base_url('Invoice/Edit/' . $invoice['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="on-default remove-row" onclick="promptAlert('<?php echo base_url('Invoice/Delete/' . $invoice['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
    <?php } ?>

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