<!DOCTYPE html>
<html>
<head>
	<title>Contestant - 
	Home
</title>

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php echo $this->tag->stylesheetLink('css/materialize.min.css'); ?>
	<?php echo $this->tag->stylesheetLink('css/style.css'); ?>
	<?php echo $this->tag->stylesheetLink('css/snarl.min.css'); ?>
	<?php echo $this->tag->stylesheetLink('css/chartist.min.css'); ?>
</head>
<body>
	<div id="whiteCover" class="valign-wrapper" style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background-color:white; z-index: 10000;">
		<div class="preloader-wrapper big active valign" style="margin: 0 auto;">
			<div class="spinner-layer spinner-yello-only">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div><div class="gap-patch">
					<div class="circle"></div>
				</div><div class="circle-clipper right">
					<div class="circle"></div>
				</div>
			</div>
		</div>
	</div>

	
<div class="row no-mar">
	<div class="col l2 m3 hide-on-small-only admin-sidebar white z-depth-2">
		<div class="menu-header">
			<img src="img/placeholder_admin.jpg">
		</div>
		<ul class="menu">
			<li class="menu-item row">
				<a href="javascript:void(0);" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">dashboard</i>
					<p class="col s10 valign">Dashboard</p>
				</a>
			</li>
			<li class="menu-item row">
				<a href="javascript:void(0);" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">group</i>
					<p class="col s10 valign">Teams</p>
				</a>
			</li>
			<li class="menu-item row">
				<a href="javascript:void(0);" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">code</i>
					<p class="col s10 valign">Problems</p>
				</a>
			</li>
			<li class="menu-item row">
				<a href="javascript:void(0);" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">gavel</i>
					<p class="col s10 valign">Judge</p>
				</a>
			</li>
			<li class="menu-item row">
				<a href="javascript:void(0);" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">settings</i>
					<p class="col s10 valign">Configuration</p>
				</a>
			</li>
			<li class="menu-item row">
				<a href="/admin/logout" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">arrow_back</i>
					<p class="col s10 valign">Log out</p>
				</a>
			</li>
		</ul>
	</div>
	<div class="col l10 m9 s12 admin-main grey lighten-5">
		<div class="row">
			<div class="col s12">
				<h4 class="valign-wrapper no-mar grey-text text-darken-1">
					<i class="material-icons valign" style="font-size: 1em; margin-right: 10px;">dashboard</i>
					<p class="valign">Dashboard</p>
				</h4>
			</div>
		</div>
		<div class="row">
			<div class="col s12 m8">
				<div class="card">
					<div class="card-content amber lighten-4">
						<h5 class="grey-text text-darken-3 center-align">Number of Correct Submissions per Problem</h5>
						<div id="problem_completion_graph" class="dark_graph"></div>
					</div>
				</div>
			</div>
			<div class="col s12 m4">
				<div class="card">
					<div class="card-content">
						<table class="striped stupidTable">
							<thead>
								<tr>
									<th data-sort="string">Problem Name</th>
									<th data-sort="float">Submission Ratio</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
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
									<th data-sort="int">Total Submissions</th>
									<th data-sort="int">Correct Submissions</th>
									<th data-sort="int">Wrong Submissions</th>
									<th data-sort="int">Score</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>Team1</td>
									<td>21</td>
									<td>10</td>
									<td>11</td>
									<td>700</td>
								</tr>
								<tr>
									<td>Team2</td>
									<td>40</td>
									<td>30</td>
									<td>10</td>
									<td>760</td>
								</tr>
								<tr>
									<td>Team3</td>
									<td>32</td>
									<td>16</td>
									<td>16</td>
									<td>620</td>
								</tr>
								<tr>
									<td>Team1</td>
									<td>21</td>
									<td>10</td>
									<td>11</td>
									<td>700</td>
								</tr>
								<tr>
									<td>Team2</td>
									<td>40</td>
									<td>30</td>
									<td>10</td>
									<td>760</td>
								</tr>
								<tr>
									<td>Team3</td>
									<td>32</td>
									<td>16</td>
									<td>16</td>
									<td>620</td>
								</tr>
								<tr>
									<td>Team1</td>
									<td>21</td>
									<td>10</td>
									<td>11</td>
									<td>700</td>
								</tr>
								<tr>
									<td>Team2</td>
									<td>40</td>
									<td>30</td>
									<td>10</td>
									<td>760</td>
								</tr>
								<tr>
									<td>Team3</td>
									<td>32</td>
									<td>16</td>
									<td>16</td>
									<td>620</td>
								</tr>
								<tr>
									<td>Team1</td>
									<td>21</td>
									<td>10</td>
									<td>11</td>
									<td>700</td>
								</tr>
								<tr>
									<td>Team2</td>
									<td>40</td>
									<td>30</td>
									<td>10</td>
									<td>760</td>
								</tr>
								<tr>
									<td>Team3</td>
									<td>32</td>
									<td>16</td>
									<td>16</td>
									<td>620</td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


	<?php echo $this->tag->javascriptInclude('js/jquery-2.1.1.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/materialize.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/snarl.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/chartist.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/chartist-plugin-axistitle.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/jquery.form.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/stupidtable.min.js'); ?>
	 
	<?php echo $this->tag->javascriptInclude('js/script.js'); ?>
	
<script type="text/javascript">
	new Chartist.Bar('#problem_completion_graph', {
		labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
		series: [
			[5, 20, 7, 8, 5, 3, 5, 4, 7, 10, 10, 20]
		]
	}, {
		fullWidth: true,
		low: 0,
		height: 350,
		showArea: true,

		chartPadding: {
			left: 20,
			bottom: 30
		},

		axisY: {
			onlyInteger: true
		},
		plugins: [
			Chartist.plugins.ctAxisTitle({
				axisX: {
					axisTitle: 'Problem Number',
					axisClass: 'ct-axis-title',
					offset: {
						x: 0,
						y: 60
					},
					textAnchor: 'middle'
				},
				axisY: {
					axisTitle: 'Number Correct',
					axisClass: 'ct-axis-title',
					offset: {
						x: 0,
						y: 0
					},
					textAnchor: 'middle',
					flipTitle: false
				}
			})
		]
	});

	$(".stupidTable").stupidtable();

	$(".stupidTable").each(function(index, element) { // Auto-sort by first column
		$(element).find("th:first").click();
	});
</script>

	<script type="text/javascript">
		$(window).load(function() {
			$("#whiteCover").delay(500).fadeOut(1000);
		});
	</script>
</body>
</html>