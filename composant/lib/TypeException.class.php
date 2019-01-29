<?php
/**
 * Component du framework
 * pour le cours 582-346-MA
 * @author Caroline Martin
 * @version 2015-06-16
 */
    class TypeException extends Exception {
    	
		const ERR_VIDE ="ERR_VIDE";	
		const ERR_STRING ="ERR_STRING";
		const ERR_INTEGER ="ERR_INTEGER";
		const ERR_NUMERIC ="ERR_NUMERIC";
		const ERR_FOLDER="ERR_FOLDER";
		const ERR_RESOURCE="ERR_RESOURCE";
		const ERR_OBJET = "ERR_OBJET";
		const ERR_INSTANCE ="ERR_INSTANCE";
		const ERR_ARRAY = "ERR_ARRAY";
		const ERR_SYSTEM = "ERR_SYSTEM";
    	/**
		 * détermine si le paramètre est une chaîne vide
		 * @param mixed $sCh
		 */
    	public static function estVide($sCh){
    		if(empty($sCh)==true)
				throw new TypeException(TypeException::ERR_VIDE);	
    	}
		
    	/**
		 * détermine si le paramètre est une chaîne de caractères
		 * @param mixed $sCh
		 */
    	public static function estChaineDeCaracteres($sCh){
    		if(is_numeric($sCh)==true)
				throw new TypeException(TypeException::ERR_STRING);	
    	}
    	/**
		 * détermine si le paramètre est une valeur numérique
		 * @param mixed $iInt
		 */
    	public static function estNumerique($iInt){
    		if(is_numeric($iInt)==false)
				throw new TypeException(TypeException::ERR_NUMERIC);	
    	}
		/**
		 * détermine si le paramètre est une valeur entière
		 * @param mixed $iInt
		 */
    	public static function estInteger($iInt){
    		if(is_integer($iInt)==false)
				throw new TypeException(TypeException::ERR_INTEGER);	
    	}
		/**
		 * détermine si le paramètre est un dossier
		 * @param mixed $sDossier
		 */
    	public static function estDossier($sDossier){
    		if(is_dir($sDossier)==false)
				throw new TypeException(TypeException::ERR_FOLDER);	
    	}
		/**
		 * détermine si le paramètre est une ressource
		 * @param mixed $rH
		 */
    	public static function estResource($rH){
    		if(is_resource($rH)==false)
				throw new TypeException(TypeException::ERR_RESOURCE);	
    	}
		/**
		 * détermine si le paramètre est un objet
		 * @param mixed $oObj
		 */
    	public static function estObjet($oObj){
    		if(is_object($oObj) == false){
				throw new Exception(TypeException::ERR_OBJET);
			}	
    	}
		
		/**
		 * détermine si le paramètre est un objet de type $sType
		 * @param mixed $oObj
		 * @param string $sType
		 */
    	public static function estDeType($oObj, $sType){
    		    
			$bType = $oObj instanceof $sType;
					
    		if(is_object($oObj) == false || $bType == false){
				throw new Exception(TypeException::ERR_INSTANCE);
			}	
    	}				
		
		/**
		 * détermine si le paramètre est un array
		 * @param mixed $aArr
		 */
    	public static function estArray($aArr){
    		if(is_array($aArr) == false){
				throw new Exception(TypeException::ERR_ARRAY);
			}	
    	}
		
		public function __construct($sMsg="", $iCode=0){
			parent::__construct($sMsg, $iCode);
		}
		
    }
?>