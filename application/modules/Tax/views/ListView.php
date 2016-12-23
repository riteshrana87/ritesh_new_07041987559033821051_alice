<?php
if ($sortOrder == 'asc') {
    $sortOrder = 'desc';
} else {
    $sortOrder = 'asc';
}
?>
<div class="col-sm-12">
    <div class="row">
        <div class="card-box mT30">
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
                                <th><?php echo lang('SETTING_LABEL_TAX_NAME');?></th>
                                <th data-priority="2"><?php echo lang('tax');?></th>
                                <th data-priority="2"><?php echo lang('actions');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($taxs) > 0) {
                            foreach ($taxs as $tax) {
                                ?>
                                <tr>
                                    <td><?php echo $tax['tax_name']; ?></td>
                                    <td><?php echo $tax['tax']; ?></td>
                                    <td class="actions">
                                        <a class="on-default cursor edit-row" href="<?php echo base_url('Tax/Edit/' . $tax['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                        <a class="on-default cursor remove-row" onclick="promptAlert('<?php echo base_url('Tax/Delete/' . $tax['_id']); ?>');"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="4" class="text-center"><?php echo lang('NO_RECORD_FOUND'); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php if (count($taxs) > 0) { ?>
                        <?php
                        echo $pagination['links'];
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
