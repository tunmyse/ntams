$(document).ready(function() {
	
function init_ongoing_change() {
$('.ongoing').change(function() {
	
	var val = $(this).val();
	
	if(val == 'No') {
		$(this).parent().next().show();
	} else {
		$(this).parent().next().hide();
	}
	
});
}

$('#id_country').change(function() {
		
	var id_country = $(this).val();
	
	var ajax_url = countries_url + '/' + id_country + '/single';
		
		$.ajax({
		  type: 'POST',
		  url: ajax_url,
		  cache: false,
		  dataType: "html",
		  
		  beforeSend: function(html) {
			$('#states_container').html('Loading states...'); 
		  },
		  		  
	      success: function(html){
			$('#states_container').html(html); 
		  },
		  error: function(html) {
			$('#states_container').html('Error: cannot load data.'); 
		  }
		 
		});
		
	});
	
$('.question_answer').keyup(function() {
	var l = $(this).val().length;
	$(this).parent().find('.limit_answer').html((150 - l));
});

function init_responsibilities() {
$('.responsibilities').keyup(function() {
	var l = $(this).val().length;
	$(this).parent().next().find('.limitation').html((200 - l));
});

$('.responsibilities').each(function() {
	var l = $(this).val().length;
	$(this).parent().next().find('.limitation').html((200 - l));
});

} // End func init_responsibilities

$('#add_new_experience').click(function() {
	var t = $('#experience_template').clone();
	
	$('#experiance_container').append(t);
	
	var i = 0;
	$('.new_ex').each(function() {
		if(i > 0) {
			$(this).find('.new-chosen-select').removeClass('new-chosen-select').chosen();
			$(this).find('.datepick').datepicker();
			$(this).show();
		}
		i++;
	});
	
	//resize_chosen();
	
	return false;
	
});

$('#add_new_education').click(function() {
	
	var t = $('#education_template').clone();
	
	$('#education_container').append(t);
	
	var i = 0;
	$('.new_ed').each(function() {
		if(i > 0) {
			$(this).find('.new-chosen-select').removeClass('new-chosen-select').chosen();
			$(this).find('.datepick').datepicker();
			$(this).show();
		}
		i++;
	});
		
	//resize_chosen();
	
	init_ongoing_change();
	return false;
});

$(".form-wizard").formwizard({ 
			//formPluginEnabled: true,
			validationEnabled: true,
			focusFirstInput : false,
			disableUIStyles:true,
			validationOptions: {
				errorElement:'span',
				errorClass: 'help-block error',
				errorPlacement:function(error, element){
					element.parents('.controls').append(error);
				},
				highlight: function(label) {
					$(label).closest('.control-group').removeClass('error success').addClass('error');
				},
				success: function(label) {
					label.addClass('valid').closest('.control-group').removeClass('error success').addClass('success');
				}
			}
			/*
			,
			formOptions :{
				success: function(data){
					alert("Response: \n\n"+data.status);
				},
				dataType: 'json',
				resetForm: true
			}
			*/
		});

		//resize_chosen();
		init_ongoing_change();
		init_responsibilities();

});