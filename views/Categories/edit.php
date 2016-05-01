<section id="edit-categories">
	<div>
		<?php foreach ($edit as $index => $value) : $cate = json_decode($value->dataCategory); ?>
			<a href="/admin/structure/categories/edit/<?php print $value->idCategory; ?>" class="btn-link"><?php print $cate->title; ?></a>
			[ <a href="/admin/structure/categories/delete/<?php print $value->idCategory; ?>"> x </a> ]
		<?php endforeach; ?>
	</div>

	<?php if(isset($selected)) : $cate = json_decode($value->dataCategory); ?>
	<section id="selected-category" ng-if="clicked">
		<form action="/admin/structure/categories/edit" method="post" id="selected_edit">
			<div class="form-horizontal">
				<label for="title">Titre : </label>
				<input id="title" type="text" name="name" value="<?php print $cate->title; ?>" />
			</div>
			<div class="form-horizontal">
				<label for="weight">Poids : </label>
				<input id="weight" type="text" name="weight" value="<?php print $cate->weight; ?>" />
			</div>
			<div class="form-horizontal">
				<input type="hidden" name="id" value="<?php print $selected->idCategory; ?>"/>
				<input type="submit" name="edit" value="Modifier" class="btn btn-warning" />
			</div>
		</form>
	</section>

	<?php endif; ?>
</section>