document.getElementById("upload").onchange = function() {
    document.getElementById("ProductuploadForm").submit();
}




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
    function loadView(vtype,vurl)
    {
        $.ajax({ 
            url:vurl,
            type:'POST',
            dataType:'HTML',
            data:{view:vtype},
            success:function(d)
            {
                
				$('#replacementdiv').html(d);
            }

        });

    }

} else if (view_name == 'Add')
{
    $('document').ready(function () {
        $('#ProductForm').parsley();
	
    });
} else if (view_name == 'Edit')
{
    $('document').ready(function () {
        $('.frmsubmit').parsley();
		 $('#from-model').parsley();
    });
} else if (view_name == 'view')

{

}else if (view_name == 'grid')

{

    function loadView(vtype,vurl)
    {
        $.ajax({ 
            url:vurl,
            type:'POST',
            dataType:'HTML',
            data:{view:vtype},
            success:function(d)
            {
                //alert(d);
				$('#replacementdiv').html(d);
            }

        });

    }
}

$('document').ready(function () {
	$('#invoice_client_id').on('change', function() {
	  $('#client_idcurlang').val($(this).val());
	  
	  var client_id = $(this).val();
		$.ajax({ 
		url: checkcurlan_url,
		data: {client_id:client_id},
		type: 'post',
		dataType:'JSON',
		success: function(output) {
			if(output.lan != ''){
				$('#invoice_language').val(output.lan);
			}
			if(output.cur != ''){
				$('#invoice_currency').val(output.cur);
			}
		}
		});
	});

	$('#client_idcurlang').val($('#invoice_client_id').val());
	
	$('#tech-companies-1').dataTable();
	
	
	
	if($("#product_description").length > 0){
			        tinymce.init({
			            selector: "textarea#product_description",
			            theme: "modern",
			            height:300,
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
			    }
	
	
	
	$('#perishable').change(function(){
		if(this.checked){
			$('#useble_div').show('slow');
			$('#useable_days').prop('required', true);
		}
		else{
			document.getElementById("useable_days").required = false;
			$('#useble_div').hide('slow');
			
		}
	});
	
	$("#opening_stock,#purchases,#sales").change(function(){
		var opening_stock = $("#opening_stock").val();
		var purchases = $("#purchases").val();
		var sales = $("#sales").val();
		
		if(opening_stock == ''){
			opening_stock = 0;
		}
		if(purchases == ''){
			purchases = 0;
		}
		if(sales == ''){
			sales = 0;
		}
		
		var closing_stock = (parseInt(opening_stock) + parseInt(purchases)) - parseInt(sales);
		
		$("#closing_stock").val(closing_stock);
		//alert(closing_stock);
		
	});
	/* 
	$('select#perisable_short').on('change', function(e) {
			e.preventDefault();
			var selectedValue = this.value;
				$.ajax({ 
				url: perishable_url,
				dataType:'HTML',
				data: {selectedValue:selectedValue,view:'grid'},
				type: 'post',
				success: function(output) {
						if(output){
							//window.location.href=output.url;
							$('#replacementdiv').html(output);
						}
					}
				});
		});
 */
});

/* $('select#perisable_short').on('change', function(e) {
			e.preventDefault();
			var selectedValue = this.value;
				$.ajax({ 
				url: perishable_url,
				dataType:'HTML',
				data: {selectedValue:selectedValue,view:'grid'},
				type: 'post',
				success: function(output) {
						if(output){
							//window.location.href=output.url;
							$('#replacementdiv').html(output);
						}
					}
				});
		}); */
function changeonpeishable(sel) {
			//var selectedValue = sel.value;
			var quantity_short = $('#quantity_short').val();
			var perisable_short = $('#perisable_short').val();
			var status_short = $('#status_short').val();
			
			//alert("1: " + quantity_short + "2: " + perisable_short + "3: " + status_short);

			$.ajax({ 
				url: perishable_url,
				dataType:'HTML',
				data: {given_year:quantity_short,perisable_short:perisable_short,status_short:status_short,shorting:true,view:'grid'},
				type: 'post',
				success: function(output) {
						if(output){
							//window.location.href=output.url;
							$('#replacementdiv').html(output);
							$('.filtr-container').filterizr();
							
							if(quantity_short != ''){
								$("#quantity_short").val(quantity_short).find("option[value=" + quantity_short +"]").attr('selected', true);
							}
							if(perisable_short != ''){
								$("#perisable_short").val(perisable_short).find("option[value=" + perisable_short +"]").attr('selected', true);
							}
							if(status_short != ''){
								$("#status_short").val(status_short).find("option[value=" + status_short +"]").attr('selected', true);
							}
						}
					}
				});
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
	
 function view(id){
	window.location.assign(view_url + '/' +id);
}
		
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
							
$(document).ready(function() {
    $('#excel_btn').click(function() 
    { 
        
        var imgVal = $('#upload').val(); 
        if(imgVal=='') 
        { 
           $("#validate").html('Empty input file');
            $("#validate").show().delay(5000).fadeOut();
            return false; 
        } 


    }); 
});
