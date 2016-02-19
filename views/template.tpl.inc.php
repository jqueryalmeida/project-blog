<!DOCTYPE html>
<html lang="fr" ng-app="App">
<head>
	<meta name="author" content="MERLIN Tahitoa">
	<meta charset="utf-8">
	<meta name="device" content="width=device-width,initial-scale=1">
	<meta name="content" content="text/html">
	<meta name="keywords" content="blog, bts, cned, tahitoa merlin, merlin, tahitoa, développement, php, html, css, mysql, angularJS, jquery, javascript">
	<meta name="description" content="Blog pour mon BTS">
	<link rel="stylesheet" href="/include/bootstrap-3.3.5-dist/css/bootstrap.min.css" />
	<script type="text/javascript" src="/include/scripts/jquery.js"></script>
	<script type="text/javascript" src="/include/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/include/scripts/angular.js"></script>
	<?php
	if(isset($scripts))
	{
		foreach($scripts as $script) : ?>
				<script type="text/javascript" src="/include/scripts/<?php print $script; ?>"></script>
		<?php endforeach;
	}
	?>
	<title><?php print $title; ?></title>
</head>

<body>
<?php include 'header.tpl.inc.php'; ?>
<?php include 'menu.tpl.inc.php'; ?>

<?php include $content; ?>

<?php include 'footer.tpl.inc.php'; ?>
</body>
</html>