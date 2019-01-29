
<?php
/**
 * Fichier testClasseVueMedia.php
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
    require('../application/modeles/Media.class.php');
	require('../application/modeles/Auteur.class.php');
 /* ========================================= */
 /* ==== Inclure les fichiers vue =========== */
 /* ========================================= */
	 require('../application/vues/VueMedia.class.php');
	
	try{
	/* ========================================= */
	/* ====== Début de la page HTML ============ */
	/* ========================================= */
	$oVue = new Vue();
	$aCss = array("../public/css/global.css");
	$aJs = array();
	echo $oVue->getHeader("Tests de la classe Media", $aCss, $aJs, "Fichier de tests", "Caroline Martin", "../public/css/ff.png", "fr", "utf-8");
	
	/* ====== Initialisation ============ */
	$_GET['s'] = 1;
?>
<?php
	/* ========================================= */
	/* ====== Contenu de la page HTML ========== */
	/* ========================================= */
?>
<h1>Test de la classe VueMedia</h1>


  <h2>adm_afficherTous($aoMedias, $sMsg="")</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oVueMedia = new VueMedia();
		
		$aoMedias  = array(
			new Media(2,"titre 1","url.gif", "#image", 0, "image/gif","2018-09-09",2),
			new Media(2,"titre 2","url.jpg", "#image", 0, "image/jpeg","2018-09-09",2),
			new Media(2,"titre 3","url.png", "#image", 0, "image/png","2018-09-09",2)
		);
		
		$oVueMedia->adm_afficherTous($aoMedias );
		
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>adm_afficherModifierUn(Media $oMedia, $sMsg="")</h2>
  <?php
  try{
  		/* ====== Initialisation ============ */
		$_GET['action'] = 'mod';
		/*Declaration d'un objet*/
		$oVueMedia = new VueMedia();
		
		$oMedia = new Media(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères",1,"image/png","2018-09-09",2);
		$aoAuteurs = array(
			new Auteur(1,"Hugo","Victor","eh@gf.ca"),
			new Auteur(2,"Zola","Émile","ez@gf.ca")
		);
		$oVueMedia->adm_afficherModifierUn($oMedia, $aoAuteurs);
		
   
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
		$oVueMedia = new VueMedia();
		$aoAuteurs = array(
			new Auteur(1,"Hugo","Victor","eh@gf.ca"),
			new Auteur(2,"Zola","Émile","ez@gf.ca")
		);
		$oVueMedia->adm_afficherAjouterUn($aoAuteurs);
		
   
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
 