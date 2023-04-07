{extends file='main.tpl'}

{block name=content}

<h3 class="thin text-center">{$page_title}</h3>
<hr>

<form action="{$conf->action_url}processFiltering" method="post">
    {include file='searchBar.tpl'}
</form>

<div class="myContainer" id="myContainer">
    {include file='myTable.tpl'}
</div>

<div class="center">
  <div class="pagination">
    <a onclick="selectPage({$pagination->currentPage - 1}, '{$conf->action_url}selectPage', 'myContainer');">&laquo;</a>

    {for $counter=($pagination->firstPage) to ($pagination->lastPage)}
      {if $pagination->currentPage == $counter}
        <a class="active">{$counter + 1}</a>
      {else}
        <a onclick="selectPage({$counter}, '{$conf->action_url}selectPage', 'myContainer');">{$counter + 1}</a>
      {/if}
    {/for}

    <a onclick="selectPage({$pagination->currentPage + 1}, '{$conf->action_url}selectPage', 'myContainer');">&raquo;</a>
  </div>
</div>

<hr>

{/block}