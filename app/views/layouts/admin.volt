{% extends "layouts/main.volt" %}

{% block title %}{{ super() }}
	Home
{% endblock %}

{% block content %}
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
				<a href="/admin/judge" class="valign-wrapper grey-text text-darken-3">
					<i class="material-icons col s2 valign">gavel</i>
					<p class="col s10 valign">Judge</p>
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
		{{ this.getContent() }}
	</div>
</div>
{% endblock %}