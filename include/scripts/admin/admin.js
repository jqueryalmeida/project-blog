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
		console.log(response.data);

		scope.categories = response.data;
	});

	rootScope.chooseMenu = function(event)
	{
		console.log(event);

		var src = event.currentTarget.dataset.src;
		var link = event.currentTarget.dataset.link;
		var type = event.currentTarget.dataset.type;
		var data = event.currentTarget.dataset.data;

		console.log(src, link);

		http(
			{
				method : type,
				url : '/'+src+'/'+link+'/'+data,
				data : data
			}
		).then(function(response)
		{
			scope.file = response.data.file;
		});
	};

}]).directive('menuDirective', function(scope, item)
{
	return {
		scope : {},
		link : function()  {
			console.log(scope, item);
		}
	};
});

app.controller('AdminController', ['$scope', function(scope)
{
	console.log('adminpanel controller');
}]);