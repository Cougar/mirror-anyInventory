<?php



include("globals.php");



$title = "anyInventory: Aide > Utilisateurs";

$breadcrumbs = '<a href="./">Aide</a> > Utilisateur';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Utilisateurs</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>La version 1.8 d\'anyInventory offre un syst�me plus complexe de gestion des utilisateurs que dans les versions pr�c�dentes. Celle-ci vous permet d\'installer une protection par mot de passe pour l\'application enti�re de l\'inventaire ou juste la section d\'administration.  Le syst�me mis en place dans la version 1.8 est plus complexe et plus puissant pour la protection par mot de passe car diff�rents utilisateurs peuvent �tre cr��s avec des droits de consultation et des privil�ges administratifs.</p>

			</td>

		</tr>

		<tr class="tableHeader">

			<td><a name="types">Types d\'Utilisateur</a></td>

		</tr>

		<tr>

			<td class="tableData">

				<p>Il y\'a deux types d\'utilisateur: utilisateur simple et administrateur.  Les administrateurs ont le plein pouvoir pour ajouter, �diter, et supprimer des utilisateurs, des champs, des cat�gories, des articles, et le texte de la page d\'accueil.  Ils peuvent aussi supprimer la protection par mot de passe pour l\'inventaire et l\'administration.  Les utilisateurs simples peuvent seulement �diter les champs, les articles, et les cat�gories autoris�es par un administrateur.</p>

				<p>Le compte d\'administrateur cr�� � l\'installation ne peut �tre supprim�.  Ceci afin d\'assurer que le syst�me d\'inventaire ne soit accidentellement ferm� en supprimant tous les utilisateurs.</p>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="introduction.php">&lt;&lt; Pr�c�dent: Introduction</a></div>

	<div style="text-align: right;"><a href="adding_users.php">Suivant: Ajouter un Utilisateur &gt;&gt;</a></div>';



display($output);



?>
