<?php
/**
* Nom : AudioLib.class.php
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

class AudioLib extends ImageLib{

	/**	
	 * Permet de téléverser un fichier 
	 * Pour une liste des types MIME valides : http://en.wikipedia.org/wiki/Internet_media_type
	 * @param string $sNameInputFile la valeur de l'attribut 'name' de la balise input de type 'File' 
	 * @return integer : 
	 * 					ERR_FILE_UPLOAD_SUCCES si le téléchargement s'est bien déroulé
	 *               	ERR_FILE_UPLOAD si le fichier ne fait pas partie de la liste des types mime.
	 * 					ERR_FILE_UPLOAD_COPY si le fichier n'a pu être copié 
	 */	
	public function televerser(&$sFileUpLoad, $aTypeMIME = array('audio/wav', 'audio/x-wav', 'audio/mpeg', 'audio/mpeg3','audio/x-mpeg-3', 'audio/ogg', 'application/ogg')){
		
		return ImageLib::televerser($sFileUpLoad, $aTypeMIME);
		
	} //fin de la fonction telecharger()	
 
 
     
}//fin de la classe 

?>