"use strict";

var app = angular.module('App');

app.controller('MenuAdd', ['$scope', '$http', function(scope, http)
{
	var form = angular.element('#add_menu');

	http
	(
		{
			method : 'get',
			url : '/menus/add'
		}
	).then(function(response)
	{
		console.log(response.data);

		scope.categories = response.data.categories;
	});

	form.submit(function(event)
	{
		console.log(event);
		var data = scope.menu;

		event.preventDefault();

		http
		(
			{
				method : 'post',
				url : '/menus/add/1',
				data : data
			}
		).then(function(response)
		{
			console.log(response.data);
		});
	});

}]);