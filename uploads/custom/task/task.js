function goBack() {
    window.history.back();
}

if (view_name == 'List')
{
    $('document').ready(function () {
        $('#duedate').datepicker({autoclose: true});
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
    function loadCompletedTasks(vurl)
    {
        $.ajax({
            url: vurl,
            type: 'POST',
            dataType: 'HTML',
            success: function (d)
            {

                $('#replacementdiv').html(d);
                $('#duedate').datepicker();
            }

        });

    }
    function loadActiveTasks(vurl)
    {
        $.ajax({
            url: vurl,
            type: 'POST',
            dataType: 'HTML',
            success: function (d)
            {
                $('#replacementdiv').html(d);
                $('#duedate').datepicker();

            }

        });

    }
    function changeTaskStatus(vurl)
    {
		
        $.ajax({
            url: vurl,
            type: 'POST',
            dataType: 'JSON',
            success: function (d)
            {
                if (d.status == 1)
                {
                    swal({
					title: "Good Job",
					//text: "You will not be able to recover this imaginary file!",
					type: "success",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ok",
					closeOnConfirm: true
				},
						function () {
							window.location.reload();
		//  swal("Deleted!", "Your imaginary file has been deleted.", "success");
						});
							
                }
            }

        });

    }

    var isPaused = false;
    var date = new Date;
//  /  date.setTime(result_from_Date_getTime);

    var seconds = date.getSeconds();
    var minutes = date.getMinutes();
    var hour = date.getHours();

    var year = date.getFullYear();
    var month = date.getMonth(); // beware: January = 0; February = 1, etc.
    var day = date.getDate();

    var dayOfWeek = date.getDay(); // Sunday = 0, Monday = 1, etc.
    var milliSeconds = date.getMilliseconds();
    var StartDate = new Date(year, month, day, hour, minutes, seconds) // second parameter is  month and it is from  from 0-11

    if (typeof is_start_date !== 'undefined')
    {
        StartDate = is_start_date;
    } else if (typeof is_pause_date !== 'undefined')
    {
        StartDate = is_pause_date;
        isPaused = true;
    }
    $('#spanStartDate').text(StartDate);
    var Sec = 0,
            Min = 0,
            Hour = 0,
            Days = 0;
    var CurrentDate = new Date()
    var Diff = CurrentDate - StartDate;
    Diff = Diff / 1000
    if (Diff > 0) {
        Days = Math.ceil(Diff / (60 * 60 * 24));
        Hour = Math.floor(Diff % (24) / 60);
        Min = Math.floor(Diff % (24 * 60) / 60);
        Sec = Math.floor(Diff % (24 * 60 * 60) / 60);
        console.log(Sec)
    }
    var counter = setInterval(function () {
        if (isPaused)
            return;
        if (Sec == 0)
            ++Sec;
        else
            Sec++
        if (Sec == 59) {
            ++Min;
            Sec = 0;
        }
        if (Min == 59) {
            ++Hour;
            Min = 0;
        }
        if (Hour == 24) {
            ++Days;
            Hour = 0;
        }


        $('#timer').text(pad(Days) + " : " + pad(Hour) + " : " + pad(Min) + " : " + pad(Sec));

    }, 1000);

    function pad(number) {
        if (number <= 9) {
            number = ("0" + number).slice(-4);
        }
        return number;
    }


//with jquery
    $('.pause').on('click', function (e) {
        e.preventDefault();
        isPaused = true;
    });

    $('.play').on('click', function (e) {
        e.preventDefault();
        isPaused = false;
    });

    function startTimer(vurl)
    {
        $.ajax({
            url: vurl,
            type: 'POST',
            dataType: 'JSON',
            data: {'timer_startdate': StartDate},
            success: function (d)
            {
                if (d.status == 1)
                {
                    $('.starttimerdiv').hide();
                    $('.pausetimerdiv').removeClass('hidden');
                    swal("Good job!", d.message, "success");
                }
            }});
    }
    function pauseTimer(vurl)
    {
        $.ajax({
            url: vurl,
            type: 'POST',
            dataType: 'JSON',
            data: {'timer_pausedate': CurrentDate, 'duration': pad(Days) + " : " + pad(Hour) + " : " + pad(Min) + " : " + pad(Sec)},
            success: function (d)
            {
                if (d.status == 1)
                {
                    $('.starttimerdiv').show();
                    $('.pausetimerdiv').addClass('hidden');
                    swal("Good job!", d.message, "success");
                }
            }});
    }
    function addFilter()
    {
        var vurl = $('#form-search').attr('action');
        var datafields = $('#form-search').serialize();
		var member_select_value = $('#members').val();
		var status_select_value = $('#status').val();
        $.ajax({
            url: vurl,
            type: 'POST',
            dataType: 'HTML',
            data: datafields,
            success: function (d)
            {
                $('#replacementdiv').html(d);
                $('#duedate').datepicker({autoclose: true});
				$('#members').val(member_select_value);
				$('#status').val(status_select_value);

                return false;
//                $('#elm_'+$e.val()).attr('selected','selected');
            }

        });

    }

} else if (view_name == 'Add')
{
	 $('document').ready(function () {
        $('#TaskForm').parsley();
    });
    var select_date = new Date();

    $('document').ready(function () {
        // Select2
        $(".select2").select2();

        $('#ProjectForm').parsley();
        $('#TaskForm').parsley();
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
        $('#TaskForm').parsley();
    });
} else if (view_name == 'view')

{
 $('document').ready(function () {
        $('#TaskForm').parsley();
    });
}


