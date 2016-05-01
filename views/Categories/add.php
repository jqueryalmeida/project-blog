<section id="categories-add">
	<h3>Ajouter une categorie</h3>

	<form id="add_categorie" method="post" action="/admin/structure/categories/add">
		<div class="form-horizontal">
			<label for="title">Titre categorie : </label>
			<input type="text" name="cate_title" placeholder="Titre catégorie" />
		</div>
		<div class="form-horizontal">
			<label for="weight">Poids de la catégorie : </label>
			<input type="text" name="cate_weight" placeholder="Poids de la catégorie" />
		</div>
		<div class="form-horizontal">
			<label for="parent">Parent : </label>
			<select id="parent" name="cate_parent">
				<option value=""></option>
				<?php foreach ($categories as $index => $value) : $parent = json_decode($value->dataCategory); ?>
					<option value="<?php print $value->idCategory; ?>"><?php print $parent->title; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-horizontal">
			<input type="submit" name="send_cate" value="Ajouter"  class="btn btn-success" />
		</div>
	</form>
</section>