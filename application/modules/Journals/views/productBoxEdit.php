<?php
if (count($items) > 0) {
    $i = 0;
    $amount_total=0;
	
    foreach ($items as $item) {
        
        ?>
  <div class="form-group pdiv" id="productDiv_<?php echo $i;?>">

    <div class="col-md-2">
        <select class="select2 form-control get_type" name="journal_category[]" id="journal_category<?php echo $i;?>" onchange="get_type(this)" placeholder="<?php echo lang('category'); ?>" required>
            <option value="" selected=""></option>
            <?php
            if (count($journal_accounts) > 0) {
                foreach ($journal_accounts as $journal_account) {
                    ?>
                    <option <?php echo ($item['journal_category'] == $journal_account['_id']) ? 'selected' : ''; ?> data-type="journal" value="<?php echo $journal_account['_id']; ?>"><?php echo $journal_account['account_name']; ?></option>

                <?php } ?>
            <?php } ?>
             <?php
                if (count($clients) > 0) {
                    foreach ($clients as $client_data) {
                        ?>
                        <option <?php echo ($item['journal_category'] == $client_data['_id']) ? 'selected' : ''; ?> data-type="client" value="<?php echo $client_data['_id']; ?>"><?php echo $client_data['firstname'] . ' ' . $client_data['lastname']; ?></option>

                    <?php } ?>
                <?php } ?>
                    <?php
                if (count($categories) > 0) {
                    foreach ($categories as $category) {
                        ?>
                        <option <?php echo ($item['journal_category'] == $category['_id']) ? 'selected' : ''; ?> data-type="category" value="<?php echo $category['_id']; ?>"><?php echo $category['categoryname']; ?></option>

                    <?php } ?>
                <?php } ?>
                 <?php
                if (count($vendors) > 0) {
                    foreach ($vendors as $vendor) {
                        ?>
                        <option <?php echo ($item['journal_category'] == $vendor) ? 'selected' : ''; ?> data-type="vendor" value="<?php echo $vendor; ?>"><?php echo $vendor; ?></option>

                    <?php } ?>
                <?php } ?>
                 <?php
                if (count($payment_with) > 0) {
                    foreach ($payment_with as $payment) {
                        ?>
                        <option <?php echo ($item['journal_category'] == $payment) ? 'selected' : ''; ?> data-type="bank" value="<?php echo $payment; ?>"><?php echo $payment; ?></option>

                    <?php } ?>
                <?php } ?>
                 <option data-type="sales" value="sales">Sales</option>
                 <option data-type="purchases" value="purchases">Purchases</option>
        </select>             
         <input type="hidden" class="selected_cat_type" name="category_type[]" id="category_type<?php echo $i;?>" value="<?php echo $item['category_type']; ?>">
    </div>
    <div class="col-md-2">
        <input type="text" name="description[]"  id="description<?php echo $i;?>" class="form-control"  placeholder="Description" value="<?php echo $item['description']; ?>" >
    </div> 
<div class="col-md-2">
    <input type="text" name="debit[]" min="0" maxlength="6" value="<?php echo $item['debit']; ?>" id="debit<?php echo $i;?>" class="form-control debit" onkeypress="return numericDecimal(event)" onkeyup="calculate_subtotal()" data-inc="<?php echo $i;?>" placeholder="<?php echo lang('debit'); ?>" data-parsley-pattern="/^\d{0,8}(\.\d{0,2})?$/" required >                     
    </div>
    <div class="col-md-2">
        <input type="text" name="credit[]" min="0" maxlength="6" value="<?php echo $item['credit']; ?>" id="credit<?php echo $i;?>" class="form-control credit" onkeypress="return numericDecimal(event)" onkeyup="calculate_subtotal()" data-inc="<?php echo $i;?>" placeholder="<?php echo lang('credit'); ?>" data-parsley-pattern="/^\d{0,8}(\.\d{0,2})?$/" required >
    </div>
    <?php 
    if($i>0){?>
    <div class="col-md-1">
        <a href="javascript:;" class="btn btn-danger" onclick="deleteItem('productDiv_<?php echo $i;?>');"><i class="fa fa-trash"></i></a>
    </div>
    <?php }?>
</div>
        <?php
        $i++;
         //$amount_total=$amount_total+$prod['product_price'];
    }
    ?>
    <?php
}?>