"use strict";

$(document).ready(function()
{
	console.log('test de jQuery');

	$('#add_article').on('submit', function(event)
	{
		event.preventDefault();

		console.log('send');

		var data = $(this).serialize();

		$.ajax
		(
				{
					method : 'post',
					url : '/articles/add',
					data :data
				}
		).complete(function(response)
		{
			console.log(response);
		});
	});
});