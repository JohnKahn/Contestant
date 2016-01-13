{% extends "layouts/main.volt" %}

{% block title %}{{ super() }}
	Home
{% endblock %}

{% block content %}
{% set token    = this.security.getToken() %}
{% set tokenKey = this.security.getTokenKey() %}
<div class="row fill-height no-mar">
	<div class="col s12 m5 l3 blue-grey darken-3 white-text">
		<h3 class="center-align" style="margin-bottom: 0;">Submission</h3>
		<div class="row">
			<div class="switch center-align">
				<label>
					Local File
					<input id="fileTypeCheck" type="checkbox">
					<span class="lever"></span>
					Server File
				</label>
			</div>
			<form id="localSubmissionForm" method="post" action="/team/submit">
				<input type="hidden" value="local">
				<div class="input-field col s12">
					<select required>
						<option value="" disabled selected>Choose a problem</option>
						{% for problem in problems %}
							<option value="{{ problem.getName() }}">{{ problem.getName() }}</option>
						{% endfor %}
					</select>
					<label>Problem</label>
				</div>
				<div class="file-field input-field col s12">
					<div class="btn blue">
						<span>Java File</span>
						<input type="file" required>
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>
				<div class="center-align col s12">
					<button class="btn waves-effect waves-light green" style="margin-top:10px;" type="submit" name="action">Submit
						<i class="material-icons right">send</i>
					</button>
				</div>
			</form>

			<form id="serverSubmissionForm" method="post" action="/team/submit">
				<input type="hidden" value="server">
				<div class="input-field col s12">
					<select required>
						<option value="" disabled selected>Choose a problem</option>
						{% for problem in problems %}
							<option value="{{ problem.getName() }}">{{ problem.getName() }}</option>
						{% endfor %}
					</select>
					<label>Problem</label>
				</div>
				<div class="input-field col s12">
					<select required>
						<option value="" disabled selected>Choose a file</option>
						<option value="ArbFib">ArbFib.java</option>
						<option value="CandyStore">CandyStore.java</option>
						<option value="DryRun">DryRun.java</option>
					</select>
					<label>File</label>
				</div>
				<div class="center-align col s12">
					<button class="btn waves-effect waves-light green" style="margin-top:10px;" type="submit" name="action">Submit
						<i class="material-icons right">send</i>
					</button>
				</div>
			</form>
		</div>
		<a href="http://www.github.com/JohnKahn" target="_blank" class="waves-effect waves-orange btn-flat creator-link white-text thin">Created by John Kahn</a>
	</div>
	<div class="col s12 m7 l9 white pos-rel no-pad" style="overflow: auto;">
		<div class="row no-mar">
			<div class="col s12">
				<ul class="tabs">
					<li class="tab col s4"><a class="active blue-grey-text" href="#scoreboard">Scoreboard</a></li>
					<li class="tab col s4"><a class="blue-grey-text" href="#clarification">Clarification</a></li>
					<li class="tab col s4"><a class="blue-grey-text" href="#editorPanel">Editor</a></li>
				</ul>
			</div>
			<div id="scoreboard" class="col s12">
				<table class="striped">
					<thead>
						<tr>
							<th data-field="id">Team Name</th>
							<th data-field="name">Score</th>
						</tr>
					</thead>

					<tbody>
						{% for team in teams %}
							<tr {% if team.getUsername() == session.get("team_user") %}class="amber lighten-4"{% endif %}>
								<td>{{ team.getUsername() }}</td>
								<td>{{ team.getScore() }}</td>
							</tr>
						{% endfor %}
					</tbody>
				</table>
			</div>
			<div id="clarification" class="col s12">
				<h5>Submit a new clarification</h5>
				<form id="clarificationForm" action="/team/clarification" method="post" novalidate>
					<div class="input-field col s12 m6">
						<select name="problem" required>
							<option value="" disabled selected>Choose a problem</option>
							<option value="1">Problem 1</option>
							<option value="2">Problem 2</option>
							<option value="3">Problem 3</option>
							<option value="4">Problem 4</option>
							<option value="5">Problem 5</option>
							<option value="6">Problem 6</option>
							<option value="7">Problem 7</option>
							<option value="8">Problem 8</option>
							<option value="9">Problem 9</option>
							<option value="10">Problem 10</option>
							<option value="11">Problem 11</option>
							<option value="12">Problem 12</option>
							
						</select>
						<label>Problem</label>
					</div>
					<div class="input-field col s12 m6">
						<select name="urgency" required>
							<option value="" disabled selected>Choose an urgency level</option>
							<option value="1">No rush</option>
							<option value="2">I can wait</option>
							<option value="3">I'm stuck until resolved</option>
						</select>
						<label>Urgency*</label>
					</div>
					<div class="input-field col s12">
						<textarea id="question" name="question" class="materialize-textarea"></textarea>
						<label for="question">What is your question?</label>
					</div>
					<div class="center-align col s12">
						<button class="btn waves-effect waves-light green" style="margin-top:10px;" type="submit" name="action">Submit
							<i class="material-icons right">send</i>
						</button>
					</div>
					<small>* Choosing an urgency level does not guarentee that you will have priority. That is up to the admin.</small>
				</form>
				<br>
				<h5>Your clarifications</h5>
				<table class="bordered">
					<thead>
						<tr>
							<th data-field="problem">Problem</th>
							<th data-field="question">Question</th>
							<th data-field="response">Response</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>CandyStore</td>
							<td>Is this a real candy store? It sounds like they have good candy.</td>
							<td>No. Go back to work.</td>
						</tr>
						<tr>
							<td>N/A</td>
							<td>Should it be this easy?</td>
							<td>You tell me.</td>
						</tr>
					</tbody>
				</table>
				<br>
				<h5>Admin broadcasts</h5>
				<table class="bordered">
					<thead>
						<tr>
							<th data-field="problem">Problem</th>
							<th data-field="message">Message</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>ArbFib</td>
							<td>There is an error in one of your values. N = 5, should be N = 6</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="editorPanel">
				<div class="row no-mar">
					<div id="editorFileList" class="col s12 m2">
						<h6>File List</h6>
						<ul>
							<li class="noSort"><a class="newFileModal" href="#newFileModal"><i class="material-icons" style="font-size: 1.3em; position: relative; top: 3px;">add</i> New File</a></li>
							{% for serverFile in serverFiles %}
								<li id="sfItem{{ serverFile.getFriendlyName()|removeDots }}"><a href="javascript:changeActiveFile('{{ serverFile.getFriendlyName() }}');">{{ serverFile.getFriendlyName() }}</a><a class="trash" href="#delete{{ serverFile.getFriendlyName()|removeDots }}"><i class="material-icons">clear</i></a></li>
							{% endfor %}
						</ul>
					</div>
					<div class="col s12 m10 right no-pad">
						<div id="editorMenu" class="grey lighten-2 valign-wrapper">
							<p class="valign">Please select a file to the left</p>
						</div>
						<div id="editor"></div>
					</div>
				</div>

				<div id="newFileModal" class="modal">
					<div class="modal-content">
						<h4>New File</h4>
						<div class="input-field col s12 m6">
							<input id="newFileName" name="newFileName" type="text">
							<label for="newFileName">Filename</label>
						</div>
					</div>
					<div class="modal-footer">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a>
						<a href="javascript:newFile();" class="modal-action modal-close waves-effect waves-green btn-flat ">Create</a>
					</div>
				</div>

				{% for serverFile in serverFiles %}
					<div id="delete{{ serverFile.getFriendlyName()|removeDots }}" class="modal">
						<div class="modal-content">
							<h4>Delete {{ serverFile.getFriendlyName() }}</h4>
							<p>Are you sure you would like to delete this file?</p>
						</div>
						<div class="modal-footer">
							<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancel</a>
							<a href="javascript:deleteFile('{{ serverFile.getFriendlyName() }}');" class="modal-action modal-close waves-effect waves-green btn-flat ">Delete</a>
						</div>
					</div>
				{% endfor %}
			</div>
		</div>
	</div>
</div>

{% endblock %}

{% block scripts %}
{{ super() }}
{{ javascript_include("ace/ace.js") }}
<script>
	$('#localSubmissionForm').ajaxForm(function(data) { 
		Snarl.addNotification({
			title: 'Problem 7 - Incorrect',
			text: data,
			icon: '<i class="material-icons right red-text">clear</i>',
			timeout: null
		});
	});

	$('#serverSubmissionForm').ajaxForm(function(data) { 
		Snarl.addNotification({
			title: 'Problem 12 - Correct',
			text: 'You have earned 40 points',
			icon: '<i class="material-icons right green-text">check</i>',
			timeout: null
		});
	});

	$('#clarificationForm').ajaxForm(function(data) { 
		Snarl.addNotification({
			title: 'Clarification received',
			text: '',
			icon: '<i class="material-icons right yellow-text text-darken-1">live_help</i>',
			timeout: null
		});
	});

	$('ul.tabs').tabs();
	$('a[href*="newFileModal"]').leanModal();
	{% for serverFile in serverFiles %}
		$('a[href*="delete{{ serverFile.getFriendlyName()|removeDots }}"]').leanModal();
	{% endfor %}


	if ($("#fileTypeCheck").is(":checked")) {
		$("#localSubmissionForm").css("display", "none");
	} else {
		$("#serverSubmissionForm").css("display", "none");
	}

	$("#fileTypeCheck").click(function() {
		$("#serverSubmissionForm").toggle();
		$("#localSubmissionForm").toggle();
	});

	editor = ace.edit("editor");
	editor.setTheme("ace/theme/xcode");
	editor.getSession().setMode("ace/mode/java");
	editor.setShowPrintMargin(false);
	editor.$blockScrolling = Infinity;
	editor.setReadOnly(true);

	activeFile = "";
	serverFiles = [];
	{% for serverFile in serverFiles %}
		serverFiles["{{ serverFile.getFriendlyName() }}"] = {
			contents : "{{ serverFile.getFileContentsEscaped() }}",
			changed  : false,
			lastSave : "{{ serverFile.getLastSave() }}"
		};
	{% endfor %}

	function sortFileList() {
		var temp = [];
		$("#editorFileList ul").html($("#editorFileList ul li").not(".noSort").get().sort(function(a, b) {
			a = $.trim($(a).text());
			b = $.trim($(b).text());
			return (a > b) ? 1 : ((a < b) ? -1 : 0);
		}));
		$("#editorFileList ul").prepend($("<li class=\"noSort\"><a class=\"newFileModal\" href=\"#newFileModal\"><i class=\"material-icons\" style=\"font-size: 1.3em; position: relative; top: 3px;\">add</i> New File</a></li>"));
		$('.newFileModal').leanModal();
		console.log("Sorted");
	}

	function newFile() {
		var filename = $("input[name='newFileName']").val();

		var lastSave = getLastSave();

		$.post("/team/newServerFile", {
			"filename"       : filename,
			"team_id"        : "{{ session.get('team_id') }}",
			"lastSave"       : lastSave
		}, function(raw) {
			var data = JSON.parse(raw);
			$("input#newFileName").val("");
			if (data.success) {
				Materialize.toast($('<div class="valign-wrapper"><i class="material-icons green-text valign">done</i><span class="valign" style="margin-left:5px;">File created</span></div>'), 3000);
				$("#editorFileList ul").append("<li id=\"sfItem" + replaceAll(data.friendlyName, '.', '') + "\"><a href=\"javascript:changeActiveFile('" + data.friendlyName + "');\">" + data.friendlyName + "</a><a class=\"trash\" href=\"#delete" + replaceAll(data.friendlyName, '.', '') + "\"><i class=\"material-icons\">clear</i></a></li>");
				serverFiles[data.friendlyName] = {
					contents : "",
					changed  : false,
					lastSave : lastSave
				};
				sortFileList();
				changeActiveFile(data.friendlyName);
			} else {
				Materialize.toast($('<div class="valign-wrapper"><i class="material-icons red-text valign">clear</i><span class="valign" style="margin-left:5px;">' + data.message + '</span></div>'), 3000);
			}
		});
	}

	saveTimeout = null;
	progInput = false;
	editor.on("change", function() {
		if (!progInput) {
			serverFiles[activeFile].changed = true;
			serverFiles[activeFile].contents = editor.getValue();
			$("#editorMenu > p").text("Last saved at " + serverFiles[activeFile].lastSave + ". Use ctrl + s to save.");
		}
	});

	function saveActiveFile(notify) {
		if (activeFile != null) {
			var lastSave = getLastSave();

			if (notify) {
				Materialize.toast($('<div class="valign-wrapper"><i class="material-icons blue-grey-text valign">save</i><span class="valign" style="margin-left:5px;">Saving</span></div>'), 1500);
			}
			
			$.post("/team/saveServerFile", {
				"filename" : activeFile,
				"team_id"  : "{{ session.get('team_id') }}",
				"content"  : editor.getValue(),
				"lastSave" : lastSave
			}, function(raw) {
				var data = JSON.parse(raw);
				if (data.success) {
					if (notify) {
						Materialize.toast($('<div class="valign-wrapper"><i class="material-icons green-text valign">done</i><span class="valign" style="margin-left:5px;">File saved successfully</span></div>'), 1500);
					}
					serverFiles[activeFile].lastSave = lastSave;
					$("#editorMenu > p").text("File is up to date");
				} else {
					if (notify) {
						Materialize.toast($('<div class="valign-wrapper"><i class="material-icons red-text valign">clear</i><span class="valign" style="margin-left:5px;">File failed to save. Please try again.</span></div>'), 1500);
					}
				}
			});
		}
	}

	function deleteFile(filename) {
		$.post("/team/deleteServerFile", {
			"filename" : filename,
			"team_id"  : "{{ session.get('team_id') }}"
		}, function(raw) {
			var data = JSON.parse(raw);
			if (data.success) {
				Materialize.toast($('<div class="valign-wrapper"><i class="material-icons green-text valign">done</i><span class="valign" style="margin-left:5px;">File deleted successfully</span></div>'), 1500);
				if (activeFile == filename) {
					changeActiveFile(null);
				}
				$("#sfItem" + replaceAll(filename, '.', '')).remove();
			} else {
				Materialize.toast($('<div class="valign-wrapper"><i class="material-icons red-text valign">clear</i><span class="valign" style="margin-left:5px;">File failed to delete. Please try again Please try again.</span></div>'), 1500);
			}
		});
	}

	function changeActiveFile(filename) {
		if (filename == null) {
			editor.setReadOnly(true);
			progInput = true;
			editor.setValue("", -1);
			progInput = false;
		} else {
			if (editor.getReadOnly()) editor.setReadOnly(false);
			progInput = true;
			editor.setValue(serverFiles[filename].contents, -1);
			progInput = false;
			$("#editorFileList a").filter(function() {return $(this).text() === activeFile;}).parent().removeClass("blue-grey lighten-3");
			activeFile = filename;
			if (serverFiles[activeFile].changed ) {
				$("#editorMenu > p").text("Last saved at " + serverFiles[activeFile].lastSave + ". Use ctrl + s to save.");
			} else {
				$("#editorMenu > p").text("File is up to date");
			}
			$("#editorFileList a").filter(function() {return $(this).text() === activeFile;}).parent().addClass("blue-grey lighten-3");
			editor.focus();
		}
	}

	function getLastSave() {
		var date    = new Date();
		var hours   = date.getHours();
		var minutes = date.getMinutes();
		var seconds = date.getSeconds();
		var ampm    = hours >= 12 ? 'pm' : 'am';
		hours       = hours % 12;
		hours       = hours ? hours : 12; // the hour '0' should be '12'
		minutes     = minutes < 10 ? '0' + minutes : minutes;
		seconds     = seconds < 10 ? '0' + seconds : seconds;
		return hours + ':' + minutes + ':' + seconds + ' ' + ampm;
	}

	function replaceAll(str, find, replace) {
	  return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
	}

	function escapeRegExp(str) {
		return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
	}

	$(window).bind('keydown', 'ctrl+s', function(e) {
		e.preventDefault();
		e.stopImmediatePropagation();
		setTimeout(function() {
			saveActiveFile(true);
		}, 0);
		return false;
	});

	$("#editor *").bind('keydown', 'ctrl+s', function(e) {
		e.preventDefault();
		e.stopImmediatePropagation();
		setTimeout(function() {
			saveActiveFile(true);
		}, 0);
		return false;
	});
</script>
{% endblock %}