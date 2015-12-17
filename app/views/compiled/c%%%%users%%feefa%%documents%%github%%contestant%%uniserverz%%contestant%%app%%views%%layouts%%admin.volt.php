<!DOCTYPE html>
<html>
<head>
	<title>Contestant - 
	Home
</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php echo $this->tag->stylesheetLink('css/materialize.min.css'); ?>
	<?php echo $this->tag->stylesheetLink('css/style.css'); ?>
	<?php echo $this->tag->stylesheetLink('css/snarl.min.css'); ?>
	<?php echo $this->tag->stylesheetLink('css/chartist.min.css'); ?>

	<?php echo $this->tag->javascriptInclude('js/jquery-2.1.1.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/materialize.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/snarl.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/chartist.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/chartist-plugin-axistitle.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/jquery.form.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/stupidtable.min.js'); ?>
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
			<img src="/img/placeholder_admin.jpg">
		</div>
		<ul class="menu">
			<li class="menu-item row">
				<a href="/admin" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">dashboard</i>
					<p class="col s10 valign">Dashboard</p>
				</a>
			</li>
			<li class="menu-item row">
				<a href="/admin/judge" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">gavel</i>
					<p class="col s10 valign">Judge</p>
				</a>
			</li>
			<li class="menu-item row">
				<a href="/admin/teams" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">group</i>
					<p class="col s10 valign">Teams</p>
				</a>
			</li>
			<li class="menu-item row">
				<a href="/admin/problems" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">code</i>
					<p class="col s10 valign">Problems</p>
				</a>
			</li>
			<li class="menu-item row">
				<a href="/admin/admins" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">face</i>
					<p class="col s10 valign">Admins</p>
				</a>
			</li>
			<li class="menu-item row">
				<a href="/admin/configuration" class="valign-wrapper grey-text text-darken-3">
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
		<?php echo $this->getContent(); ?>
	</div>
</div>


	
	<script type="text/javascript">
		$(document).ready(function() {
			$('select').material_select();
			$('.tooltipped').tooltip({delay: 50});
			$('.modal-trigger').leanModal();

			$(".stupidTable").stupidtable();

			$(".stupidTable").each(function(index, element) { // Auto-sort by first column
				$(element).find("th:first").click();
			});
		});
	</script>
	
	<script type="text/javascript">
		$(window).load(function() {
			$("#whiteCover").delay(500).fadeOut(250);
		});
	</script>
</body>
</html>