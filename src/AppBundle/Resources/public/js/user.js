$(document).ready(function() {
	loadComments();

	$('#new_comment').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
        	url: $(this).attr('action'),
        	data: $(this).serialize(),
        	success: function(response) {
  
        	}
    	}).done(function() {
        	loadComments();
        });
	});

});

function loadComments() {
	var div = $('#comments');

	$.ajax({
        url: div.data('load'),
        data: $(this).serialize(),
        success: function(view) {
			div.html(view);   
        }
    });
}