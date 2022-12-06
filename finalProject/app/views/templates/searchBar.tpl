<div class="custom-select" style="width:175px">
    <select name="genreSelect">
        <option value="0">Genre:</option>
        {if !empty($genresData)}
            {foreach $genresData as $genre}
                <option value={$genre}>{$genre}</option>
            {/foreach}
        {/if}
    </select>
</div>
<div class="custom-select" style="width:175px;">
    <select name="authorSelect">
        <option value="0">Author:</option>
        {if !empty($authorsData)}
            {foreach $authorsData as $author}
                <option value={$author}>{$author}</option>
            {/foreach}
        {/if}
    </select>
</div>
<div class="custom-select" style="width:175px;">
    <select name="yearSelect">
        <option value="0">Year:</option>
        {if !empty($yearsData)}
            {foreach $yearsData as $year}
                <option value={$year}>{$year}</option>
            {/foreach}
        {/if}
    </select>
</div>
<button class="btn btn-action" style="margin-left:100px" type="submit" name="buttonValue" value="search">Search...</button>
<button class="btn btn-action" style="margin-left:15px" type="submit" name="buttonValue" value="reset">Reset</button>
