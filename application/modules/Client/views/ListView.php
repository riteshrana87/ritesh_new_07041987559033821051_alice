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
            <?php } ?>         
            <div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">
                    <table id="tech-companies-1" class="table  table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('client_name');?></th>
                                <th data-priority="1"><?php echo lang('company');?></th>
                                <th data-priority="2"><?php echo lang('email');?></th>
                                <th data-priority="5"><?php echo lang('phone_no');?></th>
                                <th data-priority="4"><?php echo lang('creation_date');?></th>
                                <th data-priority="2"><?php echo lang('actions');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            if (count($clients) > 0) {
                                foreach ($clients as $client) {
                                    ?>
                                    <tr>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $client['_id'];?>');" ><?php echo $i; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $client['_id'];?>');" ><?php echo $client['firstname'] . ' ' . $client['lastname']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $client['_id'];?>');" ><?php echo $client['company']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $client['_id'];?>');" ><?php echo $client['email']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $client['_id'];?>');" ><?php echo $client['phone']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $client['_id'];?>');" ><?php echo $client['created_at']; ?></td>

                                        <td class="actions">
                                            <a class="on-default edit-row" href="<?php echo base_url('Client/Edit/' . $client['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="on-default remove-row cursor" onclick="promptAlert('<?php echo base_url('Client/Delete/' . $client['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
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

<script>

var view_url="<?php echo base_url('Client/View_page/'); ?>";

</script>
