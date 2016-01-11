{% set token = this.security.getToken(), tokenKey = this.security.getTokenKey() %}
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
				<a href="#newProblemModal" class="btn waves-effect waves-light modal-trigger green">
					Add Problem<i class="material-icons right">add</i>
				</a>
				<table class="striped stupidTable">
					<thead>
						<tr>
							<th data-sort="string">Problem Name</th>
							<th data-sort="string">Data File</th>
							<th data-sort="string">Judge File</th>
							<th width="1">Edit</th>
							<th width="1">Delete</th>
						</tr>
					</thead>

					<tbody>
						{% for problem in problems %}
							<tr>
								<td>{{ problem.getName() }}</td>
								<td>{{ problem.getDataFileFriendly() }}</td>
								<td>{{ problem.getJudgeFileFriendly() }}</td>
								<td>
									<a href="#prob_{{ problem.getId() }}_edit" class="btn waves-effect waves-light modal-trigger amber darken-2">
										<i class="material-icons">edit</i>
									</a>
								</td>
								<td>
									<form action="/admin/problems" method="post">
										<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">
										<input type="hidden" name="id" value="{{ problem.getId() }}">
										<input type="hidden" name="type" value="delete">
										<button type="submit" class="btn waves-effect waves-light red">
											<i class="material-icons">delete</i>
										</button>
									</form>
								</td>
							</tr>
						{% endfor %}
					</tbody>
				</table>
				<div id="newProblemModal" class="modal">
					<div class="modal-content row">
						<h5 class="grey-text text-darken-3">Add Problem</h5>
						<form action="/admin/problems" method="post" enctype="multipart/form-data">
							<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">
							<input type="hidden" name="type" value="create">
							<div class="input-field col s12 m6">
								<input id="name" name="name" type="text">
								<label for="name">Problem Name</label>
							</div>
							<div class="input-field col s12 m6">
								<input id="runtime" name="runtime" type="text" value="45">
								<label for="runtime">Run Time Limit in Seconds</label>
							</div>
							<div class="input-field col s12 m2">
								<input type="checkbox" name="hasDataFile" class="filled-in" id="dataFileCheckbox">
								<label for="dataFileCheckbox">Has Data File</label>
							</div>
							<div id="dataFileWrapper" class="file-field input-field col s12 m10">
								<div class="btn grey darken-1">
									<span>File</span>
									<input name="dataFile" class="dataFile" disabled type="file">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate dataFileText" disabled type="text" placeholder="Upload the input file">
								</div>
							</div>
							<div class="input-field col s12 m2">
								<input type="checkbox" name="hasJudgeFile" class="filled-in" id="judgeFileCheckbox">
								<label for="judgeFileCheckbox">Has Judge File</label>
							</div>
							<div id="judgeFileWrapper" class="file-field input-field col s12 m10">
								<div class="btn grey darken-1">
									<span>File</span>
									<input name="judgeFile" class="judgeFile" disabled type="file">
								</div>
								<div class="file-path-wrapper">
									<input class="file-path validate judgeFileText" disabled type="text" placeholder="Upload the output file">
								</div>
							</div>
							<div class="center-align col s12">
								<button class="btn waves-effect waves-light green modal-action modal-close" style="margin-top:10px;" type="submit" name="action">Submit
									<i class="material-icons right">send</i>
								</button>
							</div>
						</form>
					</div>
				</div>
				{% for problem in problems %}
					<div id="prob_{{ problem.getId() }}_edit" class="modal">
						<div class="modal-content row">
							<h5 class="grey-text text-darken-3">Edit Team</h5>
							<form action="/admin/problems" method="post" enctype="multipart/form-data">
								<input type="hidden" name="{{ tokenKey }}" value="{{ token }}">
								<input type="hidden" name="type" value="update">
								<input type="hidden" name="id" value="{{ problem.getId() }}">
								<div class="input-field col s12 m6">
									<input id="prob_{{ problem.getId() }}_name" name="name" type="text" value="{{ problem.getName() }}">
									<label for="prob_{{ problem.getId() }}_name">Problem Name</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="prob_{{ problem.getId() }}_runtime" name="runtime" type="text" value="{{ problem.getRuntime() }}">
									<label for="prob_{{ problem.getId() }}_runtime">Run Time Limit in Seconds</label>
								</div>
								<div class="input-field col s12 m2">
									<input type="checkbox" name="hasDataFile" class="filled-in" id="prob_{{ problem.getId() }}_dataFileCheckbox" {% if problem.getDataFile() != null %}checked{% endif %}>
									<label for="prob_{{ problem.getId() }}_dataFileCheckbox">Has Data File</label>
								</div>
								<div id="prob_{{ problem.getId() }}_dataFileWrapper" class="file-field input-field col s12 m10">
									<div class="btn {% if problem.getDataFile() == null %}grey{% else %}amber{% endif %} darken-1">
										<span>File</span>
										<input name="dataFile" class="dataFile" {% if problem.getDataFile() == null %}disabled{% endif %} type="file">
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate dataFileText" {% if problem.getDataFile() == null %}disabled{% endif %} type="text" value="{{ problem.getDataFileFriendly() }}" placeholder="Upload the input file">
									</div>
								</div>
								<div class="input-field col s12 m2">
									<input type="checkbox" name="hasJudgeFile" class="filled-in" id="prob_{{ problem.getId() }}_judgeFileCheckbox" {% if problem.getJudgeFile() != null %}checked{% endif %}>
									<label for="prob_{{ problem.getId() }}_judgeFileCheckbox">Has Judge File</label>
								</div>
								<div id="prob_{{ problem.getId() }}_judgeFileWrapper" class="file-field input-field col s12 m10">
									<div class="btn {% if problem.getJudgeFile() == null %}grey{% else %}amber{% endif %} darken-1">
										<span>File</span>
										<input name="judgeFile" class="judgeFile" {% if problem.getJudgeFile() == null %}disabled{% endif %} type="file">
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate judgeFileText" {% if problem.getJudgeFile() == null %}disabled{% endif %} type="text" value="{{ problem.getJudgeFileFriendly() }}" placeholder="Upload the output file">
									</div>
								</div>
								<div class="center-align col s12">
									<button class="btn waves-effect waves-light green modal-action modal-close" style="margin-top:10px;" type="submit" name="action">Submit
										<i class="material-icons right">send</i>
									</button>
								</div>
							</form>
						</div>
					</div>
				{% endfor %}
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	{% if changeOccurred %}
		{% if changeSuccessful %}
			Materialize.toast($('<div class="valign-wrapper"><i class="material-icons green-text valign">done</i><span class="valign" style="margin-left:5px;">Change Successful</span></div>'), 3000);
		{% else %}
			Materialize.toast($('<div class="valign-wrapper"><i class="material-icons red-text valign">clear</i><span class="valign" style="margin-left:5px;">Change Failed</span></div>'), 3000);
		{% endif %}

		{% if teamsGenerated %}
			$("#generatedTeamInfo").openModal();
		{% endif %}
	{% endif %}

	$("#dataFileCheckbox").click(function() {
		var shouldDisable = !$("#dataFileCheckbox").is(":checked");
		$("#dataFileWrapper input.dataFile").prop("disabled", shouldDisable);
		$("#dataFileWrapper input.dataFileText").prop("disabled", shouldDisable);
		if (shouldDisable) {
			$("#dataFileWrapper div.btn").removeClass("amber");
			$("#dataFileWrapper div.btn").addClass("grey");
		} else {
			$("#dataFileWrapper div.btn").removeClass("grey");
			$("#dataFileWrapper div.btn").addClass("amber");
		}
	});

	$("#judgeFileCheckbox").click(function() {
		var shouldDisable = !$("#judgeFileCheckbox").is(":checked");
		$("#judgeFileWrapper input.judgeFile").prop("disabled", shouldDisable);
		$("#judgeFileWrapper input.judgeFileText").prop("disabled", shouldDisable);
		if (shouldDisable) {
			$("#judgeFileWrapper div.btn").removeClass("amber");
			$("#judgeFileWrapper div.btn").addClass("grey");
		} else {
			$("#judgeFileWrapper div.btn").removeClass("grey");
			$("#judgeFileWrapper div.btn").addClass("amber");
		}
	});

	{% for problem in problems %}
		$("#prob_{{ problem.getId() }}_dataFileCheckbox").click(function() {
			var shouldDisable = !$("#prob_{{ problem.getId() }}_dataFileCheckbox").is(":checked");
			$("#prob_{{ problem.getId() }}_dataFileWrapper input.dataFile").prop("disabled", shouldDisable);
			$("#prob_{{ problem.getId() }}_dataFileWrapper input.dataFileText").prop("disabled", shouldDisable);
			if (shouldDisable) {
				$("#prob_{{ problem.getId() }}_dataFileWrapper div.btn").removeClass("amber");
				$("#prob_{{ problem.getId() }}_dataFileWrapper div.btn").addClass("grey");
			} else {
				$("#prob_{{ problem.getId() }}_dataFileWrapper div.btn").removeClass("grey");
				$("#prob_{{ problem.getId() }}_dataFileWrapper div.btn").addClass("amber");
			}
		});

		$("#prob_{{ problem.getId() }}_judgeFileCheckbox").click(function() {
			var shouldDisable = !$("#prob_{{ problem.getId() }}_judgeFileCheckbox").is(":checked");
			$("#prob_{{ problem.getId() }}_judgeFileWrapper input.judgeFile").prop("disabled", shouldDisable);
			$("#prob_{{ problem.getId() }}_judgeFileWrapper input.judgeFileText").prop("disabled", shouldDisable);
			if (shouldDisable) {
				$("#prob_{{ problem.getId() }}_judgeFileWrapper div.btn").removeClass("amber");
				$("#prob_{{ problem.getId() }}_judgeFileWrapper div.btn").addClass("grey");
			} else {
				$("#prob_{{ problem.getId() }}_judgeFileWrapper div.btn").removeClass("grey");
				$("#prob_{{ problem.getId() }}_judgeFileWrapper div.btn").addClass("amber");
			}
		});
	{% endfor %}
</script>