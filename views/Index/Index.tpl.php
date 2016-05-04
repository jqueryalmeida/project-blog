<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php foreach ($articles as $article) : ?>
		<div id="article-container" class="container-fluid row">
			<div class="">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<a href="/<?php print lcfirst($article->nameCategory);?>/read/<?php print $article->id_article; ?>"><?php print $article->title_article; ?></a>
					</div>
					<div class="clearfix" role="separator"></div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php print $article->description_article; ?>
					</div>
					<div class="clearfix" role="separator"></div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php print substr($article->text_article, 0, 150); ?>
					</div>
					<div class="clearfix" role="separator"></div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php print $article->date; ?>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</section>
