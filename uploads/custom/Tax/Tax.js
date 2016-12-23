$('#TaxForm').parsley();
$('document').ready(function () {
	$('#tech-companies-1').dataTable();
	
	$('.filtr-container').filterizr();
	
	
});
function goBack() {
    window.history.back();
}

if (view_name == 'List')
{
	//$('.filtr-container').filterizr();
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
      
    });
} else if (view_name == 'Edit')
{
   
} else if (view_name == 'view')
{
$('.filtr-container').filterizr();
}


$('#tech-companies-1').dataTable();

 function view(id){
			 window.location.assign(view_url + '/' +id);
		}
		
