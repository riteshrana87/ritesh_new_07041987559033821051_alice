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
                                <th data-priority="1"><a href="<?php echo $url; ?>&sortField=company&sortOrder=<?php echo $sortOrder;?>">Company</a></th>
                                <th data-priority="2">Email</th>
                                <th data-priority="5">Phone</th>
                                <th data-priority="4">Created Date</th>
                                <th data-priority="2">Actions</th>

                            </tr>
                        </thead>

                        <tbody>
<?php
if (count($clients) > 0) {
    foreach ($clients as $client) {
        ?>
                                    <tr>
                                        <td><?php echo $client['firstname'] . ' ' . $client['lastname']; ?></td>
                                        <td><?php echo $client['company']; ?></td>
                                        <td><?php echo $client['email']; ?></td>
                                        <td><?php echo $client['phone']; ?></td>
                                        <td><?php echo $client['created_at']; ?></td>

                                        <td class="actions">

                                            <a class="on-default edit-row" href="<?php echo base_url('Client/Edit/' . $client['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="on-default remove-row" onclick="promptAlert('<?php echo base_url('Client/Delete/' . $client['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
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
<?php if (count($clients) > 0) { ?>
                        <?php
                        echo $pagination['links'];
                    }
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>