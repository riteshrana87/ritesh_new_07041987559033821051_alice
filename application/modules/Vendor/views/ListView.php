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
                                <th>Vendor Name</th>
                                <th data-priority="1">Vendor Country</th>
                                <th data-priority="5">Address</th>
                                <th data-priority="4">City</th>
                                <th data-priority="2">Zip Code</th>
                                <th data-priority="2">Contact</th>
                                <th data-priority="7">Action</th>
                            </tr>
                        </thead>

                        <tbody>
<?php
$i=1;
if (count($vendors) > 0) {
    foreach ($vendors as $vendor) {
        ?>
                                    <tr>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $vendor['_id'];?>');" ><?php echo $i; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $vendor['_id'];?>');" ><?php echo $vendor['vendor_name']; ?></a></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $vendor['_id'];?>');" ><?php echo $vendor['vendor_country']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $vendor['_id'];?>');" ><?php echo $vendor['vendor_address1']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $vendor['_id'];?>');" ><?php echo $vendor['vendor_city']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $vendor['_id'];?>');" ><?php echo $vendor['vendor_zipcode']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $vendor['_id'];?>');" ><?php echo $vendor['vendor_phone']; ?></td>

                                        <td class="actions">

                                            <a class="on-default edit-row" href="<?php echo base_url('Vendor/Edit/' . $vendor['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="on-default remove-row cursor" onclick="promptAlert('<?php echo base_url('Vendor/Delete/' . $vendor['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
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
<?php if (count($vendors) > 0) { ?>
                        <?php
                        echo $pagination['links'];
                    }
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>
<script>

var view_url="<?php echo base_url('Vendor/Edit/'); ?>";

</script>