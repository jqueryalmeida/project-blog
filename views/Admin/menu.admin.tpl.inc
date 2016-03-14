<section id="admin" class="col-xs-3 col-sm-3 col-md-3 col-lg-1" ng-controller="AdminMenu">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel panel-heading text-center">
				Panel administratif
			</div>

			<div class="panel panel-body text-center">
				<ul class="list-unstyled btn-group-vertical" role="group">
					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Articles <span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a href="#" data-src="articles" data-link="add" data-type="post" data-data="0" ng-click="chooseMenu($event)">Ajouter</a></li>
							<li><a href="#" data-src="articles" data-link="edit" data-type="get" data-data="0" ng-click="chooseMenu($event)">Modifier</a></li>
						</ul>
					</li>
					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-block btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Catégories <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#" data-src="categories" data-link="add" data-data="0" ng-click="chooseMenu($event)">Ajouter</a></li>
							<li><a href="#" data-src="categories" data-link="edit" data-data="0" ng-click="chooseMenu($event)">Modifier</a></li>
						</ul>
					</li>
					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-block btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Commentaires <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#" data-src="commentaries" data-link="add">Ajouter</a></li>
							<li><a href="#" data-src="commentaries" data-link="edit">Modifier</a></li>
							<li><a href="#" data-src="commentaries" data-link="delete">Supprimer</a></li>
						</ul>
					</li>
					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-block btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Membres <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#" data-src="members" data-link="add">Ajouter</a></li>
							<li><a href="#" data-src="members" data-link="edit">Modifier</a></li>
							<li><a href="#" data-src="members" data-link="delete">Supprimer</a></li>
						</ul>
					</li>
					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-block btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Perso <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#" data-src="personal" data-link="add">Ajouter</a></li>
							<li><a href="#" data-src="personal" data-link="edit">Modifier</a></li>
							<li><a href="#" data-src="personal" data-link="delete">Supprimer</a></li>
						</ul>
					</li>

					<!--
					<li class="edit-admin-buttons btn-group {{menu.value_attr.class}}" ng-repeat="menu in menus">
						{{menu.name_object}}
					</li>
					-->
				</ul>
			</div>
		</div>
	</div>
</section>

<?php
/*
var_dump($admin);

foreach($admin as $index => $categorie) : ?>
	<li>
		<span <?php print $categorie->value_attr; ?>><?php print $categorie->name_object; ?></span>
	</li>
<?php endforeach;
*/
?>