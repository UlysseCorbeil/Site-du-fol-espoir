<?php

/**
 * Fichier Texte.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:54 PM
 */
class Texte
{

    private $idTexte;
    private $sTitreTexte;
    private $sExtraitTexte;
    private $sTexte;
    private $sNomCategorie;
    private $sMotsClefs;
    private $bAccepte;
    private $dateTexte;
    private $oAuteur;
    private $aNomCategories = array('essai', 'poésie', 'récit', 'théâtre', 'inclassable');

    /**
     * constructeur 
     * @param integer $idTexte
     * @param string $sTitreTexte
     * @param string $sTexte
     * @param string $sNomCategorie
     * @param string $sMotsClefs
     * @param integer $bAccepte
     * @param string $dateTexte
     * @param integer $iNoAuteur
     * @return void
     */
    public function __construct($idTexte = 1, $sTitreTexte = "", $sExtraitTexte = "", $sTexte = "", $sNomCategorie = "inclassable", $sMotsClefs = "", $bAccepte = 0, $iNoAuteur = 1)
    {
        $this->setidTexte($idTexte);
        $this->setsTitreTexte($sTitreTexte);
        $this->setsExtraitTexte($sExtraitTexte);

        $this->setsTexte($sTexte);
        $this->setsNomCategorie($sNomCategorie);
        $this->setsMotsClefs($sMotsClefs);
        $this->setbAccepte($bAccepte);

        $this->oAuteur = new Auteur($iNoAuteur);
    }

//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée 
     * @param integer $idTexte
     * @return void
     */
    public function setidTexte($idTexte)
    {
        TypeException::estNumerique($idTexte);
        $this->idTexte = $idTexte;
    }

//fin de la fonction

    /**
     * retourne la valeur de la propriété privée 
     * @param void
     * @return  integer
     */
    public function getidTexte()
    {
        return $this->idTexte;
    }

//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée 
     * @param string $sTitreTexte
     * @return void
     */
    public function setsTitreTexte($sTitreTexte)
    {
        TypeException::estChaineDeCaracteres($sTitreTexte);
        $this->sTitreTexte = $sTitreTexte;
    }

//fin de la fonction

    /**
     * retourne la valeur de la propriété privée 
     * @param void
     * @return  string
     */
    public function getsTitreTexte()
    {
        return $this->sTitreTexte;
    }

//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée 
     * @param string $sExtraitTexte
     * @return void
     */
    public function setsExtraitTexte($sExtraitTexte)
    {
        TypeException::estChaineDeCaracteres($sExtraitTexte);
        $this->sExtraitTexte = $sExtraitTexte;
    }

//fin de la fonction

    /**
     * retourne la valeur de la propriété privée 
     * @param void
     * @return  string
     */
    public function getsExtraitTexte()
    {
        return $this->sExtraitTexte;
    }

//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée 
     * @param string $sTexte
     * @return void
     */
    public function setsTexte($sTexte)
    {
        TypeException::estChaineDeCaracteres($sTexte);
        $this->sTexte = $sTexte;
    }

//fin de la fonction

    /**
     * retourne la valeur de la propriété privée 
     * @param void
     * @return  string
     */
    public function getsTexte()
    {
        return $this->sTexte;
    }

//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée 
     * @param string $sNomCategorie
     * @return void
     */
    public function setsNomCategorie($sNomCategorie)
    {
        TypeException::estChaineDeCaracteres($sNomCategorie);
        if (in_array($sNomCategorie, $this->aNomCategories) == false) {
            throw new Exception("ERR_CATEGORIE");
        }
        $this->sNomCategorie = $sNomCategorie;
    }

//fin de la fonction

    /**
     * retourne la valeur de la propriété privée 
     * @param void
     * @return  string
     */
    public function getsNomCategorie()
    {
        return $this->sNomCategorie;
    }

//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée 
     * @param string $sMotsClefs
     * @return void
     */
    public function setsMotsClefs($sMotsClefs)
    {
        TypeException::estChaineDeCaracteres($sMotsClefs);
        $this->sMotsClefs = $sMotsClefs;
    }

//fin de la fonction

    /**
     * retourne la valeur de la propriété privée 
     * @param void
     * @return  string
     */
    public function getsMotsClefs()
    {
        return $this->sMotsClefs;
    }

//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée 
     * @param integer $bAccepte
     * @return void
     */
    public function setbAccepte($bAccepte)
    {
        TypeException::estNumerique($bAccepte);
        if ($bAccepte != 0 && $bAccepte != 1) {
            throw new Exception("ERR_BOOL" . $bAccepte);
        }
        $this->bAccepte = $bAccepte;
    }

//fin de la fonction

    /**
     * retourne la valeur de la propriété privée 
     * @param void
     * @return  integer
     */
    public function getbAccepte()
    {
        return $this->bAccepte;
    }

//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée 
     * @param string $dateTexte
     * @return void
     */
    public function setdateTexte($dateTexte)
    {
        TypeException::estChaineDeCaracteres($dateTexte);
        $this->dateTexte = $dateTexte;
    }

//fin de la fonction

    /**
     * retourne la valeur de la propriété privée 
     * @param void
     * @return  string
     */
    public function getdateTexte()
    {
        return $this->dateTexte;
    }

//fin de la fonction

    /**
     * affecte la valeur du paramètre a la propriété privée 
     * @param Auteur $oAuteur
     * @return void
     */
    public function setoAuteur(Auteur $oAuteur)
    {
        $this->oAuteur = $oAuteur;
    }

//fin de la fonction

    /**
     * retourne la valeur de la propriété privée 
     * @param void
     * @return  Auteur
     */
    public function getoAuteur()
    {
        return $this->oAuteur;
    }

//fin de la fonction

    /**
     * ajoute un enregistrement dans la table "textes"
     * @param void
     * @return integer (le id de la dernière insertion) ou un boolean (false si l'insertion s'est mal passée)
     */
    public function ajouter()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			INSERT textes
			(sTitreTexte,sTexte, sExtraitTexte, sNomCategorie,sMotsClefs,bAccepte,dateTexte,iNoAuteur)
			VALUES(:sTitreTexte,:sTexte, :sExtraitTexte, :sNomCategorie,:sMotsClefs,:bAccepte,CURDATE(),:iNoAuteur)
		";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":sTitreTexte", $this->getsTitreTexte(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sExtraitTexte", $this->getsExtraitTexte(), PDO::PARAM_STR);

        $oPDOStatement->bindValue(":sTexte", $this->getsTexte(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sNomCategorie", $this->getsNomCategorie(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sMotsClefs", $this->getsMotsClefs(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":bAccepte", $this->getbAccepte(), PDO::PARAM_INT);

        $oPDOStatement->bindValue(":iNoAuteur", $this->getoAuteur()->getidAuteur(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {

            return (int)$oPDOLib->getoPDO()->lastInsertId();
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

//fin de la fonction

    /**
     * modifie un enregistrement dans la table "textes"
     * @param void
     * @return integer (le nombre d'enregistrement modifié) ou un boolean (false si la modification s'est mal passée)
     */
    public function modifier()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			UPDATE textes
			SET sTitreTexte = :sTitreTexte, sExtraitTexte=:sExtraitTexte, sTexte = :sTexte,sNomCategorie = :sNomCategorie,sMotsClefs = :sMotsClefs,bAccepte = :bAccepte,iNoAuteur = :iNoAuteur
			WHERE idTexte= :idTexte";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs

        $oPDOStatement->bindValue(":sTitreTexte", $this->getsTitreTexte(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sExtraitTexte", $this->getsExtraitTexte(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sTexte", $this->getsTexte(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sNomCategorie", $this->getsNomCategorie(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":sMotsClefs", $this->getsMotsClefs(), PDO::PARAM_STR);
        $oPDOStatement->bindValue(":bAccepte", $this->getbAccepte(), PDO::PARAM_INT);

        $oPDOStatement->bindValue(":iNoAuteur", $this->getoAuteur()->getidAuteur(), PDO::PARAM_INT);
        $oPDOStatement->bindValue(":idTexte", $this->getidTexte(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            $oPDOLib->fermerLaConnexion();
            return (int)$oPDOStatement->rowCount();
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

//fin de la fonction

    /**
     * supprime un enregistrement dans la table "textes"
     * @param void
     * @return integer (le nombre d'enregistrement supprimé) ou un boolean (false si la suppression s'est mal passée)
     */
    public function supprimer()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			DELETE FROM textes
			WHERE idTexte= :idTexte";


        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idTexte", $this->getidTexte(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            $oPDOLib->fermerLaConnexion();
            return (int)$oPDOStatement->rowCount();
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

//fin de la fonction

    /**
     * rechercher un enregistrement dans la table "textes"
     * @param void
     * @return boolean (true si trouvé, false dans les autres cas)
     */
    public function rechercherUn()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * 
			FROM textes
			LEFT JOIN Auteurs ON Auteurs.idAuteur = textes.iNoAuteur
			WHERE idTexte= :idTexte";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idTexte", $this->getidTexte(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);

            if ($aEnregs !== false) {
                //Affecter les valeurs aux propriétés privées de l'objet
                $this->__construct($aEnregs['idTexte'], $aEnregs['sTitreTexte'], $aEnregs['sExtraitTexte'], $aEnregs['sTexte'], $aEnregs['sNomCategorie'], $aEnregs['sMotsClefs'], $aEnregs['bAccepte'], $aEnregs['iNoAuteur']);
                $this->setoAuteur(new Auteur($aEnregs['iNoAuteur'], $aEnregs['sNomAuteur'], $aEnregs['sPrenomAuteur'], $aEnregs['sCourrielAuteur']));
                $oPDOLib->fermerLaConnexion();
                return true;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }//fin de la fonction

    /**
     * rechercher tous les enregistrements dans la table "textes"
     * @param void
     * @return array ou boolean (false si la recherche s'est mal passée)
     */
    public function rechercherTous($bByDate = false)
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * 
			FROM textes
			LEFT JOIN Auteurs ON Auteurs.idAuteur = textes.iNoAuteur";
        if ($bByDate == true) {
            $sRequete .= "
			ORDER BY dateTexte desc
			";
        }
        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs				
        //void
        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer le array 
            $aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            $iMax = count($aEnregs);
            $aoEnregs = array();
            if ($iMax > 0) {
                for ($iEnreg = 0; $iEnreg < $iMax; $iEnreg++) {
                    $aoEnregs[$iEnreg] = new Texte(
                        $aEnregs[$iEnreg]['idTexte'],
                        $aEnregs[$iEnreg]['sTitreTexte'],
                        $aEnregs[$iEnreg]['sExtraitTexte'],
                        $aEnregs[$iEnreg]['sTexte'],
                        $aEnregs[$iEnreg]['sNomCategorie'],
                        $aEnregs[$iEnreg]['sMotsClefs'],
                        $aEnregs[$iEnreg]['bAccepte'],
                        $aEnregs[$iEnreg]['iNoAuteur']
                    );
                    $aoEnregs[$iEnreg]->setoAuteur(new Auteur($aEnregs[$iEnreg]['iNoAuteur'], $aEnregs[$iEnreg]['sNomAuteur'], $aEnregs[$iEnreg]['sPrenomAuteur'], $aEnregs[$iEnreg]['sCourrielAuteur']));
                }
                $oPDOLib->fermerLaConnexion();
                //Retourner le array d'objets de la classe Texte				
                return $aoEnregs;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

//fin de la fonction

    /**
     * rechercher tous les enregistrements dans la table "textes"
     * @param void
     * @return array ou boolean (false si la recherche s'est mal passée)
     */
    public function rechercherTousPar6()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT *
			FROM textes
			LEFT JOIN auteurs ON auteurs.idAuteur = textes.iNoAuteur WHERE bAccepte=1 ORDER BY dateTexte DESC LIMIT 6";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        //void
        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer le array 
            $aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            $iMax = count($aEnregs);
            $aoEnregs = array();
            if ($iMax > 0) {
                for ($iEnreg = 0; $iEnreg < $iMax; $iEnreg++) {
                    $aoEnregs[$iEnreg] = new Texte(
                        $aEnregs[$iEnreg]['idTexte'],
                        $aEnregs[$iEnreg]['sTitreTexte'],
                        $aEnregs[$iEnreg]['sExtraitTexte'],
                        $aEnregs[$iEnreg]['sTexte'],
                        $aEnregs[$iEnreg]['sNomCategorie'],
                        $aEnregs[$iEnreg]['sMotsClefs'],
                        $aEnregs[$iEnreg]['bAccepte'],
                        $aEnregs[$iEnreg]['iNoAuteur']
                    );
                    $aoEnregs[$iEnreg]->setoAuteur(new Auteur($aEnregs[$iEnreg]['iNoAuteur'], $aEnregs[$iEnreg]['sNomAuteur'], $aEnregs[$iEnreg]['sPrenomAuteur'], $aEnregs[$iEnreg]['sCourrielAuteur']));
                }
                $oPDOLib->fermerLaConnexion();
                //Retourner le array d'objets de la classe Texte				
                return $aoEnregs;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

//fin de la fonction

    /**
     * rechercher tous les enregistrements dans la table "textes" et les ordonner dans un ordre aléatoire
     */
    public function rechercherTousAleatoire()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * 
			FROM textes
			LEFT JOIN auteurs ON auteurs.idAuteur = textes.iNoAuteur
                        ORDER BY rand()";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs				
        //void
        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer le array 
            $aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            $iMax = count($aEnregs);
            $aoEnregs = array();
            if ($iMax > 0) {
                for ($iEnreg = 0; $iEnreg < $iMax; $iEnreg++) {
                    $aoEnregs[$iEnreg] = new Texte(
                        $aEnregs[$iEnreg]['idTexte'],
                        $aEnregs[$iEnreg]['sTitreTexte'],
                        $aEnregs[$iEnreg]['sExtraitTexte'],
                        $aEnregs[$iEnreg]['sTexte'],
                        $aEnregs[$iEnreg]['sNomCategorie'],
                        $aEnregs[$iEnreg]['sMotsClefs'],
                        $aEnregs[$iEnreg]['bAccepte'],
                        $aEnregs[$iEnreg]['iNoAuteur']
                    );
                    $aoEnregs[$iEnreg]->setoAuteur(new Auteur($aEnregs[$iEnreg]['iNoAuteur'], $aEnregs[$iEnreg]['sNomAuteur'], $aEnregs[$iEnreg]['sPrenomAuteur'], $aEnregs[$iEnreg]['sCourrielAuteur']));
                }
                $oPDOLib->fermerLaConnexion();
                //Retourner le array d'objets de la classe Texte				
                return $aoEnregs;
            }
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

//fin de la fonction 

    /**
     * rechercher un enregistrement dans la table "textes"
     * @param void
     * @return boolean (true si trouvé, false dans les autres cas)
     */
    public function rechercherUnJSON()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * 
			FROM textes
			LEFT JOIN auteurs ON auteurs.idAuteur = textes.iNoAuteur
			WHERE idTexte= :idTexte";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        $oPDOStatement->bindValue(":idTexte", $this->getidTexte(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);

            return $aEnregs;
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

    /**
     * rechercher un enregistrement dans la table "textes"
     * @param void
     * @return boolean (true si trouvé, false dans les autres cas)
     */
    public function rechercherTousJSONparCateg($sFiltre)
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();

        if (is_string($sFiltre) == false) {
            throw new Exception("L'élément n'est pas une chaine de charactère");
        }

        //Réaliser la requête
        $sRequete = "
			SELECT sTitreTexte, idTexte, auteurs.sPrenomAuteur, auteurs.sNomAuteur, sNomCategorie
			FROM textes
            LEFT JOIN auteurs ON auteurs.idAuteur = textes.iNoAuteur
            WHERE sNomCategorie = '" . $sFiltre . "'
            ";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        //void

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);

            return $aEnregs;
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }//fin de la fonction

    /**
     * rechercher un enregistrement dans la table "textes"
     * @param void
     * @return boolean (true si trouvé, false dans les autres cas)
     */
    public function rechercherTousJSON()
    {
        //Se connecter à la base de données
        $oPDOLib = new PDOLib();

        //Réaliser la requête
        $sRequete = "
			SELECT sTitreTexte, idTexte, auteurs.sPrenomAuteur, auteurs.sNomAuteur, sNomCategorie
			FROM textes
            LEFT JOIN auteurs ON auteurs.idAuteur = textes.iNoAuteur
            ";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        //void

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);

            return $aEnregs;
        }

        $oPDOLib->fermerLaConnexion();
        return false;

    }//fin de la fonction


    /**
     * rechercher tous les enregistrements dans la table " textes "
     * @param void
     * @return array ou boolean (false si la recherche s'est mal passée)
     */
    public function rechercherTousRechercheJSON($sTermeRecherche = " ")
    {

        if (is_string($sTermeRecherche) == false) {
            throw new Exception(" Le terme de recherche n 'est pas une chaine...");
        }

        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT idTexte, sPrenomAuteur, sNomAuteur, sTitreTexte FROM textes 
			LEFT JOIN auteurs ON auteurs.idAuteur = textes.iNoAuteur
            WHERE (sTitreTexte LIKE ' % " . $sTermeRecherche . " % '
            OR sMotsClefs LIKE ' % " . $sTermeRecherche . " % ' 
            OR auteurs.sPrenomAuteur LIKE ' % " . $sTermeRecherche . " % ' 
            OR auteurs.sNomAuteur LIKE ' % " . $sTermeRecherche . " %') 
            AND bAccepte = 1
            ORDER BY dateTexte DESC LIMIT 10;";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer le array
            $aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            return $aEnregs;
        }
        $oPDOLib->fermerLaConnexion();
        return false;

    }//fin de la fonction
    
    
    public function rechercherTousSelonAuteur($idAuteur){

        if(is_numeric($idAuteur) == false){
            throw new Exception("idAuteur doit etre numerique");
        }

        //Se connecter à la base de données
        $oPDOLib = new PDOLib();
        //Réaliser la requête
        $sRequete = "
			SELECT * 
			FROM textes
			LEFT JOIN auteurs ON auteurs.idAuteur = textes.iNoAuteur
			WHERE textes.iNoAuteur = ". $idAuteur ." AND bAccepte = 1";

        //Préparer la requête
        $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

        //Lier les paramètres aux valeurs
        //$oPDOStatement->bindValue(":idTexte", $this->getidTexte(), PDO::PARAM_INT);

        //Exécuter la requête
        $b = $oPDOStatement->execute();

        //Si la requête a bien été exécutée
        if ($b == true) {
            //Récupérer l'enregistrement (fetch)
            $aEnregs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);

            return $aEnregs;
        }
        $oPDOLib->fermerLaConnexion();
        return false;
    }

}

//fin de la classe Texte