<section id="menu-add">
	<form id="add_menu" method="post">
		Titre menu : <input type="text" name="menu_title" placeholder="Titre menu" />
		Description menu : <input type="text" name="menu_desc" placeholder="Description menu" />
		Lien menu : <input type="text" name="menu_link" placeholder="/vers/menu" />
		Poids menu : <input type="text" name="menu_weight" placeholder="Poids du menu" />
		Catégorie : <select name="menu_cate">
			<option value=""></option>
			<option value=""></option>
		</select>
		<input type="submit" name="add_menu" value="Ajouter" class="btn btn-success text-center" />
	</form>
</section>