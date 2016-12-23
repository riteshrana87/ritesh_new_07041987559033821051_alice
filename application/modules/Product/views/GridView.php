<div class="col-md-12 text-right">
    <div class="btn-group">
        <select onchange="changeonpeishable(this)" class="shorting_quantity" id="quantity_short" name="quantity_short">
            <option value=""> Quantity</option>
            <option value="10"> < 10</option>
            <option value="50"> < 50</option>
            <option value="100"> < 100</option>
            <option value="250"> < 250</option>
            <option value="500"> < 500</option>
        </select>
    </div>
    <div class="btn-group">
        <select onchange="changeonpeishable(this)" class="perishable_status" id="perisable_short"
                name="perisable_short">
            <option value=""> All</option>
            <option value="on"> Perishable</option>
            <option value="off"> Non-Perishable</option>
        </select>
    </div>
    <div class="btn-group">
        <select onchange="changeonpeishable(this)" class="shorting_status" id="status_short" name="status_short">
            <option value=""> Status</option>
            <option value="In Stock"> In Stock</option>
            <option value="Out Of Stock"> Out Of Stock</option>
            <!-- <option value="Overdue"> Overdue</option> -->
        </select>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <div class="icon-addon addon-lg">
                <input type="text" placeholder="Search" class="form-control filtr-search" name="filtr-search" data-search>
                <label for="email" class="glyphicon glyphicon-search filtr-search-icon" rel="tooltip" title="email"></label>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="row">
        <div class="filtr-container">
            <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo lang('addTitleClient'); ?>" title="<?php echo lang('addTitleClient'); ?>">
                <a href="<?php echo base_url('Product/Add/'); ?>"">
                    <div class="card-box alert alert-success fixedheightdiv_product add_new_box">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title"><?php echo lang('new_product'); ?></h4>
                            </div>
                            <div class="col-md-12 ">
                                <i class="fa fa-plus fa-5x success"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div><!-- end col -->
            <!-- Search control -->
            <?php
            if (count($products) > 0) {
                foreach ($products as $product) {
                    ?>
                    <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo $product['product_name']; ?>">
                        <a href="<?php echo base_url('Product/Edit/' . $product['_id']); ?>"/>
                        <div class="card-box fixedheightdiv_product other_box">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php if(isset($product['perishable']) && $product['perishable'] == 'on') {
                                        echo "<div class='dot purple_dot'></div><div class='perishable'>Perishable</div>";
                                    } else {
                                        echo "<div class='dot blue_dot'></div><div class='non-perishable'>Non-Perishable</div>";
                                    } ?>
                                    <div class="product_sku"><?php echo 'SKU: '; ?> <?php if(isset($product['sku'])){ echo $product['sku']; } ?></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="product_name"><?php  if(isset($product['product_name'])){ echo $product['product_name']; } ?></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="opening_stock"><?php echo lang('opening_stock'); ?></div>
                                    <div class="opening_stock_no"><?php if(isset($product['opening_stock'])){ echo $product['opening_stock']; } ?></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="purchases"><?php echo lang('purchases'); ?></div>
				<div class="purchases_no"><?php if(isset($product['purchases'])){ echo $product['purchases']; } ?></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="sales"><?php echo lang('sales'); ?></div>
                                    <div class="sales_no"><?php if(isset($product['sales'])){ echo $product['sales']; } ?></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="closing_stock"><?php echo lang('closing_stock'); ?></div>
                                    <div class="closing_stock_no"><?php echo(($product['opening_stock'] + $product['purchases']) - $product['sales']); ?></div>
                                </div>
                                <?php $stock_status = ($product['opening_stock'] + $product['purchases']) - $product['sales']; ?>
                                <?php
                                if ($stock_status > 0) {
                                    ?>
                                    <div class="col-md-12 in_stock btn_frame">In Stock</div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="col-md-12 out_of_stock btn_frame">Out Of Stock</div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        </a>
                    </div><!-- end col -->
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    //Initialize filterizr with default options
    //$('.filtr-container').filterizr();
    var perishable_url = "<?php echo base_url('/Product'); ?>";
    var view_url = "<?php echo base_url('Product/Edit/'); ?>";
</script>