<?php



include("globals.php");



$title = "anyInventory: Aide > Articles > D�placer un Article";

$breadcrumbs = '<a href="./">Aide</a> > <a href="items.php">Articles</a> > D�placer un Article';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>D�placer un Article</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>Quand vous voulez d�placer un article, vous perdez les donn�es que vous avez saisies pour les champs qui ne font pas partie de la cat�gorie dans laquelle il est d�plac�.  Les champs que la cat�gorie de destination qui n\'existaient pas dans l\'ancienne cat�gorie sont laiss� vide.  Toute autre information reste inchang�e.</p>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="editing_items.php">&lt;&lt; Pr�c�dent: Editer un Article</a></div>

	<div style="text-align: right;"><a href="deleting_items.php">Suivant: Supprimer un Article &gt;&gt;</a></div>';



display($output);



?>
