<?php

include("globals.php");

$title = "anyInventory: Help > Categories > Editing Categories";

$output .= '
	<h2>Editing Categories</h2>
	<p>Editing a category is identical to adding a category, but the information about the category is already filled into the form.  You can move the category (and its subcategories) by choosing a new parent category, and you can change the name and fields of the category.</p>
	<div style="float: left;"><a href="categories.php#adding">&lt;&lt; Previous: Adding Categories</a></div>
	<div style="text-align: right;"><a href="deleting_categories.php">Next: Deleting Categories &gt;&gt;</a></div>';

display($output);

?>