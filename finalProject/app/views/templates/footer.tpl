<div class="footer2 top-space">
	<div class="container">
		<div class="row">

			<div class="col-md-6 widget">
				<div class="widget-body">
					<p class="simplenav">
						<a href="#">Top page</a> |
						<b><a href="{$conf->action_url}homeShow">Home</a></b> |
						<b><a href="{$conf->action_url}resultsList">Search...</a></b> |
						{if \core\RoleUtils::inRole('user') or \core\RoleUtils::inRole('admin')}
						<b><a href="{$conf->action_url}logout">LOG OUT</a></b>
						{else}
						<b><a href="{$conf->action_url}registrationShow">Register</a></b> |
						<b><a href="{$conf->action_url}loginShow">LOG IN</a></b>
						{/if}
					</p>
				</div>
			</div>

			<div class="col-md-6 widget">
				<div class="widget-body">
					<p class="text-right">
						Copyright &copy; 2022, Klaudiusz Kołtuński. Designed by <a href="http://gettemplate.com/"
							rel="designer">gettemplate</a>
					</p>
				</div>
			</div>

		</div>
	</div>
</div>