<?php

include("globals.php");

switch (LANG){
	case 'es':
		$title = "anyInventory: Ayuda > Categor&iacute;as > Eliminando Categor&iacute;as";
		$breadcrumbs = '<a href="./">Ayuda</a> > <a href="categories.php">Categor&iacute;as</a> > Eliminando Categor&iacute;as';
		
		$output .= '
			<table class="standardTable" cellspacing="0">
				<tr class="tableHeader">
					<td>Eliminando Categor&iacute;as</td>
				</tr>
				<tr>
					<td class="tableData">
						<p>Cuando decides eliminar una categor&iacute;a, tienes la opci&oacute;n de eliminar tambi&eacute;n sus sub-categor&iacute;as o moverlas a otra categor&iacute;a.  Por defecto est&aacute; seleccionada la opci&oacute;n de moverlas a la categor&iacute;a superior.  Tambi&eacute;n se te mostrar&aacute; el n&uacute;mero de elementos en la categor&iacute;a y sus respectivas sub-categor&iacute;as.</p>
					</td>
				</tr>
			</table>
			<div style="float: left;"><a href="editing_categories.php">&lt;&lt; Anterior: Editando Categor&iacute;as</a></div>
			<div style="text-align: right;"><a href="items.php">Siguiente: Art&iacute;culos &gt;&gt;</a></div>';
		
		break;
	case 'fr':
		$title = "anyInventory: Aide > Cat�gories > Supprimer une Cat�gorie";
		$breadcrumbs = '<a href="./">Aide</a> > <a href="categories.php">Cat�gories</a> > Supprimer une Cat�gorie';
		
		$output .= '
			<table class="standardTable" cellspacing="0">
				<tr class="tableHeader">
					<td>Supprimer une Cat�gorie</td>
				</tr>
				<tr>
					<td class="tableData">
						<p>Quand vous choisissez de supprimer une cat�gorie, vous avez l\'option de supprimer toutes ses sous-cat�gories ou de les d�placer dans une autre cat�gorie.  Les champs seront transf�r�s en d�placant les sous-cat�gories � la cat�gorie parente.  Vous serez �galement inform� de combien d\'articles sont inventori�s dans la cat�gorie et ses sous-cat�gories.</p>
					</td>
				</tr>
			</table>
			<div style="float: left;"><a href="editing_categories.php">&lt;&lt; Pr�c�dent: Editer une Cat�gorie</a></div>
			<div style="text-align: right;"><a href="items.php">Suivant: Articles &gt;&gt;</a></div>';
		
		break;
	case 'en':
	default:
		$title = "anyInventory: Help > Categories > Deleting Categories";
		$breadcrumbs = '<a href="./">Help</a> > <a href="categories.php">Categories</a> > Deleting Categories';
		
		$output .= '
			<table class="standardTable" cellspacing="0">
				<tr class="tableHeader">
					<td>Deleting Categories</td>
				</tr>
				<tr>
					<td class="tableData">
						<p>When you choose to delete a category, you have the option of deleting all of its subcategories or moving them to another category.  The form defaults to moving the subcategories to the category\'s parent.  You will also be informed of how many items are inventoried in the category and its subcategories.</p>
					</td>
				</tr>
			</table>
			<div style="float: left;"><a href="editing_categories.php">&lt;&lt; Previous: Editing Categories</a></div>
			<div style="text-align: right;"><a href="items.php">Next: Items &gt;&gt;</a></div>';
		
		break;
}

display($output);

?>