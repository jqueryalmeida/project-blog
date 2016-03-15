Edit categories
<section id="edit-categories" ng-controller="AdminEditCate">
	<span class="btn btn-link" role="button" data-object="{{category.id_category}}" ng-repeat="category in categories">{{category.name_category}} [ <a ng-href="/categories/delete/{{category.id_category}}" role="button" rel="nofollow" ng-click="delete($event, category.id_category)"> x </a> ]</span>
</section>s