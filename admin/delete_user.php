<?php

include("globals.php");

$title = "anyInventory: Delete User";
$breadcrumbs = 'Administration > <a href="users.php">Users</a> > Delete User';

$user = new user($_REQUEST["id"]);

$output .= '
	<form action="user_processor.php" method="post">
		<input type="hidden" name="action" value="do_delete" />
		<input type="hidden" name="id" value="'.$_REQUEST["id"].'" />
		<table class="standardTable" cellspacing="0" cellpadding="0">
			<tr class="tableHeader">
				<td>Delete User</td>
				<td style="text-align: right;">[<a href="../docs/deleting_users.php">Help</a>]</td>
			</tr>
			<tr>
				<td class="tableData" colspan="2">
					<p>Are you sure you want to delete this user?</p>
					'.$user->export_description().'
					<p class="submitButtonRow">
						<input type="submit" name="delete" value="Delete" />
						<input type="submit" name="cancel" value="Cancel" />
					</p>
				</td>
			</tr>
		</table>
	</form>';

display($output);

?>