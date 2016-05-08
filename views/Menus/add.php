<section id="menu-add">
	<section class="col-xs-12 col-sm-5 col-md-5 col-lg-10 container-fluid" style="margin-left : 20px;">
	<form id="add_menu" method="post" action="/admin/structure/menus/add">
		<div class="form-horizontal">
			<label for="title">Titre menu : </label>
			<input id="title" type="text" name="menu_title" ng-model="menu.title" placeholder="Titre menu" />
		</div>
		<div class="form-horizontal">
			<label for="description">Description menu : </label>
			<input id="description" type="text" name="menu_desc" ng-model="menu.desc" placeholder="Description menu" />
		</div>
		<div class="form-horizontal">
			<label for="link">Lien menu : </label>
			<input id="link" type="text" name="menu_link" ng-model="menu.link" placeholder="/vers/menu" />
		</div>
		<div class="form-horizontal">
			<label for="weight">Poids menu : </label>
			<input id="weight" type="text" name="menu_weight" ng-model="menu.weight" placeholder="Poids du menu" />
		</div>
		<div class="form-horizontal">
			<input type="submit" name="add_menu" value="Ajouter" class="btn btn-success text-center" />
		</div>
	</form>
		</section>
</section>