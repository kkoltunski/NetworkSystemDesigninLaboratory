{extends file='main.tpl'}

{block name=content}

<div class="panel-body">
	<h3 class="thin text-center">Add new user</h3>
	<hr>

	<form action="{$conf->action_url}addUser" method="post">
		<div class="top-margin">
			<label>Login\Username <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="login">
		</div>
		<div class="top-margin">
			<label>Password <span class="text-danger">*</span></label>
			<input type="password" class="form-control" name="pass1">
		</div>
		<div class="top-margin">
			<label>Repeat password <span class="text-danger">*</span></label>
			<input type="password" class="form-control" name="pass2">
		</div>
		<div class="top-margin">
			<label>Email <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="email">
		</div>
		<div class="top-margin">
			<label>Contact number </label>
			<input type="text" class="form-control" name="number">
		</div>
		<hr>

		<div class="row">
			<div class="col-lg-4 text-right">
				<button class="btn btn-action" type="submit">Add</button>
			</div>
		</div>
	</form>
</div>

{/block}