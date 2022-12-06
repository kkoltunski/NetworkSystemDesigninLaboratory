{extends file='main.tpl'}

{block name=content}

<h3 class="thin text-center">Products management</h3>
<hr>

<form action="{$conf->action_url}processFiltering" method="post">
    {include file='searchBar.tpl'}
</form>

<div class="myContainer">
    <div class="myTable">
        <div class="myTable-header">
            <div class="header__item"><label>idVinyl</label></div>
            <div class="header__item"><label>Author</label></div>
            <div class="header__item"><label>Name</label></div>
            <div class="header__item"><label>Year</label></div>
            <div class="header__item"><label>Genre</label></div>
            <div class="header__item"><label>idRental</label></div>
            <form action="{$conf->action_url}addVinylShow" method="post">
                <div class="header__item"><button class="btn btn-action" type="submit">+ New</button></div>
            </form>
        </div>
        <div class="myTable-content">
            {if !empty($data)}
                {foreach $data as $vinyl}
                    <div class="myTable-row">
                        {foreach $vinyl as $param}
                        {if !empty($param)}
                        <div class="myTable-data"><label>{$param}</label></div>
                        {else}
                        <div class="myTable-data"><label>-</label></div>
                        {/if}
                        {/foreach}
                        <div div class="myTable-data">
                            <form action="{$conf->action_url}deleteVinyl" method="post">
                                <button class="btn btn-action" name="buttonValue" type="submit"
                                    value={$vinyl['idVinyl']}>Delete</button>
                            </form>
                        </div>
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