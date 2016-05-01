<section ng-controller="AdminController">
	<?php
	include 'menu.admin.tpl.inc';
	?>

	<section class="col-xs-9 col-sm-9 col-md-6 col-lg-11">
		<div class="row" ng-include="file">
			<?php
			if(file_exists($tpl))
			{
				include $tpl;
			}
			?>
		</div>
	</section>

	<div class="clearfix" role="separator"></div>
</section>