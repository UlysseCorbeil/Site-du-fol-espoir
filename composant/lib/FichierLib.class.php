<?php
/**
 * Component du framework
 * pour le cours 582-346-MA
 * @author Caroline Martin
 * @version 2017-10-31
 */
    class FichierLib  {   	
    	private $sNomFichierJson;
		
		/**
		 * 
		 * Constructeur de la classe FichierLib
		 * @access public
		 * @param string $sNomFichierJson
		 * @return void  
		 */
		public function __construct($sNomFichierJson){			
			$this->setNomFichierJson($sNomFichierJson);
		}//fin de la fonction __construct()
		
		/**
		 * 
		 * Affecte la valeur du paramètre à la propriété privée
		 * @access public
		 * @param string $sNomFichierJson
		 * @return void  
		 */
		public function setNomFichierJson($sNomFichierJson){
			if(@file_exists($sNomFichierJson) == false)
				throw new Exception("Erreur - Fichier inexistant.");
			
			$this->sNomFichierJson = $sNomFichierJson;
		}//fin de la fonction
							
			
		/**
		 * 
		 * Lire un fichier JSON en une chaîne de caractères encodée JSON  
		 * pour la transformer en un tableau associatif	
		 * @access public
		 * @return array associatif  
		 */
		public function JsonToArrayAssoc(){
			$sJSONFileContent = "";			
			
			//Lecture du fichier
			$sJSONFileContent = file_get_contents($this->sNomFichierJson);
			
			/* Transforme une chaîne de caractères encodée JSON 
			pour la transformer en un tableau associatif (paramètre à true) */
			$aAssoc = array();
			$aAssoc = json_decode($sJSONFileContent, true);
			
			unset($sJSONFileContent);//prevent memory leaks for large json.
			
			return $aAssoc;
		}//fin de la fonction JsonToArrayAssoc()
		
		
		/**
		 * 
		 * Écrire un fichier JSON avec une chaîne de caractères encodée JSON  
		 * après l'avoir récupérée d'un tableau associatif	
		 * @access public		 
		 * @param array  $aAssoc
		 * @return integer le nombre d'octets écrits ou false
		 */
		public function arrayAssocToJson($aAssoc){
			
			$sJSON = json_encode($aAssoc);
			
			//Suppression du fichier
			@unlink($this->sNomFichierJson);	
			//Écriture dans le fichier
			//Lecture du fichier
			$iResult = file_put_contents($this->sNomFichierJson, $sJSON);
			
			unset($sJSON);//prevent memory leaks for large json.
			
			return $iResult;
		}//fin de la fonction arrayAssocToJson()
		
    }//fin de la classe FichierLib
?>