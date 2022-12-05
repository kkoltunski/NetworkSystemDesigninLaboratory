{extends file='main.tpl'}

{block name=content}

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
                        <button class="btn btn-action" name="buttonValue" type="submit"
                            value={$user['idUser']}>Reset</button>
                    </form>
                    <form action="{$conf->action_url}verify" method="post">
                        <button class="btn btn-action" name="buttonValue" type="submit"
                            value={$user['idUser']}>Verify</button>
                    </form>
                    <form action="{$conf->action_url}delete" method="post">
                        <button class="btn btn-action" name="buttonValue" type="submit"
                            value={$user['idUser']}>Delete</button>
                    </form>
                </div>
            </div>
            {/foreach}
        </div>
    </div>
</div>

{/block}