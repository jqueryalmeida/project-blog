<section id="edit-menu">
	<section class="col-xs-12 col-sm-5 col-md-5 col-lg-10 container-fluid" style="margin-left : 20px;">
	<div>
		<?php foreach($data as $index => $value) : $menu = json_decode($value->dataMenu);?>
			<a href="/admin/structure/menus/edit/<?php print $value->idMenu; ?>" class="btn btn-link" role="link"><?php print $menu->title; ?></a>
			[ <a href="/admin/structure/menus/delete/<?php print $value->idMenu; ?>">x</a> ]
		<?php endforeach; ?>
	</div>

	<?php if(isset($categorie)) : $cate = json_decode($categorie->dataMenu); ?>
		<section id="edition-menu" ng-if="menu">
			<form method="post" action="/admin/structure/menus/edit" id="edit_menu">
				Titre : <input type="text" name="name_menu" value="<?php print $cate->title; ?>" />
				Description : <input type="text" name="description_menu" value="<?php print $cate->description; ?>" />
				Lien : <input type="text" name="link_menu" value="<?php print $cate->link; ?>" />
				Poids : <input type="text" name="weight_menu" value="<?php print $cate->weight; ?>" />
				<input type="hidden" name="id_menu" value="<?php print $categorie->idMenu; ?>" />
				<input type="submit" value="Modifier" class="btn btn-warning" />
			</form>
		</section>
	<?php endif; ?>
		</section>
</section>