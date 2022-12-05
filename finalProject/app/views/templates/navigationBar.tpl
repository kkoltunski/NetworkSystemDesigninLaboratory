<div class="navbar-collapse collapse">
	<ul class="nav navbar-nav pull-right">    
        <li class="active"><a href="#">Top page</a></li>
        <li class="active"><a href="{$conf->action_url}homeShow">Home</a></li>
        <li class="active"><a href="{$conf->action_url}resultsList">Search...</a></li>

        {if \core\RoleUtils::inRole('user') or \core\RoleUtils::inRole('admin')}
            {if \core\RoleUtils::inRole('admin')}
                <li class="active"><a href="{$conf->action_url}manageAccountsShow">Manage users</a></li>
                <li class="active"><a href="{$conf->action_url}resultsList">Manage products</a></li>
            {else}
                <li class="active"><a href="{$conf->action_url}resultsList">Reservations</a></li>
                <li class="active"><a href="{$conf->action_url}accountShow">Account settings</a></li>
		    {/if}		

            <li><a class="btn" href="{$conf->action_url}logout">LOG OUT</a></li>
        {else}
			<li class="active"><a href="{$conf->action_url}registrationShow">Register</a></li>
    		<li><a class="btn" href="{$conf->action_url}loginShow">LOG IN</a></li>
		{/if}		
	</ul>
</div>