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
                                <th><?php echo lang('title'); ?></th>
                                <th data-priority="1"><?php echo lang('subject'); ?></th>
                                <th data-priority="4"><?php echo lang('created_date'); ?></th>
                                <th data-priority="2"><?php echo lang('actions'); ?></th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //pr($dataset);
                            if (count($dataset) > 0) {
                                foreach ($dataset as $data) {
                                    ?>
                                    <tr>
                                        <td><?php echo $data['template_title']; ?></td>
                                        <td><?php echo $data['subject']; ?></td>
                                        <td><?php echo $data['created_date']; ?></td>

                                        <td class="actions">
                                            <a class="on-default edit-row" href="<?php echo base_url('EmailTemplates/Edit/' . $data['_id']); ?>"><i class="fa fa-pencil"></i></a>
<!--                                            <a class="on-default remove-row" onclick="promptAlert('<?php //echo base_url('EmailTemplate/Delete/' . $data['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>-->
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
                    <?php if (count($dataset) > 0) { ?>
                        <?php
                        echo $pagination['links'];
                    }
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>