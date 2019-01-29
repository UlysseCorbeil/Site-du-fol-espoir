<?php
/**
* Nom : ImageLib.class.php
* Auteur : Caroline Martin
* Description :
* - fonction televerser()
* - fonction redimensionner()
* php.ini il faut ajouter l'extension php_fileinfo.dll de la manière suivante :
* extension=php_fileinfo.dll pour pouvoir utiliser fileinfo::file() afin d'obtenir le type MIME du fichier
* 
* Historique :
* Date 			Version Description 							Auteur
* 2018-10-24 	2.0 : transformation en classe						Caroline Martin
*/

class ImageLib {

	const DOSSIER_IMAGES = '../../../public/medias/';
	
	const ERR_VALIDATE_EXISTE = "Le paramètre doit être une valeur existante dans le tableau.";
	
	const ERR_DIR_OUVERTURE = "Le dossier spécifié n'a pas pu être ouvert.";
	
	const ERR_FILE_UPLOAD_SUCCES="Le fichier a &eacute;t&eacute; t&eacute;l&eacute;vers&eacute; avec succ&egrave;s sur le serveur.";
	const ERR_FILE_UPLOAD_COPY="ERREUR dans la copie, Le fichier n&rsquo;a pas &eacute;t&eacute; t&eacute;l&eacute;vers&eacute;.";	
	const ERR_FILE_UPLOAD ="Un probl&egrave;me s'est produit durant le t&eacute;l&eacute;versement du fichier.";
	const ERR_FILE_SELECT ="Le fichier n'a pas &eacute;t&eacute; s&eacute;lectionn&eacute;.";
	
	const ERR_IMAGE ="L'image n'a pas pu être créée.";
	const ERR_IMAGE_MIME ="Le fichier ne contient pas un média (image ou audio).";
	
	private $aCarIndesirables = array(" ", "<", ">", ":", "\"", "/", "\\", "|", "?", "*", "-", "..", ".", "à", "â", "é", "è", "ë", "ê", "î", "ï", "ù", "û", "ô");
	private $aTypeMIME = array('image/gif','image/jpeg','image/png');
	
	private $sNameInputFile;
	
	
	/**
    * constructeur 
	* @param string $sNameInputFile
	* @return void
    */
	public function __construct($sNameInputFile){
		$this->setsNameInputFile($sNameInputFile);
	}
	
