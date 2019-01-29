
<?php
/**
 * Fichier testClasseVueAuteur.php
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
    require('../application/modeles/Auteur.class.php');
 /* ========================================= */
 /* ==== Inclure les fichiers vue =========== */
 /* ========================================= */
	 require('../application/vues/VueAuteur.class.php');
	
	try{
	/* ========================================= */
	/* ====== Début de la page HTML ============ */
	/* ========================================= */
	$oVue = new Vue();
	$aCss = array("../public/css/global.css");
	$aJs = array();
	echo $oVue->getHeader("Tests de la classe Auteur", $aCss, $aJs, "Fichier de tests", "Caroline Martin", "../public/css/ff.png", "fr", "utf-8");
	
	/* ====== Initialisation ============ */
	$_GET['s'] = 1;
?>
<?php
	/* ========================================= */
	/* ====== Contenu de la page HTML ========== */
	/* ========================================= */
?>
<h1>Test de la classe VueAuteur</h1>
<h2>afficherTous($aoAuteurs, $sMsg="")</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oVueAuteur = new VueAuteur();
		
		$aoAuteurs  = array(
			new Auteur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères"),
			new Auteur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères"),
			new Auteur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères")
		);
		
		$oVueAuteur->afficherTous($aoAuteurs );
		
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>adm_afficherTous($aoAuteurs, $sMsg="")</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oVueAuteur = new VueAuteur();
		
		$aoAuteurs  = array(
			new Auteur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères"),
			new Auteur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères"),
			new Auteur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères")
		);
		
		$oVueAuteur->adm_afficherTous($aoAuteurs );
		
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>adm_afficherModifierUn(Auteur $oAuteur, $sMsg="")</h2>
  <?php
  try{
  		/* ====== Initialisation ============ */
		$_GET['action'] = 'mod';
		/*Declaration d'un objet*/
		$oVueAuteur = new VueAuteur();
		
		$oAuteur = new Auteur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères");
		
		$oVueAuteur->adm_afficherModifierUn($oAuteur);
		
   
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
		$oVueAuteur = new VueAuteur();
		
		$oVueAuteur->adm_afficherAjouterUn();
		
   
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
 