<?php

include("globals.php");

$title = "anyInventory: Delete Field";

$field = new field($_REQUEST["id"]);

$output .= '
	<form method="post" action="field_processor.php">
		<input type="hidden" name="id" value="'.$_REQUEST["id"].'" />
		<input type="hidden" name="action" value="do_delete" />
		<table style="width: 100%;"><tr><td>Are you sure you want to delete this field?</td><td style="text-align: right;"><a href="../docs/deleting_fields.php">Help with deleting fields</a></td></tr></table>
		<div>
			<p><b>Field:</b> '.$field->name.'</p>
			<p><b>Input type:</b> '.$field->input_type.'</p>';

if (($field->input_type != "text") && ($field->input_type != 'file')){
	$output .= '<p><b>Values:</b> ';
	
	if(is_array($field->values)){
		foreach($field->values as $value){
			$output .= $value.', ';
		}
		$output = substr($output, 0, strlen($output) - 2);
	}
	else{
		$output .= 'None';
	}
}

if (($field->input_type == "text") || ($field->input_type == "multiple")){
	$output .= '<p><b>Size:</b> '.$field->size.'</p>';
}

if ($field->input_type != 'file'){
	$output .= '<p><b>Default value:</b> '.$field->default_value.'</p>';
}

$output .= '
		<p><b>This field is used in '.count($field->categories).' categories.</b></p>
		<p style="text-align: center;"><input type="submit" name="delete" value="Delete" /> <input type="submit" name="cancel" value="Cancel" /></p>
	</form>';

display($output);

?>