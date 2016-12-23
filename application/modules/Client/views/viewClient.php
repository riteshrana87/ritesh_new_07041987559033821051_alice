<script>
    var view_name = 'View';
    var note_delete = "Are you sure? you want to delete this note";
    var curlan_url = "<?php echo base_url('Client/curlanAdd'); ?>";
    var feeoverdue_url = "<?php echo base_url('Client/feeoverdueAdd'); ?>";
</script>
<?php
$sortOrder = 'asc';
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="add_client_header">View Client</div>
            <div class="card-box form_field">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-horizontal" role="form" id="ClientForm" name="ClientForm" method="post" action="<?php echo base_url('Client/UpdateData'); ?>">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="text" name="firstname" maxlength="25" id="firstname" class="form-control" value="<?php echo $client[0]['firstname']; ?>" required placeholder="<?php echo lang('firstname'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="lastname" maxlength="25" id="lastname" class="form-control" value="<?php echo $client[0]['lastname']; ?>" required placeholder="<?php echo lang('lastname'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" id="company" maxlength="50" name="company" value="<?php echo $client[0]['company']; ?>" class="form-control" required placeholder="<?php echo lang('company'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="text" name="email" maxlength="50" id="email" class="form-control" value="<?php echo $client[0]['email']; ?>" placeholder="<?php echo lang('email'); ?>" required parsley-type="email">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="phone" id="phone" value="<?php echo $client[0]['phone']; ?>" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="25" required class="form-control" placeholder="<?php echo lang('phone_no'); ?>">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" id="address" name="address" placeholder="<?php echo lang('ADDRESS_1'); ?>" value="<?php echo $client[0]['address']; ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="text" name="zipcode" id="zipcode" class="form-control" value="<?php echo $client[0]['zipcode']; ?>" maxlength="10" required placeholder="<?php echo lang('zipcode'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="city" required id="city" class="form-control" value="<?php echo $client[0]['city']; ?>" maxlength="25" placeholder="<?php echo lang('city'); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="text" name="state" id="state" class="form-control" value="<?php echo $client[0]['state']; ?>" maxlength="25" required placeholder="<?php echo lang('state'); ?>">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="country" required id="country" class="form-control" value="<?php echo $client[0]['country']; ?>" maxlength="25" placeholder="<?php echo lang('country'); ?>">
                                </div>
                            </div>
                            <hr>
                        </form>
                    </div><!-- end col -->
                    <div class="row">
                        <div class="page_inside">
                            <h1 class="page-title">
                                <a class="sidebar-toggle-btn trigger-toggle-sidebar">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line line-angle1"></span>
                                    <span class="line line-angle2"></span>
                                </a>
                            </h1>
                            <div class="action-bar">
                                <ul class="list-inline m-b-0">
                                    <li><h3 class="title_head"><?php echo lang('invoices'); ?></h3></li>
                                    <li>
                                        <!-- <i title='<?php echo lang('gridview'); ?>' onclick="loadViewInvoice('Grid', '<?php echo base_url('Client/view_ajax/' . $client[0]['_id']); ?>')" class="fa fa-file-o fa-1x cursor"></i>&nbsp; -->
                                        <a href="<?php echo base_url('Client/View_page/' . $client[0]['_id'] . '/grid'); ?>"><i title='<?php echo lang('Client'); ?>' class="fa fa-file-o fa-2x cursor"></i></a></li>
                                    <li>
                                        <!-- <i title='<?php echo lang('listview'); ?>' onclick="loadViewInvoice('List', '<?php echo base_url('Client/view_ajax/' . $client[0]['_id']); ?>')"  class="fa fa-align-justify fa-1x cursor"></i> -->
                                        <a href="<?php echo base_url('Client/View_page/' . $client[0]['_id'] . '/list'); ?>"><i title='<?php echo lang('Client'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a> &nbsp;
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="replacementdiv" style="padding: 0 20px;">
                            <?php //echo $this->load->view($invoiceView); ?>
                            <?php //echo $this->load->view('ListView');
                            if ($view == 'list') {
                                //echo $this->input->get('view');
                                $this->load->view('ListViewInvoice');
                            } else {
                                echo $this->load->view('GridViewInvoice');
                            }
                            ?>
                        </div>
                    </div>
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
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <?php echo lang('send_reminders'); ?>
                                    </a>
                                </div>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <?php
                                    if (!empty($show_reminders)) {
                                        ?>
                                        <div class="table-responsive reminder_table">
                                            <table class="table">
                                                <thead class="reminder_table_head">
                                                <tr>
                                                    <th>Invoice Date</th>
                                                    <th>Invoice Id</th>
                                                </tr>
                                                </thead>
                                                <tbody class="reminder_table_body">
                                                <?php
                                                $i = 1;
                                                foreach ($show_reminders as $reminder) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $reminder['invoice_date']; ?></td>
                                                        <td><?php echo $reminder['invoice_id']; ?></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default bx-shadow-none">
                            <div class="panel-heading" role="tab" id="headingSecond">
                                <div class="icon">
                                    <img src="<?php echo base_url(); ?>/uploads/assets/images/client_add/atm.svg"/>
                                </div>
                                <div class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSecond" aria-expanded="false" aria-controls="collapseSecond">
                                        <?php echo lang('charge_overdue'); ?>
                                    </a>
                                </div>
                            </div>
                            <div id="collapseSecond" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSecond">
                                <div class="panel-body" id="rightinvoice">
                                    <input type="hidden" value="<?php echo $client[0]['_id']; ?>" name="client_idfeeoverdue" class="form-control" id="client_idfeeoverdue">
                                    <div class="curlang">
                                        <div class="form-group">
                                                   <input type="text" name="overdue_days" onkeypress="return numericDecimal(event)" maxlength="2" id="overdue_days" class="form-control" placeholder="<?php echo lang('overdue_days'); ?>" required
                                                       value="<?php if (isset($client[0]['overdue_days'])) {
                                                           echo $client[0]['overdue_days'];
                                                       } ?>">
                                        </div>
                                        <div class="form-group">
                                                <input type="text" name="overdue_fees" onkeypress="return numericDecimal(event)" maxlength="10" id="overdue_fees" class="form-control" placeholder="<?php echo lang('overdue_fees'); ?>" required
                                                       value="<?php if (isset($client[0]['overdue_fees'])) {
                                                           echo $client[0]['overdue_fees'];
                                                       } ?>">
                                        </div>
                                        <button id="client_feeoverdue" type="button" class="btn btn-custom waves-effect waves-light">Submit</button>
                                        <!-- <button class="btn btn-custom waves-effect waves-light btn-sm" id="client-nofee">Submit</button> -->
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
                                    <input type="hidden" name="client_idcurlang" class="form-control"
                                           id="client_idcurlang" value="<?php echo $client_id; ?>"/>
                                    <div style="display:none;" id="ddd"><?php echo $client_id; ?></div>
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

                                            <select class="form-control select2" id="invoice_currency"
                                                    name="invoice_currency" placeholder="Type" tabindex="-1"
                                                    title="" required data-parsley-trigger="change">
                                                <!-- <option value=""><?= lang('select') ?></option> -->
                                                <option value="$" <?php if (!empty($client[0]['currency'])) {
                                                    if ($client[0]['currency'] == '$') {
                                                        echo "selected";
                                                    }
                                                } ?> >Dollar - $
                                                </option>
                                                <option value="£" <?php if (!empty($client[0]['currency'])) {
                                                    if ($client[0]['currency'] == '£') {
                                                        echo "selected";
                                                    }
                                                } ?> >Pound - £
                                                </option>
                                                <option value="₹" <?php if (!empty($client[0]['currency'])) {
                                                    if ($client[0]['currency'] == '₹') {
                                                        echo "selected";
                                                    }
                                                } ?> >Rupee - ₹
                                                </option>
                                                <option value="€" <?php if (!empty($client[0]['currency'])) {
                                                    if ($client[0]['currency'] == '€') {
                                                        echo "selected";
                                                    }
                                                } ?> >Euro - €
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="invoice_language"><?php echo lang('invoice_language'); ?></label>
                                            <select class="form-control select2" id="invoice_language"
                                                    name="invoice_language" placeholder="Type" tabindex="-1"
                                                    title="" required data-parsley-trigger="change">
                                                <!-- <option value=""><?= lang('select') ?></option> -->
                                                <option value="English" <?php if (!empty($client[0]['language'])) {
                                                    if ($client[0]['language'] == 'English') {
                                                        echo "selected";
                                                    }
                                                } ?> >English
                                                </option>
                                                <option value="German" <?php if (!empty($client[0]['language'])) {
                                                    if ($client[0]['language'] == 'German') {
                                                        echo "selected";
                                                    }
                                                } ?> >German
                                                </option>
                                                <option value="Hindi" <?php if (!empty($client[0]['language'])) {
                                                    if ($client[0]['language'] == 'Hindi') {
                                                        echo "selected";
                                                    }
                                                } ?> >Hindi
                                                </option>
                                                <option value="French" <?php if (!empty($client[0]['language'])) {
                                                    if ($client[0]['language'] == 'French') {
                                                        echo "selected";
                                                    }
                                                } ?> >French
                                                </option>
                                                <option value="Dutch" <?php if (!empty($client[0]['language'])) {
                                                    if ($client[0]['language'] == 'Dutch') {
                                                        echo "selected";
                                                    }
                                                } ?> >Dutch
                                                </option>
                                            </select>
                                        </div>
                                        <button id="client_langcurr" type="button" class="btn btn-custom waves-effect waves-light">Submit</button>
                                        <!-- <button class="btn btn-custom waves-effect waves-light btn-sm" id="client-nocur">Submit</button> -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="notesdiv">
                <?php echo $this->load->view('Notes'); ?>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card-box widget-user">
                        <div>
                            <form method="post" id="noteForm" class="form-horizontal"
                                  action="<?php echo base_url('Client/AddNote'); ?>">
                                <div class="form-group">

                                    <div class="col-md-12">
                                        <textarea class="form-control" name="notes" id="notes"
                                                  required=""></textarea>
                                        <input type="hidden" name="clientid" id="clientid"
                                               value="<?php echo $client[0]['_id']; ?>">
                                    </div>


                                </div>
                                <div class="form-group text-right">

                                    <div class="col-md-12 ">
                                        <button name="submit" id="submit"
                                                class="btn btn-primary waves-effect waves-light" type="submit">
                                            <?php echo lang('add_note'); ?>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
