
<?php
/**
 * Fichier testClasseAuthentificationLib.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:14:04 PM
 */
 /* ========================================= */
 /* ==== Inclure les fichiers composant ===== */
 /* ========================================= */
 	require('../composant/lib/AuthentificationLib.class.php');
	require('../composant/lib/PDOLib.class.php');
	require('../composant/lib/TypeException.class.php');
	require('../composant/vues/Vue.class.php');
 /* ========================================= */
 /* ==== Inclure les fichiers modele ======== */
 /* ========================================= */	
    
	
	try{
	/* ========================================= */
	/* ====== Début de la page HTML ============ */
	/* ========================================= */
	$oVue = new Vue();
	$aCss = array("../public/css/global.css");
	$aJs = array();
	echo $oVue->getHeader("Tests de la classe AuthentificationLib", $aCss, $aJs, "Fichier de tests", "Caroline Martin", "../public/css/ff.png", "fr", "utf-8");
?>
<?php
	/* ========================================= */
	/* ====== Contenu de la page HTML ========== */
	/* ========================================= */
?>
<h1>Test de la classe AuthentificationLib</h1>
<h2>authentifier()</h2>
  <?php
  try{
  		session_start();
		
		/*Declaration d'un objet*/
		$oAuthent = new AuthentificationLib("cmartin","cmartin");
		
		$b = $oAuthent->authentifier("user");
		echo '<pre>';
		var_dump($b);
		echo '</pre>';
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>
  <h2>estAuthentifie($sNomSession)</h2>
  <?php
  try{
  		
		
		$b = $oAuthent->estAuthentifie("user");
		echo '<pre>';
		var_dump($b);
		echo '</pre>';
   
  }catch(Exception $oException){
   		echo $oException->getMessage();
  }
  ?>

	
	<h2>deconnecter($sNomSession)</h2>
  <?php
  try{
		$oAuthent->deconnecter("user");
		echo "<p>Vérifier avec estAuthentifie()</p>";
		$b = $oAuthent->estAuthentifie("user");
		echo '<pre>';
		var_dump($b);
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
 