<script>
var view_name='Add';
</script>

<div class="row">
    <div class="col-lg-3">
        <div class="card-box">

            <h4 class="header-title m-t-0 m-b-30">Activities</h4>

            <table class="table table-striped m-0">
                <tbody>
                <tr>
                    <th scope="row">14/05/2016 15:31 invoice created</th>
                </tr>
                <tr>
                    <th scope="row">14/05/2016 15:31 invoice send client</th>
                </tr>
                <tr>
                    <th scope="row">- succesfully send to (client email address)</th>
                </tr>
                <tr>
                    <th scope="row">- 14/05/2016 15:34 client apened invoice e-mail</th>
                </tr>
                <tr>
                    <th scope="row">15/05/2016 11:10 note</th>
                </tr>
                </tbody>
            </table>

        </div>

        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">All Payment for invoice 0003</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Line Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>01/01/2016</td>
                        <td>Adminto Admin v1</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>01/01/2016</td>
                        <td>Adminto Admin v1</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>01/01/2016</td>
                        <td>Adminto Admin v1</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <!--<button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample" onclick="dispLoginModal()">
                            </button>-->
                            <a id="displayText" class="btn btn-primary waves-effect waves-light" href="javascript:toggle();">Add a Payment</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>



        <div id="toggleText" style="display: none" class="card-box">
            <div class="modal-header">
                <h4 class="header-title m-t-0 m-b-30">Add Payment</h4>
                <a id="displayText" class="close" aria-hidden="true" href="javascript:toggle();">×</a>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=  base_url()?>" name="clientLoginForm" ENCTYPE="multipart/form-data">
                    <div class="form-group">
                        <label for="userName">Total paid*</label>
                        <input name="nick" parsley-trigger="change" required="" placeholder="Total paid" class="form-control" id="userName" data-parsley-id="4" type="text">
                    </div>
                    <div class="form-group">
                        <label for="emailAddress">Internal Note*</label>
                        <input name="email" parsley-trigger="change" required="" placeholder="Internal Note" class="form-control" id="emailAddress" data-parsley-id="6" type="email">
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input class="form-control" placeholder="mm/dd/yyyy" id="datepicker-multiple-date" type="text">
                            <span class="input-group-addon bg-primary b-0 text-white"><i class="ti-calendar"></i></span>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-sm-6">
                        <select class="form-control" placeholder="Type" tabindex="-1" title="">
                            <option>Bank Transfer</option>
                            <option>Cash</option>
                            <option>Check</option>
                            <option>credit card</option>
                        </select>
                    </div>
                    <div class="form-group text-right m-b-0">
                        <button type="submit" class="btn btn-md btn-primary" style="margin-top: 1.2em;" id="btn-clientSignIn">Add payment</button>
                    </div>
                </form>
            </div> <!-- /.modal-body -->
            <!-- /.modal-content -->
        </div>

    </div><!-- end col -->
    <form id="from-model" method="post"  action="<?php echo base_url('Invoice/insertdata'); ?>" class="frmsubmit" enctype="multipart/form-data"
          data-parsley-validate>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">
                    <h4>Invoice</h4>
                </div> -->
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="pull-left">
                            <?php
                            if(!empty($user_details[0]['company_logo'])){
                                $profile_img = base_url("/uploads/company_logo/" . $user_details[0]['company_logo']);
                            }
                            else{
                                $profile_img = base_url("/uploads/profile_images/boy-512.png");
                            }
                            ?>
                            <h3 class="logo"><img src="<?php echo $profile_img; ?>" alt="user-img" class="img-thumbnail img-responsive"></h3>
                        </div>
                        <div class="pull-right">
                            <?php if(!empty($user_details)){?>
                                <address>
                                    <strong><?php echo ucfirst($user_details[0]['company']);?></strong><br>
                                    <?php echo $user_details[0]['address'];?><br>
                                    <?php echo $user_details[0]['zipcode'];?><br>
                                    <abbr title="Phone">P:</abbr> <?php echo $user_details[0]['phone'];?>
                                </address>
                                <input type="hidden"  name="user_id" class="form-control" id="user_id" value="<?=!empty($user_details[0]['_id'])?$user_details[0]['_id']:0?>"/>
                            <?php }?>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="pull-left m-t-30">
                                <div class="select2-container form-control">
                                        <select class="form-control select2" name="client_id" required data-parsley-trigger="change" >
                                            <option value="">Select</option>
                                            <?php
                                            if (count($clients) > 0) {
                                                foreach($clients as $client_data){
                                            ?>
                                            <option <?php if (!empty($editrecord[0]['client_id']) && $editrecord[0]['client_id'] == $client_data["_id"]) {
                                                echo 'selected="selected"';
                                            } ?> value="<?php echo $client_data['_id'];?>"><?php echo $client_data['firstname'] . ' ' . $client_data['lastname']; ?></option>

                                                <?php }?>
                                            <?php }?>
                                        </select>
                                </div>
                            </div>


                            <div class="pull-right m-t-30">
                                <address>
                                    <input type="hidden" id="delete_item_id" name="delete_item_id" value="">
                                    <input type="hidden" id="invoice_id" name="invoice_id" value="<?= !empty($editrecord[0]['_id']) ? $editrecord[0]['_id'] : '' ?>">
                                    <input type="hidden"  name="invoice_auto_id" class="form-control" id="invoice_auto_id" placeholder=" *" value="<?=!empty($editrecord[0]['invoice_code'])?$editrecord[0]['invoice_code']:$invoice_auto_id?>" readonly />
                                    <input type="hidden"  name="order_date" class="form-control" id="order_date" placeholder="<?php echo date("F j, Y");?> *" value="<?=!empty($editrecord[0]['created_date'])?$editrecord[0]['created_date']:date("F j, Y")?>" readonly />
                                    <input type="hidden"  name="due_date" class="form-control" id="due_date" placeholder="<?php echo date("F j, Y");?> *" value="<?=!empty($editrecord[0]['due_date'])?$editrecord[0]['due_date']:date("F j, Y")?>" readonly />
                                    <strong>Invoice:  <?=!empty($editrecord[0]['invoice_code'])?$editrecord[0]['invoice_code']:$invoice_auto_id?></strong><br>
                                    <strong>Order Date: </strong><?=!empty($editrecord[0]['created_date'])?$editrecord[0]['created_date']:date("F j, Y")?><br>
                                    <strong>Due Date: </strong> <?=!empty($editrecord[0]['due_date'])?$editrecord[0]['due_date']:date("F j, Y")?><br>
                                </address>

                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="m-h-50"></div>
                    <!-- add auto-->
                    <div class="form-group">
                        <div class = "form-group row" id="add_items">
                            <div class="col-xs-12 col-md-12 visible-lg visible-md">
                                <div class="col-xs-12 col-md-1">
                                    <label>
                                        <?= lang('qty_hrs') ?> <span class="viewtimehide">*</span>
                                    </label>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <label>
                                        <?= lang('description') ?> <span class="viewtimehide">*</span>
                                    </label>
                                </div>

                                <div class="col-xs-12 col-md-2">
                                    <label>
                                        <?= lang('rate') ?> <span class="viewtimehide">*</span>
                                    </label>
                                </div>
                                <!-- <div class="col-xs-12 col-md-2">Type</div> -->

                                <div class="col-xs-12 col-md-2">
                                    <label>
                                        <?= lang('tax_rate') ?>
                                        (%)</label> <span class="viewtimehide">*</span>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <label>
                                        <?= lang('cost') ?>
                                    </label>
                                </div>
                                <div class="col-xs-12 col-md-1">
                                    <label>
                                        <?= lang('actions') ?>
                                    </label>
                                </div>
                            </div>
                            <?php if (!empty($item_details)) {
                                foreach ($item_details as $row) {
                                    ?>
                                    <div class="col-xs-12 col-md-12 form-group newrow" id="item_edit_<?= $row['_id'] ?>">
                                        <div class="col-xs-12 col-md-1">
                                            <input type="text" maxlength="5" name="qty_hours_<?= $row['_id'] ?>" onkeypress="return numericDecimal(event)" required class="form-control item_cal qty_item" placeholder="" value="<?= !empty($row['qty_hours']) ? $row['qty_hours'] : '' ?>">
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                            <input type="text" name="description_<?= $row['_id'] ?>" maxlength="80" class="form-control" placeholder="" required value="<?= !empty($row['description']) ? $row['description'] : '' ?>">
                                        </div>
                                        <div class="col-xs-12 col-md-2">
                                            <input type="text" maxlength="10" name="rate_<?= $row['_id'] ?>" onkeypress="return numericDecimal(event)" required class="form-control item_cal rate_item" placeholder="" value="<?= !empty($row['rate']) ? $row['rate'] : '' ?>">
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                            <select class="form-control item_cal tax_item" name="tax_rate_<?= $row['_id'] ?>" required data-parsley-trigger="change" >
                                                <option value=""><?= lang('tax') ?></option>
                                                <?php if (count($taxes) > 0) { ?>
                                                    <?php foreach ($taxes as $tax) { ?>
                                                        <option <?php if (!empty($row['tax_rate']) && $row['tax_rate'] == $tax["_id"]) {
                                                            echo 'selected="selected"';
                                                        } ?> value="<?= $tax["_id"] ?>"  data-tax="<?php echo $tax["tax"]; ?>"><?php echo $tax["tax_name"]; ?>  <?php echo $tax["tax"]; ?> </option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-xs-12 col-md-2">
                                            <input type="text" name="cost_<?= $row['_id'] ?>" onkeydown="return false" class="form-control total_cost" placeholder="" value="<?= !empty($row['cost']) ? $row['cost'] : '' ?>">
                                            <input type="hidden" name="cost_rate_<?= $row['_id'] ?>" onkeydown="return false" class="form-control cost_rate" placeholder="" value="<?= !empty($row['cost_rate']) ? $row['cost_rate'] : '' ?>">
                                            <input type="hidden" name="tax_sub_data_<?= $row['_id'] ?>" onkeydown="return false" class="form-control tax_sub_data" placeholder="" value="<?= !empty($row['tax_sub_data']) ? $row['tax_sub_data'] : '' ?>">
                                            <input type="hidden" name="tax_total_val_<?= $row['_id'] ?>" onkeydown="return false" class="form-control tax_total_val" data-tax_id="<?= !empty($row['tax_rate']) ? $row['tax_rate'] : '' ?>" placeholder="" value="<?= !empty($row['tax_total_val']) ? $row['tax_total_val'] : '' ?>">

                                        </div>
                                        <div class="col-xs-12 col-md-1"> <a class="pull-right btn btn-default "> <span class="glyphicon glyphicon-trash" onclick="delete_item_row('item_edit_<?= $row['_id'] ?>');"></span> </a> </div>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="form-group"> <a id="add_new_item" class="btn btn-default align-center"> <span class="glyphicon glyphicon-plus"></span>
                            <?= lang('add_more_item') ?>
                        </a> </div>
                    <!-- add auto close-->


                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="clearfix m-t-40">
                                <h5 class="small text-inverse font-600">PAYMENT TERMS AND POLICIES</h5>

                                <small>
                                    All accounts are to be paid within 7 days from receipt of
                                    invoice. To be paid by cheque or credit card or direct payment
                                    online. If account is not paid within 7 days the credits details
                                    supplied as confirmation of work undertaken will be charged the
                                    agreed quoted fee noted above.
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                            <p class="text-right">SubTotal: <span id="sub_price"> <?= !empty($editrecord[0]['amount']) ? $editrecord[0]['amount'] : '0' ?></span></p>
                            <p class="text-right"><?= lang('discount') ?>: <input type="text" maxlength="5" name="discount" data-parsley-gteqm="#discount" id="discount" data-parsley-required-message="Required" onkeypress="return numericDecimal(event)" class="form-control item_cal discount_item" placeholder="" value="<?= !empty($editrecord[0]['discount']) ? $editrecord[0]['discount'] : '0' ?>"></p>
                            <p class="text-right">Currency:<select class="form-control" name="country_info" data-parsley-trigger="change" >
                                    <?php if (count($country_info) > 0) { ?>
                                        <?php foreach ($country_info as $country) { ?>
                                            <option <?php if (!empty($editrecord[0]['currency']) && $editrecord[0]['currency'] == $country["_id"]) {
                                                echo 'selected="selected"';
                                            } ?> value="<?php echo $country["_id"]; ?>"><?php echo $country["currrency_symbol"]; ?></option>
                                            <?php
                                        }
                                    }

                                    ?>
                                </select></p>
                        <?php /* ?><p class="text-right">Tax: <span id="sub_tax"></span>%</p><?php */?>
                            <?php
                          //  pr($item_details);exit;
                            $taxArray=array();
                            if (!empty($item_details)) {
                                foreach ($item_details as $row) {
                                    $taxArray[$row['tax_rate']][]=$row['tax_total_val'];
                                    //    $taxArray[]=$row['tax_total_val'];
                                }
                            }
                            ?>
                            <?php if (count($taxes) > 0) { ?>
                                <?php
                                foreach ($taxes as $tax) {
                                    $taxSum=0;
                                    $taxid= $tax["_id"];
                                    $taxSum=isset($taxArray["$taxid"])?array_sum($taxArray["$taxid"]):0;

                                    ?>
                                    <p class="text-right"><?php echo $tax["tax_name"]; ?>(<?php echo $tax["tax"]; ?>%): <span id='<?php echo $tax["_id"];?>'><?php echo $taxSum;?></span></p>
                                    <?php
                                }
                            }
                            ?>

                            <p class="text-right">Tax Amount: <span id="cost_price"> <?= !empty($editrecord[0]['tax_amount']) ? $editrecord[0]['tax_amount'] : '0' ?> </span></p>
                            <hr>
                            <p class="text-right"><b><label class="  control-label">
                                        <?= lang('total_amount') ?>
                                        : <span id="total_item">
                                <?= !empty($editrecord[0]['total_payment']) ? $editrecord[0]['total_payment'] : '0.00' ?>
                                </span></label>
                                    <input type="hidden" name="amount_total" id="amount_total" value="<?= !empty($editrecord[0]['amount']) ? $editrecord[0]['amount'] : '' ?>" />
                                    <input type="hidden" name="total_tax_payment" id="total_tax_payment" value="<?= !empty($editrecord[0]['total_tax']) ? $editrecord[0]['total_tax'] : '' ?>" />
                                    <input type="hidden" name="add_dis_amount_total" id="add_dis_amount_total" value="<?= !empty($editrecord[0]['total_payment']) ? $editrecord[0]['total_payment'] : '' ?>" />
                                    <input type="hidden" name="tax_amount" id="tax_amount" value="<?= !empty($editrecord[0]['tax_amount']) ? $editrecord[0]['tax_amount'] : '0' ?>" />

                            </p>

                        </div>
                    </div>
                    <hr>
                    <div class="hidden-print">
                        <div class="pull-right">
                            <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                            <a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-lg-3">
            <div class="card-box">
                <div class="p-b-10">
                    <p>
                        <button class="btn btn-primary waves-effect waves-light" type="submit" name="save" value="save" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false"
                                aria-controls="collapseExample"> <i class="fa fa-cloud m-r-5"></i> Save
                        </button>
                        <button class="btn btn-primary waves-effect waves-light" type="submit" name="send" value="send" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false"
                                aria-controls="collapseExample"> <i class="fa fa-envelope-o m-r-5"></i>  Send
                        </button>
                        <button class="btn btn-primary waves-effect waves-light" type="submit" name="print" value="print" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false"
                                aria-controls="collapseExample"> <i class="fa fa-save m-r-5"></i>   Print
                        </button>

                    </p>
                </div>
                <h4 class="header-title m-t-0 m-b-30">Setting for this Invoice</h4>

                 <div class="inbox-widget nicescroll">
                <div class="panel-group" id="accordion" role="tablist"
                     aria-multiselectable="true">
                    <div class="panel panel-default bx-shadow-none">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse"
                                   data-parent="#accordion" href="#collapseOne"
                                   aria-expanded="true" aria-controls="collapseOne">
                                    Settings For The Invoice
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse"
                             role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                               
                                <h4 class="m-t-0 page-header header-title"> <i class="fa fa-money" style="padding-right:5px;"></i><b>Add Payment Options</b></h4>
                                <a href="#">
                                    STRIPE<br>
                                    <small>Stripe is an easy way to accept payment online simple pricing with no hidden or monthly costs:2.9% + $0.30 per transection Accept all major cards and currencies:Visa ,mastercard, Amex,Discover
                                    <!-- <a href="<?php echo base_url();?>Stripe" target="_blank" style="float:right;" class="btn btn-success waves-effect waves-light btn-sm m-b-5">Connect With Stripe</a> -->
                                    <a href="javascript:void(0)" id="stripe_call" style="float:right;" class="btn btn-success waves-effect waves-light btn-sm m-b-5">Connect With Stripe</a>
                                    </small>
                                </a>
                                <div style="clear:both;"></div>
                                <br>
                                <a href="#">
                                    PAYPAL<br>
                                    <small>Paypal is the faster,safer way to receive money or set up a merchant account Selling is 2.9% + $0.30 per sale
                                    <!-- <a href="<?php echo base_url();?>PayPal" target="_blank" style="float:right;" class="btn btn-success waves-effect waves-light btn-sm m-b-5">Connect With Paypal</a> -->
                                    <a href="javascript:void(0)" id="paypal_call" style="float:right;" class="btn btn-success waves-effect waves-light btn-sm m-b-5">Connect With Paypal</a>
                                    </small>
                                
                                </a>
                                <div style="clear:both;"></div>
                                <br>
                                <a href="#">
                                    IDEAL<br>
                                    <small>iDEAL is an e-commerce payment system based on online banking Only$0.29 per transaction
                                    </small>
                                    <!-- <a href="<?php echo base_url();?>Ideal" target="_blank" style="float:right;" class="btn btn-success waves-effect waves-light btn-sm m-b-5">Connect With Ideal</a> -->
                                    <a href="javascript:void(0)" id="ideal_call" style="float:right;" class="btn btn-success waves-effect waves-light btn-sm m-b-5">Connect With Ideal</a>
                                
                                </a>
                                <div style="clear:both;"></div>
                                
                                <?php
								/* print_r($stripe_data);
								echo "<br><br>";
								print_r($paypal_data);
								echo "<br><br>";
								print_r($ideal_data); */
								
								?>
                                <div class="stripe_form_container">
									<h1> Stripe </h1>
									<div class="col-lg-12">
										<div class="form-group">

											<div class="col-md-12">
												<input type="text" name="sk_key"  maxlength="25" id="sk_key" class="form-control" required placeholder="<?php echo lang('SecretKey'); ?>" value="<?php if(isset($stripe_data[0]['sk_key'])){ echo $stripe_data[0]['sk_key'];}?>">
											</div>
											
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<input type="text" name="pk_key"  maxlength="25" id="pk_key" class="form-control" required placeholder="<?php echo lang('PrivateKey'); ?>" value="<?php if(isset($stripe_data[0]['pk_key'])){ echo $stripe_data[0]['pk_key'];}?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-5	 col-sm-12">
												<button name="strip_submit" id="strip_submit" class="btn btn-primary waves-effect waves-light" type="button">
													<?php echo lang('save'); ?>
												</button>
											</div>
										</div> 
									</div><!-- end col -->
								</div>
								
								<div class="paypal_form_container">
									<h1> Paypal</h1>
									 <div class="col-lg-12">
										<div class="form-group">
											<div class="col-md-12">
												<input type="email" name="email"  maxlength="50" id="email" class="form-control" placeholder="<?php echo lang('email'); ?>" required parsley-type="email" value="<?php if(isset($paypal_data[0]['email'])){ echo $paypal_data[0]['email'];}?>">
											</div>
										</div>
                               
										<div class="form-group">
											<div class="col-sm-offset-5	 col-sm-12">
												<button name="paypal_submit" id="paypal_submit" class="btn btn-primary waves-effect waves-light" type="button">
													<?php echo lang('save'); ?>
												</button>
											</div>
										</div> 
									</div><!-- end col -->
								</div>
								
								
								<div class="ideal_form_container">
									<h1> IDEAL</h1>
									<?php
										
									?>
									<div class="col-lg-12">
										<div class="form-group">
											<div class="col-md-12">
												<input type="text" name="marchangeid"  maxlength="50" id="marchangeid" class="form-control" placeholder="<?php echo lang('marchangeid'); ?>" required  value="<?php if(isset($ideal_data[0]['marchangeid'])){ echo $ideal_data[0]['marchangeid'];}?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<input type="text" name="key"  maxlength="50" id="key" class="form-control" placeholder="<?php echo lang('key'); ?>" required  value="<?php if(isset($ideal_data[0]['key'])){ echo $ideal_data[0]['key'];}?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<input type="text" name="kerversion"  maxlength="50" id="kerversion" class="form-control" placeholder="<?php echo lang('kerversion'); ?>" required  value="<?php if(isset($ideal_data[0]['kerversion'])){ echo $ideal_data[0]['kerversion'];}?>">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-5	 col-sm-12">
												<button name="ideal_submit" id="ideal_submit" class="btn btn-primary waves-effect waves-light" type="button">
													<?php echo lang('save'); ?>
												</button>
											</div>
										</div> 
									</div><!-- end col -->
								</div>
								
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default bx-shadow-none">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse"
                                   data-parent="#accordion" href="#collapseTwo"
                                   aria-expanded="false" aria-controls="collapseTwo">
                                    <?php echo lang('make_recuring');?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse"
                             role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body" id="rightinvoice">
                                <?php echo lang('recurring1');?><br><br>
                                
	                                            <div class="form-group">
	                                                <label for="exampleInputEmail1"><?php echo lang('recurring2');?></label>
	                                                <input type="text" name="date"  class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" required="" data-parsley-trigger="change">
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="exampleInputPassword1"><?php echo lang('recurring3');?></label>
	                                                 <select class="form-control" id="howoften"  name="howoften" placeholder="Type" tabindex="-1" title="" required data-parsley-trigger="change">
														<option value=""><?= lang('select') ?></option>
														<option value="1"><?php echo lang('recurring4');?></option>
														<option value="2"><?php echo lang('recurring5');?></option>
														<option value="3"><?php echo lang('recurring6');?></option>
														<option value="4"><?php echo lang('recurring7');?></option>
														<option value="5"><?php echo lang('recurring8');?></option>
													</select>
	                                            </div>
	                                           <div class="form-group" >
	                                                <label for="exampleInputEmail1"><?php echo lang('recurring9');?></label>
	                                                <div class="radio radio-info">
														<div style="width: 43%;">
														<input type="radio" name="howmany" id="radio5" value="0">
														<label for="radio5">
															<?php echo lang('recurring10');?>
														</label>
														</div>
														
														<div style="width: 43%;">
														<input type="radio" name="howmany" id="radio6" value="1" data-parsley-mincheck="1" required>
														<label for="radio6">
															<?php echo lang('recurring11');?>
														</label>
														</div>
													</div>
	                                            </div>
	                                            
	                                            <div class="form-group" >
	                                                <label for="exampleInputEmail1"><?php echo lang('recurring12');?></label>
	                                                <div class="radio radio-info">
														<div>
														<input type="radio" name="delivery" id="radio7" value="0">
														<label for="radio7">
															<?php echo lang('recurring13');?>
														</label>
														</div>
														
														<div>
														<input type="radio" name="delivery" id="radio8" value="1" data-parsley-mincheck="1" required>
														<label for="radio8">
															<?php echo lang('recurring14');?>
														</label>
														</div>
													</div>
	                                            </div>
	                                            <button type="button" class="btn btn-purple waves-effect waves-light recurring">Submit</button>
	                                       
                                
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default bx-shadow-none">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse"
                                   data-parent="#accordion" href="#collapseThree"
                                   aria-expanded="false" aria-controls="collapseThree">
                                    <?php echo lang('send_reminders');?>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse"
                             role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
									<div class="col-sm-offset-3	 col-sm-12">
												<button name="create_reminder" id="create_reminder" class="btn btn-primary waves-effect waves-light create_reminder" type="button">
													<?php echo lang('create_reminder'); ?>
												</button>
									</div>
									
									<div class="reminder_set col-sm-offset-0 col-sm-11">
										<h5><b><?php echo lang('reminder');?></b></h5>

											<select class="form-control select_reminder">
												<option><?php echo lang('select_reminder');?></option>
												
													<option value="1"><?php echo lang('reminder_option1');?></option>
													<option value="2"><?php echo lang('reminder_option2');?></option>
													<option value="3"><?php echo lang('custom');?></option>
												
											  
											</select>
									</div>
									
									<div class="issue_date col-sm-offset-0 col-sm-11">
										
									<div class="issue_form">
											<div class="form-group">
	                                                <label for="exampleInputEmail1"><?php echo lang('after');?></label>
	                                                <input type="text" name="days"  class="form-control"  id="days" required="">
	                                                <label for="exampleInputEmail1"><?php echo lang('days');?></label>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="exampleInputPassword1"><?php echo lang('subject');?></label>
	                                                 <input type="text" name="subject" placeholder="<?php echo lang('subject');?>"  class="form-control"  id="subject" required="">
	                                            </div>
	                                           <div class="form-group" >
	                                                <label for="exampleInputEmail1"><?php echo lang('description');?></label>
	                                                <textarea name="issue_description" id="issue_description" placeholder="<?php echo lang('description');?>"></textarea>
	                                            </div>
	                                            <button type="button" class="btn btn-purple waves-effect waves-light issue_recurring">Submit</button>
	                              
									</div>
									</div>
									
									<div class="due_date dishit col-sm-offset-0 col-sm-11">
									
										<div class="form-group">
	                                                <label for="exampleInputEmail1"><?php echo lang('before');?></label>
	                                                <input type="text" name="days"  class="form-control"  id="days" required="">
	                                                <label for="exampleInputEmail1"><?php echo lang('days');?></label>
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="exampleInputPassword1"><?php echo lang('subject');?></label>
	                                                 <input type="text" name="subject" placeholder="<?php echo lang('subject');?>"  class="form-control"  id="subject" required="">
	                                            </div>
	                                           <div class="form-group" >
	                                                <label for="exampleInputEmail1"><?php echo lang('description');?></label>
	                                                <textarea name="due_description" id="due_description" placeholder="<?php echo lang('description');?>"></textarea>
	                                            </div>
	                                            
	                                            <button type="button" class="btn btn-purple waves-effect waves-light due_recurring">Submit</button>
									
									
									</div>
									
									<div class="custom_date col-sm-offset-0 col-sm-11">
									
									<div class="form-group">
	                                                <label for="exampleInputEmail1"><?php echo lang('on');?></label>
	                                                <input type="text"  name="custom_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-customrem">
	                                                
	                                            </div>
	                                            <div class="form-group">
	                                                <label for="exampleInputPassword1"><?php echo lang('subject');?></label>
	                                                 <input type="text" name="subject" placeholder="<?php echo lang('subject');?>"  class="form-control"  id="subject" required="">
	                                            </div>
	                                           <div class="form-group" >
	                                                <label for="exampleInputEmail1"><?php echo lang('description');?></label>
	                                                <textarea name="cust_description" id="cust_description" placeholder="<?php echo lang('description');?>"></textarea>
	                                            </div>
	                                            
	                                            <button type="button" class="btn btn-purple waves-effect waves-light cust_recurring">Submit</button>
									
									
									</div>
									
									</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div><!-- end col -->
    </form>
<script>
var recurring_url = "<?php echo base_url('Invoice/recurringadd'); ?>";
var reminder_url = "<?php echo base_url('Invoice/reminderadd'); ?>";
var stripe_url = "<?php echo base_url('Invoice/stripeAdd'); ?>";
var paypal_url = "<?php echo base_url('Invoice/paypalAdd'); ?>";
var ideal_url = "<?php echo base_url('Invoice/idealAdd'); ?>";
</script>
