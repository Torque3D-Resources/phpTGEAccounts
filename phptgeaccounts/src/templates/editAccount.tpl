{include file="header.tpl" title=$title}
		<table width="100%" cellpadding="2">
		  <tr>
			<td class="paneltitle">
			  Account Management :: Edit Account Details
			</td>
		  </tr>
		  <tr>
			<td class="panelbody">
			  <form method="GET" action="manage.php">
			  <input type="hidden" name="valid" value="true">
			  <input type="hidden" name="action" value="edit">
			  <input type="hidden" name="userid" value={$userid}>
			  <table>
			    <tr><td>Username:</td><td><input type="text" name="user" value={$user}></td></tr>
				<tr><td>Password<a href="#note1">*</a>:</td><td><input type="password" name="oldPass"></td></tr>
			    <tr><td>First Name:</td><td><input type="text" name="name_first" value={$name_first}></td></tr>
			    <tr><td>Last Name:</td><td><input type="text" name="name_last" value={$name_last}></td></tr>
			    <tr><td>E-Mail:</td><td><input type="text" name="email" value={$email}></td></tr>
				<tr><td><input type="submit" value="Edit"></td><td><input type="reset" value="Clear"></td></tr>
			  </table>
			  </form>
			  <a name="note1">*: This is not to change you password, to change your password, please click the "Change Password" link in the left bar.</a>
            </td>
		  </tr>
		</table>
{include file="footer.tpl"}