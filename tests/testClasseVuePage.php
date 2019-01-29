
<?php
/**
 * Fichier testClasseVuePage.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:14:05 PM
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
 /* ========================================= */
 /* ==== Inclure les fichiers vue =========== */
 /* ========================================= */
	 require('../application/vues/VuePage.class.php');
	
	try{
	/* ========================================= */
	/* ====== Début de la page HTML ============ */
	/* ========================================= */
	$oVue = new Vue();
	$aCss = array("../public/css/global.css");
	$aJs = array();
	echo $oVue->getHeader("Tests de la classe Page", $aCss, $aJs, "Fichier de tests", "Caroline Martin", "../public/css/ff.png", "fr", "utf-8");
	
	/* ====== Initialisation ============ */
	$_GET['s'] = 1;
?>
<?php
	/* ========================================= */
	/* ====== Contenu de la page HTML ========== */
	/* ========================================= */
?>
<h1>Test de la classe VuePage</h1>
<h2>afficherTous($aoPages, $sMsg="")</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oVuePage = new VuePage();
		
		$aoPages  = array(
			new Page(2,"Une chaine de caractères","Une chaine de caractères"),
			new Page(2,"Une chaine de caractères","Une chaine de caractères"),
			new Page(2,"Une chaine de caractères","Une chaine de caractères")
		);
		
		$oVuePage->afficherTous($aoPages );
		
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>adm_afficherTous($aoPages, $sMsg="")</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oVuePage = new VuePage();
		
		$aoPages  = array(
			new Page(2,"Une chaine de caractères","Une chaine de caractères"),
			new Page(2,"Une chaine de caractères","Une chaine de caractères"),
			new Page(2,"Une chaine de caractères","Une chaine de caractères")
		);
		
		$oVuePage->adm_afficherTous($aoPages );
		
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>adm_afficherModifierUn(Page $oPage, $sMsg="")</h2>
  <?php
  try{
  		/* ====== Initialisation ============ */
		$_GET['action'] = 'mod';
		/*Declaration d'un objet*/
		$oVuePage = new VuePage();
		
		$oPage = new Page(2,"Une chaine de caractères","Une chaine de caractères");
		
		$oVuePage->adm_afficherModifierUn($oPage);
		
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>adm_afficherAjouterUn($sMsg="")</h2>
  <?php
  try{
  		/* ====== Initialisation ============ */
		$_GET['action'] = 'add';
		/*Declaration d'un objet*/
		$oVuePage = new VuePage();
		
		$oVuePage->adm_afficherAjouterUn();
		
   
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
 