


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
                    <table id="categroytable" class="table table-striped">
                        <thead>
                            <tr>
                                <th><?php echo lang('name'); ?></th>
                                <th data-priority="2"><?php echo lang('created_date'); ?></th>
                                <th data-priority="2"><?php echo lang('actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($dataset) > 0) {
                            foreach ($dataset as $data) {
                                ?>
                                <tr>
                                    <td><?php echo $data['categoryname']; ?></td>
                                    <td><?php echo $data['created_at']; ?></td>
                                    <td class="actions">
                                        <a class="on-default cursor edit-row" href="<?php echo base_url('Category/Edit/' . $data['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                        <a class="on-default cursor remove-row" onclick="promptAlert('<?php echo base_url('Category/Delete/' . $data['_id']); ?>');"><i class="fa fa-trash-o"></i></a>
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


                </div>
            </div>
        </div>
    </div>
</div>