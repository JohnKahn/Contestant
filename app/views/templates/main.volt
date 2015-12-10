<!DOCTYPE html>
<html>
<head>
	<title>{% block title %}Contestant - {% endblock %}</title>

	<!-- Bootstrap -->
	{#{ stylesheet_link("css/bootstrap.min.css") }}
	{{ stylesheet_link("css/bootstrap_paper.min.css") }}
	{{ javascript_include("js/bootstrap.min.js") }#}

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	{{ stylesheet_link("css/style.css") }}
	{{ stylesheet_link("css/materialize.min.css") }}
	{{ stylesheet_link("css/snarl.min.css") }}
</head>
<body>
	{% block content %}{% endblock %}

	{{ javascript_include("js/jquery-2.1.1.min.js") }}
	{{ javascript_include("js/materialize.min.js") }}
	{{ javascript_include("js/snarl.min.js") }}
	{{ javascript_include("js/jquery.form.min.js") }}
	{% block scripts %}
	{{ javascript_include("js/script.js") }}
	{% endblock %}
</body>
</html>