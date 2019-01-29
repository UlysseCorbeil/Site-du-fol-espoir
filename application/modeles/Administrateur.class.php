
<?php
/**
 * Fichier Administrateur.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:53 PM
 */
class Administrateur {
	private $idAdmin;
	private $sLoginAdmin;
	private $sPwdAdmin;
	private $sCourrielAdmin;
	
    /**
    * constructeur 
	* @param integer $idAdmin
	* @param string $sLoginAdmin
	* @param string $sPwdAdmin
	* @param string $sCourrielAdmin
	* @return void
    */
    public function __construct($idAdmin=1,$sLoginAdmin="",$sPwdAdmin="",$sCourrielAdmin=""){
			$this->setidAdmin($idAdmin);
			$this->setsLoginAdmin($sLoginAdmin);
			$this->setsPwdAdmin($sPwdAdmin);
			$this->setsCourrielAdmin($sCourrielAdmin);
    	
    }//fin de la fonction
	
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param integer $idAdmin
    * @return void
    */
    public function setidAdmin($idAdmin){     	
    	TypeException::estNumerique($idAdmin);
    	$this->idAdmin = $idAdmin;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  integer
    */
    public function getidAdmin(){	   
    	return $this->idAdmin;
    }//fin de la fonction
		
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param string $sLoginAdmin
    * @return void
    */
    public function setsLoginAdmin($sLoginAdmin){     	
    	TypeException::estChaineDeCaracteres($sLoginAdmin);
    	$this->sLoginAdmin = $sLoginAdmin;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  string
    */
    public function getsLoginAdmin(){	   
    	return $this->sLoginAdmin;
    }//fin de la fonction
		
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param string $sPwdAdmin
    * @return void
    */
    public function setsPwdAdmin($sPwdAdmin){     	
    	TypeException::estChaineDeCaracteres($sPwdAdmin);
    	$this->sPwdAdmin = $sPwdAdmin;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  string
    */
    public function getsPwdAdmin(){	   
    	return $this->sPwdAdmin;
    }//fin de la fonction
		
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param string $sCourrielAdmin
    * @return void
    */
    public function setsCourrielAdmin($sCourrielAdmin){     	
    	TypeException::estChaineDeCaracteres($sCourrielAdmin);
    	$this->sCourrielAdmin = $sCourrielAdmin;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  string
    */
    public function getsCourrielAdmin(){	   
    	return $this->sCourrielAdmin;
    }//fin de la fonction
		
    /**
    * ajoute un enregistrement dans la table "administrateurs"
    * @param void
    * @return integer (le id de la dernière insertion) ou un boolean (false si l'insertion s'est mal passée)
    */
    public function ajouter(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			INSERT administrateurs
			(sLoginAdmin,sPwdAdmin,sCourrielAdmin)
			VALUES(:sLoginAdmin,:sPwdAdmin,:sCourrielAdmin)
		";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":sLoginAdmin", $this->getsLoginAdmin(), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":sPwdAdmin", $this->getsPwdAdmin(), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":sCourrielAdmin", $this->getsCourrielAdmin(), PDO::PARAM_STR);
			
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
    * modifie un enregistrement dans la table "administrateurs"
    * @param void
    * @return integer (le nombre d'enregistrement modifié) ou un boolean (false si la modification s'est mal passée)
    */
    public function modifier(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			UPDATE administrateurs
			SET sLoginAdmin = :sLoginAdmin,sPwdAdmin = :sPwdAdmin,sCourrielAdmin = :sCourrielAdmin
			WHERE idAdmin= :idAdmin";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		
		$oPDOStatement->bindValue(":sLoginAdmin", $this->getsLoginAdmin(), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":sPwdAdmin", password_hash($this->getsPwdAdmin(), PASSWORD_DEFAULT), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":sCourrielAdmin", $this->getsCourrielAdmin(), PDO::PARAM_STR); 
		$oPDOStatement->bindValue(":idAdmin", $this->getidAdmin(), PDO::PARAM_INT);
		
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
    * supprime un enregistrement dans la table "administrateurs"
    * @param void
    * @return integer (le nombre d'enregistrement supprimé) ou un boolean (false si la suppression s'est mal passée)
    */
    public function supprimer(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			DELETE FROM administrateurs
			WHERE idAdmin= :idAdmin";
			
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":idAdmin", $this->getidAdmin(), PDO::PARAM_INT);
		
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
    * rechercher un enregistrement dans la table "administrateurs"
    * @param void
    * @return boolean (true si trouvé, false dans les autres cas)
    */
    public function rechercherUn(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			SELECT * 
			FROM administrateurs
			WHERE idAdmin= :idAdmin";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":idAdmin", $this->getidAdmin(), PDO::PARAM_INT);
		
		//Exécuter la requête
		$b = $oPDOStatement->execute();
		
		//Si la requête a bien été exécutée
		if($b == true){
			//Récupérer l'enregistrement (fetch)
			$aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
			if($aEnregs !== false){
				//Affecter les valeurs aux propriétés privées de l'objet
				$this->__construct($aEnregs['idAdmin'],$aEnregs['sLoginAdmin'],$aEnregs['sPwdAdmin'],$aEnregs['sCourrielAdmin']);
				$oPDOLib->fermerLaConnexion();
				return true;
			}
		}
		$oPDOLib->fermerLaConnexion();
		return false;	
		
    }//fin de la fonction
		
    /**
    * rechercher tous les enregistrements dans la table "administrateurs"
    * @param void
    * @return array ou boolean (false si la recherche s'est mal passée)
    */
    public function rechercherTous(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			SELECT * 
			FROM administrateurs";
		
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
					$aoEnregs[$iEnreg] = new Administrateur(
						$aEnregs[$iEnreg]['idAdmin'],$aEnregs[$iEnreg]['sLoginAdmin'],$aEnregs[$iEnreg]['sPwdAdmin'],$aEnregs[$iEnreg]['sCourrielAdmin']
					);
				}
				$oPDOLib->fermerLaConnexion();
				//Retourner le array d'objets de la classe Administrateur				
				return $aoEnregs;
			}
		}
		$oPDOLib->fermerLaConnexion();
		return false;	
		
    }//fin de la fonction

//    public function connexion(){
//        //Se connecter à la base de données
//        $oPDOLib = new PDOLib();
//        //Réaliser la requête
//        $sRequete="
//			SELECT *
//			FROM administrateurs
//			WHERE sCourrielAdmin= :sCourrielAdmin
//			AND sPwdAdmin= :sPwdAdmin
//			";
//
//        //Préparer la requête
//        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
//
//        //Lier les paramètres aux valeurs
//        $oPDOStatement->bindValue(":sCourrielAdmin", $this->getsCourrielAdmin(), PDO::PARAM_STR);
//        $oPDOStatement->bindValue(":sPwdAdmin", $this->getsPwdAdmin(), PDO::PARAM_STR);
//
//
//        //Exécuter la requête
//        $b = $oPDOStatement->execute();
//
//        //Si la requête a bien été exécutée
//        if($b == true){
//            //Récupérer l'enregistrement (fetch)
//            $aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
//            if($aEnregs !== false){
//                //Affecter les valeurs aux propriétés privées de l'objet
//                $this->__construct($aEnregs['idAdmin'],$aEnregs['sLoginAdmin'],$aEnregs['sPwdAdmin'],$aEnregs['sCourrielAdmin']);
//                $oPDOLib->fermerLaConnexion();
//                return true;
//            }
//        }
//        $oPDOLib->fermerLaConnexion();
//        return false;
//    }

    /**
     * Vérifier la connexion encrypter
     * @return bool
     */
    public function connexion(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			SELECT * 
			FROM administrateurs
			WHERE sCourrielAdmin= :sCourrielAdmin
			";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sCourrielAdmin", $this->getsCourrielAdmin(), PDO::PARAM_STR);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if($b == true){
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);

            if($aEnregs !== false){
                //Affecter les valeurs aux propriétés privées de l'objet

                if(password_verify($this->getsPwdAdmin(), $aEnregs['sPwdAdmin'])){
                    $this->__construct($aEnregs['idAdmin'],$aEnregs['sLoginAdmin'],$aEnregs['sPwdAdmin'],$aEnregs['sCourrielAdmin']);
                    $oPDOLib->fermerLaConnexion();
                    return true;
                }
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }

}//fin de la classe Administrateur