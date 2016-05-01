"use strict";

var app = angular.module('App', []);

app.controller('AdminController', ['$scope', '$http', function (scope, http) {
	scope.chooseMenu = function (event) {

		var src = event.currentTarget.dataset.src;
		var link = event.currentTarget.dataset.link;
		var type = event.currentTarget.dataset.type;
		var data = event.currentTarget.dataset.data;

		http(
				{
					method: 'get',
					url: '/' + src + '/' + link
				}
		).then(function (response) {
			scope.file = response.data.file;

			switch (src) {
				case 'categories' :
					console.log('partie cate');
					scope.categories = response.data.categories;
					break;
				case 'articles' :
					break;
				case 'menus' :
					console.log('menus admin controller');
					scope.menus = response.data.menus;
					break;
			}
		});

		$(document).on('ajaxComplete', function(event)
		{
			console.log('ajax complete');

			http(
					{
						method: type,
						url: '/' + src + '/' + link
					}
			).then(function (response) {
				scope.file = response.data.file;

				switch (src) {
					case 'categories' :
						console.log('partie cate');
						scope.categories = response.data.categories;
						break;
					case 'articles' :
						break;
					case 'menus' :
						console.log('partie menus');
						scope.menus = response.data.menus;
						break;
				}
			});
		});
	};
}]);