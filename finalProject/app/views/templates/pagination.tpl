<style>
  .center {
    text-align: center;
  }

  .pagination {
    display: inline-block;
  }

  .pagination a {
    color: #FFEFD7;
    float: left;
    padding: 8px 16px;
    margin-left: 10px;
    text-decoration: none;
    background-color: rgb(185, 130, 67);
    border: 1px solid rgb(185, 130, 67);
    border-radius: 5px;
  }

  .pagination a.active {
    background-color: rgb(187, 158, 125);
    color: #FFEFD7;
    border: 1px solid rgb(187, 158, 125);
    border-radius: 5px;
  }

  .pagination a:hover:not(.active) {
    background-color: rgb(187, 158, 125);
    border: 1px solid rgb(187, 158, 125);
    border-radius: 5px;
  }
</style>

<div class="center">
  <div class="pagination">
    <a href="{$conf->action_url}selectPage?selected={$pagination->currentPage - 1}">&laquo;</a>

    {for $counter=($pagination->firstPage) to ($pagination->lastPage)}
      {if $pagination->currentPage == $counter}
        <a class="active">{$counter + 1}</a>
      {else}
        <a href="{$conf->action_url}selectPage?selected={$counter}">{$counter + 1}</a>
      {/if}
    {/for}

    <a href="{$conf->action_url}selectPage?selected={$pagination->currentPage + 1}">&raquo;</a>
  </div>
</div>