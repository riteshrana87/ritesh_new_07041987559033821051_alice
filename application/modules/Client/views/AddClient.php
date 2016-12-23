<script>
    var view_name = 'Add';
</script>
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
        <div class="col-md-8">
            <div class="add_client_header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></div>
            <div class="card-box form_field">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-horizontal" role="form" id="ClientForm" name="ClientForm" method="post" action="<?php echo base_url('Client/InsertData'); ?>">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="text" name="firstname" maxlength="25" id="firstname" class="form-control" required placeholder="<?php echo lang('firstname'); ?> *">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="lastname" maxlength="25" id="lastname" class="form-control" required placeholder="<?php echo lang('lastname'); ?> *">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" id="company" maxlength="50" name="company" class="form-control"  placeholder="<?php echo lang('company'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="email" name="email" maxlength="50" id="email" class="form-control" placeholder="<?php echo lang('email'); ?> *" required parsley-type="email">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="phone" id="phone" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="25"  class="form-control" placeholder="<?php echo lang('phone_no'); ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" id="address" name="address" placeholder="<?php echo lang('ADDRESS_1'); ?> *" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="text" name="zipcode" id="zipcode" class="form-control" maxlength="10" required placeholder="<?php echo lang('zipcode'); ?> *">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="city" required  id="city" class="form-control" maxlength="25" placeholder="<?php echo lang('city'); ?> *">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="text" name="state" id="state" class="form-control" maxlength="25"  placeholder="<?php echo lang('state'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="country" required id="country" class="form-control" maxlength="25" placeholder="<?php echo lang('country'); ?> *">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button name="submit" id="submit" class="btn btn-success btn-lg waves-effect waves-light" type="submit"><?php echo lang('create_client'); ?></button>
                                    <button class="btn btn-default btn-lg waves-effect waves-light m-l-5" type="reset" onclick="goBack()">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>
        </div><!-- end col -->
        <div class="col-md-4">
            <div class="card-box right_side_form">
                <h4 class="header-title m-t-0 m-b-30"><?php echo lang('client_settings_followup'); ?></h4>
                <div class="inbox-widget nicescroll">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default bx-shadow-none">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <div class="icon">
                                    <img src="<?php echo base_url(); ?>/uploads/assets/images/client_add/set-alarm.svg"/>
                                </div>
                                <div class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <?php echo lang('send_reminders'); ?>
                                    </a>
                                </div>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <!--
										<?php
                                    if (!empty($send_reminder)) {
                                        ?>
										<div class="table-responsive reminder_table">
											<table class="table">
												<thead class="reminder_table_head">
												<tr>
													<th>Days</th>
													<th>Subject</th>
													<th>Type</th>
												</tr>
												</thead>
												<tbody class="reminder_table_body">
										<?php
                                        $i = 1;
                                        foreach ($send_reminder as $reminder) {
                                            ?>
											<tr>
												<td><?php echo $reminder['days'];
                                            if ($reminder['reminder_type'] == 1) {
                                                echo ' Afrter';
                                            } else {
                                                echo ' Before';
                                            } ?></td>
												<td><?php echo $reminder['subject']; ?></td>
												<td><?php if ($reminder['reminder_type'] == 1) {
                                                echo lang('reminder_option1');
                                            } else if ($reminder['reminder_type'] == 2) {
                                                echo lang('reminder_option2');
                                            } else {
                                                echo lang('custom');
                                            } ?></td>
											</tr>
										<?php
                                            $i++;
                                        }
                                        ?>
										</tbody>
										</table>
										</div>
										<?php
                                    }
                                    ?>
										<div class="col-sm-offset-3	 col-sm-12">
													<button name="create_reminder" id="create_reminder" class="btn btn-primary waves-effect waves-light create_reminder" type="button">
														<?php echo lang('create_reminder'); ?>
													</button>
										</div>

										<div class="reminder_set col-sm-offset-0 col-sm-11">
											<h5><b><?php echo lang('reminder'); ?></b></h5>

												<select class="form-control select_reminder">
													<option><?php echo lang('select_reminder'); ?></option>

														<option value="1"><?php echo lang('reminder_option1'); ?></option>
														<option value="2"><?php echo lang('reminder_option2'); ?></option>
														<option value="3"><?php echo lang('custom'); ?></option>


												</select>
										</div>

										<div class="issue_date col-sm-offset-0 col-sm-11">
											<div class="issue_form">
												<div class="form-group">
		                                                <label for="exampleInputEmail1"><?php echo lang('after'); ?></label>
														 <input type="hidden" value="<?= !empty($editrecord[0]['invoice_code']) ? $editrecord[0]['invoice_code'] : $invoice_auto_id ?>" name="invoice_idafter" class="form-control" id="invoice_idafter">
		                                                <input type="text" name="after_days"  class="form-control"  id="after_days" required="">
		                                                <label for="exampleInputEmail1"><?php echo lang('days'); ?></label>
		                                            </div>
		                                            <div class="form-group">
		                                                <label for="exampleInputPassword1"><?php echo lang('subject'); ?></label>
		                                                 <input type="text" name="after_subject" placeholder="<?php echo lang('subject'); ?>"  class="form-control"  id="after_subject" required="">
		                                            </div>
		                                           <div class="form-group" >
		                                                <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
		                                                <textarea name="issue_description" id="issue_description" placeholder="<?php echo lang('description'); ?>"></textarea>
		                                            </div>
		                                            <button type="button" class="btn btn-purple waves-effect waves-light issue_recurring">Submit</button>
											</div>
										</div>

										<div class="due_date col-sm-offset-0 col-sm-11">
											<div class="issue_form1">
												<div class="form-group">
														<input type="hidden" value="<?= !empty($editrecord[0]['invoice_code']) ? $editrecord[0]['invoice_code'] : $invoice_auto_id ?>" name="invoice_idbefore" class="form-control" id="invoice_idbefore">
		                                                <label for="exampleInputEmail1"><?php echo lang('before'); ?></label>
		                                                <input type="text" name="before_days"  class="form-control"  id="before_days" required="">
		                                                <label for="exampleInputEmail1"><?php echo lang('days'); ?></label>
		                                        </div>
		                                        <div class="form-group">
		                                                <label for="exampleInputPassword1"><?php echo lang('subject'); ?></label>
		                                                 <input type="text" name="before_subject" placeholder="<?php echo lang('subject'); ?>"  class="form-control"  id="before_subject" required="">
		                                        </div>
		                                        <div class="form-group" >
		                                                <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
		                                                <textarea name="due_description" id="due_description" placeholder="<?php echo lang('description'); ?>"></textarea>
		                                        </div>
		                                        <button type="button" class="btn btn-purple waves-effect waves-light due_recurring">Submit</button>
											</div>

										</div>

										<div class="custom_date col-sm-offset-0 col-sm-11">
											<div class="issue_form2">
													<div class="form-group">
														<input type="hidden" value="<?= !empty($editrecord[0]['invoice_code']) ? $editrecord[0]['invoice_code'] : $invoice_auto_id ?>" name="invoice_idcustome" class="form-control" id="invoice_idcustome">
		                                                <label for="exampleInputEmail1"><?php echo lang('on'); ?></label>
		                                                <input type="text"  name="custom_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-customrem">

		                                            </div>
		                                            <div class="form-group">
		                                                <label for="exampleInputPassword1"><?php echo lang('subject'); ?></label>
		                                                 <input type="text" name="custom_subject" placeholder="<?php echo lang('subject'); ?>"  class="form-control"  id="custom_subject" required="">
		                                            </div>
		                                           <div class="form-group" >
		                                                <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
		                                                <textarea name="cust_description" id="cust_description" placeholder="<?php echo lang('description'); ?>"></textarea>
		                                            </div>

		                                            <button type="button" class="btn btn-purple waves-effect waves-light cust_recurring">Submit</button>
										</div>
										</div>
									-->
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default bx-shadow-none">
                            <div class="panel-heading" role="tab" id="headingSecond">
                                <div class="icon">
                                    <img src="<?php echo base_url(); ?>/uploads/assets/images/client_add/atm.svg"/>
                                </div>
                                <div class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseSecond" aria-expanded="false" aria-controls="collapseSecond">
                                        <?php echo lang('charge_overdue'); ?>
                                    </a>
                                </div>
                            </div>
                            <div id="collapseSecond" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSecond">
                                <div class="panel-body" id="rightinvoice">
                                    <input type="hidden" value="" name="client_idcurlang" class="form-control" id="client_idcurlang">
                                    <div class="curlang">
                                        <div class="form-group">
                                            <input type="text" name="overdue_days" onkeypress="return numericDecimal(event)" maxlength="50" id="overdue_days" class="form-control" placeholder="<?php echo lang('overdue_days'); ?>" required
                                                   value="<?php if (isset($ideal_data[0]['overdue_days'])) {
                                                       echo $ideal_data[0]['overdue_days'];
                                                   } ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="overdue_fees" onkeypress="return numericDecimal(event)" maxlength="50" id="overdue_fees" class="form-control" placeholder="<?php echo lang('overdue_fees'); ?>" required
                                                   value="<?php if (isset($ideal_data[0]['overdue_fees'])) {
                                                       echo $ideal_data[0]['overdue_fees'];
                                                   } ?>">
                                        </div>
                                        <button class="btn btn-custom waves-effect waves-light" id="client-nofee">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default bx-shadow-none">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <div class="icon">
                                    <img src="<?php echo base_url(); ?>/uploads/assets/images/client_add/translate.svg"/>
                                </div>
                                <div class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <?php echo lang('currency_language'); ?>
                                    </a>
                                </div>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingFour">
                                <div class="panel-body" id="rightinvoice">
                                    <input type="hidden" value="" name="client_idcurlang" class="form-control"
                                           id="client_idcurlang">
                                    <div class="curlang">
                                        <div class="form-group">
                                            <label for="invoice_currency"><?php echo lang('invoice_currency'); ?></label>
                                            <?php
                                            /* foreach($clients as $cl){
                                                if($cl['_id'] == !empty($editrecord[0]['client_id'])){
                                                    $cur = $cl['currency'] ;
                                                    $lan = $cl['language'] ;
                                                }
                                                else{
                                                }
                                            } */
                                            ?>
                                            <select class="form-control" id="invoice_currency" name="invoice_currency"
                                                    placeholder="Type" tabindex="-1" title="" required
                                                    data-parsley-trigger="change">
                                                <!-- <option value=""><?= lang('select') ?></option> -->
                                                <option value="$" <?php if (!empty($cur)) {
                                                    if ($cur == '$') {
                                                        echo "selected";
                                                    }
                                                } ?> >Dollar - $
                                                </option>
                                                <option value="£" <?php if (!empty($cur)) {
                                                    if ($cur == '£') {
                                                        echo "selected";
                                                    }
                                                } ?> >Pound - £
                                                </option>
                                                <option value="₹" <?php if (!empty($cur)) {
                                                    if ($cur == '₹') {
                                                        echo "selected";
                                                    }
                                                } ?> >Rupee - ₹
                                                </option>
                                                <option value="€" <?php if (!empty($cur)) {
                                                    if ($cur == '€') {
                                                        echo "selected";
                                                    }
                                                } ?> >Euro - €
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="invoice_language"><?php echo lang('invoice_language'); ?></label>
                                            <select class="form-control" id="invoice_language" name="invoice_language"
                                                    placeholder="Type" tabindex="-1" title="" required
                                                    data-parsley-trigger="change">
                                                <!-- <option value=""><?= lang('select') ?></option> -->
                                                <option value="English" <?php if (!empty($lan)) {
                                                    if ($lan == 'English') {
                                                        echo "selected";
                                                    }
                                                } ?> >English
                                                </option>
                                                <option value="German" <?php if (!empty($lan)) {
                                                    if ($lan == 'German') {
                                                        echo "selected";
                                                    }
                                                } ?> >German
                                                </option>
                                                <option value="Hindi" <?php if (!empty($lan)) {
                                                    if ($lan == 'Hindi') {
                                                        echo "selected";
                                                    }
                                                } ?> >Hindi
                                                </option>
                                                <option value="French" <?php if (!empty($lan)) {
                                                    if ($lan == 'French') {
                                                        echo "selected";
                                                    }
                                                } ?> >French
                                                </option>
                                                <option value="Dutch" <?php if (!empty($lan)) {
                                                    if ($lan == 'Dutch') {
                                                        echo "selected";
                                                    }
                                                } ?> >Dutch
                                                </option>
                                            </select>
                                        </div>
                                        <!-- <button id="invoice_langcurr" type="button" class="btn btn-purple waves-effect waves-light">Submit</button> -->
                                        <button class="btn btn-custom waves-effect waves-light" id="client-nocur">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

