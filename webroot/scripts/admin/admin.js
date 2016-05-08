"use strict";

$('#skill-form').on('submit', function (event) {
	event.preventDefault();

	var form = $(this);
	var data = $(this).serialize();

	$.ajax(
		{
			method : 'post',
			url : '/admin/skills/add',
			data : data
		}
	).complete(function(response)
	{
		var json = JSON.parse(response.responseText);

		if(json.status)
		{
			$.fn.setMessage('Ajouté avec succés', 'success', 'hidden failed', 'slow');

			setTimeout(function()
			{
				form[0].reset();
			}, 100);
		}
		else
		{
			$.fn.setMessage('Erreur lors de l\'ajout !', 'failed', 'hidden success', 'slow');
		}
	});
});

$('#edit-skill').on('submit', function(event)
{
	event.preventDefault();

	var form = $(this);
	var data = $(this).serialize();

	$.ajax(
		{
			method : 'post',
			url : '/admin/skills/edit',
			data : data
		}
	).complete(function(response)
	{
		var json = JSON.parse(response.responseText);

		if(json.status)
		{
			$.fn.setMessage('Mise à jour avec succés. Redirection dans 2 secondes', 'success', 'hidden failed', 'slow');

			setTimeout(function()
			{
				window.location = '/admin/skills/edit';
			}, 2000);
		}
		else
		{
			$.fn.setMessage('Erreur mise à jour', 'failed', 'hidden success', 'slow');
		}
	});
});