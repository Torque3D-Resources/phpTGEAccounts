{include file="header.tpl" title=$title}
		<table width="100%" cellpadding="2">
		  <tr>
			<td class="paneltitle">
			  Account Management :: View Account Details
			</td>
		  </tr>
		  <tr>
			<td class="panelbody">
			  <form method="GET" action="manage.php">
			  <input type="hidden" name="userid" value={$userid}>
			  <table>
			    <tr><td>Username:</td><td><input type="text" disabled name="user" value={$user}></td></tr>
			    <tr><td>First Name:</td><td><input type="text" disabled name="name_first" value={$name_first}></td></tr>
			    <tr><td>Last Name:</td><td><input type="text" disabled name="name_last" value={$name_last}></td></tr>
			    <tr><td>E-Mail:</td><td><input type="text" disabled name="email" value={$email}></td></tr>
				<tr><td><br /></td><td><br /></td></tr>
				<tr><td>Change Password:</td><td><input type="radio" name="action" value="changePass"></td></tr>
				<tr><td>Edit Information:</td><td><input type="radio" name="action" value="edit" checked></td></tr>
			    <tr><td><input type="submit" value="Edit"></td><td><input type="reset" value="Clear"></td></tr>
			  </table>
			  </form>
            </td>
		  </tr>
		</table>
{include file="footer.tpl"}