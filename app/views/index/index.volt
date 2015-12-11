{% extends "layouts/main.volt" %}

{% block title %}{{ super() }}
	Home
{% endblock %}

{% block content %}

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
			<div class="center-align"><?php $this->flashSession->output() ?></div>
		</form>

		<a class="waves-effect waves-teal btn-flat white-text" style="position: absolute; bottom: 5px;">Admin Panel</a>
	</div>
	<div class="col s12 m7 l9 white">
		<h1 class="center-align">Welcome</h1>
		<p class="center-align">Head on over to the admin panel to set up your competition and change this to display anything you want. Such as rules, tips, allowed hardware, etc.</p>
	</div>
</div>

{% endblock %}