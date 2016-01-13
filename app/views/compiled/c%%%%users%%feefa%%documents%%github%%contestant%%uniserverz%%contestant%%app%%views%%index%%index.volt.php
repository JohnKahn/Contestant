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
	<?php echo $this->tag->javascriptInclude('js/jquery.hotkeys.js'); ?>
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

	

<div class="row fill-height">
	<div class="col s12 m5 l3 blue-grey darken-3 white-text" style="position: relative;">
		<h2 class="center-align" style="margin-bottom: 0;">Log In</h2>
		<form method="POST" action="/team">
			<div class="row">
				<div class="input-field col s12">
					<input id="username" name="user" type="text">
					<label for="username">Username</label>
				</div>
				<div class="input-field col s12">
					<input id="password" name="pass" type="password">
					<label for="password">Password</label>
				</div>
				<div class="center-align col s12">
					<button class="btn waves-effect waves-light green" style="margin-top:10px;" type="submit" name="action">Submit
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
			<div class="center-align"><?php echo $this->flashSession->output(); ?></div>
		</form>

		<a href="/admin/login" class="waves-effect waves-teal btn-flat white-text" style="position: absolute; bottom: 5px;">Admin Panel</a>
	</div>
	<div class="col s12 m7 l9 white">
		<h1 class="center-align">Welcome</h1>
		<p class="center-align">Head on over to the admin panel to set up your competition and change this to display anything you want. Such as rules, tips, allowed hardware, etc.</p>
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