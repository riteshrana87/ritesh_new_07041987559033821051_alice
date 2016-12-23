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
                                <th><?php echo lang('country_name'); ?></th>
                                <th data-priority="2"><?php echo lang('capital'); ?></th>
                                <th data-priority="2"><?php echo lang('currency_code'); ?></th>
                                <th data-priority="2"><?php echo lang('currency_name'); ?></th>
                                <th data-priority="2"><?php echo lang('currency_symbol'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($currency) > 0) {
                            foreach ($currency as $currencys) {
                                ?>
                                <tr>
                                    <td><?php echo $currencys['country_name']; ?></td>
                                    <td><?php echo $currencys['capital']; ?></td>
                                    <td><?php echo $currencys['currency_code']; ?></td>
                                    <td><?php echo $currencys['currency_name']; ?></td>
                                    <td><?php echo $currencys['currrency_symbol']; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="4"><?php echo lang('NO_RECORD_FOUND'); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php if (count($currency) > 0) { ?>
                        <?php
                        echo $pagination['links'];
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>