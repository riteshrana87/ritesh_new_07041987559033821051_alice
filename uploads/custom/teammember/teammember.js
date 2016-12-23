function goBack() {
    window.history.back();
}

if (view_name == 'List')
{
	$('#tech-companies-1').dataTable();
    function promptAlert(urls)
    {
        swal({
            title: delete_msg,
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
       
       $('#UserForm').parsley();
    });
    /*
     window.ParsleyValidator
        .addValidator('filemaxmegabytes', {
            requirementType: 'string',
            validateString: function (value, requirement, parsleyInstance) {

                if (!app.utils.formDataSuppoerted) {
                    return true;
                }

                var file = parsleyInstance.$element[0].files;
                var maxBytes = requirement * 1048576;

                if (file.length == 0) {
                    return true;
                }

                return file.length === 1 && file[0].size <= maxBytes;

            },
            messages: {
                en: 'File is to big'
            }
        });
         window.ParsleyValidator.addValidator('filemimetypes', {
            requirementType: 'string',
            validateString: function (value, requirement, parsleyInstance) {

                if (!app.utils.formDataSuppoerted) {
                    return true;
                }

                var file = parsleyInstance.$element[0].files;

                if (file.length == 0) {
                    return true;
                }

                var allowedMimeTypes = requirement.replace(/\s/g, "").split(',');
                return allowedMimeTypes.indexOf(file[0].type) !== -1;

            },
            messages: {
                en: 'File mime type not allowed'
            }
        });*/
} else if (view_name == 'Edit')
{
    $('document').ready(function () {
        $('#UserForm').parsley();
    });
} else if (view_name == 'view')
{

}


 function view(id){
	window.location.assign(view_url + '/' +id);
}