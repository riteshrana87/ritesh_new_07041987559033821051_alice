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
                                <th><?php echo lang('project_name'); ?></th>
                                <th data-priority="1"><?php echo lang('client'); ?></th>
                                <th data-priority="2"><?php echo lang('hourly_price'); ?></th>
                                <th data-priority="5"><?php echo lang('fixed_project_price'); ?></th>
                                <th data-priority="4"><?php echo lang('created_date'); ?></th>
                                <th data-priority="2"><?php echo lang('actions'); ?></th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (count($dataset) > 0) {
                                foreach ($dataset as $data) {
                                    ?>
                                    <tr>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $data['_id'];?>');" ><?php echo $data['projectname']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $data['_id'];?>');" ><?php echo $data['clientid']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $data['_id'];?>');" ><?php echo $data['hourlyprice']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $data['_id'];?>');" ><?php echo $data['fixedprojectprice']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $data['_id'];?>');" ><?php echo $data['created_at']; ?></td>

                                        <td class="actions">

                                            <a class="on-default edit-row" href="<?php echo base_url('Project/Edit/' . $data['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="on-default remove-row cursor" onclick="promptAlert('<?php echo base_url('Project/Delete/' . $data['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            <?php } else { ?>
                                <tr>
                                    <td colspan="6" class="text-center"><?php echo lang('NO_RECORD_FOUND'); ?></td>
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
<script>

var view_url="<?php echo base_url('Task/'); ?>";

</script>
