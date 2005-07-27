{include file="header.tpl" title=$title}
		<table width="100%" cellpadding="2">
		  <tr>
			<td class="paneltitle">
			  Log In
			</td>
		  </tr>
		  <tr>
			<td class="panelbody">
			  <form method="GET" action="login.php">
			  <input type="hidden" name="valid" value="true">
			  <table>
			    <tr><td>Username:</td><td><input type="text" name="user" value={$user}></td></tr>
			    <tr><td>Password:</td><td><input type="password" name="pass"></td></tr>
			    <tr><td><input type="submit" value="Log In"></td><td><input type="reset" value="Clear"></td></tr>
			  </table>
			  </form>
            </td>
		  </tr>
		</table>
{include file="footer.tpl"}


