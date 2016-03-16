"use strict";


$(document).ready(function()
{
	console.log("jQuery categories");

	$('#add_categorie').on('submit', function(event)
	{
		event.preventDefault();

		console.log(event);

		var data = $(this).serialize();

		$.ajax(
			{
				method : 'post',
				url : '/categories/add',
				data : data
			}
		).complete(function(response)
		{
			console.log(response);
		});
	});
});

