<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php
	include 'menu.admin.tpl.inc';
	?>
	<div class="row">
		<?php
		if (isset($tpl) && file_exists($tpl))
		{
			include $tpl;
		}
		?>
	</div>
</section>
