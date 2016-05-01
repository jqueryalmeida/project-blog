<section id="edit-articles-container">
	<div id="edit-articles-list">
		<?php foreach ($articles as $index => $value) : ?>
			<a href="/admin/content/articles/edit/<?php print $value->id_article; ?>"><?php print $value->title_article; ?></a> [ <a href="/admin/content/articles/delete/<?php print $value->id_article; ?>">x</a> ]
		<?php endforeach; ?>
	</div>

	<?php if(isset($selected)) : ?>
		<form method="post" action="/admin/content/articles/edit">
			<div class="form-horizontal">
				<label for="title">Titre article : </label>
				<input id="title" type="text" name="title" placeholder="Titre de l'article" value="<?php print $selected->title_article; ?>" />
			</div>
			<div class="form-horizontal">
				<label for="descrioption">Description de l'article : </label>
				<input id="descrioption" type="text" name="description" placeholder="Description de l'article" value="<?php print $selected->description_article; ?>"/>
			</div>
			<div class="form-horizontal">
				<label for="category">Catégorie de l'article : </label>
				<select id="category" name="category">
					<option value="<?php print $selected->idCategory; ?>"><?php print json_decode($selected->dataCategory)->title; ?></option>
					<?php foreach ($this->getCategories() as $index => $value): var_dump($value); $cate = json_decode($value->dataCategory); ?>
						<option value="<?php print $value->idCategory; ?>"><?php print $cate->title; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-horizontal">
				<label for="text">Texte article </label>
				<textarea id="text" name="text" cols="10" rows="20"><?php print str_replace('<br />', '', nl2br($selected->text_article)); ?></textarea>
			</div>
			<div class="form-horizontal">
				<input type="hidden" name="id" value="<?php print $selected->id_article; ?>" />
				<input type="submit" name="send" value="Modifier" class="btn btn-primary" />
			</div>
		</form>
	<?php endif; ?>
</section>