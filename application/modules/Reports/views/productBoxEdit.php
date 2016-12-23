<?php
if (count($product) > 0) {
    $p = 0;
    $amount_total=0;
    foreach ($product as $prod) {
        
        ?>
        <div class="form-group pdiv" id="productDiv_<?php echo $p; ?>">
            <div class="col-md-1">
                <input type="text" name="qty[]" min="0" id="qty<?php echo $p; ?>" class="form-control product_qty" placeholder="<?php echo lang('qty'); ?>" required  value="<?php echo $prod['qty']; ?>">
            </div>
            <div class="col-md-3">
                <input type="text" name="product_name[]" id="product_name<?php echo $p; ?>" class="form-control product_name_class" placeholder="<?php echo lang('product_name'); ?>" value="<?php echo $prod['product_name']; ?>" required >
                <span class="empty-message" style="display:none; color: red">Please seletct a Product</span>
            </div>
            <div class="col-md-2">
                <select class="select2 form-control" name="product_category[]"  required  id="product_category<?php echo $i; ?>" placeholder="<?php echo lang('category'); ?>*">
                    <option value="" selected=""></option>
                    <?php
                    if (count($categories) > 0) {
                        foreach ($categories as $category) {
                            ?>
                            <option <?php echo ($prod['category'] == $category['_id']) ? 'selected' : ''; ?> value="<?php echo $category['_id']; ?>"><?php echo $category['categoryname']; ?></option>
                        <?php } ?>
                    <?php } ?>

                </select>                        
            </div>
            <!--    <div class="col-md-2">
                        <select class="select2 form-control" name="product_tax[]"  required  id="product_tax<?php echo $i; ?>" placeholder="<?php echo lang('tax'); ?>*">
                        <option value="" selected=""></option>
            <?php
            if (count($tax) > 0) {
                foreach ($tax as $tx) {
                    ?>
                                                        <option value="<?php echo $tx['_id']; ?>"><?php echo $tx['tax_name']; ?></option>
                <?php } ?>
            <?php } ?>
            
                    </select>                        
                </div>-->
            <div class="col-md-2">
                <input type="text" name="product_price[]" min="0" id="product_price<?php echo $p; ?>" onkeypress="return numericDecimal(event)" class="form-control product_price" data-inc="<?php echo $p; ?>" value="<?php echo $prod['product_price']; ?>" placeholder="<?php echo lang('price'); ?>" data-parsley-pattern="/^\d{0,8}(\.\d{0,2})?$/" required >
            </div>
            <?php if ($p > 0) { ?>
                <div class="col-md-1">
                    <a href="javascript:;" class="btn btn-danger" onclick="deleteItem('productDiv_<?php echo $p; ?>');"><i class="fa fa-trash"></i></a>
                </div>
            <?php } ?>

        </div>
        <?php
        $p++;
         $amount_total=$amount_total+$prod['product_price'];
    }
    ?>
    <?php
}?>