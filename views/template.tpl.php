<!DOCTYPE html>
<html lang="fr" ng-app="App">
<head>
	<meta name="author" content="MERLIN Tahitoa">
	<meta charset="utf-8">
	<meta name="device" content="width=device-width,initial-scale=1">
	<meta name="content" content="text/html">
	<meta name="keywords" content="blog, bts, cned, tahitoa merlin, merlin, tahitoa, développement, php, html, css, mysql, angularJS, jquery, javascript">
	<meta name="description" content="Blog pour mon BTS">
	<link rel="stylesheet" href="/webroot/style/style.css" />
	<link rel="stylesheet" href="/webroot/librairies/bootstrap-3.3.5-dist/css/bootstrap.min.css" />
	<script type="text/javascript" src="/webroot/librairies/jquery.js"></script>
	<script type="text/javascript" src="/webroot/librairies/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/webroot/librairies/angular.js"></script>
	<?php
	if(isset($scripts))
	{
		foreach($scripts as $script) : ?>
				<script type="text/javascript" src="<?php print $script; ?>"></script>
		<?php endforeach;
	}
	?>
	<title><?php print $title; ?></title>
</head>

<body>
<section id="header-container">
	<?php include 'templates/header.tpl.inc.php'; ?>
</section>

<div class="clearfix"></div>

<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php
	include $content;
	?>
</section>

<div class="clearfix"></div>

<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php include 'templates/footer.tpl.inc.php'; ?>
</section>
</body>
</html>