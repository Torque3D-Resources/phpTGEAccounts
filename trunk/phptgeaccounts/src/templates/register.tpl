{include file="header.tpl" title=$title}
		<table width="100%" cellpadding="2">
		  <tr>
			<td class="paneltitle">
			  Create Your Account for This Gateway
			</td>
		  </tr>
		  <tr>
			<td class="panelbody">
			  <form method="GET" action="register.php">
			  <input type="hidden" name="valid" value="true">
			  <table>
			    <tr><td>Username:</td><td><input type="text" name="user" value={$user}></td></tr>
			    <tr><td>Password:</td><td><input type="password" name="pass"></td></tr>
				<tr><td>Password:</td><td><input type="password" name="passConf"></td></tr>
			    <tr><td>First Name:</td><td><input type="text" name="name_first" value={$name_first}></td></tr>
			    <tr><td>Last Name:</td><td><input type="text" name="name_last" value={$name_last}></td></tr>
			    <tr><td>E-Mail:</td><td><input type="text" name="email" value={$email}></td></tr>
			    <tr><td><input type="submit" value="Register"></td><td><input type="reset" value="Clear"></td></tr>
			  </table>
			  </form>
            </td>
		  </tr>
		</table>
{include file="footer.tpl"}


