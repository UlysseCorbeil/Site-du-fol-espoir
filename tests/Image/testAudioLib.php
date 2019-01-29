<?php

/**
 * Fichier testAudioLib.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 24 of October 2018 07:14:04 PM
 */

 /* ========================================= */
 /* ==== Inclure les fichiers composant ===== */
 /* ========================================= */
 	require('../../composant/lib/ImageLib.class.php');
	require('../../composant/lib/AudioLib.class.php');
	require('../../composant/lib/TypeException.class.php');
	require('../../composant/vues/Vue.class.php');
 	
 /* ========================================= */
 /* ==== ============================== ===== */
 /* ========================================= */    
 
 
 /**	
 * Permet de d'afficher le formulaire de téléversement
  * @param void
  * @return void
 */	
function afficherFormTeleversement(){
$sHTML = "
<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\"  enctype=\"multipart/form-data\" name=\"frmUpload\">
	<!-- MAX_FILE_SIZE must precede the file input field -->
	<input   type='hidden' name='MAX_FILE_SIZE' value='50000000'>
				 
	<!-- Name of input element determines name in \$_FILES array -->
 	<input   type='file' size='140' name='sUrlImg' value=''>
				 
	<input type='submit' value='Téléverser' name='cmd' >
				 
</form>";
echo $sHTML;
}//fin de la fonction
/**	
 * Permet de d'afficher le formulaire de téléversement
  * @param void
  * @return void
 */	
function afficherAudio($sUrlAudio){
$sHTML = "
<section>
	<audio controls>
		<source src=\"".$sUrlAudio."\" >
	</audio>
</section>";
	
echo $sHTML;
}//fin de la fonction
/* ========================================= */
/* ==== ============================== ===== */
/* ========================================= */    
 
try{
	/* ========================================= */
	/* ====== Début de la page HTML ============ */
	/* ========================================= */
	$oVue = new Vue();
	$aCss = array("../public/css/global.css");
	$aJs = array();
	echo $oVue->getHeader("Tests de la classe AudioLib", $aCss, $aJs, "Fichier de tests", "Caroline Martin", "", "fr", "utf-8");
?>
<?php
	/* ========================================= */
	/* ====== Contenu de la page HTML ========== */
	/* ========================================= */
?>
<h1>Test de la classe AudioLib</h1>
<h2>televerser()</h2>

  <?php
  try{
  		$aCarIndesirables = array(" ", "<", ">", ":", "\"", "/", "\\", "|", "?", "*", "-", "..", ".");
		if(isset($_POST['cmd']) == false){
			afficherFormTeleversement();
		}else{
			
			
			$oAudioLib = new AudioLib('sUrlImg');
			
			
			var_dump($oAudioLib->televerser());
			
			$aExtensions = explode("/", $_FILES['sUrlImg']['type']);
			$aExtensions[1] = str_replace("e", "", $aExtensions[1]);
			$sFileUpload = str_replace($aCarIndesirables, "", $_FILES['sUrlImg']['name']);
			$sUrlAudio = basename($sFileUpload).".".$aExtensions[1];
			
			afficherAudio(ImageLib::DOSSIER_IMAGES.$sUrlAudio);
		}
	 }catch(Exception $oException){
   		echo  "<p>".$oException->getMessage()."</p>";
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
