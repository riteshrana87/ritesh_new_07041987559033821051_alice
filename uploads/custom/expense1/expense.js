function calculate_subtotal()
{
    var subtotal = 0;
    $('.product_price').each(function () {
        var inc = $(this).attr('data-inc');
        var qty = $('#qty' + inc).val();
        var qtycalc =(parseFloat(qty) * parseFloat($(this).val()));
        if ($(this).val() != '')
        {
            subtotal = parseFloat(subtotal) + parseFloat(qtycalc);
            $('#excluding_tax').val(subtotal);
            $('#excluding_tax_text').html(subtotal);
        }

    });
   // console.log(subtotal);
    var taxsum = 0;
    var calculatedtaxval = 0;
    var finalamt = 0;
    $('.tax_value').each(function () {


        if ($(this).val() != '')
        {
            taxsum = parseFloat(taxsum) + parseFloat($(this).val());
        }

    });
    calculatedtaxval = (parseFloat(subtotal) * parseFloat(taxsum)) / parseFloat(100);
    finalamt = (parseFloat(subtotal) + parseFloat(calculatedtaxval));
    if (finalamt < 0)
    {
        finalamt = 0;
    }
    $('#total_tax').val(calculatedtaxval);
    $('#total_text').html(finalamt);
    $('#total').val(finalamt);
    //total_text,toal

}

function deleteItem(vid)
{
    swal({
        title: delete_confirmation_product_line,
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    },
            function () {

                $('#' + vid).remove();
                calculate_subtotal();
                swal.close();
//  swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
}
function deleteItemTax(vid)
{
    swal({
        title: delete_confirmation_product_line,
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    },
            function () {

                $('#' + vid).remove();
                calculate_subtotal();
                swal.close();
//  swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
}
if (view_name == 'List')
{
    function promptAlert(urls)
    {
        swal({
            title: delete_client,
            //text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
                function () {
                    window.location.href = urls;
//  swal("Deleted!", "Your imaginary file has been deleted.", "success");
                });
    }
    function loadView(vtype, vurl)
    {
        $.ajax({
            url: vurl,
            type: 'POST',
            dataType: 'HTML',
            data: {view: vtype},
            success: function (d)
            {
                $('#replacementdiv').html(d);
            }

        });

    }



} else if (view_name == 'Add')
{


    $('body').delegate('#submit_tax', 'click', function () {
        var vurl = $('#TaxForm').attr('action');

        if ($('#TaxForm').parsley().isValid()) {
            $('input[type="submit"]').prop('disabled', true);
            $.ajax({
                url: vurl,
                data: $('#TaxForm').serialize(),
                type: "post",
                dataType: "JSON",
                success: function (d)
                {
                    $('#ajaxModal').modal('hide');
                    if (d.status == 1)
                    {
                        // console.log(d.tax_id.$id);
                        $('.tax_select').each(function ()
                        {
                            $(this).append("<option value='" + d.tax_id.$id + "'>" + d.tax_name + "</option>");
                            if ($(this).val() == 'new')
                            {
                                $(this).val(d.tax_id.$id);
                                var tbxid = $(this).attr('data-taxbox');
                                var vl = $('option:selected', this).attr('data-val');

                                $('#' + tbxid).val(d.tax_val);
                                calculate_subtotal();
                                // $('#' + tbxid).val($(this).attr('data-val'));

                            }

                        });

                    }
                }

            }
            );
            return false;
//            $('#from-model').submit();
        }
    });
    $('body').delegate('.tax_select', 'change', function () {
        var tbxid = $(this).attr('data-taxbox');
        var vl = $('option:selected', this).attr('data-val');

        $('#' + tbxid).val(vl);
        calculate_subtotal();

    });

    $('body').delegate('.product_price', 'keyup', function () {

        calculate_subtotal();

    });
    $('body').delegate('.product_qty', 'keyup', function () {

        calculate_subtotal();

    });
    var select_date = new Date();

    $('document').ready(function () {
        // Select2
        $(".select2").select2();
        $('#startdate').datepicker();

        tinymce.init({
            selector: "textarea#description",
            theme: "modern",
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });
        $('#ExpenseForm').parsley();
        window.ParsleyValidator.addValidator('gteq',
                function (value, requirement) {
                    return Date.parse($('#task_due_date input').val()) >= Date.parse($('#task_start_date input').val());
                }, 32)
                .addMessage('en', 'le', 'This value should be less or equal');
    });
    /*
     * date init for the start date  and end date validation
     */


    function addNewProduct(vurl, i)
    {
        var inc = $('.pdiv').length;
        inc = inc + 1;
        $.ajax({
            url: vurl,
            datatype: "HTML",
            type: "post",
            data: {'i': inc},
            success: function (data)
            {
                $('.appendproductbox').append(data);


            }
        });
    }
    function getTaxBox(vurl, i)
    {
        var inc = $('.tax_select').length;
        inc = inc + 1;
        $.ajax({
            url: vurl,
            datatype: "HTML",
            type: "post",
            data: {'i': inc},
            success: function (data)
            {
                $('.appendtaxbox').append(data);


            }
        });
    }
    function deleteItem(vid)
    {
        swal({
            title: delete_confirmation_product_line,
            //text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
                function () {
                    calculate_subtotal();
                    $('#' + vid).remove();
                    swal.close();
//  swal("Deleted!", "Your imaginary file has been deleted.", "success");
                });
    }

} else if (view_name == 'Edit')
{

    $('body').delegate('#submit_tax', 'click', function () {
        var vurl = $('#TaxForm').attr('action');

        if ($('#TaxForm').parsley().isValid()) {
            $('input[type="submit"]').prop('disabled', true);
            $.ajax({
                url: vurl,
                data: $('#TaxForm').serialize(),
                type: "post",
                dataType: "JSON",
                success: function (d)
                {
                    $('#ajaxModal').modal('hide');
                    if (d.status == 1)
                    {
                        // console.log(d.tax_id.$id);
                        $('.tax_select').each(function ()
                        {
                            $(this).append("<option value='" + d.tax_id.$id + "'>" + d.tax_name + "</option>");
                            if ($(this).val() == 'new')
                            {
                                $(this).val(d.tax_id.$id);
                                var tbxid = $(this).attr('data-taxbox');
                                var vl = $('option:selected', this).attr('data-val');

                                $('#' + tbxid).val(d.tax_val);
                                calculate_subtotal();
                                // $('#' + tbxid).val($(this).attr('data-val'));

                            }

                        });

                    }
                }

            }
            );
            return false;
//            $('#from-model').submit();
        }
    });
    $('body').delegate('.tax_select', 'change', function () {
        var tbxid = $(this).attr('data-taxbox');
        var vl = $('option:selected', this).attr('data-val');

        $('#' + tbxid).val(vl);
        calculate_subtotal();

    });

    $('body').delegate('.product_price', 'keyup', function () {

        calculate_subtotal();

    });
    $('body').delegate('.product_qty', 'keyup', function () {

        calculate_subtotal();

    });
    var select_date = new Date();

    $('document').ready(function () {
        // Select2
                 $('#startdate').datepicker();
        $(".select2").select2();
        calculate_subtotal();
        tinymce.init({
            selector: "textarea#description",
            theme: "modern",
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });
        $('#ExpenseForm').parsley();

    });
} else if (view_name == 'view')

{

}


