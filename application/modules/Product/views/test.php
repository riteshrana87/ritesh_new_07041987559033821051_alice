<div class="row">
				<div class="filtr-container">
                <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo lang('addTitleClient'); ?>" title="<?php echo lang('addTitleClient'); ?>">
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
                </div><!-- end col -->
				<!-- Search control -->
        
				
                <?php
                if (count($product_perishable_on) > 0) {
                    foreach ($product_perishable_on as $product) {
                        ?>
                        <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo $product['product_name']; ?>">
                            <div class="card-box ">

                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="col-md-7 pull-left text-left"><?php if($product['perishable'] == 'on'){ echo "<div class='purple_dot'> </div> Perishable"; } else{ echo "<div class='blue_dot'> </div> Non-Perishable"; } ?></div>
                                         <div class="col-md-5 pull-right text-right"><?php echo 'SKU: ' . $product['sku']; ?></div>
                                    </div>
									<div style="clear:both"> </div>
                                    <div class="col-md-12 text-center bottom_line">
                                        <h3><?php echo $product['product_name']; ?></h3>
                                    </div> 
									<hr>
									<div class="col-md-12">
										<div class="col-md-8 pull-left">
											<?php echo lang('opening_stock'); ?>
										</div>
										<div class="col-md-4 pull-right">
											<?php echo $product['opening_stock']; ?>
										</div>
                                    </div>
                                    <div class="col-md-12">
										<div class="col-md-8 pull-left">
											<?php echo lang('purchases'); ?>
										</div>
										<div class="col-md-4 pull-right">
                                         <?php echo $product['purchases']; ?>
										 </div>
                                    </div>
                                    <div class="col-md-12 bottom_line">
										<div class="col-md-8 pull-left">
											<?php echo lang('sales'); ?>
										</div>
										<div class="col-md-4 pull-right">
                                         <?php echo $product['sales']; ?>
										 </div>
                                    </div>
                                    <div class="col-md-12">
										<div class="col-md-8 pull-left">
											<h4 class="header-title"><?php echo lang('closing_stock'); ?></h4>
										</div>
										<div class="col-md-4 pull-right">
                                        <!-- <h4 class="header-title"> <?php echo $product['closing_stock']; ?></h4> -->
                                        <h4 class="header-title"> <?php echo ( ($product['opening_stock'] + $product['purchases']) - $product['sales'] ); ?></h4>
										 </div>
                                    </div>
									<?php $stock_status = ($product['opening_stock'] + $product['purchases']) - $product['sales']; ?>
									<?php
									if($stock_status > 0){
									?>
										<div class="col-md-12 in_stock text-center">
												In Stock
										</div>
									<?php
									}
									else{
										?>
										<div class="col-md-12 out_of_stock text-center">
												Out Of Stock
										</div>
									<?php
									}
									?>
                                </div>
                            </div>
                        </div><!-- end col -->
                    <?php } ?>
                <?php } ?>
				</div>

            </div>