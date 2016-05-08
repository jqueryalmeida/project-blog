<section id="skills-container">
	<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row" style="margin-left : 20px;">
		<?php if (!is_null($case)) :
			switch ($case):
				case 'add': ?>
					<form id="skill-form" method="post" action="/admin/skills/add">
						<div class="form-horizontal">
							<label for="name">Nom de la compétence : </label>
							<input id="name" type="text" name="skill_name" placeholder="Nom de la compétence" required="true"/>
						</div>
						<div class="form-horizontal">
							<label for="level">Niveau de la compétence : </label>
							<input id="level" name="level_skill" type="number" placeholder="Niveau de la compétence " required="true" />
						</div>
						<div class="form-horizontal">
							<input type="submit" name="send" value="Ajouter" class="btn btn-success" />
						</div>
					</form>
					<?php break;
				case
					'edit': ?>
					<?php if(isset($skills) && !isset($selected))
					{
						foreach($skills as $skill) : ?>
							<a href="/admin/skills/edit/<?php print $skill->idSkill; ?>"><?php print $skill->nameSkill; ?></a> [ <a href="/admin/skills/delete/<?php print $skill->idSkill; ?>">x</a> ]
						<?php endforeach;
					} ?>

					<?php if(isset($selected)): $json = json_decode($selected->dataSkill); ?>
						<form method="post" id="edit-skill" action="/admin/skills/edit/">
							<div class="form-horizontal">
								<label for="name">Nom de la compétence : </label>
								<input id="name" type="text" name="name_skill" value="<?php print $selected->nameSkill; ?>" placeholder="Nom de la compétence" />
							</div>
							<div class="form-horizontal">
								<label for="level">Niveaude la compétence : </label>
								<input id="level" type="number" name="level_skill" value="<?php print $json->level; ?>" placeholder="Niveau de la compétence" />
							</div>
							<div class="form-horizontal">
								<input type="hidden" name="id_skill" value="<?php print $selected->idSkill; ?>" />
								<input type="submit" name="update" value="Mettre à jour" class="btn btn-warning" />
							</div>
						</form>
					<?php endif; ?>
			 <?php break;
			 endswitch;
		endif; ?>
	</section>
</section>
</section>