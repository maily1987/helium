<h1>Search Attributes</h1>
<a href="{url alias='search_attribute_add'}"/>
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADlQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlx7TAAAABJ0Uk5TAAETJkRocH+Amamztcvm8/b4dwgg7gAAAGZJREFUGJVlzzsWgyAUBNALEiOggm//i02RVGHKOfMF29Hvux+bL9I+n6vW65l7gnRGy5BbnAl7vH5Sr9jZZoNSoM3N8WQYA/Lz1i8QAa7urpQRETEK9V6JxbKELrXLsHX6cu7v/gcH3AWzLpi+OgAAAABJRU5ErkJggga7b7b32f392efc87c0fb2a2fbb4c19d5"/>
    New Search Attribute
</a>
<br/><br/>
<table style="border:solid 1px black;">
{foreach from=$search_attributes_rules item=$search_attribute}
    <tr><td valign="top" style="border:solid 1px black;padding:5px;">
        {$search_attribute->get_name()}
    </td><td style="border:solid 1px black;padding:5px;">
        {foreach from=$search_attribute->rules item=$rule}
            {$rule->get_name()} ({$rule->get_value_min()} - {$rule->get_value_max()} - {$rule->get_value()})
            &nbsp;&nbsp;
            <a href="#" onclick="if (confirm('Do you confirm that you want delete this search attribute rule?')) window.location.href='{url alias='search_attribute'}?remove_rule={$rule->get_id()}';"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADxQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKNcQVgAAABN0Uk5TAAETJmhwf4CJj5mps7XLz+b2+G5VGk4AAABkSURBVBhXZY83DoBAEAPnEpfj/v+vFCAktC4tRwBcbGu16Hhgwj6jlHF2MACmS7UAtko3QBD/SvESwO3Kh7od8ViYCdIEey7aAJLkLAkYjVUAskgGKEsTyqJCVa0apqerc/zv3xr8BdfEC4s3AAAAAElFTkSuQmCC3fc07dd3f01250e98972e2a85d91785c"/></a>
            &nbsp;&nbsp;
            <a href="{url alias='search_attribute_rule_update'}?update={$search_attribute->get_id()}"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADNQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8YBMDAAAABB0Uk5TAAggOEBgeH2AuMDW4PD3+BmnWgwAAABgSURBVBhXbc85EoAwDENREZZ8dt3/tBSOAwXq9OzxjKVP6l6k1bbta5TweRR5A2AZhCnnLtP2McK1Q3SU0HuDtwdkH8aAOefLHYDbPk5wngqYYNYXev4hfols7t+2rHoAMeYGWcLzDhwAAAAASUVORK5CYII14cd8b047f1782800d858b3438f2c525"/></a>
            <br/>
        {/foreach}
        <a href="{url alias='search_attribute_rule_add'}"/>
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADlQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlx7TAAAABJ0Uk5TAAETJkRocH+Amamztcvm8/b4dwgg7gAAAGZJREFUGJVlzzsWgyAUBNALEiOggm//i02RVGHKOfMF29Hvux+bL9I+n6vW65l7gnRGy5BbnAl7vH5Sr9jZZoNSoM3N8WQYA/Lz1i8QAa7urpQRETEK9V6JxbKELrXLsHX6cu7v/gcH3AWzLpi+OgAAAABJRU5ErkJggga7b7b32f392efc87c0fb2a2fbb4c19d5"/>
            New Search Attribute Rule
        </a>
    </td><td style="border:solid 1px black;padding:5px;">
        <a href="#" onclick="if (confirm('Do you confirm that you want delete this search attribute?')) window.location.href='{url alias='search_attribute'}?remove={$search_attribute->get_id()}';"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADxQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKNcQVgAAABN0Uk5TAAETJmhwf4CJj5mps7XLz+b2+G5VGk4AAABkSURBVBhXZY83DoBAEAPnEpfj/v+vFCAktC4tRwBcbGu16Hhgwj6jlHF2MACmS7UAtko3QBD/SvESwO3Kh7od8ViYCdIEey7aAJLkLAkYjVUAskgGKEsTyqJCVa0apqerc/zv3xr8BdfEC4s3AAAAAElFTkSuQmCC3fc07dd3f01250e98972e2a85d91785c"/></a>
        &nbsp;&nbsp;
        <a href="{url alias='search_attribute_update'}?update={$search_attribute->get_id()}"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADNQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8YBMDAAAABB0Uk5TAAggOEBgeH2AuMDW4PD3+BmnWgwAAABgSURBVBhXbc85EoAwDENREZZ8dt3/tBSOAwXq9OzxjKVP6l6k1bbta5TweRR5A2AZhCnnLtP2McK1Q3SU0HuDtwdkH8aAOefLHYDbPk5wngqYYNYXev4hfols7t+2rHoAMeYGWcLzDhwAAAAASUVORK5CYII14cd8b047f1782800d858b3438f2c525"/></a>
    </td></tr>
    
{/foreach}
</table>