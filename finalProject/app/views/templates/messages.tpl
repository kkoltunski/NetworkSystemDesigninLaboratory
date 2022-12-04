{*Show errors if exists*}
{if $msgs->isError()}
<h4>Errors: </h4>
<ol class="err">
    {foreach $msgs->getMessages() as $msg}
    {strip}
    <li>{$msg->text}</li>
    {/strip}
    {/foreach}
</ol>
{/if}

{*Show informations if exist*}
{if $msgs->isInfo()}
<h4>Infos: </h4>
<ol class="inf">
    {foreach $msgs->getMessages() as $msg}
    {strip}
    <li>{$msg->text}</li>
    {/strip}
    {/foreach}
</ol>
{/if}