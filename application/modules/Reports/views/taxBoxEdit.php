<?php
if (count($data_tax) > 0) {
    $t = 0;
    $tax_total = 0;
    foreach ($data_tax as $taxs) {
        ?>
        <div class="form-group" id="tax_row_<?php echo $t; ?>">
            <div class="col-md-6">
                <select class=" form-control tax_select" name="tax_name[]" data-taxbox="tax_value_<?php echo $t; ?>"  required  id="tax_name<?php echo $t; ?>" placeholder="<?php echo lang('enter_tax_name'); ?>*">
                    <option value="" selected=""></option>
                    <?php
                    if (count($tax) > 0) {
                        foreach ($tax as $tx) {
                            ?>
                            <option <?php echo ($taxs['tax_id'] == $tx['_id']) ? 'selected' : ''; ?> value="<?php echo $tx['_id']; ?>" data-val="<?php echo $tx['tax']; ?>"><?php echo $tx['tax_name']; ?></option>
                        <?php } ?>
                    <?php } ?>
                    <option value="new"  href="<?php echo base_url('Expenses/addTax/'); ?>" aria-hidden="true" data-refresh="true" data-toggle="ajaxModal" title="<?= lang('view') ?>" ><?php echo lang('add_new'); ?></option>
                </select>             
            </div>
            <div class="col-md-5">
                <input type="text" id="tax_value_<?php echo $t; ?>" name="tax_value[]" value="<?php echo $taxs['tax_value']; ?>" readonly="" class="form-control tax_value" >
            </div>
            <div class="col-md-1">
                <a href="javascript:;" class="btn btn-danger" onclick="deleteItemTax('tax_row_<?php echo $t; ?>');"><i class="fa fa-trash"></i></a>
            </div>
        </div>
        <?php
        $t++;
        $tax_total = $tax_total + $taxs['tax_value'];
    }
    ?>
<?php } ?>
    