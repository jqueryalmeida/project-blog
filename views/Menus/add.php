<section id="menu-add" ng-controller="MenuAdd">
	<form id="add_menu" method="post" action="#">
		Titre menu : <input type="text" name="menu_title" ng-model="menu.title" placeholder="Titre menu" />
		Description menu : <input type="text" name="menu_desc" ng-model="menu.desc" placeholder="Description menu" />
		Lien menu : <input type="text" name="menu_link" ng-model="menu.link" placeholder="/vers/menu" />
		Poids menu : <input type="text" name="menu_weight" ng-model="menu.weight" placeholder="Poids du menu" />
		Catégorie : <select name="menu_cate" ng-model="menu.cate">
			<option value=""></option>
			<option value="{{category.id_category}}" ng-repeat="category in categories">{{category.name_category}}</option>
		</select>
		<input type="submit" name="add_menu" value="Ajouter" class="btn btn-success text-center" />
	</form>
</section>