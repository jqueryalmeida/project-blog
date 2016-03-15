<section id="categories-add">
	<h3>Ajouter une categorie</h3>

	<form id="add_categorie" action="#">
		Titre categorie : <input type="text" name="cate_title" placeholder="Titre catégorie" />
		Poids de la catégorie : <input type="text" name="cate_weight" placeholder="Poids de la catégorie" />
		Parent : <select name="cate_parent">
			<option value=""></option>
			<option value="{{category.id_category}}" ng-repeat="category in categories">{{category.name_category}}</option>
		</select>
		<input type="submit" name="send_cate" value="Ajouter"  class="btn btn-success" />
	</form>
</section>

<script type="text/javascript" src="/include/scripts/categories/add.js"></script>