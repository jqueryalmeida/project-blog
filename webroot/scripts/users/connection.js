"use strict";

$('#connection-form').on('submit', function(event)
{
	console.log(event);

	event.preventDefault();

	var data = $(this).serialize();

	$.ajax(
		{
			method : "post",
			url : '/members/login',
			data : data
		}
	).complete(function(response)
	{
		var json = JSON.parse(response.responseText);

		if (json.status)
		{
			$('#ajax-message').addClass('success');
			$('#ajax-message').removeClass('hidden failed');
			$('#text-message-ajax').text('Connection Success');
			$('#ajax-message').fadeIn('slow');

			setTimeout(function () {
				window.location = '/';
			}, 1000)
		}
		else
		{
			$('#ajax-message').addClass('failed');
			$('#ajax-message').removeClass('hidden success');
			$('#text-message-ajax').text('Connection Error');
			$('#ajax-message').fadeIn('slow');
		}
	});
});