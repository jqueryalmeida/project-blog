"use strict";

var app = angular.module('App', []);

app.controller('AdminController', ['$scope', '$rootScope', '$http', function(scope, rootScope, http)
{
	var menus = angular.element('a[data-src]');

	console.log(menus);

	angular.forEach(menus, function(obj, item)
	{
			obj.setAttribute('ng-click', 'chooseMenu($event)');
	});

	scope.chooseMenu = function(event)
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


}]);