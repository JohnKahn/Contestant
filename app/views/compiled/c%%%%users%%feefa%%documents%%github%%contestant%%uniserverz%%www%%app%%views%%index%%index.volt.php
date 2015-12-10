<!DOCTYPE html>
<html>
<head>
	<title>Contestant - 
	Home
</title>

	<!-- Bootstrap -->
	

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php echo $this->tag->stylesheetLink('css/style.css'); ?>
	<?php echo $this->tag->stylesheetLink('css/materialize.min.css'); ?>
	<?php echo $this->tag->stylesheetLink('css/snarl.min.css'); ?>
</head>
<body>
	

<div class="row fill-height">
	<div class="col s12 m5 l3 blue-grey darken-4 white-text" style="position: relative;">
		<h2 class="center-align" style="margin-bottom: 0;">Log In</h2>
		<form method="POST" action="/login">
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
		</form>

		<a class="waves-effect waves-teal btn-flat white-text" style="position: absolute; bottom: 5px;">Admin Panel</a>
	</div>
	<div class="col s12 m7 l9 white">
		
	</div>
</div>



	<?php echo $this->tag->javascriptInclude('js/jquery-2.1.1.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/materialize.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/snarl.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/jquery.form.min.js'); ?>
	
	<?php echo $this->tag->javascriptInclude('js/script.js'); ?>
	
</body>
</html>