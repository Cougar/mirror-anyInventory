<?php



include("globals.php");



$title = "anyInventory: Aide > Champs";

$breadcrumbs = '<a href="./">Aide</a> > Champs';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Champs</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>Les Champs sont la base d\'anyInventory.  Ils d�finissent le type de donn�es que vous voulez. jetons un coup d\'oeil aux diff�rents types de champs.</p>

			</td>

		</tr>

		<tr class="tableHeader">

			<td><a name="types">Types de Champs</a></td>

		</tr>

		<tr>

			<td class="tableData">

			<p>Il y a sept types de champs possible pour anyInventory.  Chacun d\'eux

			   sont d�crit ci-dessous, avec un exemple associ�. En plus, vous pouvez cr�er des diviseurs de champ pour s�parer les champs en groupes logiques.</p>

			<ul>

				<li>

					<b>Champ Texte</b>, contient un mot ou une phrase qui sont habituellement diff�rents pour chaque article.  Un exemple

				    de ceci serait le nom de cahque article.

					<form style="padding-left: 50px; margin: 10px;">

						<input type="text" value="Nom de l\'article" />

					</form>

				</li>

				<li>

					<b>Champ de S�lection</b>, prends un valeur tir�e d\'une liste pr�d�finie.  Un exemple de ceci

					seait la s�lection du pays ou vous r�sidez.

					<form style="padding-left: 50px; margin: 10px;">

						<select name="field_values">

							<option>Canada</option>

							<option>Angleterre</option>

							<option>Allemagne</option>

							<option>Etats-Unis</option>

						</select>

					</form>

				</li>

				<li>

					<b>Radio Boutons</b>, prends une valeur unique parmis plusieurs propositions.  Un exemple de

				    cela est si vous voulez choisir comme r�ponse "Oui" ou "Non" � une question: il ne peux y avoir qu\'une r�ponse parmis les deux.

					<form style="padding-left: 50px; margin: 10px;">

						<input type="radio" name="q" /> Oui<br />

						<input type="radio" name="q" /> Non

					</form>

				</li>

				<li>

					<b>Bo�tes � Cocher</b>, permet d\'avoir aucune ou plusieurs valeurs dans une liste pr�d�finie.  En exemple

					on peux avoir � s�lectionner toutes les couleurs qui apparaisent dans une peinture.

					<form style="padding-left: 50px; margin: 10px;">

						<input type="checkbox" name="q" /> Rouge<br />

						<input type="checkbox" name="q" /> Orange<br />

						<input type="checkbox" name="q" /> Jaune<br />

						<input type="checkbox" name="q" /> Vert<br />

						<input type="checkbox" name="q" /> Bleu<br />

						<input type="checkbox" name="q" /> Indigo<br />

						<input type="checkbox" name="q" /> Violet<br />

					</form>

				</li>

				<li>

					<b>Multiple</b>, c\'est une combinaison d\'un champ de s�lection et d\'un champ texte.  Ceci vous donne la possibilit� de choisir une valeur g�n�ralement utilis� � partir d\'une liste pr�d�finie ou d\'entrer la valeur que vous voulez pour cet article.  (Si vous avez un navigateur web avec le Javascript install�, le champ texte devrait prendre la valeur de la derni�re option choisie dans la liste pr�d�finie.
                                        
                                        <form style="padding-left: 50px; margin: 10px;">

						<input type="text" value="Mexique" id="country"/>

						<select name="values">

							<option onclick="document.getElementById(\'country\').value = \'Canada\';">Canada</option>

							<option onclick="document.getElementById(\'country\').value = \'Angleterre\';">Angleterre</option>

							<option onclick="document.getElementById(\'country\').value = \'Allemagne\';">Allemagne</option>

							<option onclick="document.getElementById(\'country\').value = \'Etats-Unis\';">Etats-Unis</option>

						</select>

					</form>

				</li>

				<li>

					<b>Fichier</b>, vous permet transf�rer un fichier de votre ordinateur ou d\'un emplacement sp�cifique Internet.

					<form style="padding-left: 50px; margin: 10px;">

						<input type="file" name="file" id="file"/> or <input type="text" name="fileremote" value="http://" />

					</form>

				</li>

				<li>

					<p><b>Article(s)</b>, vous permet d\'associer des articles de l\'inventaire entre eux.  Par exemple, vous pouvez cr�er un  champ d\'article appel� "install� sur" pour lier des articles logiciel � un article ordinateur sur lequel ils sont install�s.  Ce champ appara�tra toujours comme une liste de tous les articles de l\'inventaire, rang�s par cat�gorie.</p>

				</li>

				<li>

					<b>Champ Diviseur</b>, vous permet de s�parer les champs en groupes.

					<form style="padding-left: 50px; margin: 10px;">

						<hr />

					</form>

				</li>

			</ul>

			<p>Depuis la version 1.7.1, vous avez �galement la possibilit� d\'avoir un champ d\'auto-incr�mentation pour chaque article.  Cette option peut �tre activ�e ou non dans la partie administration pour chaque cat�gorie. Le nom de ce champ peut �tre adapt� aux besoins du client dans la section d\'administration, comme le nom du champ int�gr� "Nom"  (depuis la version 1.8).</p>

			<p>Si ce tout ceci vous semble embrouill�, ne vous inqui�tez pas.  Cela devrait devenir plus clair avec un exemple.</p>

			<h4>Un Exemple</h4>

			<p>

				Disons que vous documentez tous vos re�us des de ce que vous achetez.

			   	Vous pourriez vouloir maintenir ce qui suit:  la date de l\'achat, le lieu de l\'achat, le prix total, la taxe pay�, article

			   	ach�t�, si s\'�tait des d�penses d\'affaires, une image du re�u, et une image de

			   	l\'article ach�t�.  Vos champs pour ce type d\'article ressembleraient � ce qui suit:

			</p>

			<ul>

				<li>Date d\'achat: champ texte</li>

				<li>Lieu d\'achat: champ multiple</li>

				<li>Prix total: champ texte</li>

				<li>Article achet�: champ texte</li>

				<li>D�penses d\'affaires: radio boutons, avec les valeurs "Oui" et "Non"</li>

				<li>Image de re�u et d\'article: fichiers</li>

			</ul>

			<p>Maintenant que nous avons un groupe de champ que nous voulons utiliser,  voyons comment nous pouvons <a href="adding_fields.php">ajouter

				un champ.</a>

			</p>

		</td>

	</tr>

	</table>

	<div style="float: left;"><a href="deleting_users.php">&lt;&lt; Pr�c�dent: Supprimer un Utilisateur</a></div>

	<div style="text-align: right;"><a href="adding_fields.php">Suivant: Ajouter un Champ &gt;&gt;</a></div>';



display($output);



?>