	/**
    * affecte la valeur du paramètre a la propriété privée 
    * @param string $sNameInputFile
    * @return void
    */
	public function setsNameInputFile($sNameInputFile){
		TypeException::estVide($sNameInputFile);
		TypeException::estChaineDeCaracteres($sNameInputFile);
		
		$this->sNameInputFile = $sNameInputFile;
	}
	/**	
	 * Permet de téléverser un fichier 
	 * Pour une liste des types MIME valides : http://en.wikipedia.org/wiki/Internet_media_type
	 * @param string $sNameInputFile la valeur de l'attribut 'name' de la balise input de type 'File' 
	 * @return integer : 
	 * 					ERR_FILE_UPLOAD_SUCCES si le téléchargement s'est bien déroulé
	 *               	ERR_FILE_UPLOAD si le fichier ne fait pas partie de la liste des types mime.
	 * 					ERR_FILE_UPLOAD_COPY si le fichier n'a pu être copié 
	 */	
	public function televerser(&$sFileUpload, $aTypeMIME = array('image/gif','image/jpeg','image/png')){
		
		$oFileInfo = new finfo();
		if(key_exists($this->sNameInputFile, $_FILES) == false)
			throw new Exception(ImageLib::ERR_VALIDATE_EXISTE." sNameInputFile ".$this->sNameInputFile);
		
		$aExtensions = explode("/", $oFileInfo->file($_FILES[$this->sNameInputFile]['tmp_name'], FILEINFO_MIME_TYPE));
		
		$sFileUpload = str_replace($this->aCarIndesirables, "", strtolower($_FILES[$this->sNameInputFile]['name']));
		
		/* $sFileUpload est maintenant constitué sans caractères indésirables */
		$sFileUpload = $sFileUpload.".".$aExtensions[1];
		//var_dump($sFileUpload);
		
		$sNomFicherUpload = ImageLib::DOSSIER_IMAGES.basename($sFileUpload);
		
		
		//var_dump($oFileInfo->file($_FILES[$this->sNameInputFile]['tmp_name'], FILEINFO_MIME_TYPE));
		if(in_array(@$oFileInfo->file($_FILES[$this->sNameInputFile]['tmp_name'], FILEINFO_MIME_TYPE), $aTypeMIME) == false){
			throw new Exception(ImageLib::ERR_IMAGE_MIME);
		}
			
		if (copy($_FILES[$this->sNameInputFile]['tmp_name'], $sNomFicherUpload) == true) 
			return ImageLib::ERR_FILE_UPLOAD_SUCCES;
		else{
			return ImageLib::ERR_FILE_UPLOAD_COPY;
		}
		
	} //fin de la fonction telecharger()	
 
 
     /**
	 * Prérequis: PHP 4 >= 4.0.6 avec support de GB avec les librairies JPEG et PNG
	 * Cette méthode crée une image miniature à partir de fichier jpeg ou png.
	 * L'image source est redimensionnée en gardant les proportions.
	 * L'image est entourée de lignes de couleur $sCouleur
	 * L'image est placée dans un cadre de $iLargeurMax par $iHauteurMax de couleur $sCouleurFond
	 * @param string $sUrlImage 
	 * @param integer $iLargeurMax Largeur de l'image créée
	 * @param integer $iHauteurMax Hauteur de l'image créée.
	 * @param integer $iBordure Espace entre le thumbnail et la bordure de l'image créée.
	 * @param boolean $saveCPU  True retourne des images de moins bonne qualité mais utilise moins de ressources.
	 */
	public function redimensionner($sUrlImage, $sPath, $sPathDest, $iLargeurMax=150, $iHauteurMax=150, $iBordure=5, $saveCPU= true, $iBorderR=87, $iBorderG=84, $iBorderB=77, $iFondR=186, $iFondG=180, $iFondB=165){
		TypeException::estVide($sUrlImage);
		TypeException::estVide($sPath);
		TypeException::estVide($sPathDest);
		
		TypeException::estChaineDeCaracteres($sUrlImage);	
		TypeException::estChaineDeCaracteres($sPath);		
		TypeException::estChaineDeCaracteres($sPathDest);
		
		TypeException::estNumerique($iLargeurMax);	
		TypeException::estNumerique($iHauteurMax);		
		TypeException::estNumerique($iBordure);
		TypeException::estNumerique($iBorderR);	
		TypeException::estNumerique($iBorderG);		
		TypeException::estNumerique($iBorderB);
		TypeException::estNumerique($iFondR);	
		TypeException::estNumerique($iFondG);		
		TypeException::estNumerique($iFondB);
		
		$image = $sPath.$sUrlImage;
		
		$oFileInfo = new finfo();
		
		if(in_array($oFileInfo->file($image, FILEINFO_MIME_TYPE), $this->aTypeMIME) == false){
			throw new Exception(get_class(). "::". ImageLib::ERR_IMAGE_MIME);
		}
		
		$x = 0;
		$y = 0;
		$imageInfo = GetImageSize($image);
		//Les types d'image PNG et JPEG étant supportés, on s'assure d'utiliser la bonne fonction pour le bon type.
		switch($imageInfo['mime']){
			case 'image/jpeg':
				$source = Imagecreatefromjpeg($image);
				break;
			case 'image/png':
				$source = imagecreatefrompng($image);
				break;
			case 'image/gif':
				$source = imagecreatefromgif($image);
				break;
			default:
				throw new Exception(get_class()." ".ImageLib::ERR_IMAGE_MIME. " ->".$imageInfo['mime']."<-");
				
		}		
		$largeurSource = imagesx($source);
		$hauteurSource = imagesy($source);
		
		//Calcul des dimensions du thumbnail en gardant les bonnes proportions.
		if($largeurSource > $hauteurSource){
			$largeurDestination = $iLargeurMax;
			$hauteurDestination = $hauteurSource/$largeurSource*$largeurDestination;
			$y = ($iHauteurMax-$hauteurDestination)/2;
		}elseif($hauteurSource > $largeurSource){
			$hauteurDestination = $iHauteurMax;
			$largeurDestination = $largeurSource/$hauteurSource*$hauteurDestination;
			$x = ($iLargeurMax-$largeurDestination)/2;
		}else{
			$hauteurDestination = $iHauteurMax;
			$largeurDestination = $iLargeurMax;
		}
		
		$im = ImageCreateTrueColor ($iLargeurMax, $iHauteurMax);
		if($im == false)
			 throw new exception (get_class()."::".Image::ERR_IMAGE_CREATE);
		
		$sCouleur = ImageColorAllocate ($im, $iBorderR, $iBorderG, $iBorderB);//Couleur RVB pour le contour du thumbnail.
		$sCouleurFond = imageColorAllocate ($im, $iFondR, $iFondG, $iFondB);//Couleur RVB pour le cadre de l'image.
		ImageFill($im, 0, 0, $sCouleurFond);
		
		//Utilisation des différentes fonctions de redimensionnement dependament de la qualité voulue.
		if($saveCPU === true){
			ImageCopyResized($im, $source, $iBordure+$x, $iBordure+$y, 0, 0, $iLargeurMax-$iBordure*2-$x*2, $iHauteurMax-$iBordure*2-$y*2, $largeurSource, $hauteurSource);
		}else{
			ImageCopyResampled($im, $source, $iBordure+$x, $iBordure+$y, 0, 0, $iLargeurMax-$iBordure*2-$x*2, $iHauteurMax-$iBordure*2-$y*2, $largeurSource, $hauteurSource);
		}
		
		ImageLine ($im, $iBordure+$x, $iBordure+$y, $iLargeurMax-$iBordure-$x-1, $iBordure+$y, $sCouleur);//Ligne de detourage Haut
		ImageLine ($im, $iBordure+$x, $iBordure+$y, $iBordure+$x, $iHauteurMax-$iBordure-$y-1, $sCouleur);//Ligne de detourage Gauche
		ImageLine ($im, $iLargeurMax-$iBordure-$x-1, $iBordure+$y, $iLargeurMax-$iBordure-$x-1, $iHauteurMax-$iBordure-$y-1, $sCouleur);//Ligne de detourage Droite
		ImageLine ($im, $iBordure+$x, $iHauteurMax-$iBordure-$y-1, $iLargeurMax-$iBordure-$x-1, $iHauteurMax-$iBordure-$y-1, $sCouleur);//Ligne de detourage Bas
		ImageJpeg ($im, $sPathDest.$sUrlImage);
		
		ImageDestroy ($im);//Destruction de l'image dans le cache du serveur.
	}//fin de la fonction redimensionner()

}//fin de la classe 

?>