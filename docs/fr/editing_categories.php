<?php



include("globals.php");



$title = "anyInventory: Aide > Cat�gories > Editer une Cat�gorie";

$breadcrumbs = '<a href="./">Aide</a> > <a href="categories.php">Cat�gories</a> > Editer une Cat�gorie';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Editer une Cat�gorie</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>Editer une cat�gorie est identique � ajouter une cat�gorie, sauf ques les champs du formulaire sont d�j� remplis. Vous pouvez d�placer une cat�gorie (et ses sous-cat�gories) en choisisant une nouvelle cat�gorie parente.</p>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="categories.php#adding">&lt;&lt; Pr�c�dent: Ajouter une Cat�gorie</a></div>

	<div style="text-align: right;"><a href="deleting_categories.php">Suivant: Supprimer une Cat�gorie &gt;&gt;</a></div>';



display($output);



?>
