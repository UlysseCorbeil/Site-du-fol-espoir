<?php

/**
 * Fichier testImageLib.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 24 of October 2018 07:14:04 PM
 */

 /* ========================================= */
 /* ==== Inclure les fichiers composant ===== */
 /* ========================================= */
 	require('../../composant/lib/ImageLib.class.php');
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
	<input   type='hidden' name='MAX_FILE_SIZE' value='20000000000'>
				 
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
function afficherImage($sUrlImg){
$sHTML = "
<section>
	<h1>".$sUrlImg."</h1>
	<img src=".$sUrlImg." alt='image réduite'>
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
	echo $oVue->getHeader("Tests de la classe ImageLib", $aCss, $aJs, "Fichier de tests", "Caroline Martin", "", "fr", "utf-8");
?>
<?php
	/* ========================================= */
	/* ====== Contenu de la page HTML ========== */
	/* ========================================= */
?>
<h1>Test de la classe ImageLib</h1>
<h2>televerser()</h2>

  <?php
  try{
  		$aCarIndesirables = array(" ", "<", ">", ":", "\"", "/", "\\", "|", "?", "*", "-", "..", ".");
		if(isset($_POST['cmd']) == false){
			afficherFormTeleversement();
		}else{
			
			$oImageLib = new ImageLib('sUrlImg');
			var_dump($oImageLib->televerser());
		}
	 }catch(Exception $oException){
   		echo  "<p>".$oException->getMessage()."</p>";
  	}
	 try{	
		if(isset($_POST['cmd']) == true){	
			
			
			
			//$sPath ="file://"; 
			$sPath = ImageLib::DOSSIER_IMAGES; 
			$sPathDest = "reduite/"; 
			
			//$sUrlImage = $_FILES['sUrlImg']['tmp_name'];
			$aExtensions = explode("/", $_FILES['sUrlImg']['type']);
			$aExtensions[1] = str_replace("e", "", $aExtensions[1]);
			$sFileUpload = str_replace($aCarIndesirables, "", $_FILES['sUrlImg']['name']);
			$sUrlImage = basename($sFileUpload).".".$aExtensions[1];
			$oImageLib->redimensionner($sUrlImage, $sPath, $sPathDest, $iLargeurMax=150, $iHauteurMax=150, $iBordure=5, $saveCPU= true, $iBorderR=87, $iBorderG=84, $iBorderB=77, $iFondR=186, $iFondG=180, $iFondB=165);
			
			
			afficherImage($sPathDest.$sUrlImage);
			afficherImage(ImageLib::DOSSIER_IMAGES.$sUrlImage);
		}
	
  }catch(Exception $oException){
   		echo "<p>".$oException->getMessage()."</p>";
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
