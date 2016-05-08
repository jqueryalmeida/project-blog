<section id="skills-globalcontainer">
	<section id="skills-container" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<?php foreach ($skills as $skill) : $jsonSkill = json_decode($skill->dataSkill); ?>
			<section id="skill-container-<?php print $skill->nameSkill; ?>">
				<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4">
					<div class="row">
						<?php print $skill->nameSkill; ?>
					</div>
					<div class="row">
						<div class="progress" style="box-shadow : 0 0 2px black; margin-right : 5px;">
							<div class="progress-bar" role="progressbar" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php print $jsonSkill->level; ?>" style="width : <?php print $jsonSkill->level;?>%;">
								<?php print $jsonSkill->level; ?> %
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php endforeach; ?>
	</section>

	<section id="details-container" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<?php foreach($experiences as $experience) : $jsonExp = json_decode($experience->dataExperience); ?>
			<section id="experience-container-<?php print $skill->nameSkill; ?>" class="bordered container-fluid" style="margin-bottom : 10px;">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
					<div class="row">
						<h3><?php print $experience->nameExperience; ?> - <?php print $jsonExp->enterprise; ?></h3>
					</div>
					<div class="row">
						<h4>Type de contrat : </h4><span><?php print $jsonExp->contrat; ?></span>
						<h4>Durée du contrat : </h4> <?php print $this->formatDate($jsonExp->begin, 'fr'); ?> au <?php print $this->formatDate($jsonExp->end, 'fr'); ?></span>
						<h4>Detail du post occupé : </h4>
						<span><?php print nl2br($jsonExp->details); ?></span>
					</div>
				</div>
			</section>
		<?php endforeach; ?>
	</section>
</section>