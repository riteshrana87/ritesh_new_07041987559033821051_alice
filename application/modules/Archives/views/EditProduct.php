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

		<?php
			/* echo "<pre>";
			print_r($products);
			echo "</pre>"; */
		?>

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h3 class="text-center"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h3>
                <div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">

                            <form class="form-horizontal" role="form" id="ProductForm" name="ProductForm" method="post" action="<?php echo base_url('Product/UpdateData'); ?>">
                                <div class="form-group">

                                    <div class="col-md-6">
                                        <input type="hidden" name="product_id"  maxlength="25" id="product_id" class="form-control" required  value="<?php echo $product_id ?>">
                                        <input type="text" name="product_name"  maxlength="25" id="product_name" class="form-control" required placeholder="<?php echo lang('product_name'); ?>" value="<?php echo $products[0]['product_name'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="sku"  maxlength="25" id="sku" class="form-control" value="<?php echo $products[0]['sku'] ?>" required placeholder="<?php echo lang('sku'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea name="product_description" id="product_description" placeholder="<?php echo lang('description');?>"><?php echo $products[0]['product_description'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-3">
                                        <input type="opening_stock" maxlength="6" name="opening_stock" value="<?php echo $products[0]['opening_stock'] ?> " onkeypress="return numericDecimal(event)" required maxlength="50" id="opening_stock" class="form-control" placeholder="<?php echo lang('opening_stock'); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" maxlength="6" name="purchases" id="purchases" value="<?php echo $products[0]['purchases'] ?> "  onkeypress="return numericDecimal(event)" required class="form-control" placeholder="<?php echo lang('purchases'); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" maxlength="6" name="sales" onkeypress="return numericDecimal(event)" value="<?php echo $products[0]['sales'] ?>"  id="sales" class="form-control" required placeholder="<?php echo lang('sales'); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="closing_stock" required onkeypress="return numericDecimal(event)" value="<?php echo ( ($products[0]['opening_stock'] + $products[0]['purchases']) - $products[0]['sales'] ) ?>"  id="closing_stock" class="form-control" placeholder="<?php echo lang('closing_stock'); ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">

                                    <div class="col-md-3">
                                        <input type="text" maxlength="6" id="minimum_in_stock" name="minimum_in_stock" required value="<?php echo $products[0]['minimum_in_stock'] ?>" onkeypress="return numericDecimal(event)" placeholder="<?php echo lang('minimum_in_stock'); ?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <!-- <input type="text" id="minimum_in_stock" name="minimum_in_stock" placeholder="<?php echo lang('minimum_in_stock'); ?>" class="form-control"> -->
                                    </div>
                                    <div class="col-md-3">
                                       <div class="switchery-demo col-md-4" style="float:left">
											<input type="checkbox" name="perishable" id="perishable" <?php if($products[0]['perishable'] == 'on'){ echo 'checked'; } ?>  data-plugin="switchery" data-color="#00b19d"/>
										</div> 
										<div class="switchery-demo col-md-8" style="float:left">
											<label> <?php echo lang('perishable_only'); ?></label>
										</div>
                                    </div>
                                    <div class="col-md-3">
										<div id="useble_div" style="display:<?php if($products[0]['perishable'] == 'off'){ echo 'none' ; } ?>">
											<label style="float:left"> Useable up to </label> <input type="text" value="<?php echo $products[0]['useable_days'] ?>" onkeypress="return numericDecimal(event)" style="width:20%; float:left; margin:0px 10px;" id="useable_days" name="useable_days" <?php if($products[0]['perishable'] == 'on'){ echo 'required' ; } ?> class="form-control"> <label style="float:left"> Days </label>
										</div>
                                    </div>
                                </div>
								<!--                                
							   <div  class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="zipcode" id="zipcode" class="form-control"  maxlength="10" required placeholder="<?php echo lang('zipcode'); ?>"  >
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="city" required id="city" class="form-control"  maxlength="25" placeholder="<?php echo lang('city'); ?>">
                                    </div>
                                </div>

                                <div  class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="state" id="state" class="form-control"  maxlength="25" required placeholder="<?php echo lang('state'); ?>" >
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="country" required id="country" class="form-control"  maxlength="25" placeholder="<?php echo lang('country'); ?>">
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button name="submit" id="submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('product_edit'); ?>
                                        </button>
                                        <button class="btn btn-default waves-effect waves-light m-l-5" onclick="goBack()" type="reset">
                                            Cancel
                                        </button>
                                    </div>
                                </div> 
                            </form>
                        </div><!-- end col -->



                    </div><!-- end row -->
                </div>

            </div><!-- end col -->
              
				
             
           
        </div>
        <!-- end row -->


    </div> <!-- container -->

</div> <!-- content -->
