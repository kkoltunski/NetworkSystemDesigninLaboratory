{extends file='main.tpl'}

{block name=content}

<div class="panel-body">
	<h3 class="thin text-center">Account details</h3>
	<hr>

	<form action="{$conf->action_url}accountUpdate" method="post">
		<div class="top-margin">
			<label>New password</label>
			<input type="password" class="form-control" name="pass1">
		</div>
		<div class="top-margin">
			<label>Repeat new password</label>
			<input type="password" class="form-control" name="pass2">
		</div>
		<div class="top-margin">
			<label>New email</label>
			<input type="text" class="form-control" name="email">
		</div>
		<div class="top-margin">
			<label>New contact number</label>
			<input type="text" class="form-control" name="number">
		</div>
		<hr>

		<div class="row">
			<div class="col-lg-4 text-right">
				<button class="btn btn-action" type="Save">Update</button>
			</div>
		</div>
	</form>
</div>

{/block}