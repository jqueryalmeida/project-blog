"use strict";

var app = angular.module('App', []);

app.controller('AdminMenu', ['$scope', '$rootScope', '$http', function(scope, rootScope, http)
{
	http(
		{
			method : 'get',
			url : '/admin/getCategories'
		}
	).then(function(response)
	{
		response.data.forEach(function(obj, key)
		{
			response.data[key].value_attr = angular.fromJson(response.data[key].value_attr);
		});

		scope.menus = response.data;

	});
}]);

app.controller('AdminController', ['$scope', '$http', function(scope, http)
{
	scope.chooseMenu = function(event)
	{
		console.log(event);

		var src = event.currentTarget.dataset.src;
		var link = event.currentTarget.dataset.link;
		var type = event.currentTarget.dataset.type;
		var data = event.currentTarget.dataset.data;

		if(type == 'post')
		{
			http(
					{
						method : type,
						url : '/'+src+'/'+link+'/'+data,
						data : data
					}
			).then(function(response)
			{
				scope.file = response.data.file;
				scope.categories = response.data.categories;
			});
		} else
		{
			http(
					{
						method : type,
						url : '/'+src+'/'+link
					}
			).then(function(response)
			{
				scope.file = response.data.file;
			});
		}
	};
}]);

app.controller('AdminArticle', ['$scope', '$http', function(scope, http)
{
	console.log('admin article controller');
}]);