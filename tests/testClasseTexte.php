
<?php
/**
 * Fichier testClasseTexte.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:14:04 PM
 */
 /* ========================================= */
 /* ==== Inclure les fichiers composant ===== */
 /* ========================================= */
 	require('../composant/lib/PDOLib.class.php');
	require('../composant/lib/TypeException.class.php');
	require('../composant/vues/Vue.class.php');
 /* ========================================= */
 /* ==== Inclure les fichiers modele ======== */
 /* ========================================= */	
    require('../application/modeles/Texte.class.php');
	require('../application/modeles/Auteur.class.php');
	
	try{
	/* ========================================= */
	/* ====== Début de la page HTML ============ */
	/* ========================================= */
	$oVue = new Vue();
	$aCss = array("../public/css/global.css");
	$aJs = array();
	echo $oVue->getHeader("Tests de la classe Texte", $aCss, $aJs, "Fichier de tests", "Caroline Martin", "../public/css/ff.png", "fr", "utf-8");
?>
<?php
	/* ========================================= */
	/* ====== Contenu de la page HTML ========== */
	/* ========================================= */
?>
<h1>Test de la classe Texte</h1>
<h2>ajouter()</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oTexte = new Texte(2,"Une chaine de caractères","Une chaine de caractères","inclassable","Une chaine de caractères",0,"2018-09-09",2);
		/*Ajout*/
		$iLastInsertId = $oTexte->ajouter();
		echo '<pre>';
		var_dump($iLastInsertId);
		echo '</pre>';
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>

<h2>modifier() l'enregistrement inséré no : <?php echo $iLastInsertId; ?></h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oTexte = new Texte($iLastInsertId, "Une chaine de caractères","Une chaine de caractères","essai","Une chaine de caractères",1,"2018-09-09",2);
		echo '<pre>';
		var_dump($oTexte->modifier());
		echo '</pre>';
		

  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>rechercherUn() l'enregistrement inséré no : <?php echo $iLastInsertId; ?> Trouvé</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oTexte = new Texte($iLastInsertId);
		echo '<pre>';
		var_dump($oTexte->rechercherUn());
		echo '</pre>';
		
		echo '<pre>';
		var_dump($oTexte);
		echo '</pre>';
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>supprimer() l'enregistrement inséré no : <?php echo $iLastInsertId; ?></h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oTexte = new Texte($iLastInsertId);
		
		echo '<pre>';
		var_dump($oTexte->supprimer());
		echo '</pre>';
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>rechercherUn() l'enregistrement inséré no : <?php echo $iLastInsertId; ?> PAS Trouvé</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oTexte = new Texte($iLastInsertId);
		
		echo '<pre>';
		var_dump($oTexte->rechercherUn());
		echo '</pre>';
		
		echo '<pre>';
		var_dump($oTexte);
		echo '</pre>';
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>rechercherTous() </h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oTexte = new Texte();

		echo '<pre>';
		var_dump($oTexte->rechercherTous());
		echo '</pre>';
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
<?php	
	/* ========================================= */
	/* ====== Fin de la page HTML ============== */
	/* ========================================= */
	echo $oVue->getFooter("Caroline Martin &copy;2018");
 }catch(Exception $oException){
 	echo "<p>". $oException->getMessage()."</p>";
 }
 ?>
 