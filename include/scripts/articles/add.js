"use strict";
/*
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
*/

var app = angular.module('App');

app.controller('ArticleAdd', ['$scope', '$http', function(scope, http)
{
	console.log('contropller article add');
	var form = angular.element('#add_article');

	http
	(
		{
			method : 'get',
			url : '/articles/add'
		}
	).then(function(response)
	{
		console.log(response.data);

		scope.categories = response.data.categories;
	});

	form.submit(function(event)
	{
		console.log(event);
		var data = scope.article;

		console.log(data);

		event.preventDefault();

		http
		(
			{
				method : 'post',
				url : '/articles/add/1',
				data : data
			}
		).then(function(response)
		{
			console.log(response);
		});
	});
}]);