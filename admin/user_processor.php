<?php

include("globals.php");

if ($_REQUEST["action"] == "do_add"){
	if ($admin_user->usertype != 'Administrator'){
		header("Location: ../error_handler.php?eid=11");
		exit;
	}
	
	// Check for duplicate username
	$query = "SELECT `username` FROM `anyInventory_users` WHERE `username`='".$_REQUEST["username"]."'";
	$result = mysql_query($query) or die(mysql_error().'<br /><br />'.SUBMIT_REPORT . '<br /><br />'. $query);
	
	if (mysql_num_rows($result) > 0){
		header("Location: ../error_handler.php?eid=11");
		exit;
	}
	else{
		$query = "INSERT INTO `anyInventory_users` 
					(`username`,
					 `password`,
					 `usertype`,
					 `categories_view`,
					 `categories_admin`)
					VALUES
					('".$_REQUEST["username"]."',
					 '".md5($_REQUEST["password"])."',
					 '".$_REQUEST["usertype"]."',
					 '".addslashes(serialize($_REQUEST["c_view"]))."',
					 '".addslashes(serialize($_REQUEST["c_admin"]))."')";
		mysql_query($query) or die(mysql_error().'<br /><br />'.SUBMIT_REPORT . '<br /><br />'. $query);
	}
}
elseif($_REQUEST["action"] == "do_edit"){
	if ($_REQUEST["cancel"] != CANCEL){
		if ($admin_user->usertype != 'Administrator'){
			header("Location: ../error_handler.php?eid=11");
			exit;
		}
		
		// Check for duplicate username
		$query = "SELECT `username` FROM `anyInventory_users` WHERE `username`='".$_REQUEST["username"]."' AND `id` != '".$_REQUEST["id"]."'";
		$result = mysql_query($query) or die(mysql_error().'<br /><br />'.SUBMIT_REPORT . '<br /><br />'. $query);
		
		if (mysql_num_rows($result) > 0){
			header("Location: ../error_handler.php?eid=16");
			exit;
		}
		else{
			if (!is_array($_REQUEST["c_view"])) $_REQUEST["c_view"] = array();
			if (!is_array($_REQUEST["c_admin"])) $_REQUEST["c_admin"] = array();
			
			$query = "UPDATE `anyInventory_users` SET 
						`username`='".$_REQUEST["username"]."'";
			
			if ($_REQUEST["password"] != ''){
				$query .= ", `password`='".md5($_REQUEST["password"])."'";
			}
			
			if ($_REQUEST["id"] != ADMIN_USER_ID){
			
				$query .= ", `usertype`='".$_REQUEST["usertype"]."',
							`categories_view`='".addslashes(serialize($_REQUEST["c_view"]))."',
							`categories_admin`='".addslashes(serialize($_REQUEST["c_admin"]))."'";
			}
			
			$query .= " WHERE `id`='".$_REQUEST["id"]."'";
			mysql_query($query) or die(mysql_error().'<br /><br />'.SUBMIT_REPORT . '<br /><br />'. $query);
		}
	}
}
elseif($_REQUEST["action"] == "do_edit_own"){
	if ($_REQUEST["id"] != $_SESSION["user"]["id"]){
		header("Location: ../error_handler.php?eid=10");
		exit;
	}
	
	if ($_REQUEST["password"] != ''){
		$query = "UPDATE `anyInventory_users` SET `password`='".md5($_REQUEST["password"])."' WHERE `id`='".$_REQUEST["id"]."'";
		mysql_query($query) or die(mysql_error().'<br /><br />'.SUBMIT_REPORT . '<br /><br />'. $query);
	}
}
elseif($_REQUEST["action"] == "do_delete"){
	if ($admin_user->usertype != 'Administrator'){
		header("Location: ../error_handler.php?eid=11");
		exit;
	}
	
	if ($_REQUEST["delete"] == _DELETE){
		$query = "DELETE FROM `anyInventory_users` WHERE `id`='".$_REQUEST["id"]."'";
		$result = mysql_query($query) or die(mysql_error().'<br /><br />'.SUBMIT_REPORT . '<br /><br />'. $query);
	}
}

header("Location: users.php");
exit;

?>
