var intervalTime = 17 * 60 * 60 * 1000;
function crown_recurring() {
	
	$.ajax({ 
			url: reminder_url,
			
			type: 'post',
			
			success: function(output) {
						alert('your 17 hours completed');
						}
				});
	
	}
	setInterval(crown_recurring, intervalTime);
