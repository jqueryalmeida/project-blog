<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php foreach ($articles as $article) : ?>
		<div id="article-container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php print $article->title_article; ?>
				</div>
				<div class="clearfix" role="separator"></div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php print $article->description_article; ?>
				</div>
				<div class="clearfix" role="separator"></div>
			</div>
		</div>
	<?php endforeach; ?>
</section>
