$(document).ready(function() {

	$('#search_form').on('submit', function(e) {
		e.preventDefault();

		$('#loading').removeClass('hidden');

		$.ajax({
        	url: $(this).attr('action'),
        	data: $(this).serialize(),
        	success: function(view) {
				$('#ajax_content').html(view);   
        	}
    	}).done(function() {
        	$('#loading').addClass('hidden');
        });
	});

});