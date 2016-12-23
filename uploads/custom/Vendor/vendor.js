function goBack() {
    window.history.back();
}

if (view_name == 'List')
{
	$('#tech-companies-1').dataTable();
	
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
        $('#VendorForm').parsley();
		$("#stripe_call").click(function(){
			$(".stripe_form_container").slideToggle('slow');
			$(".paypal_form_container").slideUp('slow');
			$(".ideal_form_container").slideUp('slow');
			 $('#from-model').parsley();
		});
		$("#paypal_call").click(function(){
			$(".stripe_form_container").slideUp('slow');
			$(".paypal_form_container").slideToggle('slow');
			$(".ideal_form_container").slideUp('slow');
		});
		$("#ideal_call").click(function(){
			$(".stripe_form_container").slideUp('slow');
			$(".paypal_form_container").slideUp('slow');
			$(".ideal_form_container").slideToggle('slow');
		});
		
		
		$('#strip_submit').click(function(e){
			e.preventDefault();
			var isValid = true;
			$('.stripe_form_container input').each( function() {
				if ($(this).parsley().validate() !== true) isValid = false;
			});
			if (isValid) {
				var sk_key = $('#sk_key').val();
				var pk_key = $("#pk_key").val();
				$.ajax({ 
				url: stripe_url,
				data: {sk_key:sk_key,pk_key:pk_key},
				type: 'post',
				dataType:'JSON',
				success: function(output) {
						if(output.status==1){
							window.location.href=output.url;
						}
					}
				});
			}
		});
		$('#paypal_submit').click(function(e){
			e.preventDefault();
			var isValid = true;
			 $('.paypal_form_container input').each( function() {
			 if ($(this).parsley().validate() !== true) isValid = false;
			});
			if (isValid) {
				var paypal_email = $('#email').val();
				$.ajax({ 
				url: paypal_url,
				data: {paypal_email:paypal_email},
				type: 'post',
				dataType:'JSON',
				success: function(output) {
						if(output.status==1){
							window.location.href=output.url;
						}
					}
				});
			}
		});
		$('#ideal_submit').click(function(e){
			e.preventDefault();
			var isValid = true;
			 $('.ideal_form_container input').each( function() {
			 if ($(this).parsley().validate() !== true) isValid = false;
			});
			if (isValid) {
				var marchangeid = $('#marchangeid').val();
				var key = $('#key').val();
				var kerversion = $('#kerversion').val();
				$.ajax({ 
				url: ideal_url,
				data: {marchangeid:marchangeid,key:key,kerversion:kerversion},
				type: 'post',
				dataType:'JSON',
				success: function(output) {
						if(output.status==1){
							window.location.href=output.url;
						}
					}
				});
			}
		});
		$("#create_reminder").click(function(){
			$(".reminder_set").slideToggle('slow');
			$(".issue_date").slideUp('slow');
			$(".due_date").slideUp('slow');
			$(".custom_date").slideUp('slow');
			});
			
		$(".select_reminder").change(function(){
			if($(this).val()==1){
			$(".issue_date").slideToggle('slow');
			$(".due_date").slideUp('slow');
			$(".custom_date").slideUp('slow');
			}
			if($(this).val()==2){
			$(".issue_date").slideUp('slow');
			$(".due_date").slideToggle('slow');
			$(".custom_date").slideUp('slow');
			}
			if($(this).val()==3){
			$(".issue_date").slideUp('slow');
			$(".due_date").slideUp('slow');
			$(".custom_date").slideToggle('slow');
			}
		});
    });
} else if (view_name == 'Edit')
{
    $('document').ready(function () {
        $('.frmsubmit').parsley();
		 $('#from-model').parsley();
    });
} else if (view_name == 'view')

{

}

$('document').ready(function () {
	
	//$('input').parsley();
	$('.recurring').click(function(event){
		
		event.preventDefault();
		var isValid = true;
		 $('#rightinvoice input').each( function() {
         if ($(this).parsley().validate() !== true) isValid = false;
		});
		$('#howoften').each( function() {
         if ($(this).parsley().validate() !== true) isValid = false;
		});
	if (isValid) {
		var next_issue_date = $('#datepicker-recuring').val();
		var invoice_id = $('#invoice_idx').val();
		var howoften = $('#howoften').val();
		var howmany = $("input[name=howmany]:checked").val();
		var delivery  = $("input[name=delivery]:checked").val();
		 $.ajax({ 
		 url: recurring_url,
         data: {next_issue_date:next_issue_date,invoice_id:invoice_id,howoften:howoften,howmany:howmany,delivery:delivery},
         type: 'post',
         dataType:'JSON',
         success: function(output) {
                      if(output.status==1){
						  
						  window.location.href=output.url;
						  
						  }
                  }
		});
		}
		
		});
		 
			jQuery('#datepicker').datepicker();
            $('#datepicker-recuring').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            
            $('#datepicker-customrem').datepicker({
                autoclose: true,
                todayHighlight: true
            });
            
            $('#datepicker-due').datepicker({
                autoclose: true,
                todayHighlight: true
            });
	
     $('#paid-datepicker').datepicker({
                autoclose: true,
                todayHighlight: true
            });
		
	$('#invoice_langcurr').click(function(e){
			e.preventDefault();
			var isValid = true;
			 $('.curlang select').each( function() {
			 if ($(this).parsley().validate() !== true) isValid = false;
			});
			if (isValid) {
				var invoice_currency = $('#invoice_currency').val();
				var invoice_language = $('#invoice_language').val();
				var invoice_idcurlang = $('#invoice_idcurlang').val();
				var client_idcurlang = $('#client_idcurlang').val();
				$.ajax({ 
				url: curlan_url,
				data: {invoice_currency:invoice_currency,invoice_language:invoice_language,invoice_idcurlang:invoice_idcurlang,client_idcurlang:client_idcurlang},
				type: 'post',
				dataType:'JSON',
				success: function(output) {
						if(output.status==1){
							//window.location.href=output.url;
						}
					}
				});
			}
		});



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
	
	
	
	if($("#vendor_description").length > 0){
			        tinymce.init({
			            selector: "textarea#vendor_description",
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
	
	
	
	
	
	
});

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
		

$('document').ready(function(){	
//alert();	
$('.filtr-containerx').filterizr();
        $('#VendorForm').parsley();
		
	});
