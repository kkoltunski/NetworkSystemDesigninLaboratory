{extends file='main.tpl'}

{block name=content}

<div class="panel-body">
	<h3 class="thin text-center">Add new vinyl</h3>
	<hr>

	<form action="{$conf->action_url}addVinyl" method="post">
		<div class="top-margin">
			<label>Author<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="author">
		</div>
		<div class="top-margin">
			<label>Name<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="name">
		</div>
		<div class="top-margin">
			<label>Year<span class="text-danger">*</span></label>
			<input type="number" min="1885" max="2023" class="form-control" name="year">
		</div>
		<div class="top-margin">
			<label>Genre<span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="genre">
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