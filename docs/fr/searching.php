<?php



include("globals.php");



$title = "anyInventory: Aide > Recherche";

$breadcrumbs = '<a href="./">Aide</a> > Recherche';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Recherche</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>Quand vous entrez des termes � rechercher dans la bo�te en haut de n\'importe quelle page d\'anyInventory, la recherche est faite de la fa�on suivante:</p>

				<ol>

					<li>Si vous �crivez un nombre et aucun autre terme, anyInventory recherchera dans chaques champs <em>plus</em> le champ d\'auto-incr�mentation unique pour ce nombre.</li>

					<li>Si vous �crivez un terme qui n\'est pas num�rique, anyInventory recherchera dans chaques champs que vous avez d�fini <em>plus</em> dans le champ "Nom".</li>

					<li>Si vous �crivez plus d\'un terme, anyInventory recherchera un article qui a chacuns de ces termes de recherche contenu dans un ou plusieurs de ses champs.</li>

				</ol>

				<p>anyInventory renverra alors les r�sultats rang� par cat�gorie.  Les recherches bool�ennes ne sont pas actuellement support�es (ie. utiliser "AND" ou "OR" n\'affecte pas la recherche).</p>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="labels.php">&lt;&lt; Pr�c�dent: Etiquettes</a></div>

	<div style="text-align: right;"><a href="whats_next.php">Suivant: Quelles futures �volutions? &gt;&gt;</a></div>';



display($output);



?>
