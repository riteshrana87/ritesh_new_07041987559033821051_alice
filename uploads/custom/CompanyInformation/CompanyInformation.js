function goBack() {
    window.history.back();
}

if (view_name == 'List')
{
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
} else if (view_name == 'View')
{
    $(document).ready(function () {

    });
}


 $(document).ready(function () {
    jQuery('#datepicker_to').datepicker();
    jQuery('#datepicker_from').datepicker();
	
});

