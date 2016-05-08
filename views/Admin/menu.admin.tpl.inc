<section id="menu-admin" class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel panel-heading text-center">
				Panel administratif
			</div>

			<div class="panel panel-body text-center">
				<ul class="list-unstyled btn-group-vertical" role="group">
					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Menus <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="/admin/structure/menus/add" role="link">Ajouter</a></li>
							<li><a href="/admin/structure/menus/edit" role="link">Modifier</a></li>
						</ul>
					</li>

					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Articles <span
								class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="/admin/content/articles/add">Ajouter</a></li>
							<li><a href="/admin/content/articles/edit" data-src="articles" data-link="edit" data-type="get" data-data="0" ng-click="chooseMenu($event)">Modifier</a></li>
						</ul>
					</li>

					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-block btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Catégories <span
								class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="/admin/structure/categories/add">Ajouter</a></li>
							<li><a href="/admin/structure/categories/edit">Modifier</a></li>
						</ul>
					</li>

					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-block btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Commentaires <span
								class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#" data-src="commentaries" data-link="add">Ajouter</a></li>
							<li><a href="#" data-src="commentaries" data-link="edit">Modifier</a></li>
							<li><a href="#" data-src="commentaries" data-link="delete">Supprimer</a></li>
						</ul>
					</li>

					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-block btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Membres <span
								class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#" data-src="members" data-link="add">Ajouter</a></li>
							<li><a href="#" data-src="members" data-link="edit">Modifier</a></li>
							<li><a href="#" data-src="members" data-link="delete">Supprimer</a></li>
						</ul>
					</li>

					<li class="btn-group">
						<button type="button" role="button" data-toggle="dropdown" class="btn btn-block btn-default dropdown-toggle" aria-haspopup="true" aria-expanded="false">Perso <span
								class="caret"></span></button>
						<ul class="dropdown-menu">
							<li class="dropdown-submenu btn-group">
								Compétences <span class="caret"></span>
								<ul class="" style="">
									<li><a href="/admin/skills/add" class="btn btn-default">Ajouter</a></li>
									<li><a href="/admin/skills/edit" class="btn btn-default">Modifier</a></li>
									<li><a href="/admin/skills/delete" class="btn btn-default">Ajouter</a></li>
								</ul>
							</li>
							<li><a href="#" data-src="personal" data-link="edit">Modifier</a></li>
							<li><a href="#" data-src="personal" data-link="delete">Supprimer</a></li>
						</ul>
					</li>

					<li class="btn-group">
						<button type="button" role="button">
							<a href="/admin/reports">Rapports</a>
						</button>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>