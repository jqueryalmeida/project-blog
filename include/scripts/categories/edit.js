"use strict";

var app = angular.module('App');

app.controller('EditCate', ['$scope', '$http', function(scope, http)
{
	console.log('controller edit cate');

	scope.edit = function(event, elem)
	{
		console.log(event, elem);

		event.preventDefault();
		scope.clicked = true;
		scope.category = {};

		http
		(
			{
				method : 'get',
				url : '/categories/edit/'+elem
			}
		).then(function(response)
		{
			console.log(response.data);

			scope.category = response.data.category;
		});
	};

	scope.delete = function(event, elem)
	{
		console.log(event, elem);

		event.preventDefault();

		http
		(
			{
				method : 'get',
				url : '/categories/delete/'+elem
			}
		).then(function(response)
		{
			console.log(response);
		});
	};

	scope.submit = function(event)
	{
		console.log(event);

		var data = scope.category;

		console.log(data);

		http
		(
			{
				method : 'post',
				url : '/categories/edit/1',
				data : data
			}
		).then(function(response)
		{
			console.log(response);

			if(response.data.status)
			{
				http
				(
					{
						method : 'get',
						url : '/categories/edit'
					}
				).then(function(response)
				{
					console.log(response.data);
					scope.categories = response.data.categories;
				});
			}
		});
	};
}]);