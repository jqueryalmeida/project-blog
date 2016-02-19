<section ng-controller="AdminController">
	<?php
	include $menu;
	?>

	<section class="col-xs-9 col-sm-9 col-md-6 col-lg-11">
		<div class="row" ng-include="file">
			affichage des formulaires
		</div>
	</section>

	<div class="clearfix" role="separator"></div>
</section>