function goBack() {
    window.history.back();
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
//    $('#ledger_table').dataTable({
//          "bSort" : false,
//          "searching": false,
//          dom: "Bfrtip",
//        buttons: [{
//            extend: "csv",
//            className: "btn-sm",
//            orientation: 'landscape'
//        }, {
//            extend: "pdf",
//            className: "btn-sm",
//            orientation: 'landscape',
//              customize : function(doc){
//            var colCount = new Array();
//            var tbl = $('#ledger_table');
//            $(tbl).find('tbody tr:first-child td').each(function(){
//                if($(this).attr('colspan')){
//                    for(var i=1;i<=$(this).attr('colspan');$i++){
//                        colCount.push('*');
//                    }
//                }else{ colCount.push('*'); }
//            });
//            doc.content[1].table.widths = colCount;
//        }
//        }],
//    });

      $('#tech-companies-1').dataTable({
                    // retrieve: true,
                  
          dom: "Bfrtip",
        buttons: [{
            extend: "csv",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
        }, {
            extend: "pdf",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
            message: company_address,
            customize : function(doc){
            var colCount = new Array();
            var tbl = $('#tech-companies-1');
            var image_logo = $('#ïmage_url').val();
           
            
             doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'left',
                       image: image_logo,
                } );
            $(tbl).find('tbody tr:first td').each(function(){
               // console.log($(this).attr('colspan'));
                if($(this).attr('colspan')){
                    for(var i=1;i<=$(this).attr('colspan');$i++){
                        colCount.push('*');
                    }
                }else{ colCount.push('*'); }
            });
              //  console.log(doc);
            doc.content[3].table.widths = colCount;
           
        },
        }],
    });

} else if (view_name == 'Add')
{
    $('document').ready(function () {
        $('#ClientForm').parsley();
    });
} else if (view_name == 'Edit')
{
    $('document').ready(function () {
        $('#ClientForm').parsley();
    });
} else if (view_name == 'View')
{

    $(document).ready(function () {

        $('body').delegate('#submit', 'click', function () {

            var url = $('#noteForm').attr('action');
            if ($('#noteForm').parsley().isValid()) {
                $('input[type="submit"]').prop('disabled', true);
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'HTML',
                    data: $('#noteForm').serialize(),
                    success: function (d)
                    {
                        $('#notes').val();
                        $('.notesdiv').html(d);
                    }

                });
                return false;
            }
        });
        $('#noteForm').parsley();

    });
    function loadViewInvoice(vtype, vurl)
    {
        $.ajax({
            url: vurl,
            type: 'GET',
            dataType: 'HTML',
            data: {view: vtype},
            success: function (d)
            {
                $('#replacementdiv').html(d);

            }

        });

    }
    function deleteItem(urls)
    {
        swal({
            title: note_delete,
            //text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
                function () {
                    $.ajax({
                        url: urls+'Reports/get_ledger',
                      type: "POST",
                        //dataType: "json",
                      data: {'product_name': add_product_name, 'sku' : sku, 'product_description': product_description,'opening_stock': opening_stock,'purchases': purchases,'sales': sales,'closing_stock': closing_stock,'minimum_in_stock': minimum_in_stock,'perishable': perishable,'useable_days':useable_days},
                     success: function (d)
                        {
                            if (d.status == 1)
                            {
                                $('#' + d.id.$id).remove();
                                swal.close();
                            }

                        }

                    });
//  swal("Deleted!", "Your imaginary file has been deleted.", "success");
                });
    }



}
 $('#start_limit').datepicker({
                autoclose: true,
                todayHighlight: true,                
            }).on('changeDate', function(){
            // set the "toDate" start to not be later than "fromDate" ends:
            $('#end_limit').datepicker('setStartDate', new Date($(this).val()));
            $('#end_limit').val('');
            });
 $('#end_limit').datepicker({
                autoclose: true,
                todayHighlight: true,
            }).on('changeDate', function(){
                // set the "toDate" start to not be later than "fromDate" ends:
                $('#start_limit').datepicker('setEndDate', new Date($(this).val()));
            });
