<?php
/**
 * 
 * Code skeleton generated by dia-uml2php5 plugin
 * written by KDO kdo@zpmag.com
 */

class DossierLib {
	const ERR_OPEN_DIR ="ERREUR d'ouverture du dossier ";
	const ERR_CREATE_DIR ="ERREUR lors de la cr�ation du dossier ";
	const ERR_CREATE_FILE ="ERREUR lors de la copie du fichier ";
	/**	
	 * @access public
	 * Permet de  lire le contenu d'un dossier
	 * 
	 * @param $sNomDossier : cha�ne de caract�res, contient le nom du dossier � lire
	 * @param integer $sorting_order 
	 * @param $aFichiers : array, contient la liste des fichiers/dossiers lus 
	 * dans le dossier dans l'ordre dans lequel le syst�me les stocke.
	 * 
	 * @return boolean : true si la lecture du contenu du dossier s'est bien d�roul�e
     *                   false dans les autres cas.
	 * Note : l'op�rateur !== n'existe qu'� partir de la version 4.0.0-RC2
	 */	
	static public final  function  lireDossier($sNomDossier, $sorting_order=SCANDIR_SORT_ASCENDING, &$aFichiers){		
		$ptrDossier = @opendir($sNomDossier);
		if (!$ptrDossier) {
			throw new Exception(DossierLib::ERR_OPEN_DIR. $sNomDossier);			
		}
		closedir($ptrDossier);
		
		$aFichiers = scandir ($sNomDossier, $sorting_order);
	
	   
	   return true;
	}//fin de la fonction lireDossier()
	/**	
	 * @access public
	 * Permet de cr�er un dossier
	 * 
	 * @param $sNomDossier : cha�ne de caract�res, contient le nom du dossier � copier
	 * @return boolean : true si la cr�ation du dossier s'est bien d�roul�e
     *                   Une exception dans les autres cas.
	 */	
	static public final function creerDossier($sNomDossier){
		//Cr�er le dossier sNomDossier s'il n'existe pas
		$ptrDossier = @opendir($sNomDossier);
		if(!$ptrDossier){		
			$bCreer = mkdir($sNomDossier);
			if($bCreer == false)
				throw new Exception(DossierLib::ERR_CREATE_DIR." ".$sNomDossier);
		}
		return true;
	}
	
	/**	
	 * @access public
	 * Permet de copier le contenu d'un dossier, doccier et fichier en gardant la m�me arborescence
	 * 
	 * @param $sNomDossier : cha�ne de caract�res, contient le nom du dossier dont les dossiers set fichiers sont � copier
	 * @param $sNeoNomDossier : cha�ne de caract�res, contient le nom du dossier dont les dossiers set fichiers sont � copier
	 * @param $aFichiers : array, contient la liste des fichiers/dossiers.
	 * 
	 * @return boolean : true si la copie du contenu du dossier s'est bien d�roul�e
     *                   false dans les autres cas.
	 */	
	static public final function copierDossiers($sNomDossier, $sPath, $sNeoNomDossier){
		DossierLib::lireDossier($sNomDossier, SCANDIR_SORT_ASCENDING, $aFichiers);
		//Cr�er le dossier NeoNomDossier s'il n'existe pas
		DossierLib::creerDossier($sPath.$sNeoNomDossier);
		
		for($iFile = 0; $iFile <count($aFichiers); $iFile++) {
			if($aFichiers[$iFile]!="." && $aFichiers[$iFile]!=".."){
				$ptrDossier=@opendir($sNomDossier.$aFichiers[$iFile]);
				
				if(!$ptrDossier){
					$bCopier = copy($sNomDossier.$aFichiers[$iFile] , $sPath.$sNeoNomDossier.$aFichiers[$iFile]);
					if($bCopier == false)
						throw new Exception(DossierLib::ERR_CREATE_FILE. $sPath.$sNeoNomDossier.$aFichiers[$iFile]);
				}else{
					closedir($ptrDossier);
				}
			}
		}
		 
	}//fin de la fonction copierDossiers()
	
	/**
	 * La racine de l'arbre est visité en premier puis tous les sous-arbres contenus
	 * dans cette racine le sont, et ce, de manière récursive.
	 * @param 
	 * @param 
	 */
	static public function preorder($sPath, $aDossiers, $sPathNeo){
		$sPathNeo = rtrim($sPathNeo, "\\");
		$sPath = rtrim($sPath, "\\");	
		for($iIndice=2; $iIndice<count($aDossiers); $iIndice++){			
			if(TypeException::estDossier($sPath."\\".$aDossiers[$iIndice]) != true ){//un fichier			
				//echo "<p style='color:purple;'>".$aDossiers[$iIndice]."</p>";
				$bCopier = copy($sPath."\\".$aDossiers[$iIndice] , $sPathNeo."\\".$aDossiers[$iIndice]);
				if($bCopier == false)
					throw new Exception(DossierLib::ERR_CREATE_FILE. $sPathNeo."\\".$aDossiers[$iIndice]);
			}
		
			//Est un dossier
			if(TypeException::estDossier($sPath."\\".$aDossiers[$iIndice]) == true ){
				//echo "<h1 style='color:orange;'>".$aDossiers[$iIndice]."</h1>";
				//Cr�er le dossier s'il n'existe pas
				$ptrDossier = @opendir($sPathNeo."\\".$aDossiers[$iIndice]);
				if(!$ptrDossier){		
					$bCreer = mkdir($sPathNeo."\\".$aDossiers[$iIndice]);
					if($bCreer == false)
						throw new Exception(DossierLib::ERR_CREATE_DIR." ".$aDossiers[$iIndice]);
				}else{
					closedir($ptrDossier);
				}
				
				$aListeDossiers = @scandir($sPath."\\".$aDossiers[$iIndice], SCANDIR_SORT_ASCENDING);
				if($aListeDossiers!=false)
					 DossierLib::preorder($sPath."\\".$aDossiers[$iIndice],$aListeDossiers, $sPathNeo."\\".$aDossiers[$iIndice]);
				else{					
					throw new Exception("GROS PROBLEME");
				}
			}
		}//fin du for
		
		
	}

}
?>