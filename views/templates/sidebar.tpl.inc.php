<section id="sidebar" class="row">
	<section class="container-fluid row">
		<?php if(!$this->checkConnection($this->getSession('pseudo'))) : ?>
		<form id="connection-form" method="post" action="/members/login">
			<div class="form-horizontal">
				<label for="pseudo">Pseudo/Email : </label>
				<input type="text" id="pseudo" name="pseudo" placeholder="Pseudo/Email" required="true" />
			</div>
			<div class="form-horizontal">
				<label for="password">
					Password :
				</label>
				<input id="password" type="password" name="password" placeholder="Password" />
			</div>
			<div class="form-horizontal">
				<input type="submit" name="connection" value="Se connecter" class="btn btn-success" />
			</div>
		</form>
		<?php else : ?>
			<section id="member-space">
				<h3 class="text-center"><?php print $this->getSession('pseudo'); ?></h3>
				<ul class="list-unstyled">
					<li><a href="/members/profil">Mon profil</a></li>
					<li><a href="/members/deconnection" rel="nofollow">Déconnexion</a></li>
				</ul>
			</section>
		<?php endif; ?>
	</section>
</section>

<script type="text/javascript" src="/webroot/scripts/users/connection.js"></script>