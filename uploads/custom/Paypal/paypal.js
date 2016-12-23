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
        $('#PaypalForm').parsley();
    });
} else if (view_name == 'Edit')
{
    $('document').ready(function () {
        $('#PaypalForm').parsley();
    });
} else if (view_name == 'view')

{

}


