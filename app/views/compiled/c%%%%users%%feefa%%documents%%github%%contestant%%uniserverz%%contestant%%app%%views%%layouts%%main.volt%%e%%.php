a:7:{i:0;s:41:"<!DOCTYPE html>
<html>
<head>
	<title>";s:5:"title";a:1:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:13:"Contestant - ";s:4:"file";s:30:"../app/views/layouts/main.volt";s:4:"line";i:4;}}i:1;s:932:"</title>

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

	";s:7:"content";N;i:2;s:511:"

	<?php echo $this->tag->javascriptInclude('js/jquery-2.1.1.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/materialize.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/snarl.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/chartist.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/chartist-plugin-axistitle.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/jquery.form.min.js'); ?>
	<?php echo $this->tag->javascriptInclude('js/stupidtable.min.js'); ?>
	";s:7:"scripts";a:3:{i:0;a:4:{s:4:"type";i:357;s:5:"value";s:3:"
	";s:4:"file";s:30:"../app/views/layouts/main.volt";s:4:"line";i:37;}i:1;a:4:{s:4:"type";i:359;s:4:"expr";a:5:{s:4:"type";i:350;s:4:"name";a:4:{s:4:"type";i:265;s:5:"value";s:18:"javascript_include";s:4:"file";s:30:"../app/views/layouts/main.volt";s:4:"line";i:37;}s:9:"arguments";a:1:{i:0;a:3:{s:4:"expr";a:4:{s:4:"type";i:260;s:5:"value";s:12:"js/script.js";s:4:"file";s:30:"../app/views/layouts/main.volt";s:4:"line";i:37;}s:4:"file";s:30:"../app/views/layouts/main.volt";s:4:"line";i:37;}}s:4:"file";s:30:"../app/views/layouts/main.volt";s:4:"line";i:37;}s:4:"file";s:30:"../app/views/layouts/main.volt";s:4:"line";i:38;}i:2;a:4:{s:4:"type";i:357;s:5:"value";s:3:"
	";s:4:"file";s:30:"../app/views/layouts/main.volt";s:4:"line";i:38;}}i:3;s:149:"
	<script type="text/javascript">
		$(window).load(function() {
			$("#whiteCover").delay(500).fadeOut(1000);
		});
	</script>
</body>
</html>";}