<?php



include("globals.php");



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



display($output);



?>
