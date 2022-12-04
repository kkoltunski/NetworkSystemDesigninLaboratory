{extends file='main.tpl'}

{block name=content}

<div class="panel-body">
	<h3 class="thin text-center">Login</h3>
	<hr>

	<form action="{$conf->action_url}login" method="post">
		<div class="top-margin">
			<label>Login\Username</label>
			<input type="text" class="form-control" name="login">
		</div>
		<div class="top-margin">
			<label>Password</label>
			<input type="password" class="form-control" name="pass">
		</div>
		<hr>

		<div class="row">
			<div class="text-danger">
				<b>If you forgot password contact with us.</b>
			</div>
			<div class="col-lg-4 text-right">
				<button class="btn btn-action" type="submit">Login</button>
			</div>
		</div>
	</form>
</div>

{/block}