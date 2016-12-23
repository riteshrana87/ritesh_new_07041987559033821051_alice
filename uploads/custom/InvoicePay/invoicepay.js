function goBack() {
    window.history.back();
}

$('document').ready(function () {

/* var t =  $('#inlineRadio2').is(':checked') ;
alert(t); */
	/* $("$('#inlineRadio2').is(':checked')").click(function(event){	
		$('#invoice_installment_amount').slideToggle('slide');
	}); */

 $('input[type="radio"]').click(function(){
    if ($('#inlineRadio2').is(':checked'))
    {
      $('#invoice_installment_amount').slideDown('slide');
	  $("#invoice_installment_amount").attr("required","required");
    }
	else{
		$('#invoice_installment_amount').slideUp('slide');
		$("#invoice_installment_amount").removeAttr("required");
	}
  });	
	
	
	
	
	
	
	/* JQUERY FOR PAYMENT DECK*/
	 $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
	
	
	$('#next').click(function(e){
		//e.preventDefault();
		var totalval = $('#total_amount_to_pay').val();
		var inserted_amount = $('#invoice_installment_amount').val();
		
		if(Number(inserted_amount) >  Number(totalval)){
			e.preventDefault();
			$('#bigger_amount').show('slow');
			return false;
		}
		else{
			return true;
			$('#bigger_amount').hide('slow');
		}
	});
	
	

	
 /*For Stripe*/	
			$('#stripe_submit').click(function(e){
					Stripe.createToken({
					number: $('#stripe_cardnumber').val(),
					cvc: $('#stripe_cvv').val(),
					exp_month: $('#stripe_expity_month').val(),
					exp_year: $('#stripe_expity_year').val()
					}, stripeResponseHandler);

					return false; // submit from callback
 
			});
			});

function checkDecimal(e) {
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
		/* var totalval = $('#total_amount_to_pay').val();
		var inserted_amount = $('#invoice_installment_amount').val();
		
		if(inserted_amount > totalval){
			$('#bigger_amount').show('slow');
			return false;
		}
		else{
			$('#bigger_amount').hide('slow');
			return true;
		} */
    }

	
	function stripeResponseHandler(status, response) {
               // alert('hi');
               //alert(response);return false;
                if (response.error) {
                    // re-enable the submit button
                     //$('#contact_submit_button').prop('disabled', false);
                  //  $('.submit-button').show();
					alert("2" + response.error.message);
                    // show the errors on the form
                    //$("#errorjs").html(response.error.message);
                } else {
					 //$('#contact_submit_button').prop('disabled', true);
                    var form$ = $("#stripeform");
                    // token contains id, last4, and card type
                    var token = response.id;
                 //   alert(token);//return false;
                    // insert the token into the form so it gets submitted to the server
                    form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                    // and submit
                    //alert("1" + response.id);
					form$.get(0).submit();
                }
            }
