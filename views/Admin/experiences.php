<section id="experiences-container" class="container-fluid bordered">
	<?php if (isset($case)) :
		switch ($case) :
			case 'add' : ?>
				<h3>Ajouter une expériences professionnelle</h3>

				<form id="add-experience-form" method="post" action="/admin/experiences/add">
					<div class="form-horizontal">
						<label for="name">Titre du poste : </label>
						<input id="name" type="text" name="name_job" placeholder="Nom du poste" required="true" />
					</div>
					<div class="form-horizontal">
						<label for="enterprise">Nom de l'entreprise : </label>
						<input id="enterprise" type="text" name="name_entreprise" placeholder="Nom de l'entreprise" required="true" />
					</div>
					<div class="form-horizontal">
						<label for="contrat">Type de contrat : </label>
						<select id="contrat" name="contrat">
							<option value=""></option>
							<option value="Stage">Stage</option>
							<option value="Intérim">Intérim</option>
							<option value="CDD">CDD</option>
							<option value="CDI">CDI</option>
						</select>
					</div>
					<div class="form-horizontal">
						<label for="begin">Début contrat</label>
						<input type="date" id="begin" name="begin_exp" required="true" />
						<label for="end">Fin de contrat : </label>
						<input id="end" type="date" name="end_exp" required="false" />
					</div>
					<div class="form-horizontal">
						<label for="description">Description de l'expérience : </label>
						<textarea id="description" name="description_exp" cols="20" rows="15"></textarea>
					</div>
					<div class="form-horizontal">
						<input type="submit" name="add_exp" value="Ajouter" class="btn btn-success" />
					</div>
				</form>
				<?php break;
			case 'edit' : ?>
				edit template
				<?php break;
		endswitch;
	endif; ?>
</section>