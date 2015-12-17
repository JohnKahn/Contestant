<?php $token = $this->security->getToken(); ?>
<?php $tokenKey = $this->security->getTokenKey(); ?>
<div class="row">
	<div class="col s12">
		<h4 class="valign-wrapper no-mar grey-text text-darken-1">
			<i class="material-icons valign" style="font-size: 1em; margin-right: 10px;">group</i>
			<p class="valign">Teams</p>
		</h4>
	</div>
	<div class="col s12 m7">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col s12">
						<h5 class="grey-text text-darken-2">New Team</h5>
						<form action="/admin/teams" method="post">
							<input type="hidden" name="<?php echo $tokenKey; ?>" value="<?php echo $token; ?>">
							<input type="hidden" name="type" value="create">
							<div class="input-field col s12 m6">
								<input id="username" name="user" type="text">
								<label for="username">Team Name</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="password" name="pass" type="password">
								<label for="password">Password</label>
							</div>
							<div class="center-align col s12">
								<button class="btn waves-effect waves-light green" style="margin-top:10px;" type="submit" name="action">Submit
									<i class="material-icons right">send</i>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col s12 m5">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col s12">
						<h5 class="grey-text text-darken-2">Generate Teams</h5>
						<form action="/admin/teams" method="post">
							<input type="hidden" name="<?php echo $tokenKey; ?>" value="<?php echo $token; ?>">
							<input type="hidden" name="type" value="generate">
							<div class="input-field col s12">
								<input id="gen-username" name="user" type="text">
								<label for="gen-username">Team Name Pattern</label>
							</div>
							<div class="center-align col s12">
								<button class="btn waves-effect waves-light green" style="margin-top:10px;" type="submit" name="action">Submit
									<i class="material-icons right">send</i>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<table class="striped stupidTable">
					<thead>
						<tr>
							<th data-sort="string">Team Name</th>
							<th width="1">Edit</th>
							<th width="1">Delete</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($teams as $team) { ?>
							<tr>
								<td><?php echo $team->getUsername(); ?></td>
								<td>
									<a href="#team_<?php echo $team->getId(); ?>_edit" class="btn waves-effect waves-light modal-trigger amber darken-2">
										<i class="material-icons">edit</i>
									</a>
								</td>
								<td>
									<form action="/admin/teams" method="post">
										<input type="hidden" name="<?php echo $tokenKey; ?>" value="<?php echo $token; ?>">
										<input type="hidden" name="id" value="<?php echo $team->getId(); ?>">
										<input type="hidden" name="type" value="delete">
										<button type="submit" class="btn waves-effect waves-light red">
											<i class="material-icons">delete</i>
										</button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php foreach ($teams as $team) { ?>
					<div id="team_<?php echo $team->getId(); ?>_edit" class="modal">
						<div class="modal-content row">
							<h5 class="grey-text text-darken-3">Edit Team</h5>
							<form action="/admin/teams" method="post">
								<input type="hidden" name="<?php echo $tokenKey; ?>" value="<?php echo $token; ?>">
								<input type="hidden" name="type" value="update">
								<input type="hidden" name="id" value="<?php echo $team->getId(); ?>">
								<!-- Something here to identify which team is being edited -->
								<div class="input-field col s12 m6">
									<input id="team_<?php echo $team->getId(); ?>_username" name="user" type="text" value="<?php echo $team->getUsername(); ?>">
									<label for="team_<?php echo $team->getId(); ?>_username">New Team Name</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="team_<?php echo $team->getId(); ?>_password" name="pass" type="password" title="test">
									<label for="team_<?php echo $team->getId(); ?>_password">New Password</label>
								</div>
								<div class="center-align col s12">
									<button class="btn waves-effect waves-light green modal-action modal-close" style="margin-top:10px;" type="submit" name="action">Submit
										<i class="material-icons right">send</i>
									</button>
								</div>
							</form>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php if ($changeOccurred) { ?>
		<?php if ($changeSuccessful) { ?>
			Materialize.toast($('<div class="valign-wrapper"><i class="material-icons green-text valign">done</i><span class="valign" style="margin-left:5px;">Change Successful</span></div>'), 3000);
		<?php } else { ?>
			Materialize.toast($('<div class="valign-wrapper"><i class="material-icons red-text valign">clear</i><span class="valign" style="margin-left:5px;">Change Failed</span></div>'), 3000);
		<?php } ?>
	<?php } ?>
</script>