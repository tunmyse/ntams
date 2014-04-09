$(document).ready(function() {
	
	$('.change_task_status').click(function() {
		
		status = $(this).attr('data-status');
		id_task = $(this).attr('data-id_task');
		
		$('#change_task_status_dialog').modal();
		
		return false;
	});
	
	$('#change_task_status_button').click(function() {
		
		$('#change_task_status_dialog').modal('hide');
		
		location.href = BASE_URL + 'tasks/change_status/'+id_task+'/'+status+'/dashboard';
	});
});