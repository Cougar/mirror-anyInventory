<?php



include("globals.php");



$title = "anyInventory: Aide > Champs > Supprimer un Champ";

$breadcrumbs = '<a href="./">Aide</a> > <a href="fields.php">Champs</a> > Supprimer un Champ';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Supprimer un Champ</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>Quand vous supprimez un champ, vous supprimez �galement toutes les donn�es que vous avez saisies pour ce champ et pour tous les articles que vous avez ajout�s, faites tr�s attention quand vous supprimez.</p>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="editing_fields.php">&lt;&lt; Pr�c�dent: Editer un Champ</a></div>

	<div style="text-align: right;"><a href="field_order.php">Suivant: Organiser un Champ &gt;&gt;</a></div>';



display($output);



?>
