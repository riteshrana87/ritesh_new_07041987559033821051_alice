<div class="form-group pdiv" id="productDiv_<?php echo $i;?>">
    <div class="col-md-1">
        <input type="text" name="qty[]" min="0" id="qty<?php echo $i;?>" class="form-control product_qty" placeholder="<?php echo lang('qty'); ?>" required  value="1">
    </div>
    <div class="col-md-3">
        <input type="text" name="product_name[]"  id="product_name<?php echo $i;?>" class="form-control product_name_class" placeholder="<?php echo lang('product_name'); ?>" required >
        <span class="empty-message" style="display:none; color: red">Please seletct a Product</span>
    </div>
    <div class="col-md-2">
        <select class="select2 form-control" name="product_category[]"  required  id="product_category<?php echo $i;?>" placeholder="<?php echo lang('category'); ?>*">
            <option value="" selected=""></option>
            <?php
            if (count($categories) > 0) {
                foreach ($categories as $category) {
                    ?>
                    <option value="<?php echo $category['_id']; ?>"><?php echo $category['categoryname']; ?></option>
                <?php } ?>
            <?php } ?>

        </select>                        
    </div>
<!--    <div class="col-md-2">
            <select class="select2 form-control" name="product_tax[]"  required  id="product_tax<?php echo $i;?>" placeholder="<?php echo lang('tax'); ?>*">
            <option value="" selected=""></option>
            <?php
            if (count($tax) >0) {
                foreach ($tax as $tx) {
                    ?>
                    <option value="<?php echo $tx['_id']; ?>"><?php echo $tx['tax_name']; ?></option>
                <?php } ?>
            <?php } ?>

        </select>                        
    </div>-->
    <div class="col-md-2">
        <input type="text" name="product_price[]" min="0" id="product_price<?php echo $i;?>" class="form-control product_price" onkeypress="return numericDecimal(event)" data-inc="<?php echo $i;?>" placeholder="<?php echo lang('price'); ?>" data-parsley-pattern="/^\d{0,8}(\.\d{0,2})?$/" required >
    </div>
    <?php 
    if($i>0){?>
    <div class="col-md-1">
        <a href="javascript:;" class="btn btn-danger" onclick="deleteItem('productDiv_<?php echo $i;?>');"><i class="fa fa-trash"></i></a>
    </div>
    <?php }?>
</div>