<?php

include("globals.php");

$title = "anyInventory: Aide > Champs > Ajouter un Champ";
$inHead = '
	<script type="text/javascript">
	   _editor_url = "'.$DIR_PREFIX.'htmlarea/";
	   _editor_lang = "'.LANG.'";
	</script>
	<script type="text/javascript" src="'.$DIR_PREFIX.'htmlarea/htmlarea.js"></script>';
$inBodyTag = ' onload="HTMLArea.replaceAll();"';
$breadcrumbs = '<a href="./">Aide</a> > <a href="fields.php">Fields</a> > Ajouter un Champ';

$output .= '
	<table class="standardTable" cellspacing="0">
		<tr class="tableHeader">
			<td>Ajouter un Champ</td>
		</tr>
		<tr>
			<td class="tableData">
				<p>
					Pour commencer � g�rer vos re�us, vous devez ajouter les champs �num�r�s � la page pr�c�dente de sorte que vous puissiez entrer les donn�es plus tard.
					Pour ceci, proc�dez a l\'<a href="'.$DIR_PREFIX.'admin/add_field.php">ajout de champ</a>. L�, vous verrez
					quelque chose qui ressemble � ceci:
				</p>
				<form method="post" action="#">
					<table>
						'.display_field_form().'
					</table>
				</form>
				<p>Commen�ons � ajouter nos champs, n\'est-ce pas?  D\'abord la date de l\'achat.</p>
				<p>"Mais attendez, ne devrions-nous pas entrer le nom de chaque article?" Ne vous inqui�tez pas.  Vous ne devrez jamais cr�er un champ pour le nom d\'article; c\'est un des deux champs pr�int�gr�s dans anyInventory, l\'autre �tant le champ d\'auto-incrementation.</p>
				<p>Si vous choisissez de cocher "Mettre ce champ en surbrillance", le champ et sa valeur serons affich� avec une couleur de fond dans la description de l\'article.  Ceci pourrait �tre utile pour mettre en valeur des champs sp�ciaux pour un article, tel que l\'UPC, le num�ro de s�rie, ou les codes produit.</p>
				<p>Retournons � la date d\'achat: d\'abord, nous entrons dans le champ Nom:</p>
				<form method="post" action="#">
					<table>
						'.display_field_form('','Date D\'Achat','text').'
					</table>
				</form>
				<p>L� nous allons choisir quel type de champ nous voulons.  Puisque "texte" est d�j� choisi ici, il n\'y a aucun besoin de changer le type de donn�es.</p>
				<p>La "Valeur par d�faut" d�finie ce qui est affich� par d�faut dans un champ, quand vous ajoutez un article.  Par exemple, nous voulons nous rappeler dans quel format �crire la date, ainsi nous avons mis par DDMMYYYY:</p>
				<form method="post" action="#">
					<table>
						'.display_field_form('','Date D\'Achat','text','','DDMMYYYY').'
					</table>
				</form>
				<p>Apr�s nous avons la taille du champ.  Ceci limite le nombre de caract�res qui peuvent �tre �crits dans le champ. Puisque nous savons d�j� le format de notre date, nous pouvons mettre 10, puisque c\'est exactement la taile de notre format de date.</p>
				<p><em>Note: si la taille est de 256 ou davantage, vous obtiendrez une bo�te texte � la place d\'une ligne texte pour saisir vos donn�es.  La bo�te texte, montr� ci-dessous, rend simplement les donn�es plus visible.</em></p>
				<form style="padding-left: 50px; margin: 10px;">
					<textarea rows="10" cols="60" style="width: 100%;">
						Ceci est une bo�te texte.  Soyez libre de taper ce que vous voulez dedans.
					        Si vous avez un navigateur compatible, ceci devrait �galement �tre un �diteur WYSIWYG.
					</textarea>
				</form>
				<br />
				<form method="post" action="#">
					<table>
						'.display_field_form('','Date D\'Achat','text','','DDMMYYYY',8).'
					</table>
				</form>
				<p>Le dernier champ, "Appliquer �", permet d\'appliquer ce champ � un ensemble de cat�gories.  Nous n\'avons pas besoin de nous inqui�ter � ce sujet, puisque nous n\'avons ajout� encore aucune cat�gorie. Si nous avions d�j� ajout� quelques cat�gories, nous pourrions choisir les cat�gories nous voulons pour contenir ce champ. Ajouter des champs aux cat�gories est d�crit plus loin dans <a href="categories.php#adding">ajouter une cat�gorie</a>.</p>
				<p>Ajouter le prix total et l\'article achet� se fera de la m�me mani�re, mais jetons un coup d\'oeil � un des autres champs pour voir comment en ajoutant des champs "�num�r�s" cela marche, "�num�r�" signifiant que vous pouvez indiquer un ensemble de valeurs pour le champ.</p>
				<p>Ajoutons le champ "Lieu d\'Achat" maintenant, avec le type "multiple."  (Nous le choisisons multiple au lieu de le choisir en bo�te de s�lection afin de nous permettre de saisir un endroit qui n\'est pas dans la liste.)</p>
				<p>D\'abord, nous entrons dans le champ nom et choisissons le type de champ:</p>
				<form method="post" action="#">
					<table>
						'.display_field_form('','Lieu d\'Achat','multiple').'
					</table>
				</form>
				<p>La prochaine chose que nous devons faire est de donner � ce champ quelques valeurs. Nous faisons ceci en entrant les magasins que nous voulons voir appara�tre dans la liste, s�par�s par des virgules. Ainsi, nous mettons les cinq magasins o� nous faisons des emplettes le plus souvent, et nous placerons par d�faut le magasin o� nous allons le plus.</p>
				<form method="post" action="#">
					<table>
						'.display_field_form('','Lieu d\'Achat','multiple',array("Staples", "Bureau Max", "Bureau de D�p�t", "Radio Shack", "Sam Goody"),'Bureau Max').'
					</table>
				</form>
				<p>Puisque nous n\'avons ajout� aucune cat�gorie, nous pouvons ignorer le champ "Appliquer � :".<p>
				<p>Ce champ, dans une page d\'ajout d\'article, ressemblera � ceci:</p>
				<form style="padding-left: 50px; margin: 10px;">
					<input type="text" value="Bureau Max" id="store_we_shop_at"/>
					<select name="field_values">
						<option onclick="document.getElementById(\'store_we_shop_at\').value = \'Staples\';">Staples</option>
						<option onclick="document.getElementById(\'store_we_shop_at\').value = \'Bureau Max\';">Bureau Max</option>
						<option onclick="document.getElementById(\'store_we_shop_at\').value = \'Bureau de D�p�t\';">Bureau de D�p�t</option>
						<option onclick="document.getElementById(\'store_we_shop_at\').value = \'Radio Shack\';">Radio Shack</option>
						<option onclick="document.getElementById(\'store_we_shop_at\').value = \'Sam Goody\';">Sam Goody</option>
					</select>
				</form>
				<p>Ajouter un radio bouton, une case � cocher, ou une bo�te de s�lection se fait de la m�me mani�re.</p>
				<p>Ajouter un champ de type \'fichier\' vous permet d\'importer un fichier pour ce champ au lieu de saisir ou de choisir une valeur.  Depuis la version 1.6, ceci a remplac� les champs int�gr�s "de t�l�chargement de fichiers" et "de fichiers distant".</p>
			</td>
		</tr>
	</table>
	<div style="float: left;"><a href="fields.php#types">&lt;&lt; Pr�c�dent: Champs</a></div>
	<div style="text-align: right;"><a href="editing_fields.php">Suivant: Editer un Champ &gt;&gt;</a></div>';

display($output);

?>