function calculate_subtotal()
{
    var total_debit = 0;
    var total_credit = 0;
	
	
	
    $('.debit').each(function () {
        var inc = $(this).val();
        //var qty = $('#qty' + inc).val();
        //var qtycalc = parseFloat(qty) * parseFloat($(this).val());
		
        if ($(this).val() != '')
        {
            total_debit += parseFloat(inc);//parseFloat(subtotal) + parseFloat(qtycalc);
           // $('#excluding_tax').html(subtotal);
          //  $('#excluding_taxx').val(subtotal);
         //   $('#excluding_tax_text').html(subtotal);
        }
		
		total_tax = total_tax;
		
    });
	$('#total_debit').val(total_debit);
        $('#total_debit_span').html(total_debit);
   
      $('.credit').each(function () {
        var inc = $(this).val();
        //var qty = $('#qty' + inc).val();
        //var qtycalc = parseFloat(qty) * parseFloat($(this).val());
		
        if ($(this).val() != '')
        {
            total_credit += parseFloat(inc);//parseFloat(subtotal) + parseFloat(qtycalc);
           // $('#excluding_tax').html(subtotal);
          //  $('#excluding_taxx').val(subtotal);
         //   $('#excluding_tax_text').html(subtotal);
        }
		
		total_tax = total_tax;
		
    });
        $('#total_credit').val(total_credit);
        $('#total_credit_span').html(total_credit);
   

}

function validate()
{
     var total_debit = 0;
    var total_credit = 0;
	
	
	
    $('.debit').each(function () {
        var inc = $(this).val();
        //var qty = $('#qty' + inc).val();
        //var qtycalc = parseFloat(qty) * parseFloat($(this).val());
		
        if ($(this).val() != '')
        {
            total_debit += parseFloat(inc);//parseFloat(subtotal) + parseFloat(qtycalc);
           // $('#excluding_tax').html(subtotal);
          //  $('#excluding_taxx').val(subtotal);
         //   $('#excluding_tax_text').html(subtotal);
        }	
		
    });
	
   
      $('.credit').each(function () {
        var inc = $(this).val();
        //var qty = $('#qty' + inc).val();
        //var qtycalc = parseFloat(qty) * parseFloat($(this).val());
		
        if ($(this).val() != '')
        {
            total_credit += parseFloat(inc);//parseFloat(subtotal) + parseFloat(qtycalc);
           // $('#excluding_tax').html(subtotal);
          //  $('#excluding_taxx').val(subtotal);
         //   $('#excluding_tax_text').html(subtotal);
        }
		
    });
    if(total_debit != total_credit)
    {
        $("#validate").html('Credit and Debit should be Equal');
        $("#validate").show().delay(5000).fadeOut();
        return false;
    }
}

function get_type(select)
{
  var id = $(select).find(':selected').data('type');
  console.log(id);
  var type  = $(select).parent().find(".selected_cat_type").val(id);
    
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
	
	$('.filtr-container').filterizr();
	
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
    function view(id){
			
			 window.location.assign(view_url);
		
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

	} 
	else if (view_name == 'Add' || view_name == 'Edit')
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
    $('body').delegate('.pro_tax', 'change', function () {
        calculate_subtotal();
		
		/* alert($(this).val());
		var tax_id = $(this).attr('id');
		var row_id = tax_id.replace('product_tax','');
		alert(row_id); */

    });
    $('body').delegate('.product_qty', 'keyup', function () {

        calculate_subtotal();

    });
	
	/* try by dishit */
    $('body').delegate('.pro_tax', 'change', function () {
		countIndividualtax();
    });
	
    $('body').delegate('.product_price', 'keyup', function () {
		countIndividualtax();
    });
	
	function countIndividualtax(){
		var objArr = [];
		var ss = {};
        $('.product_price').each(function () {
			var obj = {};
			var inc = $(this).attr('data-inc');
			var qty = $('#qty' + inc).val();
			var qtycalc = parseFloat(qty) * parseFloat($(this).val());
			if ($(this).val() != '')
			{
				/* subtotal = parseFloat(subtotal) + parseFloat(qtycalc);
				$('#excluding_tax').val(subtotal);
				$('#excluding_tax_text').html(subtotal); */
			}
			
			//var selected_qty = $('#product_qty'+inc).val();
			var selected_taxrate = $('#product_tax'+inc+' option:selected').attr('data-taxrate');
			var selected_taxname = $('#product_tax'+inc+' option:selected').attr('data-taxname');
			var rt = (parseFloat(qtycalc) * parseFloat(selected_taxrate)) / parseFloat(100);
			
			
			obj[selected_taxname+"("+selected_taxrate+"%)"] = rt;
			//objArr[i] = obj;
			//console.log(selected_taxname + " : " + rt);	
			console.log(obj.toSource());	
			var t = 0;
			
			$.each(obj, function (index, value) {
				console.log( index + ' : ' + value );
				objArr.push(obj);
				//bjArr.push(index + ' : ' + value);
			}); 
			
			//console.log("**"+objArr.toSource());
			//console.log("Final Array: "+objArr.toSource());
			
			len = 0;
			for (var o in objArr) {
				len++;
			}
			
			for(var i=0; i < len; i++) {
				//console.log("array_: " + objArr.toSource());
			}
			
			
			/* array to object combine try 2*/	
			
			function combineKeyData(data) {
			var output = {}, item;
			for (var i = 0; i < data.length; i++) {
				item = data[i];
				for (var prop in item) {
					if (item.hasOwnProperty(prop)) {
						if (!(prop in output)) {
							output[prop] = [];
						}
						output[prop].push(item[prop]);
					}
				}
			}
			return output;
		}
			var result = combineKeyData(objArr);
			console.log("result: " + result.toSource());
			
			var putHTML = '';
			for (var k in result){
				if (result.hasOwnProperty(k)) {
					 console.log("Key is " + k + ", value is" + result[k]);
					 var string = result[k] + '';
					 var separeted = string.split(",");
						var sum = 0;
						for (var i = 0; i < separeted.length; i++) {
							sum += parseInt(separeted[i].toString().match(/(\d+)/)) || 0;
						}
					console.log("value is: " + sum);
				
				 //putHTML = putHTML + '<p class="text-right tax_boxvals">'+k+': <span class="tax_boxvals_item">'+sum+'</span></p>';
					 
					 //alert(k);
					 if(k != 'undefined(undefined%)'){
					 if(k!='no_tax(0%)' || result[k]!='0'){
						putHTML = putHTML + '<div class="col-sm-6">'+k+': </div> <div class="col-sm-6"> $<span>'+sum+'</span></div>';
					}
					}
				}
			}
			$('.included_tax_description').html(putHTML);
			
			
		});
	}
	
	/* try by dishit ends */
	
	
	
    var select_date = new Date();

    $('document').ready(function () {
        // Select2
        $(".select2").select2();
		  $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (1M max).'
            }
        });
        $('.dropify').change(function () {
            var fd = new FormData(document.getElementById("formUpload"));
             $("#formUpload").submit();
           // var aurl=$('#formUpload').attr('action');
            return false;
//            $.ajax({
//                url: aurl,
//                type: "POST",
//                data: fd,
//                dataType:"json",
//                processData: false, // tell jQuery not to process the data
//                contentType: false   // tell jQuery not to set contentType
//            }).done(function (data) {
//                // $('.appendproductbox').append(data.);
//            });
         
        });
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
               //  $(".select2").select2();
                $('.appendproductbox').append(data);
                $(".select2").select2();

            }
        });
    }
    
 $( "#add_account" ).click(function() {
        
             $("#myModal").modal();
        
    });
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
	$('#tech-companies-1').dataTable();
}


      //Add item html
      $(function () {
       // console.log(availableProduct);
     
        $(document).on("keydown.autocomplete",".product_name_class",function(e){
            $(this).autocomplete({
               // alert(autocomplete_url);
             source: function (request, response) {
                $.ajax({
             url: recurring_url+'Invoice/Get_products',
             type: "POST",
             data: request,
             success: function (data) {
                 
                
                  response($.map(JSON.parse(data), function (el) {
                    if(el !=''){
                     return el;
                    }else{
                   
                   return 'Add product';
                   
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
     
     if(ui.item.value == 'Add product') 
              {
                  $(this).val("");                
                  $("#myModal").modal();
              }
     },
    
      change: function (event, ui) {
      //console.log(ui.item);
              if (!ui.item) {
                  $(this).val("");
                  //$('#empty-message').show();
                  $(this).parent().find('span').show();
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
        var product_description = $('#product_description').val();
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
                url: recurring_url+'Invoice/Insert_product',
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
	$('document').ready(function () {
		calculate_subtotal();
		countIndividualtax();
	});
	
	$("#startdate").datepicker();
        $("#startdate1").datepicker();
	$('#tech-companies-1').dataTable();