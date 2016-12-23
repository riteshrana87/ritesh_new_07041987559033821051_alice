$(".mail_details_caret").click(function(){
        $('.mail_details').slideToggle('slow');
		//alert();
});
//$('#datatable').dataTable();
                
var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );

var table2 = $('#datatable').DataTable();
     
    $('#datatable tbody').on('click', 'tr', function () {
        var data = table2.row( this ).data();
        var name = $('td', this).eq(1).text();
		var modal_id = data[0];
        $('#myModal_'+modal_id).modal("show");
    } );
	