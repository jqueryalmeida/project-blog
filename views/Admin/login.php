<section class="container-fluid">
	<form method="post" action="/admin/login">
		<div class="form-horizontal">
			<label for="mail">Email : </label>
			<input id="mail" type="text" name="email" placeholder="Email@mail.com" />
		</div>
		<div class="form-horizontal">
			<label for="password">Mot de passe : </label>
			<input id="password" type="password" name="password" placeholder="Password" />
		</div>
		<div class="form-horizontal">
			<input type="submit" name="send" value="Se connecter" class="btn btn-success" />
		</div>
	</form>
</section>