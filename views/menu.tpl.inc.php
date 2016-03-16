<section id="menu">
	<div class="navbar">
		<?php foreach($menus as $menu): ?>
			<a href="<?php print $menu->link_menu; ?>"><?php print $menu->name_menu; ?></a>
		<?php endforeach; ?>
	</div>
</section>