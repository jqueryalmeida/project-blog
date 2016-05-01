"use strict";

var app = angular.module('App');

app.controller('EditMenu', ['$scope', '$http', function(scope, http)
{
	scope.edit = function(event, elem)
	{
		scope.menu = true;

		http
		(
			{
				method : 'get',
				url : '/menus/edit/'+elem
			}
		).then(function(response)
		{
			console.log(response.data);

			scope.menu = response.data.menu;

			var ytest = angular.element('#edit_menu');

			console.log(ytest);

			ytest.submit(function(event)
			{
				console.log(event);

				var data = scope.menu;

				event.preventDefault();

				http
				(
					{
						method : 'post',
						url : '/menus/edit/1',
						data : data
					}
				).then(function(response)
				{
					console.log(response.data);

					if(response.data.update)
					{
						http
						(
							{
								method : 'get',
								url : '/menus/edit/'
							}
						).then(function(response)
						{
							console.log(response.data);

							scope.menus = response.data.menus;
						});
					}
				});
			});
		});
	};

	scope.delete = function(event, elem)
	{
		event.preventDefault();

		http
		(
			{
				method : 'get',
				url : '/menus/delete/'+elem
			}
		).then(function(response)
		{
			console.log(response.data);
			scope.menu = response.data.menu;
		});
	};
}]);