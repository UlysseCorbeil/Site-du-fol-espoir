
<?php
/**
 * Fichier testClassePage.php
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
    require('../application/modeles/Page.class.php');
	
	try{
	/* ========================================= */
	/* ====== Début de la page HTML ============ */
	/* ========================================= */
	$oVue = new Vue();
	$aCss = array("../public/css/global.css");
	$aJs = array();
	echo $oVue->getHeader("Tests de la classe Page", $aCss, $aJs, "Fichier de tests", "Caroline Martin", "../public/css/ff.png", "fr", "utf-8");
?>
<?php
	/* ========================================= */
	/* ====== Contenu de la page HTML ========== */
	/* ========================================= */
?>
<h1>Test de la classe Page</h1>
<h2>ajouter()</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oPage = new Page(2,"Une chaine de caractères","Une chaine de caractères");
		/*Ajout*/
		$iLastInsertId = $oPage->ajouter();
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
		$oPage = new Page($iLastInsertId, "Une chaine de caractères","Une chaine de caractères");
		echo '<pre>';
		var_dump($oPage->modifier());
		echo '</pre>';
		

  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>rechercherUn() l'enregistrement inséré no : <?php echo $iLastInsertId; ?> Trouvé</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oPage = new Page($iLastInsertId);
		echo '<pre>';
		var_dump($oPage->rechercherUn());
		echo '</pre>';
		
		echo '<pre>';
		var_dump($oPage);
		echo '</pre>';
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>supprimer() l'enregistrement inséré no : <?php echo $iLastInsertId; ?></h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oPage = new Page($iLastInsertId);
		
		echo '<pre>';
		var_dump($oPage->supprimer());
		echo '</pre>';
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>rechercherUn() l'enregistrement inséré no : <?php echo $iLastInsertId; ?> PAS Trouvé</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oPage = new Page($iLastInsertId);
		
		echo '<pre>';
		var_dump($oPage->rechercherUn());
		echo '</pre>';
		
		echo '<pre>';
		var_dump($oPage);
		echo '</pre>';
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>rechercherTous() </h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oPage = new Page();

		echo '<pre>';
		var_dump($oPage->rechercherTous());
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
 