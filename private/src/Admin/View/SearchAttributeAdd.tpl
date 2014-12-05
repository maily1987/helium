<h1>New Search Attribute</h1>
<a href="{url alias='search_attribute'}">
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAG7AAABuwBHnU4NQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAADMSURBVDiNrdMxTgNBDAXQN1whFTVoL4CULi2H4AQp9wZwjb0A0tYRp1hRUNAg0aaiRFGoTOOgZTWpJpbc+P/v8Z8Zl4gwj1JKhwfcZcJr5nNEfPwTRIRsUtDjgCMmDJlT1g7JKX+6mfgFgRGrE2F2wCqxSG6ZN+gT2C6FlUbb5PYn+12ONp4R3GKzqI2p6eAp/dXGXuML7xU7RzzCDlNFfI9vfOKmgk+ptcewADf4wRuuz1gbsL9ygWi20HyJbc/Y/JEu8pVblqm0rvMvsx5umAXYLZ4AAAAASUVORK5CYIIb8f3721d9c8dfa174c8d9661d1a59891"/>
    Return
</a>
<br/><br/>
{if count($_POST) < 1}
    {$form}
{else}
    The attribute add in database!
{/if}