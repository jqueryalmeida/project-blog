<section id="article-add">
	<h3>Ajouter un article</h3>

	<form id="add_article" method="post" action="/admin/content/articles/add">
		<div class="form-horizontal">
			<label for="title">Titre de l'article : </label>
			<input id="title" type="text" name="title_article" placeholder="Titre de l'article" />
		</div>
		<div class="form-horizontal">
			<label for="description">Description : </label>
			<input id="description" type="text" name="desc_article" placeholder="Description de l'article" />
		</div>
		<div class="form-horizontal">
			<label for="category"> Catégorie : </label>
			<select id="category" name="cate_article">
				<option value=""></option>
				<?php foreach ($categories as $index => $value) : $cate = json_decode($value->dataCategory); ?>
					<option value="<?php print $value->idCategory; ?>"><?php print $cate->title; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-horizontal">
			<label for="text">Texte : </label>
			<textarea rows="15" cols="75" name="text_article"></textarea>
		</div>
		<div class="form-horizontal">
			<input type="hidden" name="author_article" value="<?php print $this->getSession('id_user'); ?>" />
			<input type="submit" name="post_article" value="Poster" />
		</div>
	</form>
</section>