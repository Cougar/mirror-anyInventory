<?php



include("globals.php");



$title = "anyInventory: Aide > Quelles futures �volutions?";

$breadcrumbs = '<a href="./">Aide</a> > Quelles futures �volutions?';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Quelles futures �volutions?</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>Cette page d�taille certains des fonctionnalit�es qui seront ajout�s � anyInventory dans les futures versions.</p>

				<p><b>Un meilleur support du CSS:</b> L\'interface d\'anyInventory est actuellement r�crite en utilisant le HTML strict et le CSS.  Ceci permettra aux utilisateurs d\'anyInventory d\'appliquer leurs propres th�mes plus facilement.</p>

				<p><b>Conditions d\'alertes multiple:</b>Ceci vous permettra de cr�er une alerte avec plus d\'une condition sur un article.</p>

				<p><b>Support de fichier XML:</b> Ce dispositif vous permettra d\'exporter et d\'importer l\'inventaire dans un fichier XML, pour des sauvegardes et des restaurations plus faciles.</p>

				<p><b>Recherche avan��e am�lior�e:</b> La page de recherche sera am�lior�e pour tenir compte des crit�res recherche telles que devraient �tre �gales, pas �gale �, moins que, etc.</p>

				<p><b>Un soutien am�lior� des fichiers:</b> Depuis la version 1.7, des images peuvent �tre ajout�es en tant que fichiers locaux si la biblioth�que libcurl est install�e.  Cette fonctionalit�e sans cette biblioth�que est pr�vu pour la version 1.8.</p>

				<p>Si vous avez des suggestions, descommentaires, ou des plaintes, contactez <a href="mailto:chris@efinke.com">chris@efinke.com</a>.</p>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="searching.php">&lt;&lt; Pr�c�dent: Recherche</a></div>';



display($output);



?>
