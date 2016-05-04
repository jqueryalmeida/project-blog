<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<?php if(isset($articles)) : ?>
		<?php foreach ($articles as $article) : ?>
			<section id="article-container" class=" row">
				<div class=""><a href="/blog/read/<?php print $article->id_article; ?>"><?php print $article->title_article; ?></a></div>
				<div class="clearfix"></div>
				<div class=""><?php print $article->description_article; ?></div>
				<div class="clearfix" role="separator"></div>
				<div class=""><?php print $article->text_article; ?></div>
				<div class="clearfix" role="separator"></div>
				<div class="pull-right">
					<?php print $article->date; ?>
				</div>
			</section>
		<?php endforeach; ?>
	<?php endif; ?>


	<?php if(isset($article) && !isset($articles)): ?>
		<div id="article-title-container" class="row">
			<?php print $article->title_article; ?>
		</div>
		<div id="artitle-description-container" class="row">
			<?php print $article->description_article; ?>
		</div>

		<div id="article-text-container" class="row">
			<?php print nl2br($article->text_article); ?>
		</div>

		<div class="article-infos-container">
			<div class="row">
				<div class="col-xs-7 col-sm-4 col-md-3 col-lg-3 pull-right"> le <?php print $article->date;?></div>
				<div class="col-xs-5 col-sm-3 col-md-3 col-lg-3 pull-right">Ecrit par <?php print $article->pseudo_user; ?></div>
			</div>
		</div>
	<?php endif; ?>
</section>