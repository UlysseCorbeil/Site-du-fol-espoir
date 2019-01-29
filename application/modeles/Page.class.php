
<?php
/**
 * Fichier Page.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:54 PM
 */
class Page {
	private $idPage;
	private $sTitrePage;
	private $sTextePage;
	
    /**
    * constructeur 
	* @param integer $idPage
	* @param string $sTitrePage
	* @param string $sTextePage
	* @return void
    */
    public function __construct($idPage=1,$sTitrePage="",$sTextePage=""){
			$this->setidPage($idPage);
			$this->setsTitrePage($sTitrePage);
			$this->setsTextePage($sTextePage);
    	
    }//fin de la fonction
	
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param integer $idPage
    * @return void
    */
    public function setidPage($idPage){     	
    	TypeException::estNumerique($idPage);
    	$this->idPage = $idPage;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  integer
    */
    public function getidPage(){	   
    	return $this->idPage;
    }//fin de la fonction
		
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param string $sTitrePage
    * @return void
    */
    public function setsTitrePage($sTitrePage){     	
    	TypeException::estChaineDeCaracteres($sTitrePage);
    	$this->sTitrePage = $sTitrePage;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  string
    */
    public function getsTitrePage(){	   
    	return $this->sTitrePage;
    }//fin de la fonction
		
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param string $sTextePage
    * @return void
    */
    public function setsTextePage($sTextePage){     	
    	TypeException::estChaineDeCaracteres($sTextePage);
    	$this->sTextePage = $sTextePage;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  string
    */
    public function getsTextePage(){	   
    	return $this->sTextePage;
    }//fin de la fonction
		
    /**
    * ajoute un enregistrement dans la table "pages"
    * @param void
    * @return integer (le id de la dernière insertion) ou un boolean (false si l'insertion s'est mal passée)
    */
    public function ajouter(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			INSERT pages
			(sTitrePage,sTextePage)
			VALUES(:sTitrePage,:sTextePage)
		";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":sTitrePage", $this->getsTitrePage(), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":sTextePage", $this->getsTextePage(), PDO::PARAM_STR);
			
		//Exécuter la requête
		$b = $oPDOStatement->execute();
		
		//Si la requête a bien été exécutée
		if($b == true){
			
			return (int)$oPDOLib->getoPDO()->lastInsertId();
		}
		$oPDOLib->fermerLaConnexion();	
		return false;	
		
    }//fin de la fonction
		
    /**
    * modifie un enregistrement dans la table "pages"
    * @param void
    * @return integer (le nombre d'enregistrement modifié) ou un boolean (false si la modification s'est mal passée)
    */
    public function modifier(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			UPDATE pages
			SET sTitrePage = :sTitrePage,sTextePage = :sTextePage
			WHERE idPage= :idPage";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		
		$oPDOStatement->bindValue(":sTitrePage", $this->getsTitrePage(), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":sTextePage", $this->getsTextePage(), PDO::PARAM_STR); 
		$oPDOStatement->bindValue(":idPage", $this->getidPage(), PDO::PARAM_INT);
		
		//Exécuter la requête
		$b = $oPDOStatement->execute();
		
		//Si la requête a bien été exécutée
		if($b == true){
			$oPDOLib->fermerLaConnexion();
			return (int)$oPDOStatement->rowCount();
		}
		$oPDOLib->fermerLaConnexion();
		return false;	
		
    }//fin de la fonction
		
    /**
    * supprime un enregistrement dans la table "pages"
    * @param void
    * @return integer (le nombre d'enregistrement supprimé) ou un boolean (false si la suppression s'est mal passée)
    */
    public function supprimer(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			DELETE FROM pages
			WHERE idPage= :idPage";
			
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":idPage", $this->getidPage(), PDO::PARAM_INT);
		
		//Exécuter la requête
		$b = $oPDOStatement->execute();
		
		//Si la requête a bien été exécutée
		if($b == true){
			$oPDOLib->fermerLaConnexion();
			return (int)$oPDOStatement->rowCount();
		}
		$oPDOLib->fermerLaConnexion();
		return false;	
		
    }//fin de la fonction
		
    /**
    * rechercher un enregistrement dans la table "pages"
    * @param void
    * @return boolean (true si trouvé, false dans les autres cas)
    */
    public function rechercherUn(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			SELECT * 
			FROM pages
			WHERE idPage= :idPage";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":idPage", $this->getidPage(), PDO::PARAM_INT);
		
		//Exécuter la requête
		$b = $oPDOStatement->execute();
		
		//Si la requête a bien été exécutée
		if($b == true){
			//Récupérer l'enregistrement (fetch)
			$aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
			if($aEnregs !== false){
				//Affecter les valeurs aux propriétés privées de l'objet
				$this->__construct($aEnregs['idPage'],$aEnregs['sTitrePage'],$aEnregs['sTextePage']);
				$oPDOLib->fermerLaConnexion();
				return true;
			}
		}
		$oPDOLib->fermerLaConnexion();
		return false;	
		
    }//fin de la fonction
		
    /**
    * rechercher tous les enregistrements dans la table "pages"
    * @param void
    * @return array ou boolean (false si la recherche s'est mal passée)
    */
    public function rechercherTous(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			SELECT * 
			FROM pages";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs				
		//void
		
		//Exécuter la requête
		$b = $oPDOStatement->execute();
		
		//Si la requête a bien été exécutée
		if($b == true){
			//Récupérer le array 
			$aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
			$iMax = count($aEnregs);
			$aoEnregs = array(); 
			if($iMax > 0){
				for($iEnreg=0;$iEnreg<$iMax;$iEnreg++){
					$aoEnregs[$iEnreg] = new Page(
						$aEnregs[$iEnreg]['idPage'],$aEnregs[$iEnreg]['sTitrePage'],$aEnregs[$iEnreg]['sTextePage']
					);
				}
				$oPDOLib->fermerLaConnexion();
				//Retourner le array d'objets de la classe Page				
				return $aoEnregs;
			}
		}
		$oPDOLib->fermerLaConnexion();
		return false;	
		
    }//fin de la fonction
		
}//fin de la classe Page