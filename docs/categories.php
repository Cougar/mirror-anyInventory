<?php

require_once("globals.php");

switch (LANG){
	case 'es':
		$title = "anyInventory: Ayuda > Categor&iacute;as y adici&oacute;n Categor&iacute;as";
		$breadcrumbs = '<a href="./">Ayuda</a> > Categor&iacute;as y adici&oacute;n Categor&iacute;as';
		
		$output .= '
			<table class="standardTable" cellspacing="0">
				<tr class="tableHeader">
					<td>Categor&iacute;as</td>
				</tr>
				<tr>
					<td class="tableData">
						<p>El sistema de categor&iacute;as funciona justo como la estructura de directorios de tu computadora.  Puedes crear un conjunto de categor&iacute;as principales o superiores (como "Electr&oacute;nicos" o "Deportes") y despu&eacute;s puedes crear sub-categor&iacute;as para cada categor&iacute;a ("Computadoras" y "Equipo de balonpi&eacute;," respectivamente).  Incluso puedes crear sub-categor&iacute;as para las sub-categor&iacute;as ("Discos duros" y "Balones") y de ah&iacute; para el Real.  Esto te facilita la organizaci&oacute;n del inventario de una manera sencilla y l&oacute;gica de entender.</p>
					</td>
				</tr>
				<tr class="tableHeader">
					<td><a name="adding">Adici&oacute;n de Categor&iacute;as</a></td>
				</tr>
				<tr>
					<td class="tableData">
					<p><a href="'.$DIR_PREFIX.'admin/add_category.php">Agregar una categor&iacute;a</a> es bastante obvio.  Se te preguntar&aacute; el nombre que le quieres dar, y la categor&iacute;a superior.  La categor&iacute;a que est&eacute;s agregando ser&aacute; creada "debajo" de la categor&iacute;a superior, haci&eacute;ndola una "sub-categor&iacute;a" de esta.</p>
					<p>La primera categor&iacute;a que agregues debe ser "Principal," un tipo de categor&iacute;as especiales que no pueden ser eliminadas o editadas.  (Si borraras la categor&iacute;a superior estar&iacute;as eliminando todo tu inventario.)</p>
					<p>La &uacute;nica otra informaci&oacute;n que debes proporcionar es la de los <a href="fields.php">campos</a> que quieres que contenga.  Esto te permite adecuar la categor&iacute;a, para guardar &uacute;nicamente la informaci&oacute;n que es relevante para cada art&iacute;culo.</p>
					<p>Al escoger los campos, tienes la opci&oacute;n de hacer que "Herede los campos de la categor&iacute;a superior (adem&aacute;s de los campos seleccionados a continuaci&oacute;n)."  Esto simplemente te permite dar a la nueva categor&iacute;a los mismo campos que la categor&iacute;a superior, con la opci&oacute;n de seleccionar campos adicionales.  Por ejemplo, si creaste una categor&iacute;a principal "Libros" y le diste los campos: Autor, UPC, e ISBN, podr&iacute;as seleccionar la opci&oacute;n "Heredar..." al agregar todas las sub-categor&iacute;as para hacer que tengan los mismos campos, sin tener que seleccionar cada campo para cada sub-categor&iacute;a.</p>
					<p>Tambi&eacute;n tienes la opci&oacute;n de desplegar el campo de autoincremento.  Esto mostrar&aacute; el valor num&eacute;rico &uacute;nico en el inventario para cada art&iacute;culo, en la parte superior de la descripci&oacute;n y a la izquierda del enlace a su categor&iacute;a.  Esto puede ser activado o desactivado para cada categor&iacute;a.</p>
					<p>Una vez que has agregado la categor&iacute;a, esta aparecer&aacute; en la <a href="'.$DIR_PREFIX.'admin/categories.php">Lista de Categor&iacute;as</a>, y puedes comenzar <a href="items.php#adding">agregando art&iacute;culos</a> a esta.</p>
					</td>
				</tr>
			</table>
			<div style="float: left;"><a href="field_order.php">&lt;&lt; Anterior: Orden de campos</a></div>
			<div style="text-align: right;"><a href="editing_categories.php">Siguiente: Editando Categor&iacute;as &gt;&gt;</a></div>';
		
		break;
	case 'fr':
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
		
		break;
	case 'en':
	default:
		$title = "anyInventory: Help > Categories and Adding Categories";
		$breadcrumbs = '<a href="./">Help</a> > Categories and Adding Categories';
		
		$output .= '
			<table class="standardTable" cellspacing="0">
				<tr class="tableHeader">
					<td>Categories</td>
				</tr>
				<tr>
					<td class="tableData">
						<p>The category system works just like the directory structure on your computer.  You can create a set of top-level categories (such as "Electronics" or "Sporting Goods") and then you can create sub-categories for each category ("Computers" and "Baseball Equipment," respectively).  You can then create sub-categories under the sub-categories ("Hard Drives" and "Catchers\' Mitts") and so on and so forth.  This allows you to categorize your inventory in an easy to understand, logical structure.</p>
					</td>
				</tr>
				<tr class="tableHeader">
					<td><a name="adding">Adding Categories</a></td>
				</tr>
				<tr>
					<td class="tableData">
					<p><a href="'.$DIR_PREFIX.'admin/add_category.php">Adding a category</a> is quite straight-forward.  You will be asked to supply a name and a parent category.  The category you are adding will be created "under" the parent category, making it a "child" of the parent.</p>
					<p>The first category you add must be a child of the "Top Level," a special category that cannot be deleted or edited.  (If you deleted the top level, you\'d be deleting your entire inventory.)</p>
					<p>The only other information you must fill in to create a category is what <a href="fields.php">fields</a> you want it to contain.  This allows you to tailor each category, saving only the data that is relevant for each item.</p>
					<p>When choosing the fields, you have the option of having the category "Inherit fields from parent (in addition to fields checked below)."  This simply gives the category you are adding the same fields as its parent, with the option of selecting additional fields.  For example, if you created a "Books" top-level category and gave it the fields Author, UPC, and ISBN, you could check the "Inherit..." box when adding the many subcategories to have them all use the same fields without individully checking them each time.</p>
					<p>You also have the option of displaying the auto-incrementing field.  This will display the unique numerical ID of each item in the inventory at the top of its description page and to the left of its link on each category page.  This can be activated and deactivated on a category by category basis.</p>
					<p>Once you have added a category, it will appear in the <a href="'.$DIR_PREFIX.'admin/categories.php">categories list</a>, and you can start <a href="items.php#adding">adding items</a> to it.</p> 
					</td>
				</tr>
			</table>
			<div style="float: left;"><a href="field_order.php">&lt;&lt; Previous: Field Order</a></div>
			<div style="text-align: right;"><a href="editing_categories.php">Next: Editing Categories &gt;&gt;</a></div>';
		
		break;
}

display($output);

?>