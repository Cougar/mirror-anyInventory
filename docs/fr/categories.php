<?php



include("globals.php");



$title = "anyInventory: Aide > Cat�gories et Ajouter une Cat�gorie";

$breadcrumbs = '<a href="./">Aide</a> > Cat�gories et Ajouter une Cat�gorie';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Cat�gories</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>Le syst�me de cat�gorie fonctionne comme la structure des r�pertoire de votre ordinateur.  Vous pouvez cr�er un ensemble de cat�gories principales (comme "Electronique" ou "Marchandises Sportives") et cr�er des sous-cat�gories pour chacunes d\'elles ("Ordinateur" et "Equipement Baseball").  Vous pouvez cr�er des sous-cat�gories de sous-cat�gories ("Disques Dur" et "Gants de baseball Mitts") et ainsi de suite.  Cela vous permet d\'organiser votre inventaire pour qu\'il soit facilement compr�hensible.</p>

			</td>

		</tr>

		<tr class="tableHeader">

			<td><a name="adding">Ajouter une Cat�gorie</a></td>

		</tr>

		<tr>

			<td class="tableData">

			<p><a href="'.$DIR_PREFIX.'admin/add_category.php">Ajouter une cat�gorie</a> est tr�s rapide.  Vous serez invit�s � fournir un nom et une cat�gorie parente.  La cat�gorie que vous ajoutez sera plac�e "en-dessous" de la cat�gorie parente, elle sera donc un "enfant" de la parente.</p>

			<p>La premi�re cat�gorie que vous ajoutez sera donc une enfant de la cat�gorie "Top", cat�gorie sp�ciale qui ne peut �tre supprime�e ou �dit�e.  (Si vous supprimiez la cat�gorie "Top", vous perdriez tout votre inventaire.)</p>

			<p>Les seul autres informations que vous devez compl�ter pour cr�er une cat�gorie sont les <a href="fields.php">champs</a>  que vous voulez qu\'elle contienne.  Ceci vous permet de travailler sur chaque cat�gorie, en sauvant seulement les donn�es qui sont appropri�es pour chaque article.</p>

			<p>En choisissant les champs, vous avez l\'option "H�ritez des champs parent (en plus des champs v�rifi�s ci-dessous)."  Ceci permet simplement � la cat�gorie que vous ajoutez d\'avoir les m�mes champs que son parent, avec l\'option de choisir les champs additionnels.  Par exemple, Si vous cr�e une cat�gorie principale "Livres" et lui donnez les champs Auteurs, UPC, et ISBN, vous pouvez cocher "H�ritez..." en ajoutant les nombreuses sous-cat�gories pour avoir toujours les m�mes champs sans les v�rifier individuellemnt chaque fois.</p>

			<p>Vous avez �galement l\'option d\'afficher le champ d\'auto-incr�mentation.  Ceci montrera l\'identification num�rique unique de chaque article dans l\'inventaire en haut de sa page de description et � la gauche de son lien � chaque page de cat�gorie. Ceci peut �tre activ� ou d�sactiv� sur une cat�gorie par cat�gorie.</p>

			<p>Une fois que vous avez ajout� une cat�gorie, elle appara�tra dans <a href="'.$DIR_PREFIX.'admin/categories.php">la liste des cat�gories</a>, et vous pourrez commencer � <a href="items.php#adding">ajouter des articles</a>.</p>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="field_order.php">&lt;&lt; Pr�c�dent: Organiser un Champ</a></div>

	<div style="text-align: right;"><a href="editing_categories.php">Suivant: Editer une Cat�gorie &gt;&gt;</a></div>';



display($output);



?>
