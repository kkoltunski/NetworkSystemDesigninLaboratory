{extends file='main.tpl'}

{block name=content}

<div class="pure-g">
	<div class="l-box-lrg pure-u-1 pure-u-med-2-5">
		<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">

		{include file='searchBar.tpl'}

		</form>
	</div>
</div>

{/block}