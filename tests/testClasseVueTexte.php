
<?php
/**
 * Fichier testClasseVueTexte.php
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
    require('../application/modeles/Texte.class.php');
	require('../application/modeles/Auteur.class.php');
 /* ========================================= */
 /* ==== Inclure les fichiers vue =========== */
 /* ========================================= */
	 require('../application/vues/VueTexte.class.php');
	 
	
	try{
	/* ========================================= */
	/* ====== Début de la page HTML ============ */
	/* ========================================= */
	$oVue = new Vue();
	$aCss = array("../public/css/global.css");
	$aJs = array();
	echo $oVue->getHeader("Tests de la classe Texte", $aCss, $aJs, "Fichier de tests", "Caroline Martin", "../public/css/ff.png", "fr", "utf-8");
	
	/* ====== Initialisation ============ */
	$_GET['s'] = 1;
?>
<?php
	/* ========================================= */
	/* ====== Contenu de la page HTML ========== */
	/* ========================================= */
?>
<h1>Test de la classe VueTexte</h1>
<h2>afficherTous($aoTextes, $sMsg="")</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oVueTexte = new VueTexte();
		
		$aoTextes  = array(
			new Texte(2,"titre 1","Une chaine de caractères","inclassable","#qwerty",0,"2018-09-09",2),
			new Texte(2,"titre 2","Une chaine de caractères","poésie","#qwerty",0,"2018-09-09",2),
			new Texte(2,"titre 3","Une chaine de caractères","essai","#qwerty",0,"2018-09-09",2)
		);
		
		$oVueTexte->afficherTous($aoTextes );
		
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>adm_afficherTous($aoTextes, $sMsg="")</h2>
  <?php
  try{
		/*Declaration d'un objet*/
		$oVueTexte = new VueTexte();
		
		$aoTextes  = array(
			new Texte(2,"titre 1","Une chaine de caractères","inclassable","#qwerty",0,"2018-09-09",2),
			new Texte(2,"titre 2","Une chaine de caractères","poésie","#qwerty",0,"2018-09-09",2),
			new Texte(2,"titre 3","Une chaine de caractères","essai","#qwerty",0,"2018-09-09",2)
		);
		
		$oVueTexte->adm_afficherTous($aoTextes);
		
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>adm_afficherModifierUn(Texte $oTexte, $sMsg="")</h2>
  <?php
  try{
  		/* ====== Initialisation ============ */
		$_GET['action'] = 'mod';
		/*Declaration d'un objet*/
		$oVueTexte = new VueTexte();
		
		$oTexte = new Texte(2,"titre 1","Une chaine de caractères","inclassable","#qwerty",1,"2018-09-09",2);
		$aoAuteurs = array(
			new Auteur(1,"Hugo","Victor","eh@gf.ca"),
			new Auteur(2,"Zola","Émile","ez@gf.ca")
		);
		$oVueTexte->adm_afficherModifierUn($oTexte, $aoAuteurs);
		
   
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
		$oVueTexte = new VueTexte();
		
		$oVueTexte->adm_afficherAjouterUn($aoAuteurs);
		
   
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
 