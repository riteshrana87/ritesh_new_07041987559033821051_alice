<footer class="footer text-right">

    2016 ©Alice A Product Of Blazedesk B.V.

</footer>

</div>

<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->


<script src="<?= base_url() ?>uploads/assets/js/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?= base_url() ?>uploads/assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>uploads/assets/js/detect.js"></script>
<script src="<?= base_url() ?>uploads/assets/js/fastclick.js"></script>
<script src="<?= base_url() ?>uploads/assets/js/jquery.blockUI.js"></script>
<script src="<?= base_url() ?>uploads/assets/js/waves.js"></script>
<script src="<?= base_url() ?>uploads/assets/js/jquery.nicescroll.js"></script>
<script src="<?= base_url() ?>uploads/assets/js/jquery.slimscroll.js"></script>
<script src="<?= base_url() ?>uploads/assets/js/jquery.scrollTo.min.js"></script>

<!-- KNOB JS -->
<!--[if IE]>

<!-- Editable js -->
<script src="<?= base_url() ?>uploads/assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url() ?>uploads/assets/plugins/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>uploads/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?= base_url() ?>uploads/assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
<script src="<?= base_url() ?>uploads/assets/plugins/tiny-editable/numeric-input-example.js"></script>
<!-- init -->
<script src="<?= base_url() ?>uploads/assets/pages/datatables.editable.init.js"></script>



<script type="text/javascript" src="<?= base_url() ?>uploads/assets/plugins/jquery-knob/excanvas.js"></script>
<!--[endif]-->
<script src="<?= base_url() ?>uploads/assets/plugins/jquery-knob/jquery.knob.js"></script>

<script src="<?= base_url() ?>uploads/assets/js/jquery.core.js"></script>
<script src="<?= base_url() ?>uploads/assets/js/jquery.app.js"></script>
<script src="<?= base_url() ?>uploads/custom/head/head.js"></script>
  
<?php
if (isset($footerJs)) {
	
    if (count($footerJs) > 0) {
        foreach ($footerJs as $element) {
            ?>
            <script src="<?php echo $element; ?>"></script>

            <?php
        }
    }
}
?>



<script>
    count = 0;
    function add_item_limit()
    {
        var html = '';
        html += '<div class="col-xs-12 col-md-12 newrow item_row item_new_' + count + '" id="item_new_' + count + '">';
        html += '<div class="col-xs-12 col-md-1 form-group add_items_field">';
        html += '<label class="visible-xs visible-sm">Qty/Hrs</label>';
        html += '<input type="text" maxlength="5" name="qty_hours[]" required data-parsley-required-message="Required" onkeypress="return numericDecimal(event)" class="form-control item_cal qty_item" placeholder="" value="">';
        html += '</div>';
        html += '<div class="col-xs-12 col-md-2 form-group add_items_field">';
        html += '<label class="visible-xs visible-sm">Product Name</label>';
        html += '<input type="text" name="product_name[]" id="product_name" data-parsley-required-message="Required" required class="form-control product_name_class" placeholder="" value="">';
        html += '<span class="empty-message" style="display:none;">Please Enter Product</span>';
        html += '</div>';
        html += '<div class="col-xs-12 col-md-2 form-group add_items_field">';
        html += '<label class="visible-xs visible-sm">Description</label>';
        html += '<input type="text" name="description[]"  maxlength="80"  class="form-control description_class" placeholder="" value="">';
        html += '</div>';
        html += '<div class="col-xs-12 col-md-2 form-group add_items_field">';
        html += '<label class="visible-xs visible-sm">Rate</label>';
        html += '<input type="text" maxlength="10" name="rate[]" required data-parsley-required-message="Required" onkeypress="return numericDecimal(event)" class="form-control item_cal rate_item" placeholder="" value="">';
        html += '</div>';
        html += '<div class="col-xs-12 col-md-2 form-group add_items_field">';
        html += '<label class="visible-xs visible-sm">Tax Rate (%)</label>';
        html += '<select class="form-control item_cal tax_item select_field" name="tax_rate[]" >';
        html += '<option value="0" data-tax="0"><?= lang('tax') ?></option>';
<?php if (count($taxes) > 0) { ?>
    <?php foreach ($taxes as $tax) { ?>
                html += '<option value="<?php echo $tax["_id"]; ?>" data-tax="<?php echo $tax["tax"]; ?>"><?php echo $tax["tax_name"] . '(' . $tax["tax"] . '%'.')'; ?> </option>';
        <?php
    }
}
?>
        html += '</select>';
        html += '</div>';
        /*html +='<div class="col-xs-12 col-md-2">';
         html +='<input type="text" name="type[]" class="form-control" placeholder="" value="">';
         html +='</div>';*/

        html += '<div class="col-xs-12 col-md-2 form-group add_items_field">';
        html += '<label class="visible-xs visible-sm">Cost</label>';
        html += '<input type="text" name="cost[]" onkeydown="return false" class="form-control total_cost" placeholder="" value="">';
        html += '<input type="hidden" name="cost_rate[]" onkeydown="return false" class="form-control cost_rate" placeholder="" value="">';
        html += '<input type="hidden" name="tax_sub_data[]" onkeydown="return false" class="form-control tax_sub_data" placeholder="" value="">';
        html += '<input type="hidden" name="tax_total_val[]" onkeydown="return false" class="form-control tax_total_val" placeholder="" value="">';
        html += '</div>';
        html += '<div class="col-xs-12 col-md-1 form-group add_items_field">';
        html += '<a class="pull-right btn btn-default ">';
        html += '<span class="glyphicon glyphicon-trash" onclick="delete_new_row(\'item_new_' + count + '\');"></span>';
        html += '</a>';
        html += '</div>';
        html += '</div>';
        
        count++;
        return html;
    }

  

    $(function () {
        //Add more item
        $('#add_new_item').click(function () {
            item_html = add_item_limit();
            $('#add_items').append(item_html);
            $('#from-model').parsley();
            
        });
        /*end item code*/

        /*end payment code*/
<?php if (!isset($editrecord)) { ?>
            //            //Append first time item
            item_html = add_item_limit();

            $('#add_items').append(item_html);

<?php } ?>
        //auto select client area
        $('#send_invoice_client').click(function () {
            if (this.checked) {
                $('#show_in_client_area').val(1);
            } else {
                $('#show_in_client_area').val(0);
            }
        });

    });
    //remove new row
    function delete_new_row(del_id)
    {
       
        var delete_meg = "delete";
        var discount = '';

        swal({
            title: delete_meg,
            //text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            $('#' + del_id).remove();
            //count current item
            var total_amt = 0;
            $("#add_items .total_cost").each(function (index) {
                if ($(this).val() != 0.00 && $(this).val() != '')
                {
                    total_amt += parseFloat($(this).val());
                }

            });
            var sub_cost = 0;
            $("#add_items .cost_rate").each(function (index) {
                if ($(this).val() != 0.00 && $(this).val() != '')
                {
                    sub_cost += parseFloat($(this).val());
                }
            });
            var text_price = total_amt - sub_cost;

            //discount
            discount = $('.discount_item').val();
            dis_total = 0;
            if (discount != '')
            {
                var dis_total = parseFloat(total_amt) * parseFloat(discount) / 100;
            }
            var dis_amt = total_amt - dis_total;
            var tax_sub_data = 0;
            $("#add_items .tax_sub_data").each(function (index) {
                if ($(this).val() != 0.00 && $(this).val() != '')
                {
                    tax_sub_data += parseFloat($(this).val());
                }
            });
            $('#sub_tax').text(tax_sub_data.toFixed(0));
            $('#total_tax_payment').val(tax_sub_data.toFixed(0));
            $('#sub_price').text(sub_cost.toFixed(2));
            $('#cost_price').text(text_price.toFixed(2));
            $('#tax_amount').val(text_price.toFixed(2));
            //$('#total_item').text(dis_amt.toFixed(2));
            $('#amount_total').val(sub_cost.toFixed(2));
            
            var tax = $('#' + del_id + ' .tax_item option:selected').attr('data-tax');
        var taxval = $('#' + del_id + ' .tax_item option:selected').val();

        /*        alert(tax);
         console.log(tax);
         */
        var tax_add = 0;
        var taxSum = 0;
        var dataidsum = 0;
        var taxArray = [];
        var curentTaxClac = $('#' + del_id + ' .tax_total_val').val();
        $("input[data-tax_id]").each(function () {
            // if($(this).attr('data-tax_id')!==taxval)
            // {
            taxArray.push($(this).attr('data-tax_id') + '=>' + $(this).val());
            //    }
        });
        console.log(taxArray);
        if (taxArray.length > 0)
        {
            $.ajax({
                url: "<?php echo base_url('Invoice/GetTax'); ?>",
                dataType: "JSON",
                type: "post",
                 data: {'taxs': taxArray,'delid': taxval, 'delval': curentTaxClac,'discounts':$('#discount').val(),'disctount_type':$('#discount_type').val()},
                //data: {'taxs': taxArray, 'delid': taxval, 'delval': curentTaxClac},
                success: function (data)
                {
                    if (data.status == 1)
                    {
                        $('.tax_boxvals').addClass('hidden');
                        var calculation = data.data;
                        var totaldb = 0;
                        $.each(calculation, function (i, val) {
                            $('#tax_' + i).removeClass('hidden');
                            $('#' + i).html(val);
                        });
                        
                        $('#tax_amunt').val(data.taxTot.toFixed(2));
                        $('#total_item').text(data.total.toFixed(2));
                         $('#add_dis_amount_total').val(data.total.toFixed(2));
                        
                    }

                }

            });
        }
            swal.close()
            
        });

        



    }
    //remove new row
    function delete_item_row(del_id)
    {
        var delete_meg = "delete";
        var discount = '';

        swal({
            title: delete_meg,
            //text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function () {
            var del_ids = $('#delete_item_id').val();
            remove_id = del_id.split('item_edit_');
            $('#delete_item_id').val(del_ids + remove_id[1] + ',');

            $('#' + del_id).remove();
            //count current item
            var total_amt = 0;
            $("#add_items .total_cost").each(function (index) {
                if ($(this).val() != 0.00 && $(this).val() != '')
                {
                    total_amt += parseFloat($(this).val());
                }

            });
            //alert(total_amt);

            
            
             var tax = $('#' + del_id + ' .tax_item option:selected').attr('data-tax');
        var taxval = $('#' + del_id + ' .tax_item option:selected').val();

        /*        alert(tax);
         console.log(tax);
         */
        var tax_add = 0;
        var taxSum = 0;
        var dataidsum = 0;
        var taxArray = [];
        var curentTaxClac = $('#' + del_id + ' .tax_total_val').val();
        $("input[data-tax_id]").each(function () {
            // if($(this).attr('data-tax_id')!==taxval)
            // {
            taxArray.push($(this).attr('data-tax_id') + '=>' + $(this).val());
            //    }
        });
        console.log(taxArray);
        
        var sub_cost = 0;
            $("#add_items .cost_rate").each(function (index) {
                if ($(this).val() != 0.00 && $(this).val() != '')
                {
                    sub_cost += parseFloat($(this).val());
                }
            });
            
            
        if (taxArray.length > 0)
        {
            $.ajax({
                url: "<?php echo base_url('Invoice/GetTax'); ?>",
                dataType: "JSON",
                type: "post",
                 data: {'taxs': taxArray,'delid': taxval, 'delval': curentTaxClac,'discounts':$('#discount').val(),'disctount_type':$('#discount_type').val()},
                //data: {'taxs': taxArray, 'delid': taxval, 'delval': curentTaxClac},
                success: function (data)
                {
                    if (data.status == 1)
                    {
                        $('.tax_boxvals').addClass('hidden');
                        var calculation = data.data;
                        var totaldb = 0;
                        $.each(calculation, function (i, val) {
                            $('#tax_' + i).removeClass('hidden');
                            $('#' + i).html(val);
                        });
                        
                        $('#tax_amunt').val(data.taxTot.toFixed(2));
                        $('#total_item').text(data.total.toFixed(2));
                         $('#add_dis_amount_total').val(data.total.toFixed(2));
                        
                    }

                }

            });
        }
            
            
            var text_price = total_amt - sub_cost;
            //discount
            discount = $('.discount_item').val();
            dis_total = 0;
            if (discount != '')
            {
                var dis_total = parseFloat(total_amt) * parseFloat(discount) / 100;
            }
            var dis_amt = total_amt - dis_total;

            var tax_sub_data = 0;
            $("#add_items .tax_sub_data").each(function (index) {
                if ($(this).val() != 0.00 && $(this).val() != '')
                {
                    tax_sub_data += parseFloat($(this).val());
                }
            });
            $('#total_tax_payment').val(tax_sub_data.toFixed(0));
            $('#sub_tax').text(tax_sub_data.toFixed(0));
            $('#sub_price').val(sub_cost.toFixed(2));
            $('#cost_price').text(text_price.toFixed(2));
            $('#tax_amount').val(text_price.toFixed(2));
            //$('#total_item').text(dis_amt.toFixed(2));
            $('#amount_total').val(sub_cost.toFixed(2));
           // $('#add_dis_amount_total').val(dis_amt.toFixed(2));
            
            swal.close()
        });

        




    }
    //remove payment row
    function delete_payment_row(del_id)
    {
        var delete_meg = "delete";
        BootstrapDialog.show(
                {
                    title: 'alert',
                    message: delete_meg,
                    buttons: [{
                            label: 'CANCEL',
                            action: function (dialog) {
                                dialog.close();
                                $('#confirm-id').on('hidden.bs.modal', function () {
                                    $('body').addClass('modal-open');
                                });
                            }
                        }, {
                            label: 'ok',
                            action: function (dialog) {
                                var del_ids = $('#delete_payment_id').val();
                                remove_id = del_id.split('payment_edit_');
                                $('#delete_payment_id').val(del_ids + remove_id[1] + ',');

                                $('#' + del_id).remove();
                                $('#confirm-id').on('hidden.bs.modal', function () {
                                    $('body').addClass('modal-open');
                                });
                                dialog.close();
                            }

                        }]
                });


    }
    //calculation
    $('body').delegate('.item_cal', 'change', function () {
        dis_id = $(this).parent().parent().attr('id');
       
        get_row_total(dis_id);
    });
    //calculation

    //count total payment
    $('body').delegate('.amount_payment', 'blur', function () {
        //count total payment
        var total_payment_amt = 0;
        $("#add_payment .amount_payment").each(function (index) {
            if ($(this).val() != 0.00 && $(this).val() != '')
            {
                total_payment_amt += parseFloat($(this).val());
            }

        });
        $('#total_payment').text(total_payment_amt.toFixed(2));
        $('#total_payment_input').val(total_payment_amt.toFixed(2));
    });
    //datepicker
    /* $('body .due_on').datepicker({
     autoclose: true, startDate: new Date()
     });
     $('body .recurring_time').datepicker({
     //format: 'dd'
     });
     */
    //get row wise total
    function get_row_total(dis_id)
    {
        var qty = '';
        var rate = '';
        var tax = '';
        var discount = '';
        var cost = '';
        var total_cost = 0;
        var tax_total = 0;
        var tax_add = '';
        var total_rate = 0;
        qty = $('#' + dis_id + ' .qty_item').val();
        rate = $('#' + dis_id + ' .rate_item').val();
        //tax      = $('#'+dis_id+' .tax_item:selected').text();
        // tax = $('#' + dis_id + ' .tax_item option:selected').text();
        tax = $('#' + dis_id + ' .tax_item option:selected').attr('data-tax');
        var taxval = $('#' + dis_id + ' .tax_item option:selected').val();

        /*        alert(tax);
         console.log(tax);
         */


        discount = $('.discount_item').val();
        //rate calculation
        if (rate != '')
        {
            total_cost = qty * parseFloat(rate);
            total_rate = qty * parseFloat(rate);

            $('#' + dis_id + ' .total_cost').val(total_cost.toFixed(2));
            $('#' + dis_id + ' .cost_rate').val(total_cost.toFixed(2));
        }
        //tax
        if ($.isNumeric(tax))
        {
           
            if (total_cost != 0)
            {
                var tax_total = parseFloat(total_cost) * parseFloat(tax) / 100;
                var total_cost = parseFloat(total_cost) + parseFloat(tax_total);
            } else
            {
                var total_cost = parseFloat(total_rate) * parseFloat(tax) / 100;
            }
            var taxt_pre_data = parseFloat(tax);

            //$('#' + dis_id + ' .total_cost').val(total_cost.toFixed(2));
            $('#' + dis_id + ' .tax_sub_data').val(taxt_pre_data.toFixed(2));

            $('#' + dis_id + ' .tax_total_val').val(tax_total.toFixed(2));

            $('#' + dis_id + ' .cost_rate').attr('data-tax_id', taxval);
            // $('#' + dis_id + ' .tax_total_val').('form-control tax_total_val '+ taxval);
        }
       
        
        //for tax calculation
        var tax_add = 0;
        var taxSum = 0;
        var dataidsum = 0;
        var taxArray = [];
        $("input[data-tax_id]").each(function () {
            taxArray.push($(this).attr('data-tax_id') + '=>' + $(this).val());
        });
      
      var sub_cost = 0;
        $("#add_items .cost_rate").each(function (index) {
            if ($(this).val() != 0.00 && $(this).val() != '')
            {
                sub_cost += parseFloat($(this).val());
            }
        });
        
        console.log(taxArray);
        
        
        if (taxArray.length > 0)
        {
            $.ajax({
                url: "<?php echo base_url('Invoice/GetTax'); ?>",
                dataType: "JSON",
                type: "post",
                data: {'taxs': taxArray,'discounts':$('#discount').val(),'disctount_type':$('#discount_type').val()},
                success: function (data)
                {
                    if (data.status == 1)
                    {
                        $('.tax_boxvals').addClass('hidden');
                        var calculation = data.data;
                        var totaldb = 0;
                        $.each(calculation, function (i, val) {
                            $('#tax_' + i).removeClass('hidden');
                            $('#' + i).html(val);

                        });
                        $('#tax_amunt').val(data.taxTot.toFixed(2));
                        $('#total_item').text(data.total.toFixed(2));
                         $('#add_dis_amount_total').val(data.total.toFixed(2));
                    }
                    
                }

            });
        }
//tax Ends here 

        var total_amt = 0;
        $("#add_items .total_cost").each(function (index) {
            if ($(this).val() != 0.00 && $(this).val() != '')
            {
                total_amt += parseFloat($(this).val());
            }

        });
        
        var text_price = total_amt - sub_cost;

        //discount
        dis_total = 0;
        var discount_type = $('discount_type').val();
        if (discount != '')
        {
            if (discount_type == 1)
            {
                var dis_total = parseFloat(total_amt) * parseFloat(discount) / 100;
            } else

            {
                dis_total = discount;
            }

        }
        var dis_amt = total_amt - dis_total;

        var tax_sub_data = 0;
        $("#add_items .tax_sub_data").each(function (index) {
            if ($(this).val() != 0.00 && $(this).val() != '')
            {
                tax_sub_data += parseFloat($(this).val());
            }
        });


        $('#total_tax_payment').val(tax_sub_data.toFixed(0));

        $('#sub_tax').text(tax_sub_data.toFixed(0));


        $('#sub_price').val(sub_cost.toFixed(2));
        $('#cost_price').val(text_price.toFixed(2));
        $('#tax_amount').val(text_price.toFixed(2));
       //$('#total_item').text(dis_amt.toFixed(2));
        $('#amount_total').val(sub_cost.toFixed(2));
        //alert(total_amt);

    }
    //numeric decimal number
    function numericDecimal(e) {
        var unicode = e.charCode ? e.charCode : e.keyCode;
        //alert(unicode);
        if (unicode != 8) {
            if (unicode < 9 || unicode > 9 && unicode < 46 || unicode > 57 || unicode == 47) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    //Code displays login modal and pauses video that is being played
    var dispLoginModal = function () {
        $('#modal-clientLogin').modal({backdrop: "static"});
    };

    //Continues playing the video that was paused when login modal was displayed
    var onLoginModalClose = function () {
        $('#modal-clientLogin').modal({backdrop: "static"});
    };
   /*  $('#datepicker-multiple-date').datepicker({
        format: "mm/dd/yyyy",
        clearBtn: true,
        multidate: true,
        multidateSeparator: ","
    });

    $('#order_date').datepicker({
        format: "mm/dd/yyyy",
        clearBtn: true,
        multidate: true,
        multidateSeparator: ","
    });
    $('#due_date').datepicker({
        format: "mm/dd/yyyy",
        clearBtn: true,
        multidate: true,
        multidateSeparator: ","
    }); */

    $(document).ready(function () {
        $('.select2').select2();
    });


    function toggle() {

        var ele = document.getElementById("toggleText");

        var text = document.getElementById("displayText");

        if (ele.style.display == "block") {

            ele.style.display = "none";

            text.innerHTML = "Add a Payment";

        } else {

            ele.style.display = "block";

            text.innerHTML = "Add a Payment";

        }


    }
    $('.discountval li').click(function () {
        var selectedval = $(this).text();
        console.log(selectedval);

        var dis_id = $(this).parent().parent().attr('id');
        var discountval = $('#discount').val();
        var dis_total = 0;
        var discount_type = $('discount_type').val();
        var total_amt = $('#sub_price').val();
        
      
        if (selectedval == "Flat") {
            $("#discount_type").val(2);
            $("#discounttype").html("Flat <span class=\"caret\"></span>");
            
        } else {
            $("#discount_type").val(1);
            $("#discounttype").html("% <span class=\"caret\"></span>");
        }
        if (discountval != '')
        {
            if (selectedval == "Flat")
            {
                 dis_total = discountval;
            } else
               

            {

                 dis_total = parseFloat(total_amt) * parseFloat(discountval) / 100;

            }

        }
        var dis_amt = total_amt - dis_total;
          /* $('#total_item').text(dis_amt.toFixed(2));
             $('#add_dis_amount_total').val(dis_amt.toFixed(2));
        */
        
        var tax_add = 0;
        var taxSum = 0;
        var dataidsum = 0;
        var taxArray = [];
        $("input[data-tax_id]").each(function () {
            taxArray.push($(this).attr('data-tax_id') + '=>' + $(this).val());
        });
        
        if (taxArray.length > 0)
        {
            $.ajax({
                url: "<?php echo base_url('Invoice/GetTax'); ?>",
                dataType: "JSON",
                type: "post",
                data: {'taxs': taxArray,'discounts':$('#discount').val(),'disctount_type':$('#discount_type').val()},
                success: function (data)
                {
                    if (data.status == 1)
                    {
                        $('.tax_boxvals').addClass('hidden');
                        var calculation = data.data;
                        var totaldb = 0;
                        $.each(calculation, function (i, val) {
                            $('#tax_' + i).removeClass('hidden');
                            $('#' + i).html(val);

                        });
                        $('#tax_amunt').val(data.taxTot.toFixed(2));
                        $('#total_item').text(data.total.toFixed(2));
                         $('#add_dis_amount_total').val(data.total.toFixed(2));
                    }
                    
                }

            });
        } 

    });

    function SaveInvoiceForm(val,emailTmpStatus)
    {
		
        //Place Country id in text box
        var changeEmailTmp = '';
		if(emailTmpStatus)
		{
			changeEmailTmp = emailTmpStatus;
		}
                
        var ShowMsg = '';					//Set Msg for Bootstrap 
        var hdn_submit_status = "";       	//Set Value for hidden Status
        var action = '';					//Set value for its related with Bootstrap or Just save the information
        if (val == 'save')
        {
            ShowMsg = '<?php echo lang('save_invoice'); ?>';
            hdn_submit_status = "2";       //2 Value for Draft
            action = '1';
        } else if (val == 'sendInvoice')
        {
            if(changeEmailTmp){
				ShowMsg = '<?php echo lang('change_template_save_invoice'); ?>';
			} else {
				ShowMsg = '<?php echo lang('save_current_invoice');?> <?php echo lang('sure_want_to_continue'); ?>';
			}
            
            //ShowMsg = '<?php echo lang('send_invoice'); ?>';
            hdn_submit_status = "sendInvoice";       //2 Value for Store as a Draft
            action = '1';
        } else if (val == 'print')
        {
            ShowMsg = '<?php echo lang('print_invoice'); ?>';
            hdn_submit_status = "print";       //2 Value for Store as a Draft
            action = '1';
        } else {
            action = '0';
        }
        if (action == 1)
        {
            swal({
                title: ShowMsg,
                //text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
				
                $("#hdn_submit_status").val(hdn_submit_status);
                $("#HdnSubmitBtnVlaue").val(val);
                
                if(changeEmailTmp){
			//Show Change Email Template Popup After Save
			$("#HdnChangeEmailTmp").val(changeEmailTmp);   //Show popup for Change Template
		}
                $(".frmsubmit").submit();
                swal.close()
            });
        } else {
            
            //$("#hdn_submit_status").val("1");                   
            $("#hdn_submit_status").val($("#estStatus").val());
            $("#HdnSubmitBtnVlaue").val(val);
            //$(".frmsubmit").submit();
        }
        return false;
    }
    
    function emailTemplatePopup()
	{
            
            swal({
                   title: '<?php echo lang('invoice'); ?>',
                    text: '<?php echo lang('cnfrm_change_email_template'); ?>',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<?php echo lang('EST_LBL_CHANGE_EMAIL_TEMPLATE');?>',
                    cancelButtonText: 'Send Invoice',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-success',
                    buttonsStyling: false,
                    closeOnConfirm: false,
                    closeOnCancel: false
                  },
                  function(isConfirm){
                    if (isConfirm) {
                      SaveInvoiceForm('sendInvoice', 'yes');
                    } else {
                         SaveInvoiceForm('sendInvoice');
                    }
                  });
            
	}
function client_data()
    {
        var client_id = $('#client_id option:selected').val();
        var request_url = '';
        request_url = '<?php echo base_url().'Invoice/Client_data'; ?>';
        $.ajax({
            type: "POST",
            url: request_url,
            data: {'client': client_id},
            
             success: function (html) {
                $("#client_detail").html(html);
                //    $.unblockUI();
            }
        });
        return false;
    }
    
    $(document).ready(function () {
        
        var tax_add = 0;
        var taxSum = 0;
        var dataidsum = 0;
        var taxArray = [];
        $("input[data-tax_id]").each(function () {
            taxArray.push($(this).attr('data-tax_id') + '=>' + $(this).val());
        });
        //alert(taxArray);
        if (taxArray.length > 0)
        {
            $.ajax({
                url: "<?php echo base_url('Invoice/GetTax'); ?>",
                dataType: "JSON",
                type: "post",
                data: {'taxs': taxArray,'discounts':$('#discount').val(),'disctount_type':$('#discount_type').val()},
                success: function (data)
                {
                    if (data.status == 1)
                    {
                        $('.tax_boxvals').addClass('hidden');
                        var calculation = data.data;
                        var totaldb = 0;
                        $.each(calculation, function (i, val) {
                            $('#tax_' + i).removeClass('hidden');
                            $('#' + i).html(val);

                        });
                        
                        $('#tax_amunt').val(data.taxTot.toFixed(2));
                        $('#total_item').text(data.total.toFixed(2));
                        $('#add_dis_amount_total').val(data.total.toFixed(2));
                    }
                    
                }

            });
        } 
       
    });
    
   function GeneratePrint(invoice_id)
    {
		$('#printDIV').html("");
		send_url = '<?php echo base_url();?>Invoice/DownloadPDF/'+ invoice_id + '/print';
		window.open(send_url, '_blank');
	}
        
        
       
    
</script>

<?php if(isset($estAction)){?>
<script>
    
	$("form#send_files_data").submit(function(){
    var formData = new FormData($(this)[0]);
//    console.log(formData);
     var emailTemplate_sub 	= $('#emailTemplate_sub').val();
     var emailTemplate_body = $('#emailTemplate_body').val();
		if (emailTemplate_sub != "" && $.trim(emailTemplate_sub) != '' && emailTemplate_body !== '' && emailTemplate_body !== '<p><br></p>' && emailTemplate_body !== '<br>')
		{
                    	$("#emailTemplate_sub").addClass("form-control parsley-success");
			$("#emailTemplate_body_Error").addClass( "hidden");
			$('#invChangeEmailTemplate').modal('hide');
			var chngEmlTmp = '';
                        var emailTempSts = 'takeEmailContent'
                            if(emailTempSts)
                            {
                                    chngEmlTmp = emailTempSts;
                            }
                            var loaderIMG = '<img src="<?php echo base_url()."/uploads/assets/images/ajax-loader.gif"; ?>" /> <?php echo lang('send_recipient'); ?>.' ;
                            $('#errorMsgLoader').html(loaderIMG);
                            console.log(formData);
                            send_url = '<?php echo base_url();?>Invoice/SendInvoice';
                            
                            $.ajax({
                            url: send_url,
                            type: "POST",
                            data: formData,
                            async: false,
                            success: function (data)
                            {
                                                    //alert('Success send message.');
                                            //Show Message in Top side div
                                                    $('#errorMsg').html("<div class='alert alert-success text-center'><?php echo lang('send_estimate'); ?></div>");
                                            //Hide Error Loader Message Div when mail send
                                                    $('#errorMsgLoader').hide();
                                            //Hide Message after 3 second
                                                    setTimeout(function () {
                                                            $('#errorMsg').fadeOut('5000');
                                                    }, 3000);
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            
                        });
                        
   
		} else {
			if(emailTemplate_sub == "" && $.trim(emailTemplate_sub) == '')
			{
				$("#emailTemplate_sub").addClass("form-control parsley-error");
			} else {	$("#emailTemplate_sub").addClass("form-control parsley-success");	}
			if(emailTemplate_body !== '' && emailTemplate_body !== '<p><br></p>' && emailTemplate_body !== '<br>'){} else {
				$("#emailTemplate_body_Error").removeClass( "hidden");
			}
			return false;
		}
            return false;
   
        });
	
	
     function estSendWithCustEmailTemp()
	{
                var emailTemplate_sub 	= $('#emailTemplate_sub').val();
		var emailTemplate_body = $('#emailTemplate_body').val();
		if (emailTemplate_sub != "" && $.trim(emailTemplate_sub) != '' && emailTemplate_body !== '' && emailTemplate_body !== '<p><br></p>' && emailTemplate_body !== '<br>')
		{
                    	$("#emailTemplate_sub").addClass("form-control parsley-success");
			$("#emailTemplate_body_Error").addClass( "hidden");
			$('#invChangeEmailTemplate').modal('hide');
			
			SendInvoice('<?php echo $editrecord[0]['_id'];?>', 'takeEmailContent');
                        
                        
		} else {
			if(emailTemplate_sub == "" && $.trim(emailTemplate_sub) == '')
			{
				$("#emailTemplate_sub").addClass("form-control parsley-error");
			} else {	$("#emailTemplate_sub").addClass("form-control parsley-success");	}
			if(emailTemplate_body !== '' && emailTemplate_body !== '<p><br></p>' && emailTemplate_body !== '<br>'){} else {
				$("#emailTemplate_body_Error").removeClass( "hidden");
			}
			return false;
		}
	}
        
        
        
        
        function SendInvoice(invoice_id, emailTempSts)
	{
		var chngEmlTmp = '';
		if(emailTempSts)
		{
			chngEmlTmp = emailTempSts;
		}
		var loaderIMG = '<img src="<?php echo base_url()."/uploads/assets/images/ajax-loader.gif"; ?>" /> <?php echo lang('send_recipient'); ?>.' ;
		$('#errorMsgLoader').html(loaderIMG);
		var newEmailSubject		= '';
		var newEmailTemplateBody= '';
		if(chngEmlTmp == 'takeEmailContent')
		{
			var newEmailSubject 		= $('#emailTemplate_sub').val();
			var newEmailTemplateBody 	= $('#emailTemplate_body').val();
		}
                
                
		send_url = '<?php echo base_url();?>Invoice/SendInvoice/'+ invoice_id;
		$.ajax({
                url: send_url,
                type: "POST",
                //dataType: "json",
                data: {'newEmailSubject': newEmailSubject, 'newEmailTemplateBody' : newEmailTemplateBody, 'chngEmlTmp': chngEmlTmp},
                success: function (data)
                {
					//alert('Success send message.');
				//Show Message in Top side div
					$('#errorMsg').html("<div class='alert alert-success text-center'><?php echo lang('send_estimate'); ?></div>");
				//Hide Error Loader Message Div when mail send
					$('#errorMsgLoader').hide();
				//Hide Message after 3 second
					setTimeout(function () {
						$('#errorMsg').fadeOut('5000');
					}, 3000);
		}
            });
	}
    
	</script>
<?php }?>
    <?php if(isset($estAction) && $estAction == "sendInvoice"){?>
<?php if(isset($ESTChngEmiTMP) && $ESTChngEmiTMP == "yes"){?>
<script>
		$(document).ready(function () {
                    	$('#invChangeEmailTemplate').modal('show');
		});
	</script>
<?php } else {?>
<script>
		$(document).ready(function () {
                    	SendInvoice('<?php echo $editrecord[0]['_id'];?>');
		});
	</script>
<?php }?>
<?php }?>

<?php if(isset($estAction) && $estAction == "pdf"){?>
<script>
		$(document).ready(function () {
                    	GeneratePDF('<?php echo $editrecord[0]['_id'];?>');
		});
	</script>
<?php }?>
<?php if(isset($estAction) && $estAction == "print"){?>
<script>
		$(document).ready(function () {
                    	GeneratePrint('<?php echo $editrecord[0]['_id'];?>');
		});
	</script>
<?php }?>
        <script>
        //Add item html
      $(function () {
        var availableProduct = [
            <?php
            if (isset($product_list) && count($product_list) > 0) {
                $count = 0;
                foreach ($product_list as $products) {
                    $count++;
                    echo '"' . addslashes($products['product_name']) . '"';
                    if ($count != count($product_list)) {
                        echo ", ";
                    }
                }
            }
            ?>
        ];
       // console.log(availableProduct);
     
        
        $(document).on("keydown.autocomplete",".product_name_class",function(e){
            $(this).autocomplete({
               // alert(autocomplete_url);
             source: function (request, response) {
                $.ajax({
             url: "<?php echo base_url('Invoice/Get_products'); ?>",
             type: "POST",
             data: request,
             success: function (data) {
                 window.product_data  = data;
                
                var i = 0;
                  response($.map(JSON.parse(data), function (el) {
                      
                      if(i ==0){
                          i++;
                        if(el !=''){
                         return el;
                        }else{

                       return 'Add product';

                            }
                    }
                
                 }));
               
             },
              select: function (event, ui) {
        // Prevent value from being put in the input:
       
        this.value = ui.item.product_name;
        // Set the next input's value to the "value" of the item.
        $(this).next("input").value(ui.item.product_name);
        
        event.preventDefault();
    }
         });
    },
     select: function( event, ui ) {
     var match_prod = JSON.parse(product_data);
		//if($.isEmptyObject(match_prod)){
		if(typeof match_prod['product'] !== 'undefined'){
     for(var j=0;j<match_prod['product'].length;j++)
     {
         if(match_prod['product'][j] == ui.item.value)
         {
             //console.log(match_prod['product_description'][j]);
             var div_id = $(this).parent().parent().attr('id');
             $('#'+div_id+' .description_class').val(match_prod['product_description'][j]);
         }
     }    
		}
     if(ui.item.value == 'Add product') 
              {
                  $(this).val("");   
					var div_id = $(this).parent().parent().attr('id');
					$('#'+div_id+' .description_class').val('');				  
                  $("#myModal").modal();
				  
              }
     },
    
      change: function (event, ui) {
      //console.log(ui.item);
              if (!ui.item) {
                  //$(this).val("");
                  //$('#empty-message').show();
                  //$(this).parent().find('span').show();
              }else if(ui.item.value == 'Add product') 
              {
                  $(this).val("");
                  $("#myModal").modal();
              }
              else {
                  $(this).parent().find('span').hide();
              }
          }
             });
  });
    });
    
    function add_product()
    {
        var add_product_name = $('#add_product_name').val();
        var sku = $('#sku').val();
		//var product_description = $('#' + 'product_description').html( tinymce.get('product_description').getContent() );
        //var product_description = $('#product_description').val();
        var product_description = tinymce.get('product_description').getContent();
        
		var opening_stock = $('#opening_stock').val();
        var purchases = $('#purchases').val();
        var sales = $('#sales').val();
        var closing_stock = $('#closing_stock').val();
        var minimum_in_stock = $('#minimum_in_stock').val();
        var perishable = $('#perishable:checked').val();
        var useable_days = $('#useable_days').val();
         
         if(perishable != "on"){
             perishable = "off";
        }
        $("#validate").addClass('alert');
        if(add_product_name == '')
        {   
            $("#validate").html('Enter Product Name');
            $("#validate").show().delay(5000).fadeOut();
            return false;
        }
        if(sku == '')
        {   
            $("#validate").html('Enter sku');
            $("#validate").show().delay(5000).fadeOut();
            return false;
        }
         if(opening_stock == '')
        {   
            $("#validate").html('Enter Opening Stock');
            $("#validate").show().delay(5000).fadeOut();
            return false;
        }
         if(purchases == '')
        {   
            $("#validate").html('Enter Purchases');
            $("#validate").show().delay(5000).fadeOut();
            return false;
        }
         if(sales == '')
        {   
            $("#validate").html('Enter Sales');
            $("#validate").show().delay(5000).fadeOut();
            return false;
        }
         if(closing_stock == '')
        {   
            $("#validate").html('Enter Closing Stock');
            $("#validate").show().delay(5000).fadeOut();
            return false;
        }
          if(minimum_in_stock == '')
        {   
            $("#validate").html('Enter Minimum in Stock');
            $("#validate").show().delay(5000).fadeOut();
            return false;
        }
        
        $.ajax({
                url: "<?php echo base_url('Invoice/Insert_product'); ?>",
                type: "POST",
                //dataType: "json",
                data: {'product_name': add_product_name, 'sku' : sku, 'product_description': product_description,'opening_stock': opening_stock,'purchases': purchases,'sales': sales,'closing_stock': closing_stock,'minimum_in_stock': minimum_in_stock,'perishable': perishable,'useable_days':useable_days},
                success: function (data)
                {
                   // console.log(data);
                    if(data !='Product added Successfully'){
                        $('#validation_msg').empty();
                        $('#validation_msg').append(data);
                    }else{
                        $('#validation_msg').empty();
                        //$('#validation_msg').append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>Product added Successfully.</div>');
                        
                            $('#add_product_name').val('');
                            $('#sku').val('');
                            $('#product_description').val('');
                            $('#opening_stock').val('');
                            $('#purchases').val('');
                            $('#sales').val('');
                            $('#closing_stock').val('');
                            $('#minimum_in_stock').val('');
                            $('#useable_days').val('');
                            $('#myModal').modal('hide');
                   }
					//alert('Success send message.');
				//Show Message in Top side div
					//$('#errorMsg').html("<div class='alert alert-success text-center'><?php echo lang('send_estimate'); ?></div>");
				
		}
            });
    }
        </script>



