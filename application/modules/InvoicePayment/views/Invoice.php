<form id="from-model frmsubmit" method="post"  action="<?php echo base_url('Invoice/insertdata'); ?>" enctype="multipart/form-data"
      data-parsley-validate>
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
                        <td colspan="3" align="center"><button class="btn btn-primary waves-effect waves-light" type="button" data-toggle="collapse"
                                    data-target="#collapseExample" aria-expanded="false"
                                    aria-controls="collapseExample"> Add a Payment
                            </button></td>
                     </tr>


                    </tbody>


                </table>
            </div>
        </div>
    </div><!-- end col -->




 <div class="col-lg-6">
                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading">
                                        <h4>Invoice</h4>
                                    </div> -->
                                    <div class="panel-body">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <h3 class="logo">Adminto</h3>
                                            </div>
                                            <div class="pull-right">
                                                <address>
                                                    <strong>Company name</strong><br>
                                                    795 Folsom Ave, Suite 600<br>
                                                    San Francisco, CA 94107<br>
                                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                                </address>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="pull-left m-t-30">
                                                    <address>
                                                      <strong>Twitter, Inc.</strong><br>
                                                      795 Folsom Ave, Suite 600<br>
                                                      San Francisco, CA 94107<br>
                                                      <abbr title="Phone">P:</abbr> (123) 456-7890
                                                      </address>
                                                </div>
                                                <div class="pull-right m-t-30">
                                                    <address>
                                                        <strong>Invoice: 2016-04-23654789 </strong><br>
                                                        <strong>Order Date: </strong> Jan 17, 2016<br>
                                                        <strong>Due Date: </strong> Jan 20, 2016<br>
                                                    </address>

                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="m-h-50"></div>
                                        <!-- add auto-->
                                        <div class="form-group">
                                            <!-- <label class="  control-label">
                            <?= lang('line_items') ?>
                             </label>-->
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
                                                        <div class="col-xs-12 col-md-12 form-group newrow" id="item_edit_<?= $row['invoice_item_id'] ?>">
                                                            <div class="col-xs-12 col-md-1">
                                                                <input type="text" maxlength="5" name="qty_hours_<?= $row['invoice_item_id'] ?>" onkeypress="return numericDecimal(event)" required class="form-control item_cal qty_item" placeholder="" value="<?= !empty($row['qty_hours']) ? $row['qty_hours'] : '' ?>">
                                                            </div>
                                                            <div class="col-xs-12 col-md-2">
                                                                <input type="text" name="description_<?= $row['invoice_item_id'] ?>" maxlength="80" class="form-control" placeholder="" required value="<?= !empty($row['item_name']) ? $row['item_name'] : '' ?>">
                                                            </div>
                                                            <div class="col-xs-12 col-md-2">
                                                                <input type="text" maxlength="10" name="rate_<?= $row['invoice_item_id'] ?>" onkeypress="return numericDecimal(event)" required class="form-control item_cal rate_item" placeholder="" value="<?= !empty($row['rate']) ? $row['rate'] : '' ?>">
                                                            </div>
                                                            <div class="col-xs-12 col-md-2">
                                                                <select class="form-control item_cal tax_item" name="tax_rate_<?= $row['invoice_item_id'] ?>" required data-parsley-trigger="change" >
                                                                    <option value=""><?= lang('tax') ?></option>
                                                                    <?php if (count($taxes) > 0) { ?>
                                                                        <?php foreach ($taxes as $tax) { ?>
                                                                            <option <?php if (!empty($row['tax_rate']) && $row['tax_rate'] == $tax["tax_id"]) {
                                                                                echo 'selected="selected"';
                                                                            } ?> value="<?= $tax["tax_id"] ?>" ><?php echo $tax["tax_percentage"]; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <!--  <div class="col-xs-12 col-md-2">
                                                              <input type="text" name="type_<?= $row['invoice_item_id'] ?>" class="form-control" placeholder="" value="">
                                                              </div> -->

                                                            <div class="col-xs-12 col-md-2">
                                                                <input type="text" name="cost_<?= $row['invoice_item_id'] ?>" onkeydown="return false" class="form-control total_cost" placeholder="" value="<?= !empty($row['cost']) ? $row['cost'] : '' ?>">
                                                                <input type="text" name="cost_rate<?= $row['invoice_item_id'] ?>" onkeydown="return false" class="form-control cost_rate" placeholder="" value="<?= !empty($row['cost_rate']) ? $row['cost_rate'] : '' ?>">
                                                            </div>
                                                            <div class="col-xs-12 col-md-1"> <a class="pull-right btn btn-default "> <span class="glyphicon glyphicon-trash" onclick="delete_item_row('item_edit_<?= $row['invoice_item_id'] ?>');"></span> </a> </div>
                                                        </div>
                                                    <?php }
                                                } ?>
                                            </div>
                                        </div>
                                        <div class="form-group">

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
                                                <p class="text-right">SubTotal: <span id="sub_price"></span></p>
                                                <p class="text-right"><?= lang('discount') ?>: <input type="text" maxlength="5" name="discount" data-parsley-gteqm="#discount" id="discount" required data-parsley-required-message="Required" onkeypress="return numericDecimal(event)" class="form-control item_cal discount_item" placeholder="" value=""></p>
                                                <p class="text-right">Tax: <span id="cost_price">%</span></p>
                                                <hr>
                                                <p class="text-right"><b><label class="  control-label">
                                                            <?= lang('total_amount') ?>
                                                            : <span id="total_item">
                                <?= !empty($edit_record[0]['amount']) ? $edit_record[0]['amount'] : '0.00' ?>
                                </span></label>
                                                        <input type="hidden" name="amount_total" id="amount_total" value="<?= !empty($edit_record[0]['amount']) ? $edit_record[0]['amount'] : '' ?>" /></p>

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
                     <button class="btn btn-primary waves-effect waves-light" type="submit" name="save" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample"> <i class="fa fa-cloud m-r-5"></i> Save
                    </button>
                    <button class="btn btn-primary waves-effect waves-light" type="submit" name="send" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample"> <i class="fa fa-envelope-o m-r-5"></i>  Send
                    </button>
                    <button class="btn btn-primary waves-effect waves-light" type="submit" name="print" data-toggle="collapse"
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
                                <a role="button" data-toggle="collapse"
                                   data-parent="#accordion" href="#collapseOne"
                                   aria-expanded="true" aria-controls="collapseOne">
                                    Collapsible Group Item #1
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in"
                             role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                accusamus terry richardson ad squid. 3 wolf moon officia
                                aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                sunt aliqua put a bird on it squid single-origin coffee
                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                helvetica, craft beer labore wes anderson cred nesciunt
                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                Leggings occaecat craft beer farm-to-table, raw denim
                                aesthetic synth nesciunt you probably haven't heard of them
                                accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default bx-shadow-none">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse"
                                   data-parent="#accordion" href="#collapseTwo"
                                   aria-expanded="false" aria-controls="collapseTwo">
                                    Collapsible Group Item #2
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse"
                             role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                accusamus terry richardson ad squid. 3 wolf moon officia
                                aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                sunt aliqua put a bird on it squid single-origin coffee
                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                helvetica, craft beer labore wes anderson cred nesciunt
                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                Leggings occaecat craft beer farm-to-table, raw denim
                                aesthetic synth nesciunt you probably haven't heard of them
                                accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default bx-shadow-none">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse"
                                   data-parent="#accordion" href="#collapseThree"
                                   aria-expanded="false" aria-controls="collapseThree">
                                    Collapsible Group Item #3
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse"
                             role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life
                                accusamus terry richardson ad squid. 3 wolf moon officia
                                aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor,
                                sunt aliqua put a bird on it squid single-origin coffee
                                nulla assumenda shoreditch et. Nihil anim keffiyeh
                                helvetica, craft beer labore wes anderson cred nesciunt
                                sapiente ea proident. Ad vegan excepteur butcher vice lomo.
                                Leggings occaecat craft beer farm-to-table, raw denim
                                aesthetic synth nesciunt you probably haven't heard of them
                                accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end col -->



</form>