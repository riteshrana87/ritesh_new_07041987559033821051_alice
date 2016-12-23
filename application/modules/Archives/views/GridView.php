
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
            <!-- <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo lang('addTitleClient'); ?>" title="<?php echo lang('addTitleClient'); ?>">
                    <div class="card-box alert alert-success fixedheightdiv">
						<a style="color:#5fbeaa" href="<?php echo base_url('Product/Add/'); ?>" >
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title m-t-0 m-b-30"><?php echo lang('new_product'); ?></h4>
                            </div>
                            <div class="col-md-12  ">
                                <i class="fa fa-plus fa-5x success"></i>
                            </div>
                        </div>
						</a>
                    </div>
                </div> --> <!-- end col -->
            <!-- Search control -->
            <?php
            if (count($products) > 0) {
                foreach ($products as $product) {
                    ?>
                    <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo $product['product_name']; ?>">
                        <a href="<?php echo base_url('Product/Edit/' . $product['_id'] ); ?>" />
                            <div class="card-box fixedheightdiv_product other_box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if ($product['perishable'] == 'on') {
                                            echo "<div class='dot purple_dot'></div><div class='perishable'>Perishable</div>";
                                        } else {
                                            echo "<div class='dot blue_dot'></div><div class='non-perishable'>Non-Perishable</div>";
                                        } ?>
                                        <div class="product_sku"><?php echo 'SKU: ' . $product['sku']; ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="product_name"><?php echo $product['product_name']; ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="opening_stock"><?php echo lang('opening_stock'); ?></div>
                                        <div class="opening_stock_no"><?php echo $product['opening_stock']; ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="purchases"><?php echo lang('purchases'); ?></div>
                                        <div class="purchases_no"><?php echo $product['purchases']; ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="sales"><?php echo lang('sales'); ?></div>
                                        <div class="sales_no"><?php echo $product['sales']; ?></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="closing_stock"><?php echo lang('closing_stock'); ?></div>
                                        <div class="closing_stock_no"><?php echo(($product['opening_stock'] + $product['purchases']) - $product['sales']); ?></div>
                                    </div>
                                    <?php $stock_status = ($product['opening_stock'] + $product['purchases']) - $product['sales']; ?>
                                    <?php
                                    if($stock_status > 0){
                                        ?>
                                        <div class="col-md-12 in_stock btn_frame">In Stock</div>
                                        <?php
                                    }
                                    else{
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
    var view_url="<?php echo base_url('Product/Edit/'); ?>";
</script>