{extends file='main.tpl'}

{block name=content}

<h3 class="thin text-center">{$page_title}</h3>
<hr>

<form action="{$conf->action_url}reservationsProcessFiltering" method="post">
    {include file='searchBar.tpl'}
</form>

<div class="myContainer">
    <div class="myTable">
        <div class="myTable-header">
            <div class="header__item"><label>Author</label></div>
            <div class="header__item"><label>Name</label></div>
            <div class="header__item"><label>Year</label></div>
            <div class="header__item"><label>Genre</label></div>
        </div>
        <div class="myTable-content">
            {if !empty($data)}
                {foreach $data as $vinyl}
                    <div class="myTable-row">
                        {foreach $vinyl as $param}
                            {if !\core\RoleUtils::inRole('admin') and (((strcmp($param, $vinyl['idRental']) == 0) or (strcmp($param, $vinyl['idVinyl']) == 0)))}
                            {else}
                                {if !empty($param)}
                                    <div class="myTable-data"><label>{$param}</label></div>
                                {else}
                                    <div class="myTable-data"><label>-</label></div>
                                {/if}
                            {/if}
                        {/foreach}
                    </div>
                {/foreach}
            {else}
                <div class="myTable-data" style="padding: 10px"><label>No data to display.</label></div>
            {/if}
        </div>
    </div>
</div>

<hr>

{/block}