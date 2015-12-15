<!DOCTYPE html>
<html>
<head>
	<title>{% block title %}Contestant - {% endblock %}</title>

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	{{ stylesheet_link("css/materialize.min.css") }}
	{{ stylesheet_link("css/style.css") }}
	{{ stylesheet_link("css/snarl.min.css") }}
	{{ stylesheet_link("css/chartist.min.css") }}
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

	{% block content %}{% endblock %}

	{{ javascript_include("js/jquery-2.1.1.min.js") }}
	{{ javascript_include("js/materialize.min.js") }}
	{{ javascript_include("js/snarl.min.js") }}
	{{ javascript_include("js/chartist.min.js") }}
	{{ javascript_include("js/chartist-plugin-axistitle.js") }}
	{{ javascript_include("js/jquery.form.min.js") }}
	{{ javascript_include("js/stupidtable.min.js") }}
	{% block scripts %}
	{{ javascript_include("js/script.js") }}
	{% endblock %}
	<script type="text/javascript">
		$(window).load(function() {
			$("#whiteCover").delay(500).fadeOut(1000);
		});
	</script>
</body>
</html>