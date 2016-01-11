<?php $token = $this->security->getToken(); $tokenKey = $this->security->getTokenKey(); ?>
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
						<?php foreach ($problems as $problem) { ?>
							<tr>
								<td><?php echo $problem->getName(); ?></td>
								<td><?php echo $problem->getDataFileFriendly(); ?></td>
								<td><?php echo $problem->getJudgeFileFriendly(); ?></td>
								<td>
									<a href="#prob_<?php echo $problem->getId(); ?>_edit" class="btn waves-effect waves-light modal-trigger amber darken-2">
										<i class="material-icons">edit</i>
									</a>
								</td>
								<td>
									<form action="/admin/problems" method="post">
										<input type="hidden" name="<?php echo $tokenKey; ?>" value="<?php echo $token; ?>">
										<input type="hidden" name="id" value="<?php echo $problem->getId(); ?>">
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
				<div id="newProblemModal" class="modal">
					<div class="modal-content row">
						<h5 class="grey-text text-darken-3">Add Problem</h5>
						<form action="/admin/problems" method="post" enctype="multipart/form-data">
							<input type="hidden" name="<?php echo $tokenKey; ?>" value="<?php echo $token; ?>">
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
				<?php foreach ($problems as $problem) { ?>
					<div id="prob_<?php echo $problem->getId(); ?>_edit" class="modal">
						<div class="modal-content row">
							<h5 class="grey-text text-darken-3">Edit Team</h5>
							<form action="/admin/problems" method="post" enctype="multipart/form-data">
								<input type="hidden" name="<?php echo $tokenKey; ?>" value="<?php echo $token; ?>">
								<input type="hidden" name="type" value="update">
								<input type="hidden" name="id" value="<?php echo $problem->getId(); ?>">
								<div class="input-field col s12 m6">
									<input id="prob_<?php echo $problem->getId(); ?>_name" name="name" type="text" value="<?php echo $problem->getName(); ?>">
									<label for="prob_<?php echo $problem->getId(); ?>_name">Problem Name</label>
								</div>
								<div class="input-field col s12 m6">
									<input id="prob_<?php echo $problem->getId(); ?>_runtime" name="runtime" type="text" value="<?php echo $problem->getRuntime(); ?>">
									<label for="prob_<?php echo $problem->getId(); ?>_runtime">Run Time Limit in Seconds</label>
								</div>
								<div class="input-field col s12 m2">
									<input type="checkbox" name="hasDataFile" class="filled-in" id="prob_<?php echo $problem->getId(); ?>_dataFileCheckbox" <?php if ($problem->getDataFile() != null) { ?>checked<?php } ?>>
									<label for="prob_<?php echo $problem->getId(); ?>_dataFileCheckbox">Has Data File</label>
								</div>
								<div id="prob_<?php echo $problem->getId(); ?>_dataFileWrapper" class="file-field input-field col s12 m10">
									<div class="btn <?php if ($problem->getDataFile() == null) { ?>grey<?php } else { ?>amber<?php } ?> darken-1">
										<span>File</span>
										<input name="dataFile" class="dataFile" <?php if ($problem->getDataFile() == null) { ?>disabled<?php } ?> type="file">
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate dataFileText" <?php if ($problem->getDataFile() == null) { ?>disabled<?php } ?> type="text" value="<?php echo $problem->getDataFileFriendly(); ?>" placeholder="Upload the input file">
									</div>
								</div>
								<div class="input-field col s12 m2">
									<input type="checkbox" name="hasJudgeFile" class="filled-in" id="prob_<?php echo $problem->getId(); ?>_judgeFileCheckbox" <?php if ($problem->getJudgeFile() != null) { ?>checked<?php } ?>>
									<label for="prob_<?php echo $problem->getId(); ?>_judgeFileCheckbox">Has Judge File</label>
								</div>
								<div id="prob_<?php echo $problem->getId(); ?>_judgeFileWrapper" class="file-field input-field col s12 m10">
									<div class="btn <?php if ($problem->getJudgeFile() == null) { ?>grey<?php } else { ?>amber<?php } ?> darken-1">
										<span>File</span>
										<input name="judgeFile" class="judgeFile" <?php if ($problem->getJudgeFile() == null) { ?>disabled<?php } ?> type="file">
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate judgeFileText" <?php if ($problem->getJudgeFile() == null) { ?>disabled<?php } ?> type="text" value="<?php echo $problem->getJudgeFileFriendly(); ?>" placeholder="Upload the output file">
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

	<?php foreach ($problems as $problem) { ?>
		$("#prob_<?php echo $problem->getId(); ?>_dataFileCheckbox").click(function() {
			var shouldDisable = !$("#prob_<?php echo $problem->getId(); ?>_dataFileCheckbox").is(":checked");
			$("#prob_<?php echo $problem->getId(); ?>_dataFileWrapper input.dataFile").prop("disabled", shouldDisable);
			$("#prob_<?php echo $problem->getId(); ?>_dataFileWrapper input.dataFileText").prop("disabled", shouldDisable);
			if (shouldDisable) {
				$("#prob_<?php echo $problem->getId(); ?>_dataFileWrapper div.btn").removeClass("amber");
				$("#prob_<?php echo $problem->getId(); ?>_dataFileWrapper div.btn").addClass("grey");
			} else {
				$("#prob_<?php echo $problem->getId(); ?>_dataFileWrapper div.btn").removeClass("grey");
				$("#prob_<?php echo $problem->getId(); ?>_dataFileWrapper div.btn").addClass("amber");
			}
		});

		$("#prob_<?php echo $problem->getId(); ?>_judgeFileCheckbox").click(function() {
			var shouldDisable = !$("#prob_<?php echo $problem->getId(); ?>_judgeFileCheckbox").is(":checked");
			$("#prob_<?php echo $problem->getId(); ?>_judgeFileWrapper input.judgeFile").prop("disabled", shouldDisable);
			$("#prob_<?php echo $problem->getId(); ?>_judgeFileWrapper input.judgeFileText").prop("disabled", shouldDisable);
			if (shouldDisable) {
				$("#prob_<?php echo $problem->getId(); ?>_judgeFileWrapper div.btn").removeClass("amber");
				$("#prob_<?php echo $problem->getId(); ?>_judgeFileWrapper div.btn").addClass("grey");
			} else {
				$("#prob_<?php echo $problem->getId(); ?>_judgeFileWrapper div.btn").removeClass("grey");
				$("#prob_<?php echo $problem->getId(); ?>_judgeFileWrapper div.btn").addClass("amber");
			}
		});
	<?php } ?>
</script>