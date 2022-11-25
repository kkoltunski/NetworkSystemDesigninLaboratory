{extends file='main.tpl'}

{block name=content}

<div class="pure-g">
	<div class="l-box-lrg pure-u-1 pure-u-med-2-5">
		<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
			<fieldset>

				<label for="id_x">Amount: </label>
				<input id="id_x" type="text" name="x" value="{$form->amount}" /><br />
				<label for="id_y">Years count: </label>
				<input id="id_y" type="text" name="y" value="{$form->years}" /><br />
				<label for="id_z">Interest rate: </label>
				<input id="id_z" type="text" name="z" value="{$form->interestRate}" /><br />
				<input type="submit" value="Check" />

			</fieldset>
		</form>
	</div>

	{include file='messages.tpl'}

	{if isset($result)}
	<h4>Monthly:</h4>
	<p class="res">
		{$result}
	</p>
	{/if}

</div>

{/block}