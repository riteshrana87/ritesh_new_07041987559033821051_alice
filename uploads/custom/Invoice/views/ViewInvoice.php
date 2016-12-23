<script>
    var view_name = 'Add';
</script>
<div class="row">
    
    <div class="col-lg-3"> </div>
    <div class="col-lg-6">
		<div class="col-sm-0">
			<a type="button" href="javascript:void(0)" title="Click to Print This Invoice" id="prnt_inv" class="btn btn-primary btn-bordred waves-effect w-lg waves-light m-b-5 "><i class="fa fa-print" aria-hidden="true"></i> <?php echo lang('invoice_print') ?></a>
			<a type="button" href="<?php echo base_url('Invoice/Edit/') . $editrecord[0]['_id']  ?>" title="Click to Edit This Invoice" class="btn btn-success btn-bordred waves-effect w-lg waves-light m-b-5 pull-right"><i class="fa fa-pencil"></i> <?php echo lang('edit_invoice') ?></a>
		</div>
	</div>
	<div style="clear:both"> </div>
    <div class="col-lg-3">
        

    </div><!-- end col -->
    <form id="from-model" method="post"  action="<?php echo base_url('Invoice/insertdata'); ?>" name="frmsubmit" class="frmsubmit" enctype="multipart/form-data" data-parsley-validate>
     
        <div class="col-lg-6" id="rbl">
            <div class="panel panel-default">
                <div id="errorMsgLoader" class="text-center"> </div>
                <!-- <div class="panel-heading">
                    <h4>Invoice</h4>
                </div> -->
                <div class="panel-body">
                    <div class="clearfix">
                        <div class="pull-left">
                            <?php
                            if (!empty($CompanyInformation[0]['company_logo'])) {
                                $profile_img = base_url("/uploads/company_logo/" . $CompanyInformation[0]['company_logo']);
                            } else {
                                $profile_img = base_url("/uploads/profile_images/boy-512.png");
                            }
                            ?>
                           <h3 class="logo"><img src="<?php echo $profile_img; ?>" alt="user-img" class="img-thumbnail img-responsive"></h3>
                        </div>
                        <div class="pull-right">
                            <?php if (!empty($CompanyInformation)) { ?>
                                <address>
                                    <strong><?php echo ucfirst($CompanyInformation[0]['company']); ?></strong><br>
                                    <?php echo $CompanyInformation[0]['address']; ?><br>
                                    <?php echo $CompanyInformation[0]['company_email']; ?><br>
                                    <abbr title="Phone">P:</abbr> <?php echo $CompanyInformation[0]['phone']; ?>
                                </address>
                                <input type="hidden"  name="user_id" class="form-control" id="user_id" value="<?= !empty($user_details[0]['_id']) ? $user_details[0]['_id'] : 0 ?>"/>
                            <?php } ?>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-lg-8">
                                                    <address>
                                                        <strong id="full_name"><?php echo ucfirst($client_data[0]['firstname']).' '. $client_data[0]['lastname'] ; ?></strong><br />
                                                      <?php echo $client_data[0]['address']; ?><br>
                                                      <?php echo $client_data[0]['zipcode'] .','. $client_data[0]['city']; ?><br>
                                                      <?php echo $client_data[0]['state'] .','. $client_data[0]['country']; ?><br>
                                                      <abbr title="Phone">P:</abbr> (123) 456-7890
                                                      </address>
                                
                            </div>
                            
                            
                            <div class="col-lg-4 ">
                                <address>
                                    <input type="hidden" name="hdn_submit_status" id="hdn_submit_status" value="1" />
                                    <input type="hidden" name="HdnSubmitBtnVlaue" id="HdnSubmitBtnVlaue" value="save" />
                                    <input type="hidden" name="HdnChangeEmailTmp" id="HdnChangeEmailTmp" value="no" />
                                    
                                    <input type="hidden" id="delete_item_id" name="delete_item_id" value="">

                                    <input type="hidden" id="invoice_id" name="invoice_id" value="<?= !empty($editrecord[0]['_id']) ? $editrecord[0]['_id'] : '' ?>">
                                    <input type="hidden"  name="invoice_auto_id" class="form-control" id="invoice_auto_id" placeholder=" *" value="<?= !empty($editrecord[0]['invoice_code']) ? $editrecord[0]['invoice_code'] : $invoice_auto_id ?>" readonly />
                                    <strong>Invoice Number: <?= !empty($editrecord[0]['invoice_code']) ? $editrecord[0]['invoice_code'] : $invoice_auto_id ?></strong> <br /> 
                                    <strong>Date of Issue: <?= !empty($editrecord[0]['created_date']) ? $editrecord[0]['created_date'] : '' ?></strong> <br />
                                    <strong>Due Date: <?= !empty($editrecord[0]['due_date']) ? $editrecord[0]['due_date'] :'' ?></strong> 
                                </address>
                            </div>
                            <div class="col-md-12 col-sm-6 col-xs-6">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="clearfix m-t-40">
                                                    <h5 class="small text-inverse font-600">Summary</h5>
                                                    <small>
                                                        <?= !empty($editrecord[0]['summary']) ? $editrecord[0]['summary'] : '' ?>
                                                    </small>
                                                </div>
                                            </div>
                                
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="m-h-50"></div>
                    <!-- add auto-->
                    <div class="form-group">
                        <div class = "form-group row" id="add_items">
                            <div class="col-xs-12 col-md-12 visible-lg visible-md">
                                <div class="col-xs-12 col-md-2">
                                    <label>
                                        <?= lang('qty_hrs') ?> <span class="viewtimehide">*</span>
                                    </label>
                                </div>
                                <div class="col-xs-12 col-md-3">
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

                                <div class="col-xs-12 col-md-3">
                                    <label>
                                        <?= lang('tax_rate') ?>
                                        (%)</label> <span class="viewtimehide">*</span>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <label>
                                        <?= lang('cost') ?>
                                    </label>
                                </div>
                            </div>
                            <?php
                            if (!empty($item_details)) {
                                foreach ($item_details as $row) {
                                    ?>
                                    <div class="col-xs-12 col-md-12 form-group newrow" id="item_edit_<?= $row['_id'] ?>">
                                        <div class="col-xs-12 col-md-2">
                                            <?= !empty($row['qty_hours']) ? $row['qty_hours'] : '' ?>
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                            <?= !empty($row['description']) ? $row['description'] : '' ?>
                                        </div>
                                        <div class="col-xs-12 col-md-2">
                                            <?= !empty($row['rate']) ? $row['rate'] : '' ?>
                                        </div>
                                        <div class="col-xs-12 col-md-3">
                                                <?php if (count($taxes) > 0) { ?>
                                                    <?php foreach ($taxes as $tax) { ?>
                                                        <?php
                                                        if (!empty($row['tax_rate']) && $row['tax_rate'] == $tax["_id"]) {?>
                                                           <?php echo $tax["tax_name"]; ?> (<?php echo $tax["tax"]; ?>%)
                                                        <?php }?>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                        </div>

                                        <div class="col-xs-12 col-md-2">
                                            <?= !empty($row['cost_rate']) ? $row['cost_rate'] : '' ?>
                                            <input type="hidden" name="cost_rate_<?= $row['_id'] ?>" data-tax_id="<?= !empty($row['tax_rate']) ? $row['tax_rate'] : '' ?>" onkeydown="return false" class="form-control cost_rate" placeholder="" value="<?= !empty($row['cost_rate']) ? $row['cost_rate'] : '' ?>">
                                            <input type="hidden" name="tax_sub_data_<?= $row['_id'] ?>" onkeydown="return false" class="form-control tax_sub_data" placeholder="" value="<?= !empty($row['tax_sub_data']) ? $row['tax_sub_data'] : '' ?>">
                                            <input type="hidden" name="tax_total_val_<?= $row['_id'] ?>"  onkeydown="return false" class="form-control tax_total_val" placeholder="" value="<?= !empty($row['tax_total_val']) ? $row['tax_total_val'] : '' ?>">

                                        </div>
                                    </div>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <!-- add auto close-->

                    <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-6">
                                                <p class="text-right"><b>Excluding Tax:</b> <?= !empty($editrecord[0]['sub_price']) ? $editrecord[0]['sub_price'] : '0' ?></p>
                                                <p class="text-right"><?= lang('discount') ?>: <?= !empty($editrecord[0]['discount']) ? $editrecord[0]['discount'] : '0' ?>
                                                
                                                    <?php if($editrecord[0]['discount_type'] == 1){
                                                        echo '%';
                                                    }else{
                                                        echo '';
                                                    }
                                                    ?>
                                                </p>
                                                <p class="text-right"><b>Tax Amount:</b> <?= !empty($editrecord[0]['tax_amunt']) ? $editrecord[0]['tax_amunt'] : '' ?></p>
                                                
                                                                  
                                                <?php
                            //  pr($item_details);exit;
                            $taxArray = array();
                            if (!empty($finalarr)) {
                                foreach ($finalarr as $key => $row) {
                                    $taxArray[$key][] = $row;
                                    //    $taxArray[]=$row['tax_total_val'];
                                }
                            }
                           // pr($taxArray);exit;
                            
                            ?>
            
              <?php if (count($taxes) > 0) { ?>
                                <?php
                                foreach ($taxes as $tax) {
                                    $taxSum = 0;
                                    $taxid = $tax["_id"];
                                    $taxSum = isset($taxArray["$taxid"]) ? array_sum($taxArray["$taxid"]) : 0;
                                    $taxedit = 0;
                                    if (isset($editrecord)) {
                                        if (($taxSum)>0) {
                                            $class = '';
                                        } else {
                                            $class='hidden';
                                        }
                                    }
                                    else
                                    {
                                         $class='hidden';
                                    }
                                    ?>
                            <p class="text-right <?php echo $class; ?>"><?php echo $tax["tax_name"]; ?>(<?php echo $tax["tax"]; ?>%): <?php echo $taxSum; ?></p>
                        <?php } } ?>
                            <hr>
                                                <h3 class="text-right"><?= lang('total_amount') ?>: <?= !empty($editrecord[0]['total_payment']) ? $editrecord[0]['total_payment'] : '0.00' ?></h3>
                                                
                                            </div>
                    
                    
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-6 col-xs-6">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="clearfix m-t-40">
                                                    <h5 class="small text-inverse font-600">Terms And Conditions</h5>
                                                    <small>
                                                       <?= !empty($editrecord[0]['terms_and_conditions']) ? $editrecord[0]['terms_and_conditions'] : '' ?>
                                                    </small>
                                                </div>
                                            </div>
                                
                            </div>
                        
                    </div>
					
                    <div class="row">
					<?php
					
									$today_date = strtotime(date('F d, Y'));
									$rt =strtotime($editrecord[0]['due_date']);
									if($editrecord[0]['save_type'] != 'save'){
										if(!empty($editrecord[0]['payment_status'])){
											if($editrecord[0]['payment_status'] == 'full'){
												$cl = 'invoice_paid';
												$tx = 'Paid';
											}
											else if($editrecord[0]['payment_status'] == 'partial') {
												if($today_date > $rt){
													$cl = 'overdue_invoice';
													$tx = 'Overdue';
												}
												else if($today_date <= $rt){
													$cl = 'outstanding_invoice';
													$tx = 'Outstanding';
												}
											}
										}
										else{
											if($today_date > $rt){
												$cl = 'invoice_overdue';
												$tx = 'Overdue';
											}
											else if($today_date <= $rt){
												$cl = 'outstanding_invoice';
												$tx = 'Outstanding';
											}
										}
									}
									else if($editrecord[0]['save_type'] == 'save' && $editrecord[0]['payment_status'] =='' ){
										$cl = 'invoice_draft';
												$tx = 'Draft';
									}
									else{
										if(!empty($editrecord[0]['payment_status'])){
											if($editrecord[0]['payment_status'] == 'full'){
												$cl = 'invoice_paid';
												$tx = 'Paid';
											}
											else if($editrecord[0]['payment_status'] == 'partial') {
												if($today_date > $rt){
													$cl = 'invoice_overdue';
													$tx = 'Overdue';
												}
												else if($today_date <= $rt){
													$cl = 'outstanding_invoice';
													$tx = 'Outstanding';
												}
											}
										}
										else{
										if($today_date > $rt){
												$cl = 'invoice_overdue';
												$tx = 'Overdue';
											}
											else if($today_date <= $rt){
												$cl = 'outstanding_invoice';
												$tx = 'Outstanding';
											}
										}
									}
									
									
									?>
                        <div class="col-md-12 col-sm-6 col-xs-6">
                            	<div class="col-md-12 text-center <?php echo $cl ?>">
                                        <?php echo '<h3>'.$tx.'</h3>';?>
                                </div>		
                        </div>
                    </div>
					
                </div>

            </div>

        </div>
     </form>  
	 <div style="clear:both"> </div>
	 <div class="col-lg-3"> </div>
	   <div class="col-lg-6">
                 <div class="card-box">

            <h4 class="header-title m-t-0 m-b-30"><?php echo lang('payment_history'); ?></h4>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Paid Amount</th>
                            <th>Payment With</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
								foreach($InvoicePaid as $inp){
							?>
							<tr>
								<td> <?php echo $inp['payment_date'];  ?> </td>
								<td> <?php echo $inp['paid_amount'];  ?> </td>
								<td> <?php echo $inp['payment_with'];  ?> </td>
							</tr>
							<?php
								}
							?>
                    </tbody>
                </table>
            </div>

        </div>
               
        </div>
	<!--	
<div id="content">
     <h3>Hello, this is a H3 tag</h3>

    <p>a pararaph</p>
</div>
<div id="editor"></div>
<button id="cmd">generate PDF</button>
-->
		
		
		
</div>
<div class="modal in" id="invChangeEmailTemplate" role="dialog">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <input type="hidden" name="hdn_submit_status" id="hdn_submit_status" value="1" />
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h4 class="modal-title">
          <div class="modelTaskTitle"> <?php echo lang('INV_TITLE_PRD_EMAIL_TEMPLATE'); ?> </div>
        </h4>
      </div>
      <form name="post" id="send_files_data" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
          <label for="emailTemplate_sub">
            <?=$this->lang->line('emailTemplate_sub')?>
            *</label>
          <input class="form-control" name="emailTemplate_sub" id="emailTemplate_sub" placeholder="<?=$this->lang->line('emailTemplate_sub')?>" type="text" value="<?=!empty($EmailTMPInfo[0]['subject'])?$EmailTMPInfo[0]['subject']:''?>" required="" />
        </div>
        <div class="form-group">
          <label for="emailTemplate_body">
            <?=$this->lang->line('emailTemplate_body')?>
            *</label>
          <ul class="parsley-errors-list filled hidden" id="emailTemplate_body_Error" >
            <li class="parsley-required"><?php echo lang('EST_ADD_LABEL_REQUIRED_FIELD'); ?></li>
          </ul>
          <textarea class="form-control" id="emailTemplate_body" name="emailTemplate_body" placeholder="<?=$this->lang->line('emailTemplate_body')?>" value="" ><?=!empty($EmailTMPInfo[0]['body'])?$EmailTMPInfo[0]['body']:''?>
</textarea>
        </div>
          
          <div class="form-group">
          <label for="emailTemplate_body">
            </label>
          <?php if(!empty($pdf_report_link)){?>
              <img style=" width: 100px;" src="<?php echo base_url();?>/uploads/assets/images/pdf.jpg">
          <?php }else{ ?>
             <label for="emailTemplate_body">pdf not Created</label>
          <?php }?>
        </div>
          
          <div class="form-group">
              <input type="file" name="attach_fle" >
        </div>
      </div>
      </form>
      <div class="modal-footer">
        <center>
          <a onclick="estSendWithCustEmailTemp();" href="javascript:;">
          <input type="button" value="<?php echo lang('EST_EDIT_SAVE');?>" name="remove" class="btn btn-info">
          </a>
        </center>
      </div>
    </div>
  </div>
    
    
</div>

<div id="printDIV" class=""></div>

    <script>
        var recurring_url = "<?php echo base_url('Invoice/recurringadd'); ?>";
    </script>
<style>
.header-title.m-t-0.m-b-30.amount {
  color: orange;
  font-size: 40px;
}
#overdue_price{ color: red } 
#outstanding_price{ color:orange }
#draft_price{ color:#71b6f9 }

.overdue_invoice{
	background-color:red;
}
.client_name{
	border-bottom:1px solid #000;
}
.invoice_paid{
	background-color:#10c469 ;
}
.invoice_overdue{
	background-color:red ;
}
.invoice_draft{
	background-color:#71b6f9 ;
}
.outstanding_invoice{
	background-color:orange ;
}

.invoice_paid h3, .overdue_invoice h3, .invoice_overdue h3, .invoice_draft h3, .outstanding_invoice h3{
	color:#fff;
}

</style>