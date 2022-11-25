{extends file='main.tpl'}

{block name=content}
<form action="{$conf->action_url}login" method="post" class="pure-form pure-form-aligned bottom-margin">
	<fieldset>
		<div class="pure-control-group">
			<label for="id_login">Login: </label>
			<input id="id_login" type="text" name="login" />
		</div>
		<div class="pure-control-group">
			<label for="id_pass">Password: </label>
			<input id="id_pass" type="password" name="pass" /><br />
		</div>
		<div class="pure-controls">
			<input type="submit" value="Login" />
		</div>
	</fieldset>
</form>

{include file='messages.tpl'}

{/block}