{extends file='main.tpl'}

{block name=content}

<div class="panel-body">
	<form action="{$conf->action_url}searchFromHome" method="post">
		<h3 class="thin text-center">Genres</h3>
		<hr>
		<div class="menu-container">
    		<div class="button-container">
				{if !empty($genresData)}
            		{foreach $genresData as $genre}
        				<div class="action-container">
            				<button class="btn btn-action" style="float: left" type="submit" name="buttonValue" value="0.{$genre}">{$genre}</button>
        				</div>
            		{/foreach}
        		{/if}		
    		</div>
		</div>
		<hr>

		<h3 class="thin text-center">Authors</h3>
		<hr>
		<div class="menu-container">
    		<div class="button-container">
				{if !empty($authorsData)}
            		{foreach $authorsData as $author}
        				<div class="action-container">
            				<button class="btn btn-action" style="float: left" type="submit" name="buttonValue" value="1.{$author}">{$author}</button>
        				</div>
            		{/foreach}
        		{/if}		
    		</div>
		</div>
		<hr>

		<h3 class="thin text-center">Years</h3>
		<hr>
		<div class="menu-container">
    		<div class="button-container">
				{if !empty($yearsData)}
            		{foreach $yearsData as $year}
        				<div class="action-container">
            				<button class="btn btn-action" style="float: left" type="submit" name="buttonValue" value="2.{$year}">{$year}</button>
        				</div>
            		{/foreach}
        		{/if}		
    		</div>
		</div>
		<hr>
	</form>
</div>


{/block}