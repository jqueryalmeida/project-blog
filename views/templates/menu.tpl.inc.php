<section id="menu">
	<ul class="nav nav-tabs btn-group-justified">
		<?php
		foreach ($this->getMenus() as $index => $value): ?>
			<?php $menu = json_decode($value->dataMenu); ?>
			<li role="presentation"><a href="<?php print $menu->link; ?>" title="<?php print $menu->title; ?>"><?php print $menu->title; ?></a></li>
		<?php endforeach; ?>
	</ul>
</section>