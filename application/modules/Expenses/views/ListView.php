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
                                <th>#</th>
                                <th><?php echo lang('vendor_name');?></th>
                                <th data-priority="1"><?php echo lang('total');?></th>
                                <th data-priority="4">Created Date</th>
                                <th data-priority="2">Actions</th>

                            </tr>
                        </thead>

                        <tbody>
<?php
$i=1;
if (count($expenses) > 0) {
    foreach ($expenses as $expense) {
        ?>
                                    <tr>
										
											<td class="cursor_<?php echo $i;?> cursor" onclick="view('<?php echo $expense['_id'];?>');"><?php echo $i; ?></td>
											<td class="cursor_<?php echo $i;?> cursor" onclick="view('<?php echo $expense['_id'];?>');"><?php echo $expense['vendorname']; ?></td>
											<td class="cursor_<?php echo $i;?> cursor" onclick="view('<?php echo $expense['_id'];?>');"><?php echo $expense['total']; ?></td>
											<td class="cursor_<?php echo $i;?> cursor" onclick="view('<?php echo $expense['_id'];?>');"><?php echo $expense['created_at']; ?></td>
										
                                        <td class="actions">

                                            <a class="on-default edit-row" href="<?php echo base_url('Expenses/Edit/' . $expense['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="on-default remove-row cursor" onclick="promptAlert('<?php echo base_url('Expenses/Delete/' . $expense['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
    <?php $i++; } ?>

                            <?php } else { ?>
                                <tr>
                                    <td colspan="4"><?php echo lang('NO_RECORD_FOUND'); ?></td>
                                </tr>
<?php } ?>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
</div>
