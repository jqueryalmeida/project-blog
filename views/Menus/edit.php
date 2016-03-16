Modifier un menu
<section id="edit-menu" ng-controller="EditMenu">
	<div ng-repeat="menu in menus">
		<span class="btn btn-link" role="link" rel="nofollow" ng-click="edit($event, menu.id_menu)">{{menu.name_menu}}</span>
		[ <a ng-href="/menus/delete/{{menu.id_menu}}" rel="nofollow" role="button" ng-click="delete($event, menu.id_menu)">x</a> ]
	</div>

	<section id="edition-menu" ng-if="menu">
		<form method="post" action="#" id="edit_menu">
			Titre : <input type="text" ng-model="menu.name_menu" placeholder="Titre menu" />
			Description : <input type="text" ng-model="menu.description_menu" placeholder="Description" />
			Lien : <input type="text" ng-model="menu.link_menu" placeholder="/lien/vers" />
			Poids : <input type="text" ng-model="menu.weight_menu" placeholder="Poids" />
			<input type="hidden" ng-model="menu.id_menu" />
			<input type="submit" value="Modifier" class="btn btn-warning" />
		</form>
	</section>
</section>