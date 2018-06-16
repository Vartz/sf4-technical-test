$(document).ready(function() {
	loadComments();

	$("form[name='comment']").on('submit', function(e) {
		e.preventDefault();

		$.post({
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

	$.post({
        url: div.data('load'),
        data: $(this).serialize(),
        success: function(view) {
			div.html(view);   
        }
    });
}