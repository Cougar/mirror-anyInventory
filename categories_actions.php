<?php

include("globals.php");

if ($_REQUEST["action"] == "do_add"){
	$query = "INSERT INTO `anyInventory_categories` (`name`,`parent`) VALUES ('".$_REQUEST["name"]."','".$_REQUEST["parent"]."')";
	$result = query($query);
	
	$this_id = insert_id();
	
	if (is_array($_REQUEST["fields"])){
		foreach($_REQUEST["fields"] as $key => $value){
			$temp_field = new field($key);
			$temp_field->add_category($this_id);
		}
	}
}
elseif($_REQUEST["action"] == "do_delete"){
	if ($_REQUEST["delete"] == "Delete"){
		$category = new category($_REQUEST["id"]);
		
		$query = "DELETE FROM `anyInventory_categories` WHERE `id`='".$_REQUEST["id"]."'"; 
		$result = query($query);
		
		if ($_REQUEST["item_action"] == "delete"){
			$query = "DELETE FROM `anyInventory_items` WEHRE `category`='".$category->id."'";
			$result = query($query);
		}
		elseif($_REQUEST["item_action"] == "move"){
			$query = "UPDATE `anyInventory_items` SET `category`='".$_REQUEST["move_items_to"]."'";
			$result = query($query);
		}
		
		if ($_REQUEST["subcat_action"] == "delete"){
			delete_subcategories($category);
		}
		elseif($_REQUEST["subcat_action"] == "move"){
			$query = "UPDATE `anyInventory_categories` SET `parent`='".$_REQUEST["move_subcats_to"]."' WHERE `parent`='".$category->id."'";
			$result = query($query);
		}
		
		remove_from_fields($category->id);
	}
}

header("Location: categories.php");

?>