"use strict";

var app = angular.module('App', []);

/*
app.controller('AdminMenu', ['$scope', '$rootScope', '$http', function (scope, rootScope, http) {
	http(
		{
			method: 'get',
			url: '/admin/getCategories'
		}
	).then(function (response) {
		response.data.forEach(function (obj, key) {
			response.data[key].value_attr = angular.fromJson(response.data[key].value_attr);
		});

		scope.menus = response.data;

	});
}]);
*/

app.controller('AdminController', ['$scope', '$http', function (scope, http) {
	scope.chooseMenu = function (event) {
		console.log(event);

		var src = event.currentTarget.dataset.src;
		var link = event.currentTarget.dataset.link;
		var type = event.currentTarget.dataset.type;
		var data = event.currentTarget.dataset.data;

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
						break;
				}
			});
		});
	};
}]);
