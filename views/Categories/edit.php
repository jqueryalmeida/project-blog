Edit categories
<section id="edit-categories" ng-controller="EditCate">
	<div ng-repeat="category in categories">
		<span class="btn-link" ng-click="edit($event, category.id_category)"> {{category.name_category}} </span>
		[ <a ng-href="/categories/delete/{{category.id_category}}" role="button" rel="nofollow" ng-click="delete($event, category.id_category)"> x </a> ]
	</div>

	<section id="selected-category" ng-if="clicked">
		<form method="post" id="selected_edit">
			Titre : <input type="text" name="name" ng-model="category.name_category" />
			Poids : <input type="text" name="weight" ng-model="category.weight_category" />
			<input type="hidden" name="id" ng-model="category.id_category"/>
			<button role="button" type="submit" name="edit" value="Modifier" class="btn btn-warning" ng-click="submit($event)">Modifier</button>
		</form>
	</section>
</section>