
<?php
/**
 * Fichier Media.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:54 PM
 */
class Media {
    private $idMedia;
    private $sTitreMedia;
    private $sUrlMedia;
    private $sMotsClefs;
    private $bAccepte;
    private $dateMedia;
    private $sTypeMedia;
    private $oAuteur = NULL;
    private $aTypeMIME = array('image/gif','image/jpeg','image/png','audio/x-wav','audio/mpeg3','audio/x-mpeg-3', 'audio/ogg');

    /**
     * constructeur
     * @param integer $idMedia
     * @param string $sTitreMedia
     * @param string $sUrlMedia
     * @param string $sMotsClefs
     * @param integer $bAccepte
     * @param string $sTypeMedia
     * @param string $dateMedia
     * @param integer $iNoAuteur
     * @return void
     */
    public function __construct($idMedia=1,$sTitreMedia="",$sUrlMedia="",$sMotsClefs="", $bAccepte=0,  $iNoAuteur=1){
        $this->setidMedia($idMedia);
        $this->setsTitreMedia($sTitreMedia);
        $this->setsUrlMedia($sUrlMedia);
        $this->setsMotsClefs($sMotsClefs);
        $this->setbAccepte($bAccepte);
        $this->oAuteur = new Auteur($iNoAuteur);

    }//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée
     * @param integer $idMedia
     * @return void
     */
    public function setidMedia($idMedia){
        TypeException::estNumerique($idMedia);
        $this->idMedia = $idMedia;
    }//fin de la fonction

    /**
     * retourne la valeur de la propriété privée
     * @param void
     * @return  integer
     */
    public function getidMedia(){
        return $this->idMedia;
    }//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée
     * @param string $sTitreMedia
     * @return void
     */
    public function setsTitreMedia($sTitreMedia){
        TypeException::estChaineDeCaracteres($sTitreMedia);
        $this->sTitreMedia = $sTitreMedia;
    }//fin de la fonction

    /**
     * retourne la valeur de la propriété privée
     * @param void
     * @return  string
     */
    public function getsTitreMedia(){
        return $this->sTitreMedia;
    }//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée
     * @param string $sUrlMedia
     * @return void
     */
    public function setsUrlMedia($sUrlMedia){
        TypeException::estChaineDeCaracteres($sUrlMedia);
        $this->sUrlMedia = $sUrlMedia;
    }//fin de la fonction

    /**
     * retourne la valeur de la propriété privée
     * @param void
     * @return  string
     */
    public function getsUrlMedia(){
        return $this->sUrlMedia;
    }//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée
     * @param string $sMotsClefs
     * @return void
     */
    public function setsMotsClefs($sMotsClefs){
        TypeException::estChaineDeCaracteres($sMotsClefs);
        $this->sMotsClefs = $sMotsClefs;
    }//fin de la fonction

    /**
     * retourne la valeur de la propriété privée
     * @param void
     * @return  string
     */
    public function getsMotsClefs(){
        return $this->sMotsClefs;
    }//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée
     * @param boolean $bAccepte
     * @return void
     */
    public function setbAccepte($bAccepte){
        TypeException::estNumerique($bAccepte);
        if($bAccepte != 0 && $bAccepte != 1 ){
            throw new Exception("ERR_BOOL".$bAccepte);
        }
        $this->bAccepte = $bAccepte;
    }//fin de la fonction

    /**
     * retourne la valeur de la propriété privée
     * @param void
     * @return  boolean
     */
    public function getbAccepte(){
        return $this->bAccepte;
    }//fin de la fonction


    /**
     * affecte la valeur du paramètre a la propriété privée
     * @param string $sTypeMedia
     * @return void
     */
    public function setsTypeMedia($sTypeMedia){
        TypeException::estChaineDeCaracteres($sTypeMedia);
        if(in_array($sTypeMedia, $this->aTypeMIME) == false){
            throw new Exception("ERR_TYPE_MIME");
        }
        $this->sTypeMedia = $sTypeMedia;
    }
    /**
     * retourne la valeur de la propriété privée
     * @param void
     * @return  string
     */
    public function getsTypeMedia(){
        return $this->sTypeMedia;
    }

    /**
     * affecte la valeur du paramètre a la propriété privée
     * @param string $dateMedia
     * @return void
     */
    public function setdateMedia($dateMedia){
        TypeException::estChaineDeCaracteres($dateMedia);
        $this->dateMedia = $dateMedia;
    }//fin de la fonction

    /**
     * retourne la valeur de la propriété privée
     * @param void
     * @return  string
     */
    public function getdateMedia(){
        return $this->dateMedia;
    }//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée
     * @param integer $iNoAuteur
     * @return void
     */
    public function setoAuteur(Auteur $oAuteur){
        $this->oAuteur = $oAuteur;
    }//fin de la fonction

    /**
     * retourne la valeur de la propriété privée
     * @param void
     * @return  integer
     */
    public function getoAuteur(){
        return $this->oAuteur;
    }//fin de la fonction

    /**
     * ajoute un enregistrement dans la table "medias"
     * @param void
     * @return integer (le id de la dernière insertion) ou un boolean (false si l'insertion s'est mal passée)
     */
    public function ajouter(){
        //Se connecter à la base de données

        $oFileInfo = new finfo();
        $sTypeMedia = $oFileInfo->file(ImageLib::DOSSIER_IMAGES.$this->getsUrlMedia(), FILEINFO_MIME_TYPE);
        if(in_array($sTypeMedia, $this->aTypeMIME) == false){
            throw new Exception(ImageLib::ERR_IMAGE_MIME);
        }
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			INSERT medias
			(sTitreMedia,sUrlMedia, enumTypeMedia, sMotsClefs,bAccepte,dateMedia,iNoAuteur)
			VALUES(:sTitreMedia,:sUrlMedia,'".$sTypeMedia."' ,:sMotsClefs,:bAccepte, CURDATE(),:iNoAuteur)
		";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sTitreMedia", $this->getsTitreMedia(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sUrlMedia", $this->getsUrlMedia(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sMotsClefs", $this->getsMotsClefs(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":bAccepte", $this->getbAccepte(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":iNoAuteur", $this->getoAuteur()->getidAuteur(), PDO::PARAM_INT);

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
     * modifie un enregistrement dans la table "medias"
     * @param void
     * @return integer (le nombre d'enregistrement modifié) ou un boolean (false si la modification s'est mal passée)
     */
    public function modifier(){
        $oFileInfo = new finfo();
        $sTypeMedia = $oFileInfo->file(ImageLib::DOSSIER_IMAGES.$this->getsUrlMedia(), FILEINFO_MIME_TYPE);
        if(in_array($sTypeMedia, $this->aTypeMIME) == false){
            throw new Exception(ImageLib::ERR_IMAGE_MIME);
        }
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			UPDATE medias
			SET sTitreMedia = :sTitreMedia, enumTypeMedia='".$sTypeMedia."',sUrlMedia = :sUrlMedia, sMotsClefs = :sMotsClefs,bAccepte = :bAccepte,iNoAuteur = :iNoAuteur
			WHERE idMedia= :idMedia";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs

        $oPDOStatement->bindValue(":sTitreMedia", $this->getsTitreMedia(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sUrlMedia", $this->getsUrlMedia(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sMotsClefs", $this->getsMotsClefs(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":bAccepte", $this->getbAccepte(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":iNoAuteur", $this->getoAuteur()->getidAuteur(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":idMedia", $this->getidMedia(), PDO::PARAM_INT);

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
     * supprime un enregistrement dans la table "medias"
     * @param void
     * @return integer (le nombre d'enregistrement supprimé) ou un boolean (false si la suppression s'est mal passée)
     */
    public function supprimer(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			DELETE FROM medias
			WHERE idMedia= :idMedia";


        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idMedia", $this->getidMedia(), PDO::PARAM_INT);

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
     * rechercher un enregistrement dans la table "medias"
     * @param void
     * @return boolean (true si trouvé, false dans les autres cas)
     */
    public function rechercherUn(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			SELECT * 
			FROM medias
			LEFT JOIN Auteurs ON Auteurs.idAuteur = medias.iNoAuteur 
			WHERE idMedia= :idMedia";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idMedia", $this->getidMedia(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if($b == true){
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
            if($aEnregs !== false){
                //Affecter les valeurs aux propriétés privées de l'objet
                $this->__construct($aEnregs['idMedia'],$aEnregs['sTitreMedia'],$aEnregs['sUrlMedia'],$aEnregs['sMotsClefs'],$aEnregs['bAccepte'],$aEnregs['iNoAuteur']);
                $this->setoAuteur(new Auteur($aEnregs['idAuteur'], $aEnregs['sNomAuteur'], $aEnregs['sPrenomAuteur'], $aEnregs['sCourrielAuteur']));
                $oPDOLib->fermerLaConnexion();
                return true;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }//fin de la fonction

    /**
     * rechercher tous les enregistrements dans la table "medias"
     * @param void
     * @return array ou boolean (false si la recherche s'est mal passée)
     */
    public function rechercherTous($bByDate = false){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			SELECT * 
			FROM medias
			LEFT JOIN Auteurs ON Auteurs.idAuteur = medias.iNoAuteur ";
        if($bByDate == true){
            $sRequete.="
			ORDER BY dateMedia desc";
        }

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
                    $aoEnregs[$iEnreg] = new Media(
                        $aEnregs[$iEnreg]['idMedia'],$aEnregs[$iEnreg]['sTitreMedia'],$aEnregs[$iEnreg]['sUrlMedia'],$aEnregs[$iEnreg]['sMotsClefs'],$aEnregs[$iEnreg]['bAccepte'],$aEnregs[$iEnreg]['iNoAuteur']
                    );
                    $aoEnregs[$iEnreg]->setsTypeMedia($aEnregs[$iEnreg]['enumTypeMedia']);
                    $aoEnregs[$iEnreg]->setoAuteur(new Auteur($aEnregs[$iEnreg]['idAuteur'], $aEnregs[$iEnreg]['sNomAuteur'], $aEnregs[$iEnreg]['sPrenomAuteur'], $aEnregs[$iEnreg]['sCourrielAuteur']));
                }
                $oPDOLib->fermerLaConnexion();
                //Retourner le array d'objets de la classe Media
                return $aoEnregs;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }//fin de la fonction




    /**
     * rechercher tous les enregistrements dans la table "medias"
     * @param void
     * @return array ou boolean (false si la recherche s'est mal passée)
     */
    public function rechercherTousJSON(){
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete="
			SELECT  sTitreMedia, sUrlMedia, auteurs.sPrenomAuteur, auteurs.sNomAuteur
			FROM medias
			LEFT JOIN auteurs ON auteurs.idAuteur = medias.iNoAuteur WHERE bAccepte = 1";

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
            return $aEnregs;
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }//fin de la fonction

}//fin de la classe Media