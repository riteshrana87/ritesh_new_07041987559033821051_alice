<script>
var view_name='Add';
</script>

<div class="row">
    <div class="col-lg-3">

    </div><!-- end col -->
    <form id="from-model" method="post" action="<?php echo base_url('InvoicePayment/PaymentGateway/'.$invoice_id); ?>" class="frmsubmit" enctype="multipart/form-data"
          data-parsley-validate>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">
                    <h4>Invoice</h4>
                </div> -->
                <div class="panel-body">
                    <div class="clearfix">
					
					<?php
					/* echo "<pre>";
					print_r($invoice_details);
					echo "</pre>";
					
					echo "<br> <br><pre>";
					print_r($user_details);
					echo "</pre>"; */
					/* echo "<br> <br><pre>";
					print_r($invoice_items);
					echo "</pre>";
					echo "<br> <br><pre>";
					print_r($taxes);
					echo "</pre>"; */
					
					/* echo "<br> <br><pre>";
					print_r($stripedetails);
					echo "</pre>";
					echo "<br> <br><pre>";
					print_r($paypaldetails);
					echo "</pre>";
					echo "<br> <br><pre>";
					print_r($idealdetails);
					echo "</pre>"; */
					//Set useful variables for paypal form
					$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
					$paypal_id = 'info@codexworld.com'; //Business Email
					?>
					
                        <div class="pull-left">
                            <?php
                            if(!empty($CompanyInformation[0]['company_logo'])){
                                $profile_img = base_url("/uploads/company_logo/" . $CompanyInformation[0]['company_logo']);
                            }
                            else{
                                $profile_img = base_url("/uploads/profile_images/boy-512.png");
                            }
                            ?>
                            <h3 class="logo"><img src="<?php echo $profile_img; ?>" alt="user-img" class="img-thumbnail img-responsive"></h3>
                        </div>
                        <div class="pull-right">
                            <?php if(!empty($CompanyInformation)){?>
                                <address>
                                    <strong><?php echo ucfirst($CompanyInformation[0]['company']);?></strong><br>
                                    <?php echo $CompanyInformation[0]['address']; ?> <br>
                                    <?php echo $CompanyInformation[0]['company_email']; ?> <br>
                                   <abbr title="Phone">P:</abbr> <?php echo $CompanyInformation[0]['phone']; ?>
                                </address>
                                <input type="hidden"  name="user_id" class="form-control" id="user_id" value="<?=!empty($user_details[0]['_id'])?$user_details[0]['_id']:0?>"/>
                            <?php }?>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
	
        <div class="card-box">
            <!--<div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Invoice ID: </td>
                        <td><?php echo $invoice_details[0]['invoice_code']; ?></td>
                    </tr>
                    <tr>
                        <td>Payable Amount</td>
                        <td><?php echo $invoice_details[0]['total_payment']; ?></td>
                    </tr>
                    <tr>
                        <td>Issue Date</td>
                        <td><?php echo $invoice_details[0]['created_date']; ?></td>
                    </tr>
                    <tr>
                        <td>Due Date</td>
                        <td><?php echo $invoice_details[0]['due_date']; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div> -->
                    <div class="row">
                        <div class="col-md-12">

                            <div class="pull-left billed-to_container">
								<p> Billed To:</p>
                                <div class="billed-to">
                                            <?php
                                            if (count($clients) > 0) {
                                                foreach($clients as $client_data){
													if (!empty($invoice_details[0]['client_id']) && $invoice_details[0]['client_id'] == $client_data["_id"]) {
														
														if(!empty($invoice_details[0]['currency'])){
															$currency_symbol = $invoice_details[0]['currency'];
														}
														else{
															$currency_symbol = $client_data['currency'];
														}
														
														?>
														<p> <strong> <?php echo $client_data['firstname'] . ' ' . $client_data['lastname']; ?> </strong></p>
														<p> <?php echo $client_data['address']; ?> </p>
														<p> <?php echo $client_data['zipcode'] . ', ' . $client_data['city']; ?> </p>
														<p> <?php echo $client_data['state'] . ', ' . $client_data['country']; ?> </p>
													<?php
													}
												}
											}
											?>
                                </div>
                            </div>


                            <div class="pull-right m-t-30">
                                <address>
                                    <strong>Invoice:  <?php echo $invoice_details[0]['invoice_code']; ?></strong><br>
                                    <strong>Order Date: </strong><?php echo $invoice_details[0]['created_date']; ?><br>
                                    <strong>Due Date: </strong> <?php echo $invoice_details[0]['due_date']; ?><br>
                                </address>

                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->
			<br>
			<hr>
			<div class="table-responsive">
			<h4 class="header-title m-t-0"> Items Included</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Qty/Hrs </th>
                        <th>Description </th>
                        <th>Rate</th>
                        <th>Tax Rate (%)</th>
                        <th>Cost</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php
					for($i=0; $i<count($invoice_items);$i++){
					?>
                    <tr>
                        <td><?php echo $invoice_items[$i]['qty_hours']; ?></td>
                   
                        <td><?php echo $invoice_items[$i]['description']; ?></td>
                    
                        <td><?php echo $currency_symbol . ' ' . $invoice_items[$i]['rate']; ?></td>
                    
                        <td>
							<?php if (count($taxes) > 0) { 
                               foreach ($taxes as $tax) { 
                                   if (!empty($invoice_items[$i]['tax_rate']) && $invoice_items[$i]['tax_rate'] == $tax["_id"]) {
											echo $tax['tax_name'] . ' - ' . $tax['tax'] . '%';
                                        } 
							   }
							}
										 
							?>
						</td>
                    
                        <td><?php echo $currency_symbol . ' ' . $invoice_items[$i]['cost']; ?></td>
                    </tr>
					<?php
					}
					?>
                    </tbody>
                </table>
            </div>
			
			<div class="payment_total col-md-3 col-sm-6 col-xs-6 col-md-offset-3 pull-right">
				<hr>	
				<p class=""><strong>SubTotal: </strong><span><?php echo $currency_symbol . ' ' . $invoice_details[0]['amount']; ?></span></p>
				<p class="">Discount Added<?php if($invoice_details[0]['discount_type'] == '1'){echo '(%)';} ?>: <span><?php echo $invoice_details[0]['discount'] . '%' ; ?></span></p>
					<?php
					if (count($taxes) > 0) { 
								 foreach ($taxes as $tax) {
									${$tax['tax_name']} = 0;
								 }
					}
					for($i=0; $i<count($invoice_items);$i++){
					?>
					<?php if (count($taxes) > 0) { 
                               foreach ($taxes as $tax) {
                                   if (!empty($invoice_items[$i]['tax_rate']) && $invoice_items[$i]['tax_rate'] == $tax["_id"]) {
											//echo '<p class="">' . $tax['tax_name'] . ' (' . $tax['tax'] . '%):<span> ' . $invoice_items[$i]['tax_total_val']  . ' </span></p>';
											//echo "<br>#" . ${$tax['tax_name']};
											${$tax['tax_name']} = ${$tax['tax_name']} + $invoice_items[$i]['tax_total_val'];
											//${'track_' . $i} = 'val'
											//$taxtotal = array($tax["_id"] => $invoice_items[$i]['tax_total_val']);
											
                                        } 
							   }
							}
					}		
					
					foreach ($taxes as $tax) {
						if(${$tax['tax_name']} != 0){
							echo '<p class="">' . $tax['tax_name'] . ' (' . $tax['tax'] . '%):<span> ' .  $currency_symbol . ' ' . ${$tax['tax_name']}  . ' </span></p>';
						}
					}
					
							?>
				<!-- <p class="">Tax: <span><?php echo $invoice_details[0]['tax_amount']; ?></span></p> -->
				<p class="">Tax Amount: <span><?php echo $currency_symbol . ' ' . $invoice_details[0]['tax_amunt']; ?></span></p>
				<hr>
				<p class=""><strong>Total: </strong><span><?php echo $currency_symbol . ' ' . $invoice_details[0]['total_payment']; ?></span></p>
			</div>
			
        </div>
		
		<div style="clear:both"> </div>
			
			<?php
			
			if(!empty($invoice_details[0]['payment_status'])){
			if($invoice_details[0]['payment_status'] == 'partial' || empty($invoice_details[0]['payment_status'])){
			?>
			<div class="payment_footer">
				<!-- <p class="text-muted font-13 m-b-15 m-t-20">Payment Amount</p> -->
					<div class="payment_amount">
						<div class="radio radio-info radio-inline">
							<input type="radio" checked="" name="radioInline" value="full_payment" id="inlineRadio1">
							<label for="inlineRadio1"> Full Payment </label>
						</div>
						<br>
						<div class="radio radio-inline">
							<input type="radio" name="radioInline" value="partial_payment" id="inlineRadio2">
							<label for="inlineRadio2"> Partial Payment</label>
							<input type="text" id="invoice_installment_amount" name="invoice_installment_amount" onkeypress="return checkDecimal(event)" value="" class="form-control" style="display:none" placeholder="Partial Payment Amount"/>
							<p style="display:none; color:red" id="bigger_amount"> Please enter value equal or less than Total Amount</p>
						</div>
					</div>	
					<div style="clear:both"> </div>
					<div class="payment_buttons">
						<!-- <a class="btn btn-success waves-effect waves-light btn-md m-b-5 pull-right" style="margin:5px" href="javascript:void(0)">Next</a> -->
						<input type="hidden" name="total_amount_to_pay" id="total_amount_to_pay" value="<?php echo $invoice_details[0]['total_payment']; ?>"/>
						
						
						<input type="submit" name="next" id="next" class="btn btn-success pull-right" value="Next" />
						
						<?php if(!empty($stripedetails)){ ?> <!-- <a class="btn btn-success waves-effect waves-light btn-md m-b-5" style="margin:5px" href="javascript:void(0)">Pay With Stripe</a> --> <?php } ?>
						<?php if(!empty($paypaldetails)){ ?> <!-- <a class="btn btn-success waves-effect waves-light btn-md m-b-5" style="margin:5px" href="javascript:void(0)">Pay With Paypal</a> -->  <?php } ?>
						<?php if(!empty($idealdetails)){ ?> <!-- <a class="btn btn-success waves-effect waves-light btn-md m-b-5" style="margin:5px" href="javascript:void(0)">Pay With Ideal</a> -->  <?php } ?>
					</div>
			</div>
                          
			<?php
			}
			
			else{
				echo "<br>" . SUCCESS_START_DIV_NEW ."Payment complete for this invoice". SUCCESS_END_DIV;
			}
			}
			else{
			?>
			<div class="payment_footer">
				<!-- <p class="text-muted font-13 m-b-15 m-t-20">Payment Amount</p> -->
					<div class="payment_amount">
						<div class="radio radio-info radio-inline">
							<input type="radio" checked="" name="radioInline" value="full_payment" id="inlineRadio1">
							<label for="inlineRadio1"> Full Payment </label>
						</div>
						<br>
						<div class="radio radio-inline">
							<input type="radio" name="radioInline" value="partial_payment" id="inlineRadio2">
							<label for="inlineRadio2"> Partial Payment</label>
							<input type="text" id="invoice_installment_amount" name="invoice_installment_amount" onkeypress="return checkDecimal(event)" value="" class="form-control" style="display:none" placeholder="Partial Payment Amount"/>
							<p style="display:none; color:red" id="bigger_amount"> Please enter value equal or less than Total Amount</p>
						</div>
					</div>	
					<div style="clear:both"> </div>
					<div class="payment_buttons">
						<!-- <a class="btn btn-success waves-effect waves-light btn-md m-b-5 pull-right" style="margin:5px" href="javascript:void(0)">Next</a> -->
						<input type="hidden" name="total_amount_to_pay" id="total_amount_to_pay" value="<?php echo $invoice_details[0]['total_payment']; ?>"/>
						
						
						<input type="submit" name="next" id="next" class="btn btn-success pull-right" value="Next" />
						
						<?php if(!empty($stripedetails)){ ?> <!-- <a class="btn btn-success waves-effect waves-light btn-md m-b-5" style="margin:5px" href="javascript:void(0)">Pay With Stripe</a> --> <?php } ?>
						<?php if(!empty($paypaldetails)){ ?> <!-- <a class="btn btn-success waves-effect waves-light btn-md m-b-5" style="margin:5px" href="javascript:void(0)">Pay With Paypal</a> -->  <?php } ?>
						<?php if(!empty($idealdetails)){ ?> <!-- <a class="btn btn-success waves-effect waves-light btn-md m-b-5" style="margin:5px" href="javascript:void(0)">Pay With Ideal</a> -->  <?php } ?>
					</div>
			</div>
			<?php
			}
			?>


            </div><!-- end col -->
                    </div>
                    <!-- end row -->

                   
                    <!-- add auto-->
                   
                </div>

            </div>

        </div>
        <div class="col-lg-3">
           
        </div><!-- end col -->
    </form>
<script>
var recurring_url = "<?php echo base_url('Invoice/recurringadd'); ?>";
</script>
