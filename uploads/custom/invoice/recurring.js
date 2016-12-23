$(document).ready(function () {
			    if($("#cust_description").length > 0){
			        tinymce.init({
			            selector: "textarea#cust_description",
			            theme: "modern",
			            height:300,
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
			    }
			    
			    if($("#issue_description").length > 0){
			        tinymce.init({
			            selector: "textarea#issue_description",
			            theme: "modern",
			            height:300,
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
			    }
			    
			    if($("#due_description").length > 0){
			        tinymce.init({
			            selector: "textarea#due_description",
			            theme: "modern",
			            height:300,
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
			    }
			    
			    //$('.frmsubmit').parsley();
			    $('.issue_recurring').click(function(e){
					e.preventDefault();
					var isValid = true;
					$('.issue_form input').each( function() {
						if ($(this).parsley().validate() !== true) isValid = false;
					});
					if (isValid) {
						var reminder_type=$('.select_reminder').val();
						var days = $('#after_days').val();
						var subject = $("#after_subject").val();
						var invoice_idafter = $("#invoice_idafter").val();
						var issue_description = tinymce.get('issue_description').getContent();
						$.ajax({ 
						url: reminder_url,
						data: {days:days,subject:subject,issue_description:issue_description,reminder_type:reminder_type,invoice_id:invoice_idafter},
						type: 'post',
						dataType:'JSON',
						success: function(output) {
								if(output.status==1){
									//window.location.href=output.url;
									$('.reminder_set').prepend(output.msg);
								}
							}
						});
					}
				});
				
				/*  By Dishit 21/11/2016 */
			    //$('.frmsubmit').parsley();
			    $('.due_recurring').click(function(e){
					e.preventDefault();
					var isValid = true;
					$('.issue_form1 input').each( function() {
						if ($(this).parsley().validate() !== true) isValid = false;
					});
					if (isValid) {
						var reminder_type=$('.select_reminder').val();
						var days = $('#before_days').val();
						var subject = $("#before_subject").val();
						var invoice_idbefore = $("#invoice_idbefore").val();
						var due_description = tinymce.get('due_description').getContent();
						$.ajax({ 
						url: reminder_url,
						data: {days:days,subject:subject,issue_description:due_description,reminder_type:reminder_type,invoice_id:invoice_idbefore},
						type: 'post',
						dataType:'JSON',
						success: function(output) {
								if(output.status==1){
									//window.location.href=output.url;
									$('.reminder_set').prepend(output.msg);
								}
							}
						});
					}
				});
					
					
				$('.cust_recurring').click(function(e){
					e.preventDefault();
					var isValid = true;
					$('.issue_form2 input').each( function() {
						if ($(this).parsley().validate() !== true) isValid = false;
					});
					if (isValid) {
						var reminder_type=$('.select_reminder').val();
						var custom_date = $('#datepicker-customrem').val();
						var subject = $("#custom_subject").val();
						var invoice_idcustome = $("#invoice_idcustome").val();
						var cust_description = tinymce.get('cust_description').getContent();
						$.ajax({ 
						url: reminder_url,
						data: {days:custom_date,subject:subject,issue_description:cust_description,reminder_type:reminder_type,invoice_id:invoice_idcustome},
						type: 'post',
						dataType:'JSON',
						success: function(output) {
								if(output.status==1){
									//window.location.href=output.url;
									$('.reminder_set').prepend(output.msg);
								}
							}
						});
					}
				});
						
			    
			});
