{% extends "layouts/main.volt" %}

{% block title %}{{ super() }}
	Home
{% endblock %}

{% block content %}
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
				<div class="center-align">{{ flashSession.output() }}</div>
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
{% endblock %}