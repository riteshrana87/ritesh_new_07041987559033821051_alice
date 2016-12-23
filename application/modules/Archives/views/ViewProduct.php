<script>
    var view_name = 'Add';
</script>
<div class="content">
    <div class="container">

        <?php if ($this->session->flashdata('error')) {
            ?>
            <?php echo $this->session->flashdata('error'); ?>
        <?php } ?>
        <?php if ($this->session->flashdata('message')) {
            ?>
            <?php echo $this->session->flashdata('message'); ?>
        <?php } ?>
        <div class="row">
		 <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
				<div class="col-md-4 col-md-offset-4 view_box">
                            <div class="card-box ">

                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="col-md-7 pull-left text-left"><?php if($product[0]['perishable'] == 'on'){ echo "<div class='purple_dot'> </div> Perishable"; } else{ echo "<div class='blue_dot'> </div> Non-Perishable"; } ?></div>
                                         <div class="col-md-5 pull-right text-right"><?php echo 'SKU: ' . $product[0]['sku']; ?></div>
                                    </div>
									<div style="clear:both"> </div>
                                    <div class="col-md-12 text-center bottom_line">
                                        <h1><?php echo $product[0]['product_name']; ?></h1>
										<?php echo $product[0]['product_description'] ?>
                                    </div> 
									<hr>
									<div class="col-md-12">
										<div class="col-md-8 pull-left">
											<?php echo lang('opening_stock'); ?>
										</div>
										<div class="col-md-4 pull-right">
											<?php echo $product[0]['opening_stock']; ?>
										</div>
                                    </div>
                                    <div class="col-md-12">
										<div class="col-md-8 pull-left">
											<?php echo lang('purchases'); ?>
										</div>
										<div class="col-md-4 pull-right">
                                         <?php echo $product[0]['purchases']; ?>
										 </div>
                                    </div>
                                    <div class="col-md-12">
										<div class="col-md-8 pull-left">
											<?php echo lang('sales'); ?>
										</div>
										<div class="col-md-4 pull-right">
                                         <?php echo $product[0]['sales']; ?>
										 </div>
                                    </div>
                                    <div class="col-md-12">
										<div class="col-md-8 pull-left">
											<?php echo lang('closing_stock'); ?>
										</div>
										<div class="col-md-4 pull-right">
                                         <?php echo ( ($product[0]['opening_stock'] + $product[0]['purchases']) - $product[0]['sales'] ); ?>
										 </div>
                                    </div>
                                    <div class="col-md-12">
										<div class="col-md-8 pull-left">
											<?php echo lang('minimum_stock'); ?>
										</div>
										<div class="col-md-4 pull-right">
                                         <?php echo $product[0]['minimum_in_stock']; ?>
										 </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div><!-- end col -->
             
           
        </div>
        <!-- end row -->


    </div> <!-- container -->

</div> <!-- content -->

<style>
			.divider{
			border: 1px solid #000;
			}
		.purple_dot{
			width:30px;
			height:30px;
			border-radius:50%;
			background-color:purple;
			float:left;
			margin-right:6px
		}
		.blue_dot{
			width:30px;
			height:30px;
			border-radius:50%;
			background-color:blue;
			float:left;
			margin-right:6px;
		}
		.text-center{
			margin:20px 0px;
		}
		.bottom_line{
			border-bottom:1px solid #000;;
		}
		.view_box{
			font-size:26px;
		}
</style>