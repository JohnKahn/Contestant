<div class="row">
	<div class="col s12">
		<h4 class="valign-wrapper no-mar grey-text text-darken-1">
			<i class="material-icons valign" style="font-size: 1em; margin-right: 10px;">group</i>
			<p class="valign">Teams</p>
		</h4>
	</div>
	<div class="col s12 m12">
		<div class="card">
			<div class="card-content">
				<div class="row">
					<div class="col s12 m8">
						<h5 class="grey-text text-darken-2">New Team</h5>
						<form action="/admin/team" method="post">
							<input type="hidden" name="new" value="">
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
					<div class="col s12 m4" style="border-left: solid 1px #d9d9d9">
						<h5 class="grey-text text-darken-2">Generate Teams</h5>
						<form action="/admin/team" method="post">
							<input type="hidden" name="generate" value="">
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
						<tr>
							<td>Team1</td>
							<td>
								<a href="#8sah090a" class="btn waves-effect waves-light modal-trigger amber darken-2">
									<i class="material-icons">edit</i>
								</a>
							</td>
							<td>
								<form action="/admin/teams" method="post">
									<button type="submit" class="btn waves-effect waves-light red">
										<i class="material-icons">delete</i>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td>Team2</td>
							<td>
								<a href="#hf9s0xas" class="btn waves-effect waves-light modal-trigger amber darken-2">
									<i class="material-icons">edit</i>
								</a>
							</td>
							<td>
								<form action="/admin/teams" method="post">
									<button type="submit" class="btn waves-effect waves-light red">
										<i class="material-icons">delete</i>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td>Team3</td>
							<td>
								<a href="#js9xlo1s" class="btn waves-effect waves-light modal-trigger amber darken-2">
									<i class="material-icons">edit</i>
								</a>
							</td>
							<td>
								<form action="/admin/teams" method="post">
									<button type="submit" class="btn waves-effect waves-light red">
										<i class="material-icons">delete</i>
									</button>
								</form>
							</td>
						</tr>
					</tbody>
				</table>
				<span style="display:block;">
					<div id="8sah090a" class="modal">
						<div class="modal-content row">
							<h5 class="grey-text text-darken-3">Edit Team</h5>
							<form action="/admin/teams" method="post">
								<input type="hidden" name="edit" value="">
								<!-- Something here to identify which team is being edited -->
								<div class="input-field col s12 m6	">
									<input id="js9xlo1s-username" name="user" type="text" value="Team1">
									<label for="js9xlo1s-username">New Team Name</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="js9xlo1s-password" name="pass" type="password" title="test">
									<label for="js9xlo1s-password">New Password</label>
								</div>
								<div class="center-align col s12">
									<button class="btn waves-effect waves-light green modal-action modal-close" style="margin-top:10px;" type="submit" name="action">Submit
										<i class="material-icons right">send</i>
									</button>
								</div>
							</form>
						</div>
					</div>
					<div id="hf9s0xas" class="modal">
						<div class="modal-content row">
							<h5 class="grey-text text-darken-3">Edit Team</h5>
							<form action="/admin/teams" method="post">
								<input type="hidden" name="edit" value="">
								<!-- Something here to identify which team is being edited -->
								<div class="input-field col s12 m6	">
									<input id="js9xlo1s-username" name="user" type="text" value="Team2">
									<label for="js9xlo1s-username">New Team Name</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="js9xlo1s-password" name="pass" type="password" title="test">
									<label for="js9xlo1s-password">New Password</label>
								</div>
								<div class="center-align col s12">
									<button class="btn waves-effect waves-light green modal-action modal-close" style="margin-top:10px;" type="submit" name="action">Submit
										<i class="material-icons right">send</i>
									</button>
								</div>
							</form>
						</div>
					</div>
					<div id="js9xlo1s" class="modal">
						<div class="modal-content row">
							<h5 class="grey-text text-darken-3">Edit Team</h5>
							<form action="/admin/teams" method="post">
								<input type="hidden" name="edit" value="">
								<!-- Something here to identify which team is being edited -->
								<div class="input-field col s12 m6	">
									<input id="js9xlo1s-username" name="user" type="text" value="Team3">
									<label for="js9xlo1s-username">New Team Name</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="js9xlo1s-password" name="pass" type="password" title="test">
									<label for="js9xlo1s-password">New Password</label>
								</div>
								<div class="center-align col s12">
									<button class="btn waves-effect waves-light green modal-action modal-close" style="margin-top:10px;" type="submit" name="action">Submit
										<i class="material-icons right">send</i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</span>
			</div>
		</div>
	</div>
</div>