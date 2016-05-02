<section id="error-container">
	<section class="col-xs-9 col-sm-9 col-md-9 col-lg-10 row" style="margin-left : 5px;">
		<?php if (!isset($error_selected)) : ?>
			<table class="table table-bordered">
				<tr>
					<th>Date</th>
					<th>Type</th>
					<th>Message</th>
				</tr>

				<?php foreach ($errors as $index => $error) : ?>
					<tr>
						<td><?php print $error->datetime; ?></td>
						<td><?php print $error->typeError; ?></td>
						<td><a href="/admin/reports/event/<?php print $error->idError; ?>"><?php print substr($error->messageError, 0, 15); ?></a></td>
					</tr>

				<?php endforeach; ?>
			</table>
		<?php endif; ?>

		<?php if (isset($error_selected)) : ?>
			<table class="table table-bordered">
				<tr>
					<th>Fichier :</th>
					<td><?php print $error_selected->file; ?></td>
				</tr>
				<tr>
					<th>Code Erreur :</th>
					<td><?php print $error_selected->codeError; ?></td>
				</tr>
				<tr>
					<th>Ligne :</th>
					<td><?php print $error_selected->lineFile; ?></td>
				</tr>
				<tr>
					<th>Type Erreur :</th>
					<td><?php print $error_selected->typeError; ?></td>
				</tr>
				<tr>
					<th>Message Erreur :</th>
					<td><?php print $error_selected->messageError; ?></td>
				</tr>
			</table>
			<h3 class="col-xs-9 col-sm-9 col-md-9 col-lg-10 row text-center">Trace </h3>
			<div class="clearfix" role="separator"></div>
			<?php $traces = json_decode($error_selected->trace); ?>
			<?php foreach ($traces as $trace) : ?>
				<table class="table table-bordered">
					<tr>
						<th>Classe :</th>
						<td><?php print $trace->class; ?></td>
					</tr>
					<tr>
						<th>Fichier :</th>
						<td><?php print $trace->file; ?></td>
					</tr>
					<tr>
						<th>Ligne :</th>
						<td><?php print $trace->line; ?></td>
					</tr>
					<tr>
						<th>Fonction :</th>
						<td><?php print $trace->function; ?></td>
					</tr>
					<tr>
						<th>Ligne :</th>
						<td><?php print $trace->line; ?></td>
					</tr>
					<tr>
						<th>Arguments : </th>
						<td colspan="5">
						<?php foreach($trace->args as $arg) : ?>
							<?php if(!is_array($arg) && !is_object($arg)) : ?>
								<?php print $arg; ?> |
							<?php endif; ?>
						<?php endforeach; ?>
						</td>
					</tr>
				</table>
			<?php endforeach; ?>
		<?php endif; ?>
	</section>
</section>
