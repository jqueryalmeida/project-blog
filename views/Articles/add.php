<script src="/include/scripts/articles/add.js"></script>
<section id="article-add">
	<h3>Ajouter un article</h3>

	<form id="add_article" method="post" action="#" ng-controller="AdminArticle">
		Titre : <input type="text" name="article_title" placeholder="Titre de l'article" />
		Description : <input type="text" name="desc_article" placeholder="Description de l'article" />
		Catégorie : <select name="cate_article">
			<option value=""></option>
			<option value="{{category.id_category}}" ng-repeat="category in categories">{{category.name_category}}</option>
		</select>

		Texte : <textarea rows="15" cols="75" name="text_article"></textarea>

		<input type="submit" name="post_article" value="Poster" />
	</form>
</section>
