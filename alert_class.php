<?php

class alert {
	var $id;
	
	var $item_ids;
	var $category_ids;
	
	var $title;
	var $field_id;
	var $condition;
	var $value;
	
	var $time;
	var $unix_time;
	
	var $expire_time;
	var $unix_expire_time;
	
	var $timed = false;
	
	var $expires = false;
	
	function alert($alert_id){
		global $db;
		
		$this->id = $alert_id;
		
		$query = "SELECT * FROM `anyInventory_alerts` WHERE `id`= ?";
		$query_data = array($this->id);
		$pquery = $db->prepare($query);
		$result = $db->execute($pquery, $query_data);
		if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
		
		$row = $result->fetchRow();
		
		$this->title = $row["title"];
		
		$this->item_ids = unserialize($row["item_ids"]);
		$this->category_ids = unserialize($row["category_ids"]);
		
		$this->field_id = $row["field_id"];
		$this->condition = $row["condition"];
		$this->value = $row["value"];
		
		$this->time = $row["time"];
		$this->unix_time = unix_timestamp($row["time"]);
		
		$this->expire_time = $row["expire_time"];
		$this->unix_expire_time = unix_timestamp($row["expire_time"]);
		
		if ($this->expire_time != '00000000000000'){
			$this->expires = true;
		}
		
		$this->timed = $row["timed"];
	}
	
	// This function returns a "teaser" or short description for the alert.
	
	function export_teaser(){
		return $this->title;
	}
	
	// This function removes an item from the alert.
	
	function remove_item($item_id){
		global $db;
		
		// Find the key of the category id in the array.
		$key = array_search($item_id, $this->item_ids);
		
		// If the category id is in the array, remove it.
		if ($key) unset($this->item_ids[$key]);
		
		if (count($this->item_ids) == 0){
			$query = "DELETE FROM `anyInventory_alerts` WHERE `id`= ?";
			$query_data = array($this->id);
			$pquery = $db->prepare($query);
			$result = $db->execute($pquery, $query_data);
			if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
		}
		else{
			$query = "UPDATE `anyInventory_alerts` SET `item_ids`= ? WHERE `id`= ?";
			$query_data = array(serialize($this->item_ids), $this->id);
			$pquery = $db->prepare($query);
			$result = $db->execute($pquery, $query_data);
			if (DB::isError($result)) die($result->getMessage().': line '.__LINE__.'<br /><br />'.$result->userinfo);
		}
	}
	
	// This function returns a full description of the item.
	
	function export_description(){
		global $DIR_PREFIX;
		
		// Create the header with the name.
		$output .= '
			<table class="standardHeader" cellspacing="0" cellpadding="0">
				<tr class="tableHeader">
					<td>'.$this->title.'</td>
				</tr>
				<tr>
					<td class="tableData">
						<table>
							<tr>
								<td class="form_label">'.APPLIES_TO.':</td>
								<td>';
		
		if (is_array($this->item_ids)){
			foreach($this->item_ids as $item_id){
				$item = new item($item_id);
				$output .= $item->export_teaser().'<br />';
			}
		}
		
		$output .= '</td>
						</tr>
						<tr>
							<td class="form_label">'.ACTIVE_WHEN.':</td>
							<td>';
		
		$field = new field($this->field_id);
		
		$output .= $field->name." ";
		$output .= $this->condition;
		$output .= (trim($this->value) == '') ? " ''" : ' '.$this->value;
		
		$output .= '</td>
							</tr>
							<tr>
								<td class="form_label">'.EFFECTIVE_DATE.':</td>
								<td>'.date("Y m d",$this->unix_time).'</td>
							</tr>';
		
		if ($this->expires){
			$output .= '
				<tr>
					<td class="form_label">'.EXPIRATION_DATE.':</td>
					<td>'.date("Y m d",$this->unix_expire_time).'</td>
				</tr>';
		}
		
		if ($this->email != ''){
			$output .= '
				<tr>
					<td class="form_label">'.EMAIL_ALERT_TO.':</td>
					<td>'.$this->email.'</td>
				</tr>';
		}
		
		$output .= '
						</table>
					</td>
				</tr>
			</table>';
		
		return $output;
	}
	
	function export_box($item_id = null){
		// This function creates an alert box for an activated alert.
		global $DIR_PREFIX;
		
		if ($item_id != null){
			$item = new item($item_id);
			$item_link = '<br /><a href="'.$DIR_PREFIX.'index.php?id='.$item->id.'">'.$item->name.'</a>';
		}
		else{
			$item_link = '';
		}
		
		$output = '
			<table class="alertBox" cellspacing="0" cellpadding="2" border="0">
				<tr class="alertTitle">
					<td>
						'.ALERT.'
					</td>
					<td style="text-align: right;">
						<a href="'.$DIR_PREFIX.'docs/'.LANG.'/alerts.php">?</a>
					</td>
				</tr>
				<tr class="alertContent">
					<td colspan="2">
						<b>'.$this->title.'</b>'.$item_link.'
					</td>
				</tr>
			</table>';
		
		return $output;
	}
}

?>
