<?php



include("globals.php");



$title = "anyInventory: Aide > Introduction";

$breadcrumbs = '<a href="./">Aide</a> > <a href="introduction.php">Introduction</a>';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Introduction</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>anyInventory a �t� cr�� pour remplir un vide dans le domaine personnel des syst�mes d\'inventaire; tous les autres syst�mes d\'inventaire �tant con�us avec un certain type d\'inventaire � l\'esprit.  anyInventory est diff�rent; il est con�u pour vous permettre de d�cider de quel type d\'article vous voulez r�f�rencer et quel type de donn�es vous voulez maintenir.</p>

				<p>Par exemple, n\'importe quel autre syst�me d\'inventaire que vous pourriez trouver vous indiquerait, "Avec ce produit, vous pouvez r�f�rencer vos logiciels. Pour chaque logiciel, vous pouvez sauver le nom, l\'�diteur, et la date de l\'achat; vous pouvez �galement t�l�charger une image si vous le souhaitez." Si vous vouliez enregister le num�ro de s�rie, vous pourriez essaiyer d\'ajouter ce champ dans le code source, ou vous pourriez juste le n�gocier.  Voici pourquoi anyInventory est diff�rent:</p>

				<p>Ce logiciel vient avec <em>aucunes</em> notions pr�con�ues de ce que vous voulez faire avec lui. Il est assez flexible pour g�r� la nourriture dans votre r�frig�rateur en plus des d�s de votre collection de plus de 1000 pi�ces. Il est suffisament simple pour �tre employ� comme DVDth�que, et assez puissant pour g�rer l\'inventaire de votre entreprise.</p>

				<p>La raison pour laquelle anyInventory peut �tre si le puissant et flexible est la mani�re dont vous, l\'utilisateur, saisissez les donn�es.  Au lieu de commencer par entrer les articles dans l\'inventaire, vous commencez par d�finir quelles donn�es vous voulez y mettre.  Pour une vision plus d�taill� de ces donn�es, vous pouvez jeter un oeil sur les <a href="fields.php">champs</a>.  Si vous choisissiez un mot de passe pour prot�ger votre installation, vous pouvez regarder la documentation sur les <a href="users.php">utilisateurs</a>.</p>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="index.php">&lt;&lt; Pr�c�dent: Table des Mati�res</a></div>

	<div style="text-align: right;"><a href="users.php">Suivant: Utilisateurs &gt;&gt;</a></div>';



display($output);



?>
