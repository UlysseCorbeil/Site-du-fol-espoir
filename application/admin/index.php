<?php
session_start();
ob_start();
/**
 * Fichier index.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:14:07 PM
 */

/* =================================== */
/* = Nécessaire ====================== */
/* =================================== */
require('../../composant/vues/Vue.class.php');
require('../../composant/lib/Autoloader.class.php');

require("../controleurs/Controleur.class.php");

spl_autoload_register('autoload');


/* =================================== */
/* = Programme Principal ============= */
/* =================================== */
try{
	$oControleur = new Controleur();
	
	$oControleur->adm_gererAuthentification();
	
}catch(Exception $oException){
	echo "<p>".$oException->getMessage()."</p>";
}