function get_ledger()
    {
        var data = $('#client_id').val();
        
        var start_limit = $('#start_limit').val();
        var end_limit = $('#end_limit').val();
        var type = $('#client_id').find(':selected').data('type');
        convert_image();
        if(data == '')
        {
            $("#validate").html('Enter Name');
            $("#validate").show().delay(5000).fadeOut();
            return false;
        }
        $.ajax({
            url: recurring_url+'Reports/Get_ledger_data',
             type: "POST",
            //dataType: "json",
            data: {'data': data, 'type' : type,'start_limit':start_limit,'end_limit':end_limit},
            success: function (d)
            {
                $('#ledger_table').DataTable().destroy();
                $('#ledger_sales_table').DataTable().destroy();
                //$('#replacementdiv').html(d);
                var data = JSON.parse(d);
                console.log(data);
                if(type == 'client')
                {
                    var row;
                            row += '<tr>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">Opening Balance</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[0]['currency']+'0.00</td>';
                            row += '</tr>';
                    for(var i=0;i<data.length-1;i++)
                    {
                        if(data[i]['type']=='invoice'){
                          if(data[i]['ínvoice']['invoice_type'] !=1)
                          {
                              console.log('test'+i);
                            row += '<tr>';
                            row += '<td class="cursor">'+data[i]['ínvoice']['created_date']+'</td>';
                            row += '<td class="cursor">Sales</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[i]['ínvoice']['invoice_code']+'</td>';
                            row += '<td class="cursor">Invoice</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['net_income']+'</td>';
                            row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';
                            row += '</tr>';
                            var tax = data[i]['tax'];
                            for(var j=0;j<tax.length;j++)
                            {
                                row += '<tr>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+tax[j]['tax_name']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[i]['ínvoice']['invoice_code']+'</td>';
                                row += '<td class="cursor">Invoice</td>';
                                row += '<td class="cursor">'+data[i]['currency']+' '+tax[j]['tax_total_val']+'</td>';
                                row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';
                                row += '</tr>';
                            }
                            if(data[i]['invoice_paid'] != null)
                            {
                                var invoice_paid = data[i]['invoice_paid'];
                            for(var k=0;k<invoice_paid.length;k++)
                            {
                                row += '<tr>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">By '+invoice_paid[k]['payment_with']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">ReceiptVoucher</td>';
                                row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';
                                row += '<td class="cursor">'+data[i]['currency']+' '+invoice_paid[k]['paid_amount']+'</td>';
                                row += '</tr>';
                              /*  row += '<tr>';
                                row += '<td class="cursor"></td>';
                                row += '<td class="cursor"></td>';
                                row += '<td class="cursor"></td>';
                                row += '<td class="cursor"></td>';
                                row += '<td class="cursor"></td>';
                                row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['invoice_paid']['paid_amount']+'</td>';
                                row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['invoice_paid']['paid_amount']+'</td>';
                                row += '</tr>';*/
                            }
                            }
                        }else
                        {
                             row += '<tr>';
                            row += '<td class="cursor">'+data[i]['ínvoice']['created_date']+'</td>';
                            row += '<td class="cursor">Purchases</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[i]['ínvoice']['invoice_code']+'</td>';
                            row += '<td class="cursor">Invoice</td>';
                            row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['net_income']+'</td>';
                            row += '</tr>';
                            var tax = data[i]['tax'];
                            for(var j=0;j<tax.length;j++)
                            {
                                row += '<tr>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+tax[j]['tax_name']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[i]['ínvoice']['invoice_code']+'</td>';
                                row += '<td class="cursor">Invoice</td>';
                                row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';
                                row += '<td class="cursor">'+data[i]['currency']+' '+tax[j]['tax_total_val']+'</td>';                              
                                row += '</tr>';
                            }
                            if(data[i]['invoice_paid'] != null)
                            {
                                var invoice_paid = data[i]['invoice_paid'];
                            for(var k=0;k<invoice_paid.length;k++)
                            {
                                row += '<tr>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">By '+invoice_paid[k]['payment_with']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">ReceiptVoucher</td>';
                                row += '<td class="cursor">'+data[i]['currency']+' '+invoice_paid[k]['paid_amount']+'</td>';
                                row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';                            
                                row += '</tr>';
                             
                            }
                            }
                        }
                    }else{
                                row += '<tr>';
                                row += '<td class="cursor">'+data[i]['date']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[i]['journal_code']+'</td>';
                                row += '<td class="cursor">Journal</td>';
                                row += '<td class="cursor">'+((data[i]['journal']['debit']!='0')?data[i]['currency']+' '+data[i]['journal']['debit']:'-')+'</td>';
                                row += '<td class="cursor">'+((data[i]['journal']['credit']!='0')?data[i]['currency']+' '+data[i]['journal']['credit']:'-')+'</td>';                            
                                row += '</tr>';
                    }
                    }
                        if(data[data.length-1]['net_payment_paid'] != null)
                            {
                    
                        if(data[data.length-1]['remaining_in'] !='Payable Amount')
                          {
                                row += '<tr>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[data.length-1]['remaining_in']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[data.length-1]['currency']+' '+data[data.length-1]['remaining']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '</tr>';
                            }else{
                                 row += '<tr>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[data.length-1]['remaining_in']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[data.length-1]['currency']+' '+data[data.length-1]['remaining']+'</td>';
                                row += '</tr>';
                            }
                            }else
                            {
                                row += '<tr>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">Closing Balance</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[data.length-1]['currency']+'0.00</td>';
                                row += '</tr>';
                                
                            }
                    $('#ledger_data').empty();
                    $('#ledger_data').append(row);
                }
                if(type == 'vendor')
                {   
                    var row;
                            row += '<tr>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">Opening Balance</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[0]['currency']+'0.00</td>';
                            row += '</tr>';
                    for(var i=0;i<data.length-1;i++)
                    {
                        if(data[i]['type']=='expense'){
                            row += '<tr>';
                            row += '<td class="cursor">'+data[i]['expense']['created_at']+'</td>';
                            row += '<td class="cursor"></td>';
                            row += '<td class="cursor">'+data[i]['expense']['description']+'</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">Expense</td>';
                            row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['expense']['excluding_tax']+'</td>';                           
                            row += '</tr>';
                             var tax = data[i]['tax'];
                            for(var j=0;j<tax.length;j++)
                            {
                                row += '<tr>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+tax[j]['tax_name']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">Expense</td>';
                                row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';
                                row += '<td class="cursor">'+data[i]['currency']+' '+tax[j]['tax_total_val']+'</td>';
                                row += '</tr>';
                            }
                            if(data[i]['expense_paid'] != null)
                            {
                                var expense_paid = data[i]['expense_paid'];
                            for(var k=0;k<expense_paid.length;k++)
                            {
                                row += '<tr>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">By '+expense_paid[k]['payment_with']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">ReceiptVoucher</td>';
                                row += '<td class="cursor">'+data[i]['currency']+' '+expense_paid[k]['paid_amount']+'</td>';
                                row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';
                                row += '</tr>';
                              /*  row += '<tr>';
                                row += '<td class="cursor"></td>';
                                row += '<td class="cursor"></td>';
                                row += '<td class="cursor"></td>';
                                row += '<td class="cursor"></td>';
                                row += '<td class="cursor"></td>';
                                row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['invoice_paid']['paid_amount']+'</td>';
                                row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['invoice_paid']['paid_amount']+'</td>';
                                row += '</tr>';*/
                            }
                            }
                        }else{
                                row += '<tr>';
                                row += '<td class="cursor">'+data[i]['date']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[i]['journal_code']+'</td>';
                                row += '<td class="cursor">Journal</td>';
                                row += '<td class="cursor">'+((data[i]['journal']['debit']!='0')?data[i]['currency']+' '+data[i]['journal']['debit']:'-')+'</td>';
                                row += '<td class="cursor">'+((data[i]['journal']['credit']!='0')?data[i]['currency']+' '+data[i]['journal']['credit']:'-')+'</td>';                            
                                row += '</tr>';
                            }
                    }
                            row += '<tr>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[0]['currency']+'0.00</td>';
                            row += '<td class="cursor">'+data[0]['currency']+' '+data[data.length-1]['net_expense']+'</td>';
                            row += '</tr>';
                            row += '<tr>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[data.length-1]['remaining_in']+'</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[0]['currency']+' '+data[data.length-1]['remaining']+'</td>';
                            row += '<td class="cursor">-</td>';
                            row += '</tr>';
                    $('#ledger_data').empty();
                    $('#ledger_data').append(row);
                     
                }
                    if(type == 'category')
                {   
                    var row;
                            row += '<tr>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">Opening Balance</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[0]['currency']+'0.00</td>';
                            row += '</tr>';
                    for(var i=0;i<data.length-1;i++)
                    {
                        if(data[i]['type']=='expense'){
                            row += '<tr>';
                            row += '<td class="cursor">'+data[i]['expense']['created_at']+'</td>';
                            row += '<td class="cursor">'+data[i]['expense']['vendorname']+'</td>';
                            row += '<td class="cursor">'+data[i]['expense']['description']+'</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">Expense</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['expense']['total']+'</td>';
                            row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';
                            row += '</tr>';
                        }else{
                                row += '<tr>';
                                row += '<td class="cursor">'+data[i]['date']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[i]['journal_code']+'</td>';
                                row += '<td class="cursor">Journal</td>';
                                row += '<td class="cursor">'+((data[i]['journal']['debit']!='0')?data[i]['currency']+' '+data[i]['journal']['debit']:'-')+'</td>';
                                row += '<td class="cursor">'+((data[i]['journal']['credit']!='0')?data[i]['currency']+' '+data[i]['journal']['credit']:'-')+'</td>';                            
                                row += '</tr>';
                        }
                    }
                            row += '<tr>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">Closing Balance</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[0]['currency']+' '+data[data.length-1]['net_expense']+'</td>';
                            row += '<td class="cursor">'+data[0]['currency']+'0.00</td>';
                            row += '</tr>';
                          
                    $('#ledger_data').empty();
                    $('#ledger_data').append(row);
                     
                }
                  if(type == 'bank')
                {   
                    var row;
                            row += '<tr>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">Opening Balance</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[0]['currency']+'0.00</td>';
                            row += '</tr>';
                    for(var i=0;i<data.length-1;i++)
                    {
                         if(data[i]['type']=='bank'){
                            row += '<tr>';
                            row += '<td class="cursor">'+data[i]['bank']['payment_date']+'</td>';
                            row += '<td class="cursor">By '+data[i]['client_name']+'</td>';
                            row += '<td class="cursor"></td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">ReceiptVoucher</td>';
                            row += '<td class="cursor">'+data[i]['currency']+'0.00</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['bank']['paid_amount']+'</td>';
                            row += '</tr>';
                        }else{
                                row += '<tr>';
                                row += '<td class="cursor">'+data[i]['date']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[i]['journal_code']+'</td>';
                                row += '<td class="cursor">Journal</td>';
                                row += '<td class="cursor">'+((data[i]['journal']['debit']!='0')?data[i]['currency']+' '+data[i]['journal']['debit']:'-')+'</td>';
                                row += '<td class="cursor">'+((data[i]['journal']['credit']!='0')?data[i]['currency']+' '+data[i]['journal']['credit']:'-')+'</td>';                            
                                row += '</tr>';
                        }
                    }
                            row += '<tr>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">Closing Balance</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[0]['currency']+' '+data[data.length-1]['net_transaction']+'</td>';
                            row += '</tr>';
                    $('#ledger_data').empty();
                    $('#ledger_data').append(row);
                     
                }
                  if(type == 'journal')
                {   
                    var row;
                            row += '<tr>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">Opening Balance</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+data[0]['currency']+' '+data[0]['opening_balance']+'</td>';
                            row += '</tr>';
                    for(var i=0;i<data.length-1;i++)
                    {
                                row += '<tr>';
                                row += '<td class="cursor">'+data[i]['date']+'</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">-</td>';
                                row += '<td class="cursor">'+data[i]['journal_code']+'</td>';
                                row += '<td class="cursor">Journal</td>';
                                row += '<td class="cursor">'+((data[i]['journal']['debit']!='0')?data[i]['currency']+' '+data[i]['journal']['debit']:'-')+'</td>';
                                row += '<td class="cursor">'+((data[i]['journal']['credit']!='0')?data[i]['currency']+' '+data[i]['journal']['credit']:'-')+'</td>';                            
                                row += '</tr>';
                        
                    }
                            row += '<tr>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">Closing Balance</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+((data[data.length-1]['type']!='credit')?data[data.length-1]['currency']+' '+data[data.length-1]['net_amount']:'-')+'</td>';
                            row += '<td class="cursor">'+((data[data.length-1]['type']!='debit')?data[data.length-1]['currency']+' '+data[data.length-1]['net_amount']:'-')+'</td>';
                            row += '</tr>';
                          
                    $('#ledger_data').empty();
                    $('#ledger_data').append(row);
                     
                }
                     if(type == 'sales')
                {   
                    $('#ledger_table').hide();
                     $('#ledger_sales_table').show();
                    var row;
                            
                    for(var i=0;i<data.length;i++)
                    {
                         if(data[i]['type']=='invoice'){
                            row += '<tr>';
                            row += '<td class="cursor">'+data[i]['ínvoice']['created_date']+'</td>';
                            row += '<td class="cursor">By '+data[i]['client']+'</td>';
                            row += '<td class="cursor">'+data[i]['ínvoice']['invoice_code']+'</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['ínvoice']['amount']+'</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['ínvoice']['tax_amunt']+'</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['ínvoice']['total_payment']+'</td>';
                            row += '</tr>';
                        }else{
                            row += '<tr>';
                            row += '<td class="cursor">'+data[i]['date']+'</td>';
                            row += '<td class="cursor">'+((data[i]['journal']['credit']!='0')?'Credit':'Debit')+'</td>';
                            row += '<td class="cursor">'+data[i]['journal_code']+'</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+((data[i]['journal']['credit']!='0')?data[i]['currency']+' '+data[i]['journal']['credit']:data[i]['currency']+' '+data[i]['journal']['debit'])+'</td>';
                            row += '</tr>';
                        }
                    }
                           
                            $('#ledger_sales_data').empty();
                            $('#ledger_sales_data').append(row);

                              $('#ledger_sales_table').dataTable({
                                   // retrieve: true,
                                   "bSort" : false,
                                   "searching": false,
                                   "paging": false,
                         dom: "Bfrtip",
                       buttons: [{
                           extend: "csv",
                           className: "btn-sm",
                           orientation: 'landscape',
                           title : company_name,
                       }, {
                           extend: "pdf",
                           className: "btn-sm",
                           orientation: 'landscape',
                           title : company_name,
                           message: company_address,
                           customize : function(doc){
                           var colCount = new Array();
                           var tbl = $('#ledger_sales_table');
                           var image_logo = $('#ïmage_url').val();


                            doc.content.splice( 1, 0, {
                                       margin: [ 0, 0, 0, 12 ],
                                       alignment: 'left',
                                      image: image_logo,
                               } );
                           $(tbl).find('tbody tr:nth-child(2) td').each(function(){
                              // console.log($(this).attr('colspan'));
                               if($(this).attr('colspan')){
                                   for(var i=1;i<=$(this).attr('colspan');$i++){
                                       colCount.push('*');
                                   }
                               }else{ colCount.push('*'); }
                           });
                             //  console.log(doc);
                           doc.content[3].table.widths = colCount;

                       },
                       }],
                       });
                } else if(type == 'purchases')
                    {
                          $('#ledger_table').hide();
                     $('#ledger_sales_table').show();
                    var row;
                            
                    for(var i=0;i<data.length;i++)
                    {
                         if(data[i]['type']=='purchases'){
                            row += '<tr>';
                            row += '<td class="cursor">'+data[i]['ínvoice']['created_date']+'</td>';
                            row += '<td class="cursor">By '+data[i]['client']+'</td>';
                            row += '<td class="cursor">'+data[i]['ínvoice']['invoice_code']+'</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['ínvoice']['amount']+'</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['ínvoice']['tax_amunt']+'</td>';
                            row += '<td class="cursor">'+data[i]['currency']+' '+data[i]['ínvoice']['total_payment']+'</td>';
                            row += '</tr>';
                        }else{
                            row += '<tr>';
                            row += '<td class="cursor">'+data[i]['date']+'</td>';
                            row += '<td class="cursor">'+((data[i]['journal']['credit']!='0')?'Credit':'Debit')+'</td>';
                            row += '<td class="cursor">'+data[i]['journal_code']+'</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">-</td>';
                            row += '<td class="cursor">'+((data[i]['journal']['credit']!='0')?data[i]['currency']+' '+data[i]['journal']['credit']:data[i]['currency']+' '+data[i]['journal']['debit'])+'</td>';
                            row += '</tr>';
                        }
                    }
                           
                            $('#ledger_sales_data').empty();
                            $('#ledger_sales_data').append(row);

                              $('#ledger_sales_table').dataTable({
                                   // retrieve: true,
                                   "bSort" : false,
                                   "searching": false,
                                   "paging": false,
                         dom: "Bfrtip",
                       buttons: [{
                           extend: "csv",
                           className: "btn-sm",
                           orientation: 'landscape',
                           title : company_name,
                       }, {
                           extend: "pdf",
                           className: "btn-sm",
                           orientation: 'landscape',
                           title : company_name,
                           message: company_address,
                           customize : function(doc){
                           var colCount = new Array();
                           var tbl = $('#ledger_sales_table');
                           var image_logo = $('#ïmage_url').val();


                            doc.content.splice( 1, 0, {
                                       margin: [ 0, 0, 0, 12 ],
                                       alignment: 'left',
                                      image: image_logo,
                               } );
                           $(tbl).find('tbody tr:nth-child(2) td').each(function(){
                              // console.log($(this).attr('colspan'));
                               if($(this).attr('colspan')){
                                   for(var i=1;i<=$(this).attr('colspan');$i++){
                                       colCount.push('*');
                                   }
                               }else{ colCount.push('*'); }
                           });
                             //  console.log(doc);
                           doc.content[3].table.widths = colCount;

                       },
                       }],
                       });
                    }
                else{
                         $('#ledger_sales_table').hide();
                     $('#ledger_table').show();
                        $('#ledger_table').dataTable({
                           // retrieve: true,
                           "bSort" : false,
                           "searching": false,
                           "paging": false,
                 dom: "Bfrtip",
               buttons: [{
                   extend: "csv",
                   className: "btn-sm",
                   orientation: 'landscape',
                   title : company_name,
               }, {
                   extend: "pdf",
                   className: "btn-sm",
                   orientation: 'landscape',
                   title : company_name,
                   message: company_address,
                   customize : function(doc){
                   var colCount = new Array();
                   var tbl = $('#ledger_table');
                   var image_logo = $('#ïmage_url').val();


                    doc.content.splice( 1, 0, {
                               margin: [ 0, 0, 0, 12 ],
                               alignment: 'left',
                              image: image_logo,
                       } );
                   $(tbl).find('tbody tr:nth-child(2) td').each(function(){
                      // console.log($(this).attr('colspan'));
                       if($(this).attr('colspan')){
                           for(var i=1;i<=$(this).attr('colspan');$i++){
                               colCount.push('*');
                           }
                       }else{ colCount.push('*'); }
                   });
                     //  console.log(doc);
                   doc.content[3].table.widths = colCount;

               },
               }],
               });
            }
            }

        });

    }
    
    function convert_image(){
     getDataUri(company_logo, function(dataUri) {
    // Do whatever you'd like with the Data URI!
    
            $('#ïmage_url').val(dataUri);
            });
        } 
        
        // convert image to base64
    function getDataUri(url, callback) {
    var image = new Image();

    image.onload = function () {
        var canvas = document.createElement('canvas');
        canvas.width = 50;//this.naturalWidth; // or 'width' if you want a special/scaled size
        canvas.height = 50;//this.naturalHeight; // or 'height' if you want a special/scaled size
        
        canvas.getContext('2d').drawImage(this, 0, 0,50,50);

        // Get raw image data
       // callback(canvas.toDataURL('image/png').replace(/^data:image\/(png|jpg);base64,/, ''));

        // ... or get as Data URI
        callback(canvas.toDataURL('image/png'));
    };

    image.src = url;
}
function get_trial_balance()
{
    var invoice_start = $('#invoice_start').val();
    
    $('#trial_balance_table').DataTable().destroy();
    $.ajax({
                url: recurring_url+'Reports/Get_trial_data',
                type: "POST",
                //dataType: "json",
                data: {'invoice_start': invoice_start},
                success: function (d)
                {
                        var data = JSON.parse(d);
                        var row;
                   //console.log(data);
                        for(var i=0;i<data.length;i++)
                        {
                            row += '<tr>';
                            row += '<td>'+data[i]['client_name']+'</td>';
                            row += '<td>-</td>';
                            row += '<td>'+data[i]['currency']+' '+((data[i]['total_amount']!=undefined)?data[i]['total_amount']:'0.00')+'</td>';
                            row += '<td>'+data[i]['currency']+' '+((data[i]['total_payment']!=undefined)?data[i]['total_payment']:'0.00')+'</td>';
                            row += '</tr>';
                            row += '<tr>';
                            row += '<td></td>';
                            row += '<td>'+((data[i]['remaining_in']!=undefined)?data[i]['remaining_in']:'-')+'</td>';
                            row += '<td>'+data[i]['currency']+' '+((data[i]['remaining_amount']!=undefined)?data[i]['remaining_amount']:'0.00')+'</td>';
                            row +='<td>-</td>';
                            row += '</tr>';
                        }
                        $('#trial_balance_data').empty();
                        $('#trial_balance_data').append(row);
                        
                            $('#trial_balance_table').dataTable({
                    // retrieve: true,
                    "bSort" : false,
                    "searching": false,
                    "paging": false,
          dom: "Bfrtip",
        buttons: [{
            extend: "csv",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
        }, {
            extend: "pdf",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
            message: company_address,
            customize : function(doc){
            var colCount = new Array();
            var tbl = $('#trial_balance_table');
            var image_logo = $('#ïmage_url').val();
           
            
             doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'left',
                       image: image_logo,
                } );
            $(tbl).find('tbody tr:nth-child(2) td').each(function(){
               // console.log($(this).attr('colspan'));
                if($(this).attr('colspan')){
                    for(var i=1;i<=$(this).attr('colspan');$i++){
                        colCount.push('*');
                    }
                }else{ colCount.push('*'); }
            });
              //  console.log(doc);
            doc.content[3].table.widths = colCount;
           
        },
        }],
    });
		}
            });
}

