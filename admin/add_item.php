<?php

require_once("globals.php");

$title = ADD_ITEM;
$inHead = '
	<script type="text/javascript">
	   _editor_url = "'.$DIR_PREFIX.'htmlarea/";
	   _editor_lang = "'.LANG.'";
	</script>
	<script type="text/javascript" src="'.$DIR_PREFIX.'htmlarea/htmlarea.js"></script>';
$inBodyTag = ' onload="HTMLArea.replaceAll();"';
$breadcrumbs = ADMINISTRATION.' > <a href="items.php">'.ITEMS.'</a> > '.ADD_ITEM;

if (!isset($_GET["c"])){
	$output .= '
		<form method="get" action="add_item.php">
			<table class="standardTable" cellspacing="0">
				<tr class="tableHeader">
					<td>'.ADD_ITEM.'</td>
					<td style="text-align: right;">[<a href="../docs/'.LANG.'/items.php#adding">'.HELP.'</a>]</td>
				</tr>
				<tr>
					<td class="tableData" colspan="2">
						<table>
							<tr>
								<td class="form_label"><label for="c">'.ADD_ITEM_TO.':</label></td>
								<td class="form_input">
									<select name="c" id="c" style="width: 100%;">
										'.$admin_user->get_admin_categories_options(null, false).'
									</select>
								</td>
							</tr>
							<tr>
								<td class="submitButtonRow" colspan="2"><input type="submit" name="submit" id="submit" value="'.SUBMIT.'" /></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>';
}
else{
	if (!$admin_user->can_admin($_GET["c"])){
		header("Location: ../error_handler.php?eid=13");
		exit;
	}
	
	$category = new category($_GET["c"]);
	
	$output .= '
			<form method="post" action="item_processor.php" enctype="multipart/form-data">
				<input type="hidden" name="action" value="do_add" />
				<input type="hidden" name="c" value="'.$_GET["c"].'" />
				<table class="standardTable" cellspacing="0">
					<tr class="tableHeader">
						<td>'.ADD_ITEM.': '.$category->get_breadcrumb_admin_links().'</td>
						<td style="text-align: right;">[<a href="../docs/'.LANG.'/items.php#adding">'.HELP.'</a>]</td>
					</tr>
					<tr>
						<td class="tableData" colspan="2">
							<table cellspacing="0" cellpadding="2">
								<tr>
									<td class="form_label"><label for="name">'.NAME_FIELD_NAME.':</label></td>
									<td class="form_input"><input type="text" name="name" id="name" value="" maxlength="64" style="width: 100%;" />
								</tr>';
	
	if ($category->field_ids){
		$last_divider = false;
		
		foreach($category->field_ids as $field_id){
			
			$field = new field($field_id);
			
			if ($field->input_type == 'divider'){
				if (!$last_divider){
					$last_divider = true;
					$output .= '<tr><td colspan="2"><hr /></td></tr>';
				}
			}
			else{
				$last_divider = false;
				
				if ($field->highlight) $extra = ' class="highlighted_field"';
				else $extra = '';
				
				$output .= '
					<tr'.$extra.'>
						<td class="form_label"><label for="'.str_replace(" ","_",$field->name).'">'.$field->name.':</label>';
				
				if ($field->input_type == 'item'){
					$output .= '<br /><small><a href="javascript:void(0);" onclick="selectNone(\''.str_replace(" ","_",$field->name).'[]\');">'.SELECT_NONE.'</a></small>';
				}
				
				$output .= '</td>
						<td class="form_input">';
				
				switch($field->input_type){
					case 'multiple':
						$output .= '<input type="text" id="'.str_replace(" ","_",$field->name).'_text" name="'.str_replace(" ","_",$field->name).'_text" maxlength="'.$field->size.'" value="" style="width: 49%;" /> ';
						$output .= '<select name="'.str_replace(" ","_",$field->name).'_select" id="'.str_replace(" ","_",$field->name).'_select" style="width: 49%;">';
						
						if (is_array($field->field_values)){
							foreach($field->field_values as $value){
								$output .= '<option value="'.$value.'"';
								if ($value == $field->default_value) $output .= ' selected="selected"';
								$output .= ' onclick="document.getElementById(\''.str_replace(" ","_",$field->name).'_text\').value = \''.$value.'\';">'.$value.'</option>';
							}
						}
						
						$output .= '</select>';
						
						break;
					case 'select':
						$output .= '<select name="'.str_replace(" ","_",$field->name).'" id="'.str_replace(" ","_",$field->name).'" style="width: 100%;">';
						
						if (is_array($field->field_values)){
							foreach($field->field_values as $value){
								$output .= '<option value="'.$value.'"';
								if ($value == $field->default_value) $output .= ' selected="selected"';
								$output .= '>'.$value.'</option>';
							}
						}
						
						break;
					case 'text':
						if ($field->size <= 64) $output .= '<input type="text" name="'.str_replace(" ","_",$field->name).'" id="'.str_replace(" ","_",$field->name).'" maxlength="'.$field->size.'" value="'.$field->default_value.'" style="width: 100%;" />';
						else $output .= '<textarea rows="8" cols="40" name="'.str_replace(" ","_",$field->name).'" id="'.str_replace(" ","_",$field->name).'" style="width: 100%;">'.$field->default_value.'</textarea>';
						break;
					case 'radio':
						if (is_array($field->field_values)){
							foreach($field->field_values as $value){
								$output .= '<input type="radio" name="'.str_replace(" ","_",$field->name).'" value="'.str_replace(" ","_",$value).'"';
								if ($value == $field->default_value) $output .= ' checked="checked"';
								$output .= ' /> '.$value.'<br />';
							}
						}
						
						break;
					case 'checkbox':
						if (is_array($field->field_values)){
							foreach($field->field_values as $value){
								$output .= '<input type="checkbox" name="'.str_replace(" ","_",$field->name).'['.$value.']" value="yes"';
								if ($value == $field->default_value) $output .= ' checked="checked"';
								$output .= ' /> '.$value.'<br />';
							}
						}
						
						break;
					case 'file':
						$output .= '<input type="file" name="'.str_replace(" ","_",$field->name).'" id="'.str_replace(" ","_",$field->name).'" /> or <input type="text" name="'.str_replace(" ","_",$field->name).'remote" id="'.str_replace(" ","_",$field->name).'remote" value="http://" />';
						break;
					case 'item':
						$output .= '<select name="'.str_replace(" ","_",$field->name).'[]" id="'.str_replace(" ","_",$field->name).'[]" style="width: 100%;" multiple="multiple" size="10">';
						
						if (is_array($view_user->categories_view)){
							foreach($view_user->categories_view as $cat_id){
								$category = new category($cat_id);
								
								$options = get_item_options($cat_id, 0);
								
								if ($options != ''){
									$output .= '<optgroup label="'.$category->breadcrumb_names.'">';
									$output .= $options;
									$output .= '</optgroup>';
								}
							}
						}
						 
						$output .= '</select>';
						break;
				}
				
				$output .= '</td>
					</tr>';
			}
		}
	}
	
	$output .= '
								<tr>
									<td class="submitButtonRow" colspan="2"><input type="submit" name="submit" id="submit" value="'.SUBMIT.'" /></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>';
}

display($output);

?>