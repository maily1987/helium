<h1>categories</h1>
<a href="{url alias='categories_add'}"/>
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADlQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlx7TAAAABJ0Uk5TAAETJkRocH+Amamztcvm8/b4dwgg7gAAAGZJREFUGJVlzzsWgyAUBNALEiOggm//i02RVGHKOfMF29Hvux+bL9I+n6vW65l7gnRGy5BbnAl7vH5Sr9jZZoNSoM3N8WQYA/Lz1i8QAa7urpQRETEK9V6JxbKELrXLsHX6cu7v/gcH3AWzLpi+OgAAAABJRU5ErkJggga7b7b32f392efc87c0fb2a2fbb4c19d5"/>
    New Category
</a>
<br/><br/>
<table>
{foreach from=$categories item=$category}
    <tr><td>
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAAOQAAADkBx5TNewAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAACMSURBVDiN3dOxCQJREATQt3KBYgPGNmAhtmFuZAemF9iFBRjYiKkNmJhetCYHwlc59AuCA5PsMssyOxuZqQajKjUaiIg5Noiif0WbmZehDZaYYFxwhtXgBpj2gmdYRMS+qCW2mXnSm3jsi+/wkJlVJjZ84Qp/NKD7QNtxz8EaZ49JfIXEDuLnz1Q94AYrlit9y4jROgAAAABJRU5ErkJggged19ae0eb9b26a5a591ac2d5b656c300"/>
        {$category->get_name()}
    </td><td>
        {if count($category->sub_menu) < 1}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="if (confirm('Do you confirm that you want delete this category?')) window.location.href='{url alias='categorys'}?remove={$category->get_id()}';"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADxQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKNcQVgAAABN0Uk5TAAETJmhwf4CJj5mps7XLz+b2+G5VGk4AAABkSURBVBhXZY83DoBAEAPnEpfj/v+vFCAktC4tRwBcbGu16Hhgwj6jlHF2MACmS7UAtko3QBD/SvESwO3Kh7od8ViYCdIEey7aAJLkLAkYjVUAskgGKEsTyqJCVa0apqerc/zv3xr8BdfEC4s3AAAAAElFTkSuQmCC3fc07dd3f01250e98972e2a85d91785c"/></a>
        {/if}
    </td><td>
        &nbsp;&nbsp;<a href="{url alias='categories_update'}?update={$category->get_id()}"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADNQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8YBMDAAAABB0Uk5TAAggOEBgeH2AuMDW4PD3+BmnWgwAAABgSURBVBhXbc85EoAwDENREZZ8dt3/tBSOAwXq9OzxjKVP6l6k1bbta5TweRR5A2AZhCnnLtP2McK1Q3SU0HuDtwdkH8aAOefLHYDbPk5wngqYYNYXev4hfols7t+2rHoAMeYGWcLzDhwAAAAASUVORK5CYII14cd8b047f1782800d858b3438f2c525"/></a>
        <br/>
        {foreach from=$category->sub_menu item=$category_sub_menu}
            </td></tr><tr><td>
                &nbsp;&nbsp;&nbsp;&nbsp;<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAAOQAAADkBx5TNewAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAACMSURBVDiN3dOxCQJREATQt3KBYgPGNmAhtmFuZAemF9iFBRjYiKkNmJhetCYHwlc59AuCA5PsMssyOxuZqQajKjUaiIg5Noiif0WbmZehDZaYYFxwhtXgBpj2gmdYRMS+qCW2mXnSm3jsi+/wkJlVJjZ84Qp/NKD7QNtxz8EaZ49JfIXEDuLnz1Q94AYrlit9y4jROgAAAABJRU5ErkJggged19ae0eb9b26a5a591ac2d5b656c300"/>
                {$category_sub_menu->get_name()}
            </td><td>
                {if count($category_sub_menu->sub_menu) < 1}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="if (confirm('Do you confirm that you want delete this category?')) window.location.href='{url alias='categorys'}?remove={$category->get_id()}';"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADxQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKNcQVgAAABN0Uk5TAAETJmhwf4CJj5mps7XLz+b2+G5VGk4AAABkSURBVBhXZY83DoBAEAPnEpfj/v+vFCAktC4tRwBcbGu16Hhgwj6jlHF2MACmS7UAtko3QBD/SvESwO3Kh7od8ViYCdIEey7aAJLkLAkYjVUAskgGKEsTyqJCVa0apqerc/zv3xr8BdfEC4s3AAAAAElFTkSuQmCC3fc07dd3f01250e98972e2a85d91785c"/></a>
                {/if}
            </td><td>
                &nbsp;&nbsp;<a href="{url alias='categories_update'}?update={$category_sub_menu->get_id()}"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAbsAAAG7AEedTg1AAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAADNQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8YBMDAAAABB0Uk5TAAggOEBgeH2AuMDW4PD3+BmnWgwAAABgSURBVBhXbc85EoAwDENREZZ8dt3/tBSOAwXq9OzxjKVP6l6k1bbta5TweRR5A2AZhCnnLtP2McK1Q3SU0HuDtwdkH8aAOefLHYDbPk5wngqYYNYXev4hfols7t+2rHoAMeYGWcLzDhwAAAAASUVORK5CYII14cd8b047f1782800d858b3438f2c525"/></a>
                <br/>
        {/foreach}
    </td></tr>
{/foreach}
</table>