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

	
<div class="valign-wrapper blue-grey darken-2" style="height: 100vh; width: 100vw;">
	<div class="card medium valign white z-depth-4" style="margin: 0 auto;">
		<form method="POST" action="/admin">
			<div class="card-content">
				<div class="row no-mar">
					<h4 class="center-align">Admin Login</h4>
					<div class="input-field col s12">
						<input id="username" name="user" type="text">
						<label for="username">Username</label>
					</div>
					<div class="input-field col s12">
						<input id="password" name="pass" type="password">
						<label for="password">Password</label>
					</div>
				</div>
				<div class="center-align"><?php echo $this->flashSession->output(); ?></div>
			</div>
			<div class="card-action">
				<div class="center-align col s12">
					<button class="btn waves-effect waves-light green" style="margin-top:10px;" type="submit" name="action">Submit
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
		</form>
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
		$(window).load(function() {
			$("#whiteCover").delay(500).fadeOut(1000);
		});
	</script>
</body>
</html>