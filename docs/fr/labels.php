<?php



include("globals.php");



$title = "anyInventory: Aide > Etiquettes";

$breadcrumbs = '<a href="./">Aide</a> > Etiquettes';



$output .= '

	<table class="standardTable" cellspacing="0">

		<tr class="tableHeader">

			<td>Etiquettes</td>

		</tr>

		<tr>

			<td class="tableData">

				<p>anyInventory, depuis la version 1.5, vous permet de cr�er une �tiquette avec un code barre de n\'importe quel champ d\'un article.  Par exemple, disons que vous avez achet� le DVD du film "Animal House" et que vous l\'avez ajout� � votre inventaire, avec l\'UPC, l\'ISBN, et le nom.  Vous pourriez produire une �tiquette � partir de l\'UPC de deux mani�res:</p>

				<ol>

					<li>De la page d\'article pour "Animal House," � c�t� de chaque champ il y a un lien pour cr�er une �tiquette avec un code barre de la valeur de ce champ.  Pour obtenir l\'�tiquette de UPC, vous cliqueriez juste le lien "�tiquette" � c�t� du champ de l\'UPC.</li>

					<li>Vous pourriez aller � la <a href="'.$DIR_PREFIX.'labels.php">page etiquettes</a> et suivre les instructions pour cr�er une �tiquette du champ UPC de "Animal House."  Cette m�thode vous permet �galement de faire des �tiquettes pour plusieurs articles en m�me temps.</li>

				</ol>

				<p>Apr�s que ayez choisis un de ces deux m�thodes, vous obtiendrez un graphique qui ressemble � ceci:</p>

				<p style="text-align: center;"><img src="'.$DIR_PREFIX.'images/sample_label.png" alt="Etiquette UPC Animal House" /></p>

				<p>La future version d\'anyInventory vous permettra de cr�er des �tiquettes PDF que vous pouvez imprimer sur des feuilles </p>

				<p><i>Note: Cette possibilit�e marche seulement si les fonctions n�cessaires sont install�es.  <b>Selon un auto-test, les fonctions n�cessaires pour la production d\'�tiquette ';



if (!function_exists('imagecreate') ||

    !function_exists('imagecolorallocate') ||

	!function_exists('imagettftext') ||

	!function_exists('imagestring') ||

	!function_exists('imagecopyresized') ||

	!function_exists('imagedestroy') ||

	!function_exists('imagepng')){

	

	$output .= ' ne sont pas ';

}
else {   $output .= ' sont ';}


$output .= ' install�es.</b></i></p>

			</td>

		</tr>

	</table>

	<div style="float: left;"><a href="deleting_alerts.php">&lt;&lt; Pr�c�dent: Supprimer une Alerte</a></div>

	<div style="text-align: right;"><a href="searching.php">Suivant: Rechercher &gt;&gt;</a></div>';



display($output);



?>
