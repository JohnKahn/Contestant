<?php $token = $this->security->getToken(); ?>
<?php $tokenKey = $this->security->getTokenKey(); ?>
<div class="row">
	<div class="col s12">
		<h4 class="valign-wrapper no-mar grey-text text-darken-1">
			<i class="material-icons valign" style="font-size: 1em; margin-right: 10px;">group</i>
			<p class="valign">Teams</p>
		</h4>
	</div>
	<div class="col s12">
		<div class="card">
			<div class="card-content">
				<a href="#newAdminModal" class="btn waves-effect waves-light modal-trigger green">
					Add Admin<i class="material-icons right">add</i>
				</a>
				<table class="striped stupidTable">
					<thead>
						<tr>
							<th data-sort="string">Team Name</th>
							<th width="1">Edit</th>
							<th width="1">Delete</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($admins as $admin) { ?>
							<tr>
								<td><?php echo $admin->getUsername(); ?></td>
								<td>
									<?php if ($this->session->get('admin_user') == $admin->getUsername() || $admin->getUsername() == 'root') { ?>
										<button disabled class="btn waves-effect waves-light amber darken-2">
											<i class="material-icons">edit</i>
										</button>
									<?php } else { ?>
										<a href="#admin_<?php echo $admin->getId(); ?>_edit" class="btn waves-effect waves-light modal-trigger amber darken-2">
											<i class="material-icons">edit</i>
										</a>
									<?php } ?>
								</td>
								<td>
									<?php if ($this->session->get('admin_user') == $admin->getUsername() || $admin->getUsername() == 'root') { ?>
										<button type="submit" class="btn waves-effect waves-light red" disabled>
											<i class="material-icons">delete</i>
										</button>
									<?php } else { ?>
										<form action="/admin/admins" method="post">
											<input type="hidden" name="<?php echo $tokenKey; ?>" value="<?php echo $token; ?>">
											<input type="hidden" name="id" value="<?php echo $admin->getId(); ?>">
											<input type="hidden" name="type" value="delete">
											<button type="submit" class="btn waves-effect waves-light red">
												<i class="material-icons">delete</i>
											</button>
										</form>
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<div id="newAdminModal" class="modal">
					<div class="modal-content row">
						<h5 class="grey-text text-darken-3">New Admin</h5>
						<form action="/admin/admins" method="post">
							<input type="hidden" name="<?php echo $tokenKey; ?>" value="<?php echo $token; ?>">
							<input type="hidden" name="type" value="create">
							<div class="input-field col s12 m6">
								<input id="admin_new_username" name="user" type="text">
								<label for="admin_new_username">New Admin Name</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="admin_new_password" name="pass" type="password" title="test">
								<label for="admin_new_password">New Password</label>
							</div>
							<div class="center-align col s12">
								<button class="btn waves-effect waves-light green modal-action modal-close" style="margin-top:10px;" type="submit" name="action">Submit
									<i class="material-icons right">send</i>
								</button>
							</div>
						</form>
					</div>
				</div>
				<?php foreach ($admins as $admin) { ?>
					<div id="admin_<?php echo $admin->getId(); ?>_edit" class="modal">
						<div class="modal-content row">
							<h5 class="grey-text text-darken-3">Edit Admin</h5>
							<form action="/admin/admins" method="post">
								<input type="hidden" name="<?php echo $tokenKey; ?>" value="<?php echo $token; ?>">
								<input type="hidden" name="type" value="update">
								<input type="hidden" name="id" value="<?php echo $admin->getId(); ?>">
								<div class="input-field col s12 m6">
									<input id="admin_<?php echo $admin->getId(); ?>_username" name="user" type="text" value="<?php echo $admin->getUsername(); ?>">
									<label for="admin_<?php echo $admin->getId(); ?>_username">New Admin Name</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="admin_<?php echo $admin->getId(); ?>_password" name="pass" type="password" title="test">
									<label for="admin_<?php echo $admin->getId(); ?>_password">New Password</label>
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

		<?php if ($teamsGenerated) { ?>
			$("#generatedTeamInfo").openModal();
		<?php } ?>
	<?php } ?>
</script>