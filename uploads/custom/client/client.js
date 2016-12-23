
function goBack() {
    window.history.back();
}


$('#tech-companies-1').dataTable();
	if (view_name == 'List')
{
	$(document).ready(function () {
		
        $("#invoice_currency").select2();
        $(".select2").select2();
	});
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
    $('#tech-companies-1').dataTable();

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
} else if (view_name == 'gridview')
{
	$('.filtr-container').filterizr();
}
else if (view_name == 'View')
{
	alert('2');
	
   $('#tech-companies-1').dataTable();
$('.filtr-container').filterizr();
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
                        url: urls,
                        type: 'GET',
                        dataType: 'JSON',
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

function view(client_id){
	window.location = view_url + client_id;
}

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
$('document').ready(function () {
	//alert('1');
       /*  $("#invoice_currency").select2();
        $("#invoice_language").select2(); */
		$('#tech-companies-1').dataTable();
	$('#client_langcurr').click(function(e){
			e.preventDefault();
			var isValid = true;
			 $('.curlang select').each( function() {
			 if ($(this).parsley().validate() !== true) isValid = false;
			});
			if (isValid) {
				var invoice_currency = $('#invoice_currency').val();
				var invoice_language = $('#invoice_language').val();
				var client_idcurlang = $('#ddd').html();
				$('#client_langcurr').addClass("btn-trans");
				$('#client_langcurr').attr("disabled",true);
				
				$.ajax({ 
				url: curlan_url,
				data: {invoice_currency:invoice_currency,invoice_language:invoice_language,client_idcurlang:client_idcurlang},
				type: 'post',
				dataType:'JSON',
				success: function(output) {
						if(output.status==true){
							//window.location.href=output.url;
							$('.curlang').prepend(output.res);
							$('#client_langcurr').removeClass("btn-trans");
							$('#client_langcurr').attr("disabled",false);
						}
					},
				error: function(output) {
							//window.location.href=output.url;
							$('.curlang').prepend('<div style="color:red"> Error Occured. </div>');
							$('#client_langcurr').removeClass("btn-trans");
							$('#client_langcurr').attr("disabled",false);
					}
				});
			}
		});
});

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
                        url: urls,
                        type: 'GET',
                        dataType: 'JSON',
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
