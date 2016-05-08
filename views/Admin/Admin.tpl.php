<section id="admin-container">
	<?php if ($this->getSession('id_user') && $this->getSession('grade') == 9999) : ?>
		<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="row">
				<?php
				if (isset($tpl) && file_exists($tpl))
				{
					include $tpl;
				}
				?>
			</div>
		</section>
	<?php endif; ?>

	<?php if (!$this->getSession('id_user') && $this->getSession('grade') != 9999) : ?>
		<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="row">
				<?php
				if (isset($tpl) && file_exists($tpl))
				{
					include $tpl;
				}
				?>
			</div>
		</section>
	<?php endif; ?>
</section>