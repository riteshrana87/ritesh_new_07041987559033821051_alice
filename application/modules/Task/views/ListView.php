<?php
if ($sortOrder == 'asc') {
    $sortOrder = 'desc';
} else {
    $sortOrder = 'asc';
}
?>
<div class="col-sm-12">
    <div class="row">
        <?php if ($this->session->flashdata('error')) {
            ?>
            <?php echo $this->session->flashdata('error'); ?>
        <?php } ?>
        <?php if ($this->session->flashdata('message')) {
            ?>
            <?php echo $this->session->flashdata('message'); ?>
        <?php } ?>
        <div class="card-box taskboard-box">
            <ul id="drag-upcoming" class="list-unstyled task-list">
                <?php
                if (count($dataset) > 0) {
                    foreach ($dataset as $data) {
                        ?>
                        <li>
                            <div class="kanban-detail">
                                <h4><?php echo $data['taskname']; ?></h4>
                                <ul class="list-inline m-b-0">
                                    <li>
                                        <div class="text-center"><b><?php echo lang('start_date'); ?></b><?php echo "&nbsp;&nbsp;" . $data['start_date']; ?></div>
                                        <div class="text-center"><b><?php echo lang('due_date'); ?></b><?php echo "&nbsp;&nbsp;" . $data['due_date']; ?></div>
                                    </li>
                                    <?php if ($data['status'] == 1) { ?>
                                        <li>
                                            <div class="timerdiv">
                                                <span id="spanStartDate" class="hidden"></span>
                                                <script>
                                                    var timer_flag =<?php echo $data['timer_status']; ?>;
                                                </script>
                                                <?php if ($data['timer_status'] == 0) { ?>
                                                    <script>
                                                        var is_pause_date = '<?php echo $data['timer_pausedate']; ?>';

                                                    </script>
                                                    <div class="starttimerdiv">
                                                        <img class="play" src="<?php echo base_url('uploads/assets/images/starttimer.png'); ?>" onclick="startTimer('<?php echo base_url('Task/startTimer/' . $data['_id'] . '?project=' . $projectId); ?>&status=1')">
                                                    </div>
                                                <?php } else {
                                                    ?>
                                                    <script>
                                                        var is_start_date = '<?php echo $data['timer_startdate']; ?>';
                                                    </script>
                                                    <div class="pausetimerdiv">
                                                        <img class="pause" src="<?php echo base_url('uploads/assets/images/pausetimer.png'); ?>" onclick="pauseTimer('<?php echo base_url('Task/pauseTimer/' . $data['_id'] . '?project=' . $projectId); ?>&status=1')">
                                                    </div>
                                                <?php } ?>
                                                <small id="timer"></small>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <?php if ($data['status'] == 3) { ?>
                                            <img class="cursor" src="<?php echo base_url('uploads/assets/images/reopen.png'); ?>" onclick="changeTaskStatus('<?php echo base_url('Task/updateTaskStatus/' . $data['_id'] . '?project=' . $projectId); ?>&status=1')">
                                        <?php } else { ?>
                                            <img class="cursor" src="<?php echo base_url('uploads/assets/images/play.png'); ?>" onclick="changeTaskStatus('<?php echo base_url('Task/updateTaskStatus/' . $data['_id'] . '?project=' . $projectId); ?>&status=1')">
                                            <img class="cursor" src="<?php echo base_url('uploads/assets/images/pause.png'); ?>" onclick="changeTaskStatus('<?php echo base_url('Task/updateTaskStatus/' . $data['_id'] . '?project=' . $projectId); ?>&status=2')">
                                            <img class="cursor" src="<?php echo base_url('uploads/assets/images/completed.png'); ?>" onclick="changeTaskStatus('<?php echo base_url('Task/updateTaskStatus/' . $data['_id'] . '?project=' . $projectId); ?>&status=3')">
                                        <?php } ?>
                                        <img title="<?php echo lang('cancle');?>" class="cursor" src="<?php echo base_url('uploads/assets/images/cancel.png'); ?>"  onclick="promptAlert('<?php echo base_url('Task/Delete/' . $data['_id']); ?>');">
                                        <a class="cursor" href="<?php echo base_url('Task/Edit/') . $data['_id'] . '?project=' . $projectId; ?>"><img src="<?php echo base_url('uploads/assets/images/edit.png'); ?>"></a>
                                    </li>
                                    <li>
                                        <?php
                                        echo $status[$data['status']];
                                        ?>
                                    </li>
                                    <li>
                                        <b> <?php echo lang('team_member');?></b>
                                    </li>
                                    <?php
                                    if (count($data['members']) > 0) {
                                    for($i=0;$i<count($data['members']);$i++) {
                                    ?>
                                    <li>
                                        <a data-original-title="<?php echo $data['members'][$i]['firstname'].$data['members'][$i]['lastname'];?>" title="" data-placement="top" data-toggle="tooltip" href="">
                                            <img class="thumb-sm img-circle" alt="img" src="<?php echo base_url('uploads/profile_image/'.$data['members'][$i]['profile_picture']); ?>">
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                    <?php } ?>
                    <?php } else { ?>
                    <li>
                        <div class="kanban-detail">
                            <h4><?php echo lang('NO_RECORD_FOUND'); ?></h4>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php if (count($dataset) > 0) { ?>
            <?php
            echo $pagination['links'];
        }
        ?>
    </div>
</div>

