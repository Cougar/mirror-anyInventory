<?php



include("globals.php");



$title = "anyInventory: Aide > Articles et Ajouter un Article";

$breadcrumbs = '<a href="./">Aide</a> > Articles et Ajouter un Article';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Articles</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>"Article" est le terme g�n�rique pour tout ce que vous rentrez dans votre inventaire, que ce soit une pi�ce d\'ordinateur, un document, un DVD, un cadre de tableau - ce que vous voulez. Les articles dans un inventaire sont ce qui le rendent important.  Les champs et les cat�gories fixent la structure; les articles la remplissent.</p>

			</td>

		</tr>

		<tr class="tableHeader">

			<td><a name="adding">Ajouter un Article</a></td>

		</tr>

		<tr>

			<td class="tableData">

				<p>Pour ajouter un article, vous devez choisir en premier une <a href="categories.php">cat�gorie</a>.  Cela d�terminera quels <a href="fields.php">champs</a> vous devrez remplir.</p>

				<p>Apr�s avoir choisi une cat�gorie, vous obtiendrez un formulaire qui comprend les champs que vous avez d�finis pour cette cat�gorie.  Il n\'y a rien de plus � dire sur ce sujet; vous devriez savoir compl�ter les champs, puisque vous les avez cr�es.</p>

				<p>Si vous t�l�chargez un fichier image, il appara�tra en miniature (petit aper�u de l\'image) quand vous consulterez l\'article dans votre inventaire.  Sinon, il appara�tra comme lien vers le fichier, que vous pourrez t�l�charg�.</p>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="deleting_categories.php">&lt;&lt; Pr�c�dent: Supprimer une Cat�gorie</a></div>

	<div style="text-align: right;"><a href="editing_items.php">Suivant: Editer un Article &gt;&gt;</a></div>';



display($output);



?>
