<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="author" content="MERLIN Tahitoa">
	<meta charset="utf-8">
	<meta name="device" content="width=device-width,initial-scale=1">
	<meta name="content" content="text/html">
	<meta name="keywords" content="blog, bts, cned, tahitoa merlin, merlin, tahitoa, développement, php, html, css, mysql, angularJS, jquery, javascript">
	<meta name="description" content="Blog pour mon BTS">
	<link rel="stylesheet" href="/webroot/style/style.css" />
	<link rel="stylesheet" href="/webroot/librairies/bootstrap-3.3.5-dist/css/bootstrap.min.css" />
	<link rel="stylesheet" href="/webroot/librairies/font-awesome-4.6.1/css/font-awesome.min.css" />
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
	<title><?php print isset($title) ? $title : 'Blog MERLIN Tahitoa'; ?></title>
</head>

<body>
<section id="header-container">
	<?php include 'templates/header.tpl.inc.php'; ?>
</section>

<div class="clearfix" style="margin-top: 20px;"></div>

<section id="global-container" class="container-fluid">
	<section class="col-xs-12 col-sm-6 col-md-5 col-lg-3 container-fluid">
		<?php include 'templates/sidebar.tpl.inc.php'; ?>
	</section>
	<section class="container-fluid col-xs-12 col-sm-6 col-md-7 col-lg-9">
		<div class="row">
			<?php
			include $content;
			?>
		</div>
	</section>
</section>

<div class="clearfix"></div>

<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php include 'templates/footer.tpl.inc.php'; ?>
</section>

<script type="text/javascript" src="/webroot/scripts/function.scripts.js"></script>
<script type="text/javascript">
		$('.icon-ajax-message').closeMessage();
	
</script>
</body>
</html>