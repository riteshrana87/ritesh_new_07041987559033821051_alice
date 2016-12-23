<script>
var view_name='PaymenyGateway';
</script>

<div class="row">
    <div class="col-lg-3">

    </div><!-- end col -->
    <!-- <form id="from-model" method="post"  action="<?php echo base_url('Invoice/insertdata'); ?>" class="frmsubmit" enctype="multipart/form-data" data-parsley-validate> -->
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
					?>
					 <?php
                                            if (count($clients) > 0) {
                                                foreach($clients as $client_data){
													if (!empty($invoice_details[0]['client_id']) && $invoice_details[0]['client_id'] == $client_data["_id"]) {
														//$currency_symbol = $client_data['currency'];
														if(!empty($invoice_details[0]['currency'])){
															$currency_symbol = $invoice_details[0]['currency'];
														}
														else{
															$currency_symbol = $client_data['currency'];
														}
													}
												}
											}
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
                                   <abbr title="Phone">P:</abbr> <?php echo $CompanyInformation[0]['phone']; ?>
                                </address>
                                <input type="hidden"  name="user_id" class="form-control" id="user_id" value="<?=!empty($user_details[0]['_id'])?$user_details[0]['_id']:0?>"/>
                            <?php }?>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="row">
							<div class="col-lg-11 col-md-11 col-sm-8 col-xs-9 text-right"> 
								<?php 
								if($radioInline == 'partial_payment'){
									$payable_amount = $invoice_installment_amount;
								}
								else{
									$payable_amount = $total_amount_to_pay;
								}
								?>
								<h3> <strong> Amount to Pay:  <?php echo $currency_symbol . ' ' . $payable_amount; ?> </strong> </h3>
							</div>
						
							<div class="col-lg-11 col-md-11 col-sm-8 col-xs-9 bhoechie-tab-container">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
								  <div class="list-group">
									<a href="#" class="list-group-item active text-center">
									  <!-- <h4 class="glyphicon glyphicon-plane"></h4><br/>Stripe -->
									  <img src="<?php echo base_url('uploads/payment_logo/strip.png') ?>" /><br/>Stripe
									</a>
									<a href="#" class="list-group-item text-center">
									 <!--  <h4 class="glyphicon glyphicon-road"></h4><br/>Paypal -->
									 <img src="<?php echo base_url('uploads/payment_logo/paypal.png') ?>" /><br/>Paypal
									</a>
									<a href="#" class="list-group-item text-center">
									  <!-- <h4 class="glyphicon glyphicon-home"></h4><br/>iDEAL -->
									  <img src="<?php echo base_url('uploads/payment_logo/ideal_mollie.png') ?>" /><br/>iDEAL
									</a>
								  </div>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
									<!-- flight section -->
									<div class="bhoechie-tab-content active">
										<!-- <center>
											<form action="<?php echo base_url('InvoicePayment/PayWithStripe/'); ?>" method="post"> 
												<input type="submit" name="stripe_submit" id="stripe_submit" class="btn btn-success pull-right" value="Pay with Stripe"/>
											</form> -->
								<div class="row">
                        <div class="col-lg-12">

                            <form class="form-horizontal" role="form" id="stripeform" name="stripeform" method="post" action="<?php echo base_url('InvoicePayment/PayWithStripe/'); ?>">
										
										<input type="hidden" name="payable_amount" id="payable_amount" value="<?php echo $payable_amount ?>" />
										<input type="hidden" name="stripe_invoiceid" id="stripe_invoiceid" value="<?php echo $invoice_id ?>" />
										<input type="hidden" name="stripe_clientid" id="stripe_clientid" value="<?php echo $invoice_details[0]['client_id'] ?>" />
										<input type="hidden" name="stripe_totalamounttopay" id="stripe_totalamounttopay" value="<?php echo $invoice_details[0]['total_payment'] ?>" />
										<input type="hidden" name="stripe_userid" id="stripe_userid" value="<?php echo $user_details[0]['_id'] ?>" />
										<input type="hidden" name="stripe_invoicenumber" id="stripe_invoicenumber" value="<?php echo $invoice_details[0]['invoice_code'] ?>" />
										<input type="hidden" name="stripe_radioInline" id="stripe_radioInline" value="<?php echo $radioInline ?>" />
                                
								
								
								
								<h4 class="page-header header-title">Billing Details</h4>
                                <div class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" id="stripe_address" name="stripe_address" placeholder="<?php echo lang('ADDRESS_1'); ?>" class="form-control" required>
                                    </div>
									<div class="col-md-6">
                                        <input type="text" name="stripe_city" required id="stripe_city" class="form-control"  maxlength="25" placeholder="<?php echo lang('city'); ?>">
                                    </div>
                                </div>
                                <div  class="form-group">

                                     <div class="col-md-6">
                                        <input type="text" name="stripe_state" id="stripe_state" class="form-control"  maxlength="25" required placeholder="<?php echo lang('state'); ?>" >
                                    </div>
									 <div class="col-md-6">
                                        <input type="text" name="stripe_zipcode" id="stripe_zipcode" class="form-control"  maxlength="10" required placeholder="<?php echo lang('zipcode'); ?>"  >
                                    </div>
                                </div>

                                <div  class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" name="stripe_country" required id="stripe_country" class="form-control"  maxlength="25" placeholder="<?php echo lang('country'); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="stripe_email"  maxlength="50" id="stripe_email" class="form-control" placeholder="<?php echo lang('email'); ?>" required parsley-type="email">
                                    </div>
                                </div>
								
								<h4 class="page-header header-title">Card Details</h4>
								<div class="form-group">                                    
									<div class="col-md-6">
										<input type="text" name="stripe_cardholdername"  maxlength="25" id="stripe_cardholdername" class="form-control" required placeholder="Card Holder's Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="stripe_cardnumber"  maxlength="25" id="stripe_cardnumber" onkeypress="return checkDecimal(event)" class="form-control" required placeholder="Card Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                   <div class="col-md-12">
								   <label for="textinput" class="col-sm-3 control-label" style="text-align:left">Card Expiry Date</label>
                                        <div class="col-sm-6">
											<div class="form-inline">
											  <select class="card-expiry-month stripe-sensitive required form-control" data-stripe="exp-month"  name="stripe_expity_month"  id="stripe_expity_month" data-bv-field="expMonth">
												<option selected="selected" value="01">01</option>
												<option value="02">02</option>
												<option value="03">03</option>
												<option value="04">04</option>
												<option value="05">05</option>
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											  </select>
											  <span> / </span>
											  <select class="card-expiry-year stripe-sensitive required form-control" data-stripe="exp-year" name="stripe_expity_year" id="stripe_expity_year" data-bv-field="expYear">
											  <option selected="" value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option></select>
											  <script type="text/javascript">
												var select = $(".card-expiry-year"),
												year = new Date().getFullYear();
									 
												for (var i = 0; i < 12; i++) {
													select.append($("&lt;option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+"&gt;"+(i + year)+"&lt;/option&gt;"))
												}
											</script> 
											</div>
										  
                                    </div>
                                </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="stripe_cvv" id="stripe_cvv" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="3" required class="form-control" onkeypress="return checkDecimal(event)" placeholder="CVV/CVV2">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button name="stripe_submit" id="stripe_submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            Pay with Stripe
                                        </button>
                                        <button class="btn btn-default waves-effect waves-light m-l-5" type="reset">
                                            Cancel
                                        </button>
                                    </div>
                                </div> 
                            </form>
                        </div><!-- end col -->



                    </div><!-- end row -->
											
											
											
										</center>
									</div>
									<!-- train section -->
									<div class="bhoechie-tab-content">
										<center>
										  <!-- <h1 class="glyphicon glyphicon-road" style="font-size:12em;color:#188ae2"></h1> -->
											<form action="<?php echo base_url('InvoicePayment/PayWithPaypal/'); ?>" method="post"> 
												<input type="hidden" name="payable_amount" id="payable_amount" value="<?php echo $payable_amount ?>" />
												<input type="hidden" name="paypal_invoiceid" id="paypal_invoiceid" value="<?php echo $invoice_id ?>" />
												<input type="hidden" name="paypal_clientid" id="stripe_clientid" value="<?php echo $invoice_details[0]['client_id'] ?>" />
												<input type="hidden" name="paypal_totalamounttopay" id="paypal_totalamounttopay" value="<?php echo $invoice_details[0]['total_payment'] ?>" />
												<input type="hidden" name="paypal_userid" id="paypal_userid" value="<?php echo $user_details[0]['_id'] ?>" />
												<input type="hidden" name="paypal_invoicenumber" id="paypal_invoicenumber" value="<?php echo $invoice_details[0]['invoice_code'] ?>" />
												<input type="hidden" name="paypal_radioInline" id="paypal_radioInline" value="<?php echo $radioInline ?>" />
												
												
												<div  class="form-group">
													<div class="col-md-3">
													</div>
													<div class="col-md-6">
														<input type="text" name="paypal_email" maxlength="50" id="paypal_email" class="form-control" placeholder="<?php echo lang('email'); ?>" required parsley-type="email">
														 <input type="hidden" name="<email>" value="jdoe@zyzzyu.com">
													</div>
													<div class="col-md-3">
													</div>
												</div>
												<!-- <input type="submit" name="paypal_submit" id="paypal_submit" class="btn btn-success" value="Pay with Paypal"/> -->
												<div style="clear:both"> </div>
												<br>
												<div class="form-group">
													<div class="col-md-12 .col-md-offset-4">
														<button name="paypal_submit" id="paypal_submit" class="btn btn-primary waves-effect waves-light" type="submit">
															Pay with Paypal
														</button>
														<button class="btn btn-default waves-effect waves-light m-l-5" type="reset">
															Cancel
														</button>
													</div>
												</div> 
												<!-- <a href="<?php echo base_url().'InvoicePayment/PayWithPaypal/'.$invoice_id; ?>">Pay with paypal</a> -->
											</form>
										</center>
									</div>
						
									<!-- hotel search -->
									<div class="bhoechie-tab-content">
										<center>
										  <div class="col-lg-12">

                            <form class="form-horizontal" role="form" id="idealform" name="idealform" method="post" action="<?php echo base_url('InvoicePayment/PayWithIdeal/'); ?>">
										
										<input type="hidden" name="payable_amount" id="payable_amount" value="<?php echo $payable_amount ?>" />
										<input type="hidden" name="ideal_invoiceid" id="ideal_invoiceid" value="<?php echo $invoice_id ?>" />
										<input type="hidden" name="ideal_clientid" id="ideal_clientid" value="<?php echo $invoice_details[0]['client_id'] ?>" />
										<input type="hidden" name="ideal_totalamounttopay" id="ideal_totalamounttopay" value="<?php echo $invoice_details[0]['total_payment'] ?>" />
										<input type="hidden" name="ideal_userid" id="ideal_userid" value="<?php echo $user_details[0]['_id'] ?>" />
										<input type="hidden" name="ideal_invoicenumber" id="ideal_invoicenumber" value="<?php echo $invoice_details[0]['invoice_code'] ?>" />
										<input type="hidden" name="ideal_radioInline" id="ideal_radioInline" value="<?php echo $radioInline ?>" />
								
								<!-- <h4 class="page-header header-title">Billing Details</h4>
                                <div class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" id="idealaddress" name="idealaddress" placeholder="<?php echo lang('ADDRESS_1'); ?>" class="form-control" required>
                                    </div>
									<div class="col-md-6">
                                        <input type="text" name="idealcity" required id="idealcity" class="form-control"  maxlength="25" placeholder="<?php echo lang('city'); ?>">
                                    </div>
                                </div>
                                <div  class="form-group">

                                     <div class="col-md-6">
                                        <input type="text" name="idealstate" id="idealstate" class="form-control"  maxlength="25" required placeholder="<?php echo lang('state'); ?>" >
                                    </div>
									 <div class="col-md-6">
                                        <input type="text" name="idealzipcode" id="idealzipcode" class="form-control"  maxlength="10" required placeholder="<?php echo lang('zipcode'); ?>"  >
                                    </div>
                                </div>

                                <div  class="form-group">
                                    <div class="col-md-6">
                                        <input type="text" name="idealcountry" required id="idealcountry" class="form-control"  maxlength="25" placeholder="<?php echo lang('country'); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="idealemail"  maxlength="50" id="idealemail" class="form-control" placeholder="<?php echo lang('email'); ?>" required parsley-type="email">
                                    </div>
                                </div>
								
								<h4 class="page-header header-title">Card Details</h4>
								<div class="form-group">                                    
									<div class="col-md-6">
										<input type="text" name="ideal_cardholdername"  maxlength="25" id="ideal_cardholdername" class="form-control" required placeholder="Card Holder's Name">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="ideal_cardnumber"  maxlength="25" id="ideal_cardnumber" class="form-control" required placeholder="Card Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                   <div class="col-md-12">
								   <label for="textinput" class="col-sm-3 control-label" style="text-align:left">Card Expiry Date</label>
                                        <div class="col-sm-6">
											<div class="form-inline">
											  <select class="card-expiry-month stripe-sensitive required form-control" data-stripe="exp-month" name="ideal_expiry_month" id="ideal_expiry_month" data-bv-field="expMonth">
												<option selected="selected" value="01">01</option>
												<option value="02">02</option>
												<option value="03">03</option>
												<option value="04">04</option>
												<option value="05">05</option>
												<option value="06">06</option>
												<option value="07">07</option>
												<option value="08">08</option>
												<option value="09">09</option>
												<option value="10">10</option>
												<option value="11">11</option>
												<option value="12">12</option>
											  </select>
											  <span> / </span>
											  <select class="card-expiry-year stripe-sensitive required form-control" data-stripe="exp-year" name="ideal_expiry_year" id="ideal_expiry_year" data-bv-field="expYear">
											  <option selected="" value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option><option value="2025">2025</option><option value="2026">2026</option><option value="2027">2027</option></select>
											  <script type="text/javascript">
												var select = $(".card-expiry-year"),
												year = new Date().getFullYear();
									 
												for (var i = 0; i < 12; i++) {
													select.append($("&lt;option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+"&gt;"+(i + year)+"&lt;/option&gt;"))
												}
											</script> 
											</div>
										  
                                    </div>
                                </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-6">
                                        <input type="text" name="ideal_cvv" id="ideal_cvv" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="25" required class="form-control" placeholder="CVV/CVV2">
                                    </div>
                                </div> -->
                                
                                <div class="form-group">
                                    <div class="col-sm-offset-1 col-sm-8">
                                        <button name="ideal_submit" id="ideal_submit" class="btn btn-primary waves-effect waves-light" type="submit">
                                            Pay with Ideal
                                        </button>
                                       <!-- <button class="btn btn-default waves-effect waves-light m-l-5" type="reset">
                                            Cancel
                                        </button> -->
                                    </div>
                                </div> 
                            </form>
                        </div><!-- end col -->

										</center>
									</div>
								</div>
							</div>
					  </div>
										</div>
                    <!-- end row -->

                   
                    <!-- add auto-->
                   
                </div>

            </div>

        </div>
        <div class="col-lg-3">
           
        </div><!-- end col -->
    <!-- </form> -->

<script type="text/javascript" src="https://js.stripe.com/v1/"></script>	
<script>
// this identifies your website in the createToken call below
//                Stripe.setPublishableKey('pk_test_suxHAAvKSymUCw8lxGk7ZxLs'); 
           Stripe.setPublishableKey('pk_test_iMsPlNbtZbbx1j94ohmXU9fy');  // DEV1's publishable key
            //Stripe.setPublishableKey('pk_test_suxHAAvKSymUCw8lxGk7ZxLs');  // DEV1's publishable key
             //Stripe.setPublishableKey(STRIPE_KEY_PK);
             //Stripe.setPublishableKey('<?php echo STRIPE_KEY_PK;?>');
            //Stripe.setPublishableKey('pk_live_SOVTnN8wMLfiSgGMrWdCVcsQ');

</script>
