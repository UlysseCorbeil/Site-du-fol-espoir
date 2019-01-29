<?php
session_start();
/**
 * Fichier adm_gererTexte.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:14:07 PM
 */

/* =================================== */
/* = Nécessaire ====================== */
/* =================================== */
require('../../../composant/vues/Vue.class.php');
require('../../../composant/lib/Autoloader.class.php');

require("../../controleurs/ControleurAdmin.class.php");

spl_autoload_register('autoloadAjax');

ob_start();


/* =================================== */
/* = Programme Principal ============= */
/* =================================== */
try{
	$oControleur = new ControleurAdmin();
	
	$oControleur->adm_gererAuteur();
		
}catch(Exception $oException){
	echo "<p>".$oException->getMessage()."</p>";
}
