{*Show errors if exists*}
{if $msgs->isError()}
<h4>Errors: </h4>
<ol class="err">
    {foreach $msgs->getErrors() as $msg}
    {strip}
    <li>{$msg}</li>
    {/strip}
    {/foreach}
</ol>
{/if}

{*Show informations if exist*}
{if $msgs->isInfo()}
<h4>Infos: </h4>
<ol class="inf">
    {foreach $msgs->getInfos() as $msg}
    {strip}
    <li>{$msg}</li>
    {/strip}
    {/foreach}
</ol>
{/if}