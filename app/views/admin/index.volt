<div class="row">
	<div class="col s12">
		<h4 class="valign-wrapper no-mar grey-text text-darken-1">
			<i class="material-icons valign" style="font-size: 1em; margin-right: 10px;">dashboard</i>
			<p class="valign">Dashboard</p>
		</h4>
	</div>
	<div class="col s12 m8">
		<div class="card">
			<div class="card-content">
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
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

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
</script>