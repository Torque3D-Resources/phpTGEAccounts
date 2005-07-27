{include file="header.tpl" title=$title}
		<table width="100%" cellpadding="2">
		  <tr>
			<td class="paneltitle">
			  Account Management :: Change Password
			</td>
		  </tr>
		  <tr>
			<td class="panelbody">
			  <form method="GET" action="manage.php">
			  <input type="hidden" name="valid" value="true">
			  <input type="hidden" name="action" value="changePass">
			  <input type="hidden" name="userid" value={$userid}>
			  <table>
			    <tr><td>Old Password:</td><td><input type="password" name="oldPass"></td></tr>
			    <tr><td>New Password:</td><td><input type="password" name="newPass"></td></tr>
			    <tr><td>New Password:</td><td><input type="password" name="newPassConf"></td></tr>
			    <tr><td><input type="submit" value="Change"></td><td><input type="reset"value="Clear"></td></tr>
			  </table>
			  </form>
            </td>
		  </tr>
		</table>
{include file="footer.tpl"}