
<?php
/**
 * Fichier Auteur.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:53 PM
 */
class Auteur {
	private $idAuteur;
	private $sNomAuteur;
	private $sPrenomAuteur;
	private $sCourrielAuteur;
	
    /**
    * constructeur 
	* @param integer $idAuteur
	* @param string $sNomAuteur
	* @param string $sPrenomAuteur
	* @param string $sCourrielAuteur
	* @return void
    */
    public function __construct($idAuteur=1,$sNomAuteur="",$sPrenomAuteur="",$sCourrielAuteur=""){
			$this->setidAuteur($idAuteur);
			$this->setsNomAuteur($sNomAuteur);
			$this->setsPrenomAuteur($sPrenomAuteur);
			$this->setsCourrielAuteur($sCourrielAuteur);
    	
    }//fin de la fonction
	
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param integer $idAuteur
    * @return void
    */
    public function setidAuteur($idAuteur){     	
    	TypeException::estNumerique($idAuteur);
    	$this->idAuteur = $idAuteur;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  integer
    */
    public function getidAuteur(){	   
    	return $this->idAuteur;
    }//fin de la fonction
		
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param string $sNomAuteur
    * @return void
    */
    public function setsNomAuteur($sNomAuteur){     	
    	TypeException::estChaineDeCaracteres($sNomAuteur);
    	$this->sNomAuteur = $sNomAuteur;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  string
    */
    public function getsNomAuteur(){	   
    	return $this->sNomAuteur;
    }//fin de la fonction
		
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param string $sPrenomAuteur
    * @return void
    */
    public function setsPrenomAuteur($sPrenomAuteur){     	
    	TypeException::estChaineDeCaracteres($sPrenomAuteur);
    	$this->sPrenomAuteur = $sPrenomAuteur;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  string
    */
    public function getsPrenomAuteur(){	   
    	return $this->sPrenomAuteur;
    }//fin de la fonction
		
    /**
    * affecte la valeur du paramètre a la propriété privée 
    * @param string $sCourrielAuteur
    * @return void
    */
    public function setsCourrielAuteur($sCourrielAuteur){     	
    	TypeException::estChaineDeCaracteres($sCourrielAuteur);
    	$this->sCourrielAuteur = $sCourrielAuteur;
    }//fin de la fonction
	
    /**
    * retourne la valeur de la propriété privée 
    * @param void
    * @return  string
    */
    public function getsCourrielAuteur(){	   
    	return $this->sCourrielAuteur;
    }//fin de la fonction
		
    /**
    * ajoute un enregistrement dans la table "auteurs"
    * @param void
    * @return integer (le id de la dernière insertion) ou un boolean (false si l'insertion s'est mal passée)
    */
    public function ajouter(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			INSERT auteurs
			(sNomAuteur,sPrenomAuteur,sCourrielAuteur)
			VALUES(:sNomAuteur,:sPrenomAuteur,:sCourrielAuteur)
		";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":sNomAuteur", $this->getsNomAuteur(), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":sPrenomAuteur", $this->getsPrenomAuteur(), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":sCourrielAuteur", $this->getsCourrielAuteur(), PDO::PARAM_STR);
			
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
    * modifie un enregistrement dans la table "auteurs"
    * @param void
    * @return integer (le nombre d'enregistrement modifié) ou un boolean (false si la modification s'est mal passée)
    */
    public function modifier(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			UPDATE auteurs
			SET sNomAuteur = :sNomAuteur,sPrenomAuteur = :sPrenomAuteur,sCourrielAuteur = :sCourrielAuteur
			WHERE idAuteur= :idAuteur";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		
		$oPDOStatement->bindValue(":sNomAuteur", $this->getsNomAuteur(), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":sPrenomAuteur", $this->getsPrenomAuteur(), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":sCourrielAuteur", $this->getsCourrielAuteur(), PDO::PARAM_STR); 
		$oPDOStatement->bindValue(":idAuteur", $this->getidAuteur(), PDO::PARAM_INT);
		
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
    * supprime un enregistrement dans la table "auteurs"
    * @param void
    * @return integer (le nombre d'enregistrement supprimé) ou un boolean (false si la suppression s'est mal passée)
    */
    public function supprimer(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			DELETE FROM auteurs
			WHERE idAuteur= :idAuteur";
			
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":idAuteur", $this->getidAuteur(), PDO::PARAM_INT);
		
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
    * rechercher un enregistrement dans la table "auteurs"
    * @param void
    * @return boolean (true si trouvé, false dans les autres cas)
    */
    public function rechercherUn(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			SELECT * 
			FROM auteurs
			WHERE idAuteur= :idAuteur";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":idAuteur", $this->getidAuteur(), PDO::PARAM_INT);
		
		//Exécuter la requête
		$b = $oPDOStatement->execute();
		
		//Si la requête a bien été exécutée
		if($b == true){
			//Récupérer l'enregistrement (fetch)
			$aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
			if($aEnregs !== false){
				//Affecter les valeurs aux propriétés privées de l'objet
				$this->__construct($aEnregs['idAuteur'],$aEnregs['sNomAuteur'],$aEnregs['sPrenomAuteur'],$aEnregs['sCourrielAuteur']);
				$oPDOLib->fermerLaConnexion();
				return true;
			}
		}
		$oPDOLib->fermerLaConnexion();
		return false;	
		
    }//fin de la fonction
		
    /**
    * rechercher tous les enregistrements dans la table "auteurs"
    * @param void
    * @return array ou boolean (false si la recherche s'est mal passée)
    */
    public function rechercherTous(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			SELECT * 
			FROM auteurs";
		
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
					$aoEnregs[$iEnreg] = new Auteur(
						$aEnregs[$iEnreg]['idAuteur'],$aEnregs[$iEnreg]['sNomAuteur'],$aEnregs[$iEnreg]['sPrenomAuteur'],$aEnregs[$iEnreg]['sCourrielAuteur']
					);
				}

				$oPDOLib->fermerLaConnexion();
				//Retourner le array d'objets de la classe Auteur				
				return $aoEnregs;
			}
		}
		$oPDOLib->fermerLaConnexion();
		return false;	
		
    }//fin de la fonction

    /**
     * rechercher tous les enregistrements dans la table "Auteurs"
     * @param void
     * @return array ou boolean (false si la recherche s'est mal passée)
     */
    public function verifierNbOeuvresPourUnAuteur(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			SELECT idAuteur, textes.idTexte as iNo
			FROM auteurs
			LEFT JOIN textes ON textes.iNoAuteur = auteurs.idAuteur
            WHERE auteurs.idAuteur= :idAuteur
			
           UNION
          	SELECT idAuteur, medias.idMedia as iNo
            FROM auteurs
			LEFT JOIN medias ON medias.iNoAuteur = auteurs.idAuteur
			WHERE auteurs.idAuteur= :idAuteur
			
			";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idAuteur", $this->getidAuteur(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if($b == true){
            //Récupérer le array
            $aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            $iMax = count($aEnregs);
            $oPDOLib->fermerLaConnexion();

            if($iMax == 2 && $aEnregs[0]['iNo'] == NULL  //quand pas de texte mais une image
                || $iMax == 2 && $aEnregs[1]['iNo'] == NULL // quand un texte mais pas d'image
            ){
                return 0;
            }else{
                return $iMax; //L'auteur a  encore une oeuvre ou plus dans la BDD autre que celle à supprimer
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }//fin de la fonction
    
    
    /**
    * rechercher un enregistrement dans la table "auteurs"
    * @param void
    * @return boolean (true si trouvé, false dans les autres cas)
    */
    public function rechercherCourriel(){	   
    	//Se connecter à la base de données
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			SELECT * 
			FROM auteurs
			WHERE sCourrielAuteur= :sCourrielAuteur";
		
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":sCourrielAuteur", $this->getsCourrielAuteur(), PDO::PARAM_INT);
		
		//Exécuter la requête
		$b = $oPDOStatement->execute();
		
		//Si la requête a bien été exécutée
		if($b == true){
			//Récupérer l'enregistrement (fetch)
			$aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
			if($aEnregs !== false){
				//Affecter les valeurs aux propriétés privées de l'objet
				$this->__construct($aEnregs['idAuteur'],$aEnregs['sNomAuteur'],$aEnregs['sPrenomAuteur'],$aEnregs['sCourrielAuteur']);
				$oPDOLib->fermerLaConnexion();
				return true;
			}
		}
		$oPDOLib->fermerLaConnexion();
		return false;	
		
    }//fin de la fonction
		
}//fin de la classe Auteur