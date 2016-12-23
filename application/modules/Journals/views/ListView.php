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
                    <table id="tech-companies-1" class="table table-striped">
                        <thead>
                            <tr>
                               
                                <th data-priority="1"><?php echo lang('journal_number');?></a></th>
                                <th data-priority="5"><?php echo lang('debit');?></th>
                                <th data-priority="5"><?php echo lang('credit');?></th>
                                <th data-priority="6"><?php echo lang('creation_date');?></th>
                                <th data-priority="9"><?php echo lang('actions');?></th>
                            </tr>
                        </thead>

                        <tbody>
<?php

				$today_date = strtotime(date('F d, Y'));
$i=1;
if (count($journals) > 0) {
    foreach ($journals as $Journal) {
	?>
		
                                    <tr>

                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $Journal['_id'];?>');" ><?php echo $Journal['journal_code']; ?></td>
                                       
                                        <?php /* ?><td><?php echo $invoice['total_tax']; ?></td>
                                        <td><?php echo $invoice['discount']; ?></td>
                                        <?php */ ?>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $Journal['_id'];?>');" ><?php echo $Journal['total_debit']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $Journal['_id'];?>');" ><?php echo $Journal['total_credit']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $Journal['_id'];?>');" ><?php echo $Journal['created_date']; ?></td>
                                        
                                        <td class="actions cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $Journal['_id'];?>');" >
                                            <a class="on-default edit-row" href="<?php echo base_url('Journals/Edit/' . $Journal['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="on-default remove-row" onclick="promptAlert('<?php echo base_url('Journals/Delete/' . $Journal['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
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
<?php if (count($journals) > 0) { ?>
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

var view_url="<?php echo base_url('Journals/View'); ?>";

</script>