$('#invoice_start').datepicker({
                autoclose: true,
                todayHighlight: true,                
            });
   
   $('#trial_balance_table').dataTable({
                    // retrieve: true,
                    "bSort" : false,
                    "searching": false,
                    "paging": false,
          dom: "Bfrtip",
        buttons: [{
            extend: "csv",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
        }, {
            extend: "pdf",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
            message: company_address,
            customize : function(doc){
            var colCount = new Array();
            var tbl = $('#trial_balance_table');
            var image_logo = $('#ïmage_url').val();
           
            
             doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'left',
                       image: image_logo,
                } );
            $(tbl).find('tbody tr:nth-child(2) td').each(function(){
               // console.log($(this).attr('colspan'));
                if($(this).attr('colspan')){
                    for(var i=1;i<=$(this).attr('colspan');$i++){
                        colCount.push('*');
                    }
                }else{ colCount.push('*'); }
            });
                //console.log(doc);
            doc.content[3].table.widths = colCount;
           
        },
        }],
    });
    $(document).ready(function(){
        convert_image();
    });
    
       $('#low_stock_register_table').dataTable({
                    // retrieve: true,
                  //  "bSort" : false,
                  //  "searching": false,
                    "paging": false,
          dom: "Bfrtip",
        buttons: [{
            extend: "csv",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
        }, {
            extend: "pdf",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
            message: company_address,
            customize : function(doc){
            var colCount = new Array();
            var tbl = $('#low_stock_register_table');
            var image_logo = $('#ïmage_url').val();
           
            
             doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'left',
                       image: image_logo,
                } );
            $(tbl).find('tbody tr:first td').each(function(){
               // console.log($(this).attr('colspan'));
                if($(this).attr('colspan')){
                    for(var i=1;i<=$(this).attr('colspan');$i++){
                        colCount.push('*');
                    }
                }else{ colCount.push('*'); }
            });
                //console.log(doc);
            doc.content[3].table.widths = colCount;
           
        },
        }],
    });
    
    $('#stock_summary_table').dataTable({
                    // retrieve: true,
                   // "bSort" : false,
                    //"searching": false,
                   // "paging": false,
          dom: "Bfrtip",
        buttons: [{
            extend: "csv",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
        }, {
            extend: "pdf",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
            message: company_address,
            customize : function(doc){
            var colCount = new Array();
            var tbl = $('#stock_summary_table');
            var image_logo = $('#ïmage_url').val();
           
            
             doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'left',
                       image: image_logo,
                } );
            $(tbl).find('tbody tr:first td').each(function(){
               // console.log($(this).attr('colspan'));
                if($(this).attr('colspan')){
                    for(var i=1;i<=$(this).attr('colspan');$i++){
                        colCount.push('*');
                    }
                }else{ colCount.push('*'); }
            });
                console.log(doc);
            doc.content[3].table.widths = colCount;
           
        },
        }],
    });
    
    function get_tax_summary()
    {
        var data = $('#tax_rate').val();
        var start_limit = $('#start_limit').val();
        var end_limit = $('#end_limit').val();
       
        convert_image();
        
        $.ajax({
            url: recurring_url+'Reports/Tax_summary_ajax',
             type: "POST",
            //dataType: "json",
            data: {'data': data,'start_limit':start_limit,'end_limit':end_limit},
            success: function (d)
            {
                $('#tax_summary_table').DataTable().destroy();
                //$('#replacementdiv').html(d);
                var data = JSON.parse(d);
                console.log(data);
            
                
                    var row;
                           
                    for(var i=0;i<data.length-1;i++)
                    {
                     
                            row += '<tr>';
                            row += '<td>'+data[i]['ínvoice_date']+'</td>';
                            row += '<td>'+data[i]['ínvoice']+'</td>';
                            row +='<td>'+data[i]['tax_name']+'</td>';
                            row +='<td>'+data[i]['currency']+' '+data[i]['tax_val']+'</td>';
                            row +='</tr>';
                    }
                            row += '<tr>';
                            row += '<td></td>';
                            row += '<td></td>';
                            row +='<td>Total</td>';
                            row +='<td>'+data[data.length-1]['currency']+' '+data[data.length-1]['total_tax']+'</td>';
                            row +='</tr>';
                    $('#tax_summary_data').empty();
                    $('#tax_summary_data').append(row);
                     
                
                
                 $('#tax_summary_table').dataTable({
                    // retrieve: true,
                    "bSort" : false,
                    "searching": false,
                    "paging": false,
          dom: "Bfrtip",
        buttons: [{
            extend: "csv",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
        }, {
            extend: "pdf",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
            message: company_address,
            customize : function(doc){
            var colCount = new Array();
            var tbl = $('#tax_summary_table');
            var image_logo = $('#ïmage_url').val();
           
            
             doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'left',
                       image: image_logo,
                } );
            $(tbl).find('tbody tr:nth-child(1) td').each(function(){
               // console.log($(this).attr('colspan'));
                if($(this).attr('colspan')){
                    for(var i=1;i<=$(this).attr('colspan');$i++){
                        colCount.push('*');
                    }
                }else{ colCount.push('*'); }
            });
              //  console.log(doc);
            doc.content[3].table.widths = colCount;
           
        },
        }],
    });
    
            }

        });

    }
    
      $('#tax_summary_table').dataTable({
                    // retrieve: true,
                    "bSort" : false,
                    "searching": false,
                    "paging": false,
          dom: "Bfrtip",
        buttons: [{
            extend: "csv",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
        }, {
            extend: "pdf",
            className: "btn-sm",
            orientation: 'landscape',
            title : company_name,
            message: company_address,
            customize : function(doc){
            var colCount = new Array();
            var tbl = $('#tax_summary_table');
            var image_logo = $('#ïmage_url').val();
           
            
             doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'left',
                       image: image_logo,
                } );
            $(tbl).find('tbody tr:nth-child(1) td').each(function(){
               // console.log($(this).attr('colspan'));
                if($(this).attr('colspan')){
                    for(var i=1;i<=$(this).attr('colspan');$i++){
                        colCount.push('*');
                    }
                }else{ colCount.push('*'); }
            });
              //  console.log(doc);
            doc.content[3].table.widths = colCount;
           
        },
        }],
    });
