function goBack() {
    window.history.back();
}
 
if (view_name == 'List')
{
	$('document').ready(function(){
		$('#tech-companies-1').dataTable();
		$('.filtr-container').filterizr();
    });
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
  function loadCompletedProject(vurl)
    {
        $.ajax({
            url: vurl,
            type: 'POST',
            dataType: 'HTML',
            success: function (d)
            {

                $('#replacementdiv').html(d);
                //$('#duedate').datepicker();
            }

        });

    }
    function loadActiveProject(vurl)
    {
        $.ajax({
            url: vurl,
            type: 'POST',
            dataType: 'HTML',
            success: function (d)
            {
                $('#replacementdiv').html(d);
              //  $('#duedate').datepicker();

            }

        });

    }


} else if (view_name == 'Add')
{
    var select_date = new Date();

    $('document').ready(function () {
        // Select2
        $(".select2").select2();

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
        $('#ProjectForm').parsley();
        window.ParsleyValidator.addValidator('gteq',
                function (value, requirement) {
                    return Date.parse($('#task_due_date input').val()) >= Date.parse($('#task_start_date input').val());
                }, 32)
                .addMessage('en', 'le', 'This value should be less or equal');
    });
    /*
     * date init for the start date  and end date validation
     */

    //Intialize datepicker
    $('#startdate').datepicker({
        autoclose: true,
        todayHighlight: true,
      //  startDate: select_date,
    }).on('changeDate', function (selected) {
        startDate = new Date(selected.date.valueOf());
        startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
        $('#duedate').datepicker('setStartDate', startDate);
    });
    $('#duedate')
            .datepicker({
                autoclose: true, startDate: new Date(), todayHighlight: true
            });/*.on('changeDate', function(){
             $('#task_start_date').datepicker('setEndDate', new Date($(this).val()));
             });*/
} else if (view_name == 'Edit')
{
    $('document').ready(function () {
        $('#ProjectForm').parsley();
    });
} else if (view_name == 'view')

{

}


