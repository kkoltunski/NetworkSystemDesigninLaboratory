{extends file='main.tpl'}

{block name=content}

<h3 class="thin text-center">Accounts management</h3>
<hr>

<div class="myContainer">
    <div class="myTable">
        <div class="myTable-header">
            <div class="header__item"><label>idUser</label></div>
            <div class="header__item"><label>Username</label></div>
            <div class="header__item"><label>Password</label></div>
            <div class="header__item"><label>Email</label></div>
            <div class="header__item"><label>Verified</label></div>
            <div class="header__item"><label>Contact number</label></div>
            <form action="{$conf->action_url}addUserShow" method="post">
                <div class="header__item"><button class="btn btn-action" type="submit">+ New</button></div>
            </form>
        </div>
        <div class="myTable-content">
            {if !empty($data)}
                {foreach $data as $user}
                    <div class="myTable-row">
                        {foreach $user as $param}
                            {if !empty($param)}
                                <div class="myTable-data"><label>{$param}</label></div>
                            {else}
                                <div class="myTable-data"><label>-</label></div>
                            {/if}
                        {/foreach}
                        <div div class="myTable-data">
                            <form action="{$conf->action_url}resetPassword" method="post">
                                <button class="btn btn-action" style="margin-bottom:2px" name="buttonValue" type="submit"
                                    value={$user['idUser']}>Reset</button>
                            </form>
                            <form action="{$conf->action_url}verify" method="post">
                                <button class="btn btn-action" style="margin-bottom:2px" name="buttonValue" type="submit"
                                    value={$user['idUser']}>Verify</button>
                            </form>
                            <form action="{$conf->action_url}delete" method="post">
                                <button class="btn btn-action" style="margin-bottom:2px" name="buttonValue" type="submit"
                                    value={$user['idUser']}>Delete</button>
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