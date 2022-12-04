{extends file="main.tpl"}

{block name=content}

<table id="tab_results" class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th> </th>
            <th>Result</th>
        </tr>
    </thead>
    <tbody>
        {foreach $results as $result}
        {strip}
        <tr>
            <td>{$result["creation"]} </td>
            <th> </th>
            <td>{$result["value"]} </td>
        </tr>
        {/strip}
        {/foreach}
    </tbody>
</table>

{/block}