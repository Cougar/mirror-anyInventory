<?php



include("globals.php");



$title = "anyInventory: Aide > Utilisateurs > Editer un Utilisateur";

$breadcrumbs = '<a href="./">Aide</a> > <a href="users.php">Utilisateurs</a> > Editer un Utilisateur';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Editer un Utilisateur</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>L\'�dition d\'un utilisateur est semblable � ajouter un utilisateur, sauf que les champs sont pr�-remplis.  L\'�dition diff�rera de d\'ajouter dans les situations suivantes:</p>

				<ul>

					<li>Quand vous �ditez l\'administrateur cr�� pendant l\'installation, vous ne pouvez changer que son nom et son mot de passe.</li>

					<li>En �ditant votre propre compte utilisateur, vous ne pouvez changer que votre mot de passe.</li>

				</ul>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="adding_users.php">&lt;&lt; Pr�c�dent: Ajouter un Utilsateur</a></div>

	<div style="text-align: right;"><a href="deleting_users.php">Suivant: Supprimer un Utilisateur &gt;&gt;</a></div>';



display($output);



?>
