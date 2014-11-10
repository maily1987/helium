<h1>Main configuration</h1>
<form name="setup" method="post">
	<table>
		<tr>
			<td>Language :</td>
			<td><select name="language"><option value="en" {if $setup->language == 'en'}checked="checked"{/if}>English</option></select></td>
		</tr><tr>
			<td colspan="2"><input type="submit" value="Validate"/></td>
		</tr>
	</table>
</form>