<?php

error_reporting(E_ALL ^ E_NOTICE);

require_once('DB.php');

require_once("functions.php");
require_once("item_class.php");

$errors = array();

// Set the text of globals.php
$writetoglobals = '<?php

session_start();

error_reporting(E_ALL ^ E_NOTICE);

$DIR_PREFIX .= "./";

$db_host = "'.$_POST["db_host"].'";
$db_name = "'.$_POST["db_name"].'";
$db_user = "'.$_POST["db_user"].'";
$db_pass = "'.$_POST["db_pass"].'";
$db_type = "'.$_POST["db_type"].'";

include($DIR_PREFIX."environment.php");

?>';

if (is_array($_POST)) foreach($_POST as $key => $value) $_POST[$key] = stripslashes($value);

if ($_POST["action"] == "upgrade"){
	if (strlen(trim($_POST["db_host"])) == 0){
		$errors[] = 'Please enter the name of your database server.';
	}
	if (strlen(trim($_POST["db_user"])) == 0){
		$errors[] = 'Please enter your database username.';
	}
	if (strlen(trim($_POST["db_name"])) == 0){
		$errors[] = 'Please enter the database name.';
	}
	if (strlen(trim($_POST["db_pass"])) == 0){
		$errors[] = 'Please enter the database password.';
	}
	if (strlen(trim($_POST["db_type"])) == 0){
		$errors[] = 'Please enter the database type.';
	}
	if ($_POST["password_protect_admin"] || $_POST["password_protect_view"]){
		if (strlen(trim($_POST["username"])) == 0){
			$errors[] = 'Please enter a username.';
		}
		if (strlen(trim($_POST["password"])) == 0){
			$errors[] = 'Please enter a password.';
		}
	}
	
	$files_to_read = array("./","./admin","./docs","./docs/en","./images","./fonts","./item_files");
	
	foreach($files_to_read as $file){
		if (!is_readable(realpath($file))){
			$errors[] = "The path ".realpath($file)." (".$file.") is not readable.";
		}
	}
	
	if (!is_writable(realpath("./item_files/"))){
		$errors[] = 'The path '.realpath("./item_files/").' is not writable by the Web server.';
	}
	
	// Check for the correct database information.	
	if (count($errors) == 0){
		// check for Oracle 8 - data source name syntax is different
		if ($_POST["db_type"] != 'oci8'){
			$dsn = $_POST["db_type"]."://".$_POST['db_user'].":".$_POST['db_pass']."@".$_POST['db_host']."/".$_POST['db_name'];
		}
		else {
			$dsn = $_POST["db_type"]."://".$_POST['db_user'].":".$_POST['db_pass']."@www";
		}
		
	    // establish the connection
		$db = DB::connect($dsn);
		
		if($DB::isError($db)){
			$errors[] = 'anyInventory could not connect to the SQL server with the information you provided.';
		}
	}
	
	// Make the appropriate changes, depending on the old version.	
	if (count($errors) == 0){
		
		switch($_POST["old_version"]){
			case '1.0':
			case '1.2':
			case '1.3':
				## Changes introduced in 1.4
				$query = "CREATE TABLE `anyInventory_alerts` (
					`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
					`item_ids` text NOT NULL ,
					`title` varchar( 255 ) NOT NULL default '',
					`field_id` int( 11 ) NOT NULL default '0',
					`condition` enum( '==', '!=', '<', '>', '<=', '>=' ) NOT NULL default '==',
					`value` varchar( 255 ) NOT NULL default '',
					`time` timestamp( 14 ) NOT NULL ,
					UNIQUE KEY `id` ( `id` )
					) TYPE = MYISAM ;";
				@$db->query($query);
				
				$query = "ALTER TABLE `anyInventory_files` ADD `offsite_link` VARCHAR(255) NOT NULL";
				@$db->query($query);
				
				// Fix field values data type
				
				$query = "SELECT `id`,`values` FROM `anyInventory_fields`";
				$result = $db->query($query);
				
				while ($row = $result->fetchRow()){
					$field_values = unserialize($row["values"]);
					
					if (!is_array($field_values)){
						$field_values = explode(",",$row["values"]);
						
						if (is_array($field_values)){
							foreach($field_values as $key => $thing) $field_values[$key] = trim($thing);
						}
						else{
							$field_values = array();
						}
						
						$sql_values = serialize($field_values);
						
						$new_query = "UPDATE `anyInventory_fields` SET `values`='".$sql_values."' WHERE `id`='".$row["id"]."'";
						$db->query($query);
					}
				}
				
				// Fix field categories data type
				
				$query = "SELECT `id`,`categories` FROM `anyInventory_fields`";
				$result = $db->query($query);
				
				while ($row = $result->fetchRow()){
					$categories = unserialize($row["categories"]);
					
					if (!is_array($categories)){
						$categories = explode(",",$row["categories"]);
						
						if (is_array($categories)){
							foreach($categories as $key => $thing) $categories[$key] = trim($thing);
							$categories = array_unique($categories);
							sort($categories);
						}
						else{
							$categories = array();
						}
						
						$sql_categories = serialize($categories);
						
						$new_query = "UPDATE `anyInventory_fields` SET `categories`='".$sql_categories."' WHERE `id`='".$row["id"]."'";
						$db->query($new_query);
					}
				}
				
				break;
			case '1.4.':
			case '1.4.1':
			case '1.5':
				# Changes introduced in 1.6
				
				// Added timed alerts
				$query = "ALTER TABLE `anyInventory_alerts` ADD `timed` INT( 1 ) DEFAULT '0' NOT NULL";
				@$db->query($query);
				
				$query = "ALTER TABLE `anyInventory_fields` CHANGE `input_type` `input_type` ENUM( 'text', 'textarea', 'checkbox', 'radio', 'select', 'multiple', 'file' ) DEFAULT 'text' NOT NULL ";
				@$db->query($query);
				
				$query = "SELECT COUNT(`key`) AS `num_files` FROM `anyInventory_files` GROUP BY `key` ORDER BY `key` DESC LIMIT 1";
				$result = $db->query($query);
				
				while ($row = $result->fetchRow()){
					$max_files = $row["num_files"];
					
					if ($max_files > 0){
						$catquery = "SELECT `id` FROM `anyInventory_categories`";
						$catresult = $db->query($catquery);
						
						$cat_ids = array();
						$field_values = array();
						
						while ($catrow = $catresult->fetchRow()){
							$cat_ids[] = $catrow["id"];
						}
						
						for($i = 1; $i <= $max_files + 1; $i++){
							$query = "ALTER TABLE `anyInventory_items` ADD `Generic File ".$i."` INT NOT NULL";
							@$db->query($query);
							
							$query_data = array("id"=>get_unique_id('anyInventory_fields'),
												"name"=>"Generic File ".$i,
												"input_type"=>"file",
												"categories"=>serialize($cat_ids),
												"values"=>serialize($field_values));
							$result = $db->autoExecute('anyInventory_fields',$query_data,DB_AUTOQUERY_INSERT);
							if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
						}
						
						$query = "SELECT `id`,`key` FROM `anyInventory_files` ORDER BY `key`,`id`";
						$file_result = $db->query($query);
						
						$current_key = 0;
						
						while($file_row = $file_result->fetchRow()){
							if ($current_key != $file_row["key"]){
								$i = 1;
								$current_key = $file_row["key"];
							}
							
							$query = "UPDATE `anyInventory_items` SET `Generic File ".$i."`='".$file_row["id"]."' WHERE `id`='".$file_row["key"]."'";
							$db->query($query);
							
							$i++;
						}
					}
				}
			case '1.6':
				# Changes introduced in 1.7
				
				$query = "ALTER TABLE `anyInventory_alerts` ADD `category_ids` TEXT NOT NULL";
				@$db->query($query);
				
				// Run script to add a category array for each alert
				
				$query = "SELECT * FROM `anyInventory_alerts`";
				$result = $db->query($query);
				
				while ($row = $result->fetchRow()){
					if (!is_array(unserialize($row["category_ids"]))){
						$items = unserialize($row["item_ids"]);
						
						$item = new item($items[0]);
						
						$category_ids = array($item->category->id);
						
						$newquery = "UPDATE `anyInventory_alerts` SET `category_ids`='".serialize($category_ids)."' WHERE `id`='".$row["id"]."'";
						$newresult = $db->query($newquery);
					}
				}
			
			case '1.7':
				# Changes introduced in 1.7.1
				
				$query = "ALTER TABLE `anyInventory_categories` ADD `auto_inc_field` INT( 1 ) DEFAULT '0' NOT NULL";
				@$db->query($query);
				
				$query = "ALTER TABLE `anyInventory_fields` ADD `highlight` INT( 1 ) DEFAULT '0' NOT NULL";
				@$db->query($query);
				
				$query = "ALTER TABLE `anyInventory_fields` CHANGE `name` `name` VARCHAR( 64 ) NOT NULL";
				@$db->query($query); 
			case '1.7.1':
				# Changes introduced in 1.8
				
				$query = "CREATE TABLE `anyInventory_users` (
					`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
					`username` varchar(32) NOT NULL default '',
					`password` varchar(32) NOT NULL default '',
					`usertype` ENUM( 'User', 'Administrator' ) DEFAULT 'User' NOT NULL,
					`categories_view` text NOT NULL ,
					`categories_admin` text NOT NULL ,
					UNIQUE KEY `id` ( `id` ),
					UNIQUE KEY `username` (`username`)
					) TYPE=MyISAM";
				@$db->query($query);
				
				$blank = array();
				
				$_POST["username"] = ($_POST["username"] == '') ? 'username' : $_POST["username"];
				$_POST["password"] = ($_POST["password"] == '') ? 'password' : $_POST["password"];
				
				$query_data = array("id"=>get_unique_id('anyInventory_users'),
									"username"=>$_POST["username"],
									"password"=>md5($_POST["password"]),
									"usertype"=>'Administrator',
									"categories_admin"=>serialize($blank),
									"categories_view"=>serialize($blank));
				$result = $db->autoExecute('anyInventory_users',$query_data,DB_AUTOQUERY_INSERT);
				if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
				
				$query = "CREATE TABLE `anyInventory_config` (
					`id` int( 11 ) NOT NULL AUTO_INCREMENT ,
					`key` varchar( 64 ) NOT NULL default '',
					`value` text NOT NULL ,
					UNIQUE KEY `id` ( `id` ),
					UNIQUE KEY `key` ( `key` )
					) TYPE = MYISAM";
				@$db->query($query);
				
				$query_data = array("id"=>get_unique_id('anyInventory_config'),
									"key"=>'AUTO_INC_FIELD_NAME',
									"value"=>'anyInventory ID');
				$result = $db->autoExecute('anyInventory_config',$query_data,DB_AUTOQUERY_INSERT);
				if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
				
				$query_data = array("id"=>get_unique_id('anyInventory_config'),
									"key"=>'FRONT_PAGE_TEXT',
									"value"=>'This is the front page and top-level category of anyInventory.  You can <a href=\"docs/en/\">read the documentation</a> for instructions on using anyInventory, or you can navigate the inventory by clicking on any of the subcategories below; any items in a category will appear below the subcategories.  You can tell where you are in the inventory by the breadcrumb links at the top of each category page.');
				$result = $db->autoExecute('anyInventory_config',$query_data,DB_AUTOQUERY_INSERT);
				if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
				
				$query_data = array("id"=>get_unique_id('anyInventory_config'),
									"key"=>'PP_VIEW',
									"value"=>intval(($_POST["password_protect_view"] == "yes")));
				$result = $db->autoExecute('anyInventory_config',$query_data,DB_AUTOQUERY_INSERT);
				if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
				
				$query_data = array("id"=>get_unique_id('anyInventory_config'),
									"key"=>'PP_ADMIN',
									"value"=>intval(($_POST["password_protect_admin"] == "yes")));
				$result = $db->autoExecute('anyInventory_config',$query_data,DB_AUTOQUERY_INSERT);
				if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
				
				$query_data = array("id"=>get_unique_id('anyInventory_config'),
									"key"=>'ADMIN_USER_ID',
									"value"=>(get_unique_id('anyInventory_users') - 1));
				$result = $db->autoExecute('anyInventory_config',$query_data,DB_AUTOQUERY_INSERT);
				if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
				
				$query_data = array("id"=>get_unique_id('anyInventory_config'),
									"key"=>'NAME_FIELD_NAME',
									"value"=>NAME);
				$result = $db->autoExecute('anyInventory_config',$query_data,DB_AUTOQUERY_INSERT);
				if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
				
				$maxidres = $db->query("SELECT MAX('id') from anyInventory_users;");
				$maxid = $maxidres->fetchRow();
				
				$query = "ALTER TABLE `anyInventory_fields` CHANGE `input_type` `input_type` ENUM( 'text', 'textarea', 'checkbox', 'radio', 'select', 'multiple', 'file', 'divider' ) DEFAULT 'text' NOT NULL ";
				@$db->query($query);
				
				$query = "ALTER TABLE `anyInventory_fields` DROP INDEX `name`";
				@$db->query($query);
			case '1.8':
				$query = "ALTER TABLE `anyInventory_config` CHANGE `key` `key_value` VARCHAR( 64 ) NOT NULL";
				@$db->query($query);
				
				$query = "ALTER TABLE `anyInventory_files` CHANGE `key` `key_value` INT( 11 ) DEFAULT '0' NOT NULL";
				@$db->query($query);
				
				$query = "ALTER TABLE `anyInventory_fields` CHANGE `values` `field_values` TEXT NOT NULL";
				@$db->query($query);
				
				$query = "ALTER TABLE `anyInventory_fields` CHANGE `input_type` `input_type` ENUM( 'text', 'textarea', 'checkbox', 'radio', 'select', 'multiple', 'file', 'divider', 'item' ) DEFAULT 'text' NOT NULL ";
				@$db->query($query);
				
				$query_data = array("id"=>get_unique_id('anyInventory_config'),
									"key_value"=>'LANG',
									"value"=>$_REQUEST["lang"]);
				$result = $db->autoExecute('anyInventory_config',$query_data,DB_AUTOQUERY_INSERT);
				if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
				
				$query = "ALTER TABLE `anyInventory_alerts` ADD `modified` TIMESTAMP NOT NULL AFTER `value`";
				@$db->query($query);
				
				$query = "ALTER TABLE `anyInventory_alerts` ADD `expire_time` TIMESTAMP NOT NULL AFTER `time`";
				@$db->query($query);
				
				// The following code uses mysql-only commands because I'm not sure of all of the DB equivalents.
				// It's a moot point because users of pre-1.9 versions could only be using MySQL anyway
				
				$query = "CREATE TABLE `anyInventory_values` (
					`item_id` int( 11 ) NOT NULL default '0',
					`field_id` int( 11 ) NOT NULL default '0',
					`value` text NOT NULL ,
					UNIQUE KEY `item_id` ( `item_id` , `field_id` )
					) TYPE = MYISAM";
				@mysql_query($query);
				
				$query = "SELECT * FROM `anyInventory_categories`";
				$result = mysql_query($query);
				
				while ($row = mysql_fetch_array($result)){
					$newquery = "SELECT * FROM `anyInventory_fields` WHERE `categories` LIKE '%\"".$row["id"]."\"%'";
					$newresult = mysql_query($newquery) or die(mysql_error() . '<br />' . $newquery);
					
					$newestquery = "SELECT * FROM `anyInventory_items` WHERE `item_category`='".$row["id"]."' ORDER BY `id`";
					$newestresult = mysql_query($newestquery) or die(mysql_error() . '<br />' . $newestquery);
					
					while ($newestrow = mysql_fetch_array($newestresult)){
						while ($newrow = mysql_fetch_array($newresult)){
							$query_data = array("item_id"=>$newestrow["id"],
												"field_id"=>$newrow["id"],
												"value"=>$newestrow[$newrow["name"]]);
							$xresult = $db->autoExecute('anyInventory_values',$query_data,DB_AUTOQUERY_INSERT);
							if (DB::isError($xresult)) die($xresult->getMessage().': line '.__LINE__.'<br /><br />'.$xresult->userinfo);
						}
						
						mysql_data_seek($newresult, 0);
					}
				}
				
				$query = "SHOW COLUMNS FROM `anyInventory_items`";
				$result = mysql_query($query);
				
				while ($row = mysql_fetch_array($result)){
					if (($row["Field"] != 'id') && ($row["Field"] != 'name') && ($row["Field"] != 'item_category')){
						$newquery = "ALTER TABLE `anyInventory_items` DROP `".$row["Field"]."`";
						mysql_query($newquery) or die(mysql_error() . '<br />' . $newquery);
					}
				}
				
				/////////////////////////////////
		}
		
		// Attempt to write the globals file.
		@chmod(realpath("globals.php"), 0777);
		
		$handle = @fopen(realpath("globals.php"),"w");
		
		if ($handle){
			fwrite($handle, $writetoglobals);
			fclose($handle);
			@chmod(realpath("globals.php"), 0755);
			
			$globals_written = true;
		}
		
		if ($globals_written){
			if (is_file(realpath("install.php"))) @unlink(realpath("install.php"));
			if (is_file(realpath("upgrade.php"))) @unlink(realpath("upgrade.php"));
			
			header("Location: index.php");
		}
		else{
			$globals_error = true;
			
			$output .= '
				<input type="hidden" name="action" value="try_again" />
				<input type="hidden" name="lang" value="'.$_REQUEST["lang"].'" />
				<input type="hidden" name="db_host" value="'.stripslashes($_POST["db_host"]).'" />
				<input type="hidden" name="db_user" value="'.stripslashes($_POST["db_user"]).'" />
				<input type="hidden" name="db_pass" value="'.stripslashes($_POST["db_pass"]).'" />
				<input type="hidden" name="db_name" value="'.stripslashes($_POST["db_name"]).'" />
				<input type="hidden" name="db_type" value="'.stripslashes($_POST["db_type"]).'" />
				<input type="hidden" name="password_protect_view" value="'.stripslashes($_POST["password_protect_view"]).'" />
				<input type="hidden" name="password_protect_admin" value="'.stripslashes($_POST["password_protect_admin"]).'" />
				<input type="hidden" name="username" value="'.stripslashes($_POST["username"]).'" />
				<input type="hidden" name="password" value="'.stripslashes($_POST["password"]).'" />
				<p>The following error occurred:</p>
				<ul class="error">
					<li>anyInventory could not write the globals.php file.  Either make this file writable by the Web server and click "Try Again", or replace the contents of the current globals.php file with the following code:<br /><pre>' . htmlentities($writetoglobals) . '</pre>If you choose to overwrite the file manually, do so, and then delete the install.php file.  Don\'t forget to change the permissions back on globals.php after you overwrite it.</li>
				</ul>
				<table>
					<tr>
						<td colspan="2" style="text-align: center;"><input type="submit" name="submit" value="Try Again" /></td>
					</tr>
				</table>';
		}
	}
}

if($_POST["action"] == "try_again"){
	$handle = @fopen(realpath("globals.php"),"w");
	
	if ($handle){
		fwrite($handle, $writetoglobals);
		fclose($handle);
		
		$globals_written = true;
	}
	else{
		@chmod(realpath("globals.php"), 0666);
		
		$handle = @fopen(realpath("globals.php"),"w");
		
		if ($handle){
			fwrite($handle, $writetoglobals);
			fclose($handle);
			
			$globals_written = true;
		}
	}
	
	if ($globals_written){
		if (is_file(realpath("install.php"))) @unlink(realpath("install.php"));
		if (is_file(realpath("upgrade.php"))) @unlink(realpath("upgrade.php"));
		
		header("Location: index.php");
	}
	else{
		$output .= '
			<input type="hidden" name="action" value="try_again" />
			<input type="hidden" name="lang" value="'.$_REQUEST["lang"].'" />
			<input type="hidden" name="db_host" value="'.stripslashes($_POST["db_host"]).'" />
			<input type="hidden" name="db_user" value="'.stripslashes($_POST["db_user"]).'" />
			<input type="hidden" name="db_pass" value="'.stripslashes($_POST["db_pass"]).'" />
			<input type="hidden" name="db_name" value="'.stripslashes($_POST["db_name"]).'" />
			<input type="hidden" name="db_type" value="'.stripslashes($_POST["db_type"]).'" />
			<input type="hidden" name="password_protect_view" value="'.stripslashes($_POST["password_protect_view"]).'" />
			<input type="hidden" name="password_protect_admin" value="'.stripslashes($_POST["password_protect_admin"]).'" />
			<input type="hidden" name="username" value="'.stripslashes($_POST["username"]).'" />
			<input type="hidden" name="password" value="'.stripslashes($_POST["password"]).'" />			<p>The following error occurred:</p>
			<ul class="error">
				<li>anyInventory could not write the globals.php file.  Either make this file writable by the Web server and click "Try Again", or replace the contents of the current globals.php file with the following code:<br /><pre>' . htmlentities($writetoglobals) . '</pre>If you choose to overwrite the file manually, do so, and then delete the install.php file.  Don\'t forget to change the permissions back on globals.php after you overwrite it.</li>
			</ul>
			<table>
				<tr>
					<td colspan="2" style="text-align: center;"><input type="submit" name="submit" value="Try Again" /></td>
				</tr>
			</table>';
	}
}
elseif(!$globals_error){
	$db_host = ($_POST["action"] != "") ? $_POST["db_host"] : 'localhost';
	$pp_view_checked = ($_POST["password_protect_view"]) ? ' checked="true"' : '';
	$pp_admin_checked = ($_POST["password_protect_admin"]) ? ' checked="true"' : '';
	$inBodyTag = ' onload="toggle();"';
	
	if (count($errors) > 0){
		$output .= '
			<p>The following errors occurred:</p>
			<ul class="error">';
		
		foreach($errors as $error){
			$output .= '<li>'.$error.'</li>';
		}
		
		$output .= '</ul>';
	}
	
	$output .= '	<input type="hidden" name="action" value="upgrade" />
					<table>
						<tr>
							<td class="form_label"><label for="db_host">Language:</label></td>
							<td class="form_input">
								<select name="lang" id="lang">
									<option value="en"';if($_REQUEST["lang"] == "en") $output .= ' selected="selected"'; $output .= '>English</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="form_label">From which version of anyInventory are you upgrading?<br /><small style="font-weight: normal;">If you are not sure, select 1.0.</small></td>
							<td class="form_input">
								<select name="old_version">
									<option value="1.8"';if($_REQUEST["old_version"] == '1.8')$output .= ' selected="selected"'; $output .= '>1.8</option>
									<option value="1.7.1"';if($_REQUEST["old_version"] == '1.7.1')$output .= ' selected="selected"'; $output .= '>1.7.1</option>
									<option value="1.7"';if($_REQUEST["old_version"] == '1.7')$output .= ' selected="selected"'; $output .= '>1.7</option>
									<option value="1.6"';if($_REQUEST["old_version"] == '1.6')$output .= ' selected="selected"'; $output .= '>1.6</option>
									<option value="1.5"';if($_REQUEST["old_version"] == '1.5')$output .= ' selected="selected"'; $output .= '>1.5</option>
									<option value="1.4.1"';if($_REQUEST["old_version"] == '1.4.1')$output .= ' selected="selected"'; $output .= '>1.4.1</option>
									<option value="1.4"';if($_REQUEST["old_version"] == '1.4')$output .= ' selected="selected"'; $output .= '>1.4</option>
									<option value="1.3"';if($_REQUEST["old_version"] == '1.3')$output .= ' selected="selected"'; $output .= '>1.3</option>
									<option value="1.2"';if($_REQUEST["old_version"] == '1.2')$output .= ' selected="selected"'; $output .= '>1.2</option>
									<option value="1.1"';if($_REQUEST["old_version"] == '1.1')$output .= ' selected="selected"'; $output .= '>1.1</option>
									<option value="1.0"';if($_REQUEST["old_version"] == '1.0')$output .= ' selected="selected"'; $output .= '>1.0</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="form_label"><label for="db_host">DB Server:</label></td>
							<td class="form_input"><input type="text" name="db_host" id="db_host" value="'.$db_host.'" /></td>
						</tr>
						<tr>
							<td class="form_label"><label for="db_user">DB Username:</label></td>
							<td class="form_input"><input type="text" name="db_user" id="db_user" value="'.stripslashes($_POST["db_user"]).'" /></td>
						</tr>
						<tr>
							<td class="form_label"><label for="db_pass">DB Password:</label></td>
							<td class="form_input"><input type="text" name="db_pass" id="db_pass" value="'.stripslashes($_POST["db_pass"]).'" /></td>
						</tr>
						<tr>
							<td class="form_label"><label for="db_name">DB Name:</label></td>
							<td class="form_input"><input type="text" name="db_name" id="db_name" value="'.stripslashes($_POST["db_name"]).'" /></td>
						</tr>
						<tr>
							<td class="form_label"><label for="db_type">DB Type:</label></td>
							<td class="form_input">
								<select name="db_type">
								       <option value="mysql"';if($_REQUEST["db_type"] == 'mysql') $output .= ' selected="selected"'; $output .= '>MySQL</option>
								       <option value="pgsql"';if($_REQUEST["db_type"] == 'pgsql') $output .= ' selected="selected"'; $output .= '>PostgreSQL</option>
								       <option value="mssql"';if($_REQUEST["db_type"] == 'mssql') $output .= ' selected="selected"'; $output .= '>MSSQL</option>
								       <option value="odbc"';if($_REQUEST["db_type"] == 'odbc') $output .= ' selected="selected"'; $output .= '>ODBC</option>
								       <option value="fbsql"';if($_REQUEST["db_type"] == 'fbsql') $output .= ' selected="selected"'; $output .= '>FrontBase</option>
								       <option value="msql"';if($_REQUEST["db_type"] == 'msql') $output .= ' selected="selected"'; $output .= '>MiniSQL</option>
								       <option value="SQLite"';if($_REQUEST["db_type"] == 'SQLite') $output .= ' selected="selected"'; $output .= '>SQLite</option>
									   <option value="oci8"';if($_REQUEST["db_type"] == 'oci8') $output .= ' selected="selected"'; $output .= '>Oracle</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="form_label"><input onclick="toggle();" type="checkbox" name="password_protect_view" id="password_protect_view" value="yes"'.$pp_view_checked.' /></td>
							<td class="form_input"><label for="password_protect">Password protect entire inventory</label></td>
						</tr>
						<tr>
							<td class="form_label"><input onclick="toggle();" type="checkbox" name="password_protect_admin" id="password_protect_admin" value="yes"'.$pp_admin_checked.' /></td>
							<td class="form_input"><label for="password_protect">Password protect admin directory</label></td>
						</tr>
						<tr>
							<td class="form_label"><label for="username">Username:</label></td>
							<td class="form_input"><input type="text" name="username" id="username" value="'.stripslashes($_POST["username"]).'" /></td>
						</tr>
						<tr>
							<td class="form_label"><label for="password">Password:</label></td>
							<td class="form_input"><input type="text" name="password" id="password" value="'.stripslashes($_POST["password"]).'" /></td>
						</tr>
						<tr>
							<td class="submitButtonRow" colspan="2"><input type="submit" name="submit" id="submit" value="Upgrade" /></td>
						</tr>
					</table>';
}

echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title>Upgrade to anyInventory 1.9</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		'.$inHead.'
		<script type="text/javascript">
			function toggle(){
				document.getElementById(\'username\').disabled = !(document.getElementById(\'password_protect_view\').checked || document.getElementById(\'password_protect_admin\').checked);
				document.getElementById(\'password\').disabled = !(document.getElementById(\'password_protect_view\').checked || document.getElementById(\'password_protect_admin\').checked);
				
				document.getElementById(\'password_protect_admin\').checked = (document.getElementById(\'password_protect_view\').checked || document.getElementById(\'password_protect_admin\').checked);
			}
		</script>
	</head>
	<body'.$inBodyTag.'>
		<table style="width: 99%; margin: 5px; background-color: #ffffff;" cellspacing="0">
			<tr>
				<td id="appTitle">
					anyInventory 1.9
				</td>
			</tr>
			<tr>
				<td id="mainMenu">
					<table style="width: 100%;">
						<tr>
							<td>&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<div style="min-height: 400px;">
						<table class="standardTable" cellspacing="0">
							<tr class="tableHeader">
								<td>Upgrade to anyInventory 1.9</td>
							</tr>
							<tr>
								<td class="tableData">
									<p>Welcome to the upgrade page of anyInventory.  To upgrade, simply fill out the following form.  If there are any errors, such as unexecutable files or incorrect data, you will be notified and ask to fix them before the upgrade will continue.  After the upgrade has finished, you will be redirected to the home page of your anyInventory installation.  If you need any help, feel free to contact <a href="mailto:chris@efinke.com">chris@efinke.com</a>.</p>
									<form action="upgrade.php" method="post">
										'.$output.'
									</form>
								</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr class="footerCell">
				<td>
					<a href="http://anyinventory.sourceforge.net/">anyInventory, the web\'s most flexible and powerful inventory system</a>
				</td>
			</tr>
		</table>
	</body>
</html>';

exit;

?>
