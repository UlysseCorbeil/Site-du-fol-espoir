<?php

/**
 * Fichier Controleur.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:14:01 PM
 */
class Controleur
{

    private $aTypeMIME = array('image/gif', 'image/jpeg', 'image/png', 'audio/wav', 'audio/x-wav', 'audio/mpeg', 'audio/mpeg3', 'audio/x-mpeg-3', 'audio/ogg', 'application/ogg');

    /* ====================================================== */
    /* ============== INTERNAUTE ============================ */
    /* ====================================================== */

    /**
     * Gère le fonctionnement du site Web
     * @param void
     * @return void
     */
    public function gererSite()
    {
        try {
            //Déclaration d'un objet de la classe Vue
            //pour accéder à toutes les méthodes de cette classe
            $oVue = new Vue();

            /* Afficher le début de la page HTML */
            /*             * ********************************** */

            if (isset($_GET['s']) == false) {
                $_GET['s'] = 1;
            }

            // CSS
            $aCSS = array(
                "../../public/css/reset.css",
                "../../public/css/global.css",
                "https://use.fontawesome.com/releases/v5.5.0/css/all.css"
            );

            // JS
            $aJS = array("../../public/js/jquery-3.3.1.min.js", "../../public/js/jquery-te-1.4.0.min.js", "../../public/js/fenetreContenu.js", "../../public/js/pace.js");

            // Déterminer les feuilles de style selon la page

            switch ($_GET['s']) {
                // CATÉGORIES
                case 2:
                    // CSS
                    array_push($aCSS, "../../public/css/ulysse.css", "../../public/css/ulysse_mobile.css", "../../public/css/texte.css");


                    array_push($aJS, "../../public/js/jquery.mousewheel.js", "../../public/js/followMouse.js", "../../public/js/RandomColors.js", "../../public/js/menu.js");
                    break;
                // MÉDIAS
                case 3:
                    array_push($aCSS, "../../public/css/gallerie.css");
                    break;
                // À PROPOS
                case 4:
                    array_push($aCSS, "../../public/css/formulaire.css");

                    /* array_push($aJS,
                      "../../public/js/smoothScroll.min.js",
                      "../../public/js/jquery.mousewheel.js"
                      ); */
                    break;
                // CONTACT
                case 5:
                    array_push(
                        $aCSS,
                        "../../public/css/jquery-te-1.4.0.css",
                        "https://fonts.googleapis.com/icon?family=Material+Icons",
                        "../../public/css/formulaire.css"
                    );
                    break;

                //SON
                case 7:
                    array_push($aCSS, "../../public/css/son.css");
                    break;

                // ACCUEIL
                case 1:
                default:
                    array_push($aCSS, "../../public/css/nguyen.css", "../../public/css/texte.css");
                    break;
            }

            // CSS
            array_push($aCSS, "../../public/css/fenetreTexte.css");

            /* Afficher l'entête de la page */
            /*             * ******************** */
            echo $oVue->getHeader('Le Fol Espoir', $aCSS, $aJS);

            /* Afficher le menu */
            /*             * ******************** */
            $oTextes = new Texte();
            $aoTextes = $oTextes->rechercherTousPar6();
            echo $oVue->getNavigation($aoTextes);

            // Texte
            $oVueTexte = new VueTexte();
            $oVueTexte->afficherUn();


            /* Afficher le contenu */
            /*             * ******************** */
            switch ($_GET['s']) {
                case 2:
                    $this->gererCategorie();
                    break;
                case 3:
                    $this->gererMedias();
                    break;
                case 4:
                    $this->gererAPropos();
                    break;
                case 5:
                    $this->gererFormulaire();
                    break;
                case 7:
                    $this->gererSon();
                    break;
                case 1:
                default:
                    $this->gererAccueil();
                    break;
            }


            /* Afficher la fin de la page HTML */
            /*             * ********************************** */
            echo $oVue->getFooter();
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

//fin de la fonction

    /**
     * Gérer l'affichage de l'accueil
     * @param void
     * @return void
     */
    public function gererAccueil()
    {
        try {
            $oTexte = new Texte();
            $aoTextes = $oTexte->rechercherTousAleatoire();
            $oVuePage = new VuePage();
            $oVuePage->AfficherAccueil($aoTextes);
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /**
     * Gérer l'affichage de la page médias
     * @param void
     * @return void
     */
    public function gererMedias()
    {
        try {
            if (isset($_GET['idMedia']) == false) {
                $oVueMedia = new VueMedia();
                $oVueMedia->afficherTous();
            } else {
                $oMedia = new Media($_GET['idMedia']);
                if ($oMedia->rechercherUn()) {
                    $oVueMedia = new VueMedia();
                    $oVueMedia->afficherUn($oMedia);
                }
            }
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /**
     * Gérer l'affichage de la page catégorie
     * @param void
     * @return void
     */
    public function gererCategorie()
    {
        try {
            if(isset($_GET['idAuteur']) == false){
                $oVuePage = new VuePage();
                $oVuePage->AfficherTextesParCateg();
            }
            else{
                $oAuteur = new Auteur($_GET['idAuteur']);
                $oTexte = new Texte();
                $oaTexteAuteur = $oTexte->rechercherTousSelonAuteur($oAuteur->getidAuteur());
                $oVuePage = new VuePage();
                $oVuePage->AfficherTextesParCateg("auteur", $oaTexteAuteur);
            }

        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /**
     * Gérer l'affichage de la page à propos
     * @param void
     * @return void
     */
    public function gererAPropos()
    {
        try {
            $oPage = new Page();
            $oPage->rechercherUn();
            $oVuePage = new VuePage();
            $oVuePage->afficherApropos($oPage, $sMsg = '');
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /**
     * Gère les formulaires de soumission d'oeuvres
     * @param void
     * @return void
     */
    public function gererFormulaire()
    {
        try {
                //Déclaration d'un objet de la classe VueTexte
                //pour accéder aux méthodes de la classe
            $oVueSoumettre = new VueSoumettre();
            $oAuteur = new Auteur();
            $sMsg = '';


            if (isset($_GET['action']) == false && isset($_POST['action']) == false) {
                $oVueSoumettre->afficherFormulaire();
            } else {

                switch ($_POST['action']) {

                    case 'ajouterMedia':
                        $this->formulaireMedia();
                        break;

                    case 'ajouterTexte':
                        $this->formulaireTexte();
                        break;

                }//fin du switch()
            }

        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }//fin de la fonction



    /**********************************************************************************************************************************************
     * Gérer AJOUT AUTEUR SI EXISTE ET TEXTE ENSUITE
     * @param void
     * @return void
     */
    public function formulaireTexte()
    {
        try {

            $oVueSoumettre = new VueSoumettre();
            $oAuteur = new Auteur();
            $sMsg = '';

            $oAuteur = new Auteur(1, $_POST['sNomAuteur'], $_POST['sPrenomAuteur'], $_POST['sCourrielAuteur']);

            if ($oAuteur->rechercherCourriel() == false) {
                    //Sauvegarder
                $iLastInsertId = $oAuteur->ajouter();
                if ($iLastInsertId !== false) {
                    $sMsg = 'L\'ajout de  - ' . $oAuteur->getsNomAuteur() . ' - s\'est déroulé avec succès.';
                            //Affichage            
                    echo $sMsg;

                    $oTexte = new Texte();
                    $oTexte = new Texte(1, $_POST['sTitreTexte'], $_POST['sExtraitTexte'], $_POST['sTexte'], $_POST['sNomCategorie'], $_POST['sMotsClefs'], 0, $iLastInsertId);

                    if ($oTexte->ajouter() !== false) {
                        $sMsg = 'L\'ajout du texte  - ' . $oTexte->getsTitreTexte() . ' - s\'est déroulé avec succès.';
                                     //Affichage
                        echo $sMsg;
                        echo $this->enovoiEmail();
                    } else {
                        echo 'Une erreur est survenue durant l\'ajout du texte  : ' . $oTexte->getsTitreTexte();
                    }
                } else {
                    echo 'Une erreur est survenue durant l\'ajout de auteur  : ' . $oAuteur->getsNomAuteur();
                }

            } else {

                $oAuteur->getidAuteur();
                $oTexte = new Texte();
                $oTexte = new Texte(1, $_POST['sTitreTexte'], $_POST['sExtraitTexte'], $_POST['sTexte'], $_POST['sNomCategorie'], $_POST['sMotsClefs'], 0, $oAuteur->getidAuteur());

                if ($oTexte->ajouter() !== false) {
                    $sMsg = 'L\'ajout du texte  - ' . $oTexte->getsTitreTexte() . ' - s\'est déroulé avec succès.';
                              //Affichage           
                    echo $sMsg;
                    echo $this->enovoiEmail();
                } else {
                    echo 'Une erreur est survenue durant l\'ajout du texte  : ' . $oTexte->getsTitreTexte();
                }
            }


        } catch (Exception $oException) {
            echo $oException->getMessage();
        }
    }//fin de la fonction


    public function enovoiEmail() {
        $to = "lefolespoir@cmaisonneuve.qc.ca, " . $_POST['sCourrielAuteur']; // this is your Email address
        $first_name = $_POST['sPrenomAuteur'];
        $last_name = $_POST['sNomAuteur'];
        $subject = "Nouvelle soumission d'oeuvre";
        $subject2 = "Confirmation d'envoi de votre oeuvre";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


        $message = $first_name . " " . $last_name . " a soumis la nouvelle oeuvre: " . "\n\n" . $_POST['sTitreTexte'] ."
            http://folespoir.pobourdeau.com/application/site/";
        
        
        //$message = $first_name . " " . $last_name . " a soumis la nouvelle oeuvre: " . "\n\n" . $_POST['sTitreTexte'];
        $message2 = "Bonjour ". $first_name .", \n\nVoici l'oeuvre que vous avez envoyé : \n\n" . $_POST['sTitreTexte'];

        /*$headers = "De:" . $from;
        $headers2 = "De:" . $to;*/
        if(mail($to,$subject,$message, $headers) && mail($to,$subject2,$message2, $headers)){
            return  "Oeuvre soumise. Merci de votre participation " . $first_name . ", votre envoie sera révisé par notre comité sous peu.";
        }
        else{
            return "Impossible d'envoyer le courriel!";
        }

    }


    /*****************************************************************************************************************************************************************/

    /********************************************************************************************************************************************************            
     /**
     * Gérer AJOUT AUTEUR SI EXISTE ET MEDIA ENSUITE
     * @param void
     * @return void
     */
    public function formulaireMedia()
    {
        try {

            $oVueSoumettre = new VueSoumettre();
            $oAuteur = new Auteur();
            $sMsg = '';


            $oAuteur = new Auteur(1, $_POST['sNomAuteur'], $_POST['sPrenomAuteur'], $_POST['sCourrielAuteur']);
            if (isset($_POST['sUrlMedia']) == false) {
                echo ("Sélectionnez un fichier à téléverser.");
                return;
            }
            if ($oAuteur->rechercherCourriel() == false) {
                    //Sauvegarder
                $iLastInsertId = $oAuteur->ajouter();
                if ($iLastInsertId !== false) {
                    $sMsg = 'L\'ajout de  - ' . $oAuteur->getsNomAuteur() . ' - s\'est déroulé avec succès.';
                            //Affichage            
                    echo $sMsg;


                    $oMedia = new Media();
                    $oMedia = new Media(1, $_POST['sTitreMedia'], $_POST['sUrlMedia'], $_POST['sMotsClefs'], 0, $iLastInsertId);

                    if ($oMedia->ajouter() !== false) {
                        $sMsg = 'L\'ajout du média  - ' . $oMedia->getsTitreMedia() . ' - s\'est déroulé avec succès.';
                                //Affichage            
                        echo $sMsg;
                    } else {
                        echo 'Une erreur est survenue durant l\'ajout du média  : ' . $oMedia->getsTitreMedia();
                    }
                } else {
                    echo 'Une erreur est survenue durant l\'ajout de l\'auteur  : ' . $oAuteur->getsNomAuteur();
                }

            } else {
                $oAuteur->getidAuteur();
                $oMedia = new Media();
                $oMedia = new Media(1, $_POST['sTitreMedia'], $_POST['sUrlMedia'], $_POST['sMotsClefs'], 0, $oAuteur->getidAuteur());

                if ($oMedia->ajouter() !== false) {
                    $sMsg = 'L\'ajout du média  - ' . $oMedia->getsTitreMedia() . ' - s\'est déroulé avec succès.';
                        //Affichage           
                    echo $sMsg;
                } else {
                    echo 'Une erreur est survenue durant l\'ajout du média  : ' . $oMedia->getsTitreMedia();
                }

            }



        } catch (Exception $oException) {
            echo $oException->getMessage();
        }
    }//fin de la fonction

    /**
     * Gère l'affichage de la page son
     * @param void
     * @return void
     */
    public function gererSon()
    {
        try {
            if(isset($_GET['idSon']) == false){
                $oSon = new Media(27);
                $oSon->rechercherUn();
                $oVueMedia = new VueMedia();
                $oVueMedia->afficherPageSon($oSon);
            }
            else{
                $oSon = new Media($_GET['idSon']);
                $oSon->rechercherUn();
                $oVueMedia = new VueMedia();
                $oVueMedia->afficherPageSon($oSon);
            }

        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    /* ====================================================== */
    /* ============== Administration ======================== */
    /* ====================================================== */

    /**
     * Gère le fonctionnement du site Web
     * @param void
     * @return void
     */
    public function adm_gererSite()
    {
        try {
            //Déclaration d'un objet de la classe Vue
            //pour accéder à toutes les méthodes de cette classe
            $oVue = new Vue();

            if (isset($_GET['s']) == false) {
                $_GET['s'] = "accueil";
            }

            /* Afficher le menu */
            /*             * ******************** */
            $aOptionsMenu = array(
                array('href' => 'index.php?s=accueil', 'title' => 'Accueil', 'text' => 'Accueil'),
                array('href' => 'index.php?s=textes', 'title' => 'Textes', 'text' => 'Textes'),
                array('href' => 'index.php?s=auteurs', 'title' => 'Auteurs', 'text' => 'Auteurs'),
                array('href' => 'index.php?s=medias', 'title' => 'Medias', 'text' => 'Medias'),
                array('href' => 'index.php?s=pages', 'title' => 'À propos', 'text' => 'À propos'),
                array('href' => 'index.php?s=administrateurs', 'title' => 'Administrateurs', 'text' => 'Administrateurs'),
                array('href' => 'index.php?s=deconnexion', 'title' => 'Déconnexion', 'text' => 'Déconnexion')
            );
            echo $oVue->adm_getNavigation($aOptionsMenu);


            /* Afficher le contenu */
            /*             * ******************** */
            switch ($_GET['s']) {
                case "textes":
                    $this->adm_gererTexte();
                    break;
                case "administrateurs":
                    $this->adm_gererAdministrateur();
                    break;
                case "auteurs":
                    $this->adm_gererAuteur();
                    break;
                case "medias":
                    $this->adm_gererMedia();
                    break;
                case "pages":
                    $this->adm_gererPage();
                    break;
                case "deconnexion":
                    unset($_SESSION['connexion']);
                    header("location:index.php");
                    break;
                case "accueil":
                default:
                    $this->adm_gererAccueil();
                    break;
            }
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

//fin de la fonction

    /**
     * Gérer l'affichage de l'accueil admin
     * @param void
     * @return void
     */
    public function adm_gererAccueil()
    {
        try {
            $oVueAccueilAdmin = new VueAccueilAdmin();
            $oVueAccueilAdmin->adm_afficherAccueil();
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

    public function adm_gererAuthentification()
    {
        try {

            $oVue = new Vue();
            $aCss = array(
                "../../public/css/global.css",
                "https://fonts.googleapis.com/icon?family=Material+Icons",
                "https://use.fontawesome.com/releases/v5.5.0/css/all.css",
                "../../public/TE/jquery-te-1.4.0.css",
                "../../public/css/admin.css", "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
            );
            $aJs = array(
                "../../public/js/jquery-3.3.1.min.js",
                "../../public/TE/jquery-te-1.4.0.min.js", "https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            );
            /* Afficher le début de la page HTML */
            /*             * ********************************** */
            echo $oVue->getHeader('Administration :: Le Fol Espoir', $aCss, $aJs);

            $oVueAdministrateur = new VueAdministrateur();

            if (isset($_SESSION['connexion']) == false) {
                //L'internaute n'est pas authentifié
                if (isset($_POST['cmd']) == false) {
                    //l'arrivée sur le formulaire (pas encore cliqué sur le submit)
                    $oVueAdministrateur->adm_afficherConnexion();
                } else {
                    //L'internaute a cliqué sur le submit
                    //Affecter les propriétés privées
                    $oAdministrateur = new Administrateur();
                    $oAdministrateur->setsCourrielAdmin($_POST['sCourrielAdmin']);
                    $oAdministrateur->setsPwdAdmin($_POST['sPwdAdmin']);

                    //Rechercher login/pwd
                    if ($oAdministrateur->connexion() == true) {
                        $_SESSION['connexion'] = $_POST['sCourrielAdmin'];
                        Controleur::adm_gererSite();
                    } else {//login/pwd pas trouvé
                        $sMsg = "Erreur. Login ou mot de passe incorrects. Veuillez réessayer.";
                        $oVueAdministrateur->adm_afficherConnexion($sMsg);
                    }
                }
            } else {
                //L'internaute est authentifié
                Controleur::adm_gererSite();
            }

            /* Afficher la fin de la page HTML */
            /*             * ********************************** */
            echo $oVue->getFooter();
        } catch (Exception $oException) {
            $oVue = new Vue();
            echo $oVue->getMessage($oException->getMessage());
        }
    }

    /**
     * Gère les administrateurs côté administration
     * @param void
     * @return void
     */
    public function adm_gererAdministrateur()
    {
        try {
            //Déclaration d'un objet de la classe VueAdministrateur
            //pour accéder aux méthodes de la classe
            $oVueAdministrateur = new VueAdministrateur();
            $oAdministrateur = new Administrateur();
            $sMsg = '';
            if (isset($_GET['action']) == false) {
                $this->adm_gererAfficherTousAdministrateur();
            } else {
                switch ($_GET['action']) {
                    case 'mod':
                        $this->adm_gererModifierAdministrateur();
                        break;
                    case 'sup':
                        $this->adm_gererSupprimerAdministrateur();
                        break;
                    case 'add':
                        $this->adm_gererAjouterAdministrateur();
                        break;
                    default:
                        $this->adm_gererAfficherTousAdministrateur();
                }//fin du switch()
            }
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

//fin de la fonction

    /**
     * Gère 'afficher tous de' administrateurs côté administration
     * @param string $sMsg
     * @return void
     */
    public function adm_gererAfficherTousAdministrateur($sMsg = '')
    {
        //Déclaration d'un objet de la classe VueAdministrateur
        //pour accéder aux méthodes de la classe
        $oVueAdministrateur = new VueAdministrateur();
        $oAdministrateur = new Administrateur();

        //Rechercher tous les Administrateur
        $aoAdministrateurs = $oAdministrateur->rechercherTous();
        //Affichage
        $oVueAdministrateur->adm_afficherTous($aoAdministrateurs, $sMsg);
    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire de modification ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererModifierAdministrateur()
    {
        try {
            $oVueAdministrateur = new VueAdministrateur();
            $oAdministrateur = new Administrateur();
            $sMsg = '';
            $oAdministrateur = new Administrateur($_GET['idAdmin']);
            if (isset($_GET['cmd']) == false) {

                if ($oAdministrateur->rechercherUn() == true) {
                    //Affichage
                    $oVueAdministrateur->adm_afficherModifierUn($oAdministrateur, $sMsg);
                } else {
                    throw new Exception('Erreur - Ce Administrateur n\'existe pas.  : ' . $_GET['idAdmin']);
                }
            } else {

                if ($oAdministrateur->rechercherUn() == true) {
                    //Affecter
                    $oAdministrateur = new Administrateur($_GET['idAdmin'], $_GET['sLoginAdmin'], $_GET['sPwdAdmin'], $_GET['sCourrielAdmin']);
                    //Sauvegarder
                    if ($oAdministrateur->modifier() !== false) {
                        $sMsg = 'La modification de  - ' . $oAdministrateur->getsLoginAdmin() . ' - s\'est déroulée avec succès.';
                        //Affichage
                        unset($_SESSION['connexion']);
                        header("location:index.php");
                    } else {
                        throw new Exception('Une erreur est survenue durant la modification de  : ' . $oAdministrateur->getsLoginAdmin());
                    }
                } else {
                    throw new Exception('Erreur - Ce Administrateur n\'existe pas.  : ' . $_GET['idAdmin']);
                }
            }
        } catch (Exception $oException) {
            $oVueAdministrateur = new VueAdministrateur();
            $oAdministrateur = new Administrateur($_GET['idAdmin']);

            $oAdministrateur->rechercherUn();
            $oVueAdministrateur->adm_afficherModifierUn($oAdministrateur, $oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire d'ajout ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererAjouterAdministrateur()
    {
        try {
            $oVueAdministrateur = new VueAdministrateur();
            $oAdministrateur = new Administrateur();
            $sMsg = '';
            if (isset($_GET['cmd']) == false) {
                //Affichage
                $oVueAdministrateur->adm_afficherAjouterUn();
            } else {
                //Affecter
                $oAdministrateur = new Administrateur(1, $_GET['sLoginAdmin'], $_GET['sPwdAdmin'], $_GET['sCourrielAdmin']);

                //Sauvegarder
                if ($oAdministrateur->ajouter() !== false) {
                    $sMsg = 'L\'ajout de  - ' . $oAdministrateur->getsLoginAdmin() . ' - s\'est déroulé avec succès.';
                    //Affichage
                    $oVueAdministrateur->adm_afficherAjouterUn($sMsg);
                } else {
                    throw new Exception('Une erreur est survenue durant l\'ajout de  : ' . $oAdministrateur->getsLoginAdmin());
                }
            }
        } catch (Exception $oException) {
            $oVueAdministrateur = new VueAdministrateur();
            $oVueAdministrateur->adm_afficherAjouterUn($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère la suppression dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererSupprimerAdministrateur()
    {
        try {
            $oVueAdministrateur = new VueAdministrateur();
            $oAdministrateur = new Administrateur();
            $sMsg = '';

            //Affecter
            $oAdministrateur = new Administrateur($_GET['idAdmin']);

            if ($oAdministrateur->rechercherUn() == true) {
                //Sauvegarder
                if ($oAdministrateur->supprimer() !== false) {
                    $sMsg = 'La suppression de  - ' . $oAdministrateur->getsLoginAdmin() . ' - s\'est déroulée avec succès.';
                    //Affichage
                    $this->adm_gererAfficherTousAdministrateur($sMsg);
                } else {
                    throw new Exception('Une erreur est survenue durant la suppression de  : ' . $oAdministrateur->getsLoginAdmin());
                }
            } else {
                throw new Exception('Erreur - Ce Administrateur n\'existe pas.  : ' . $_GET['idAdmin']);
            }
        } catch (Exception $oException) {
            $this->adm_gererAfficherTousAdministrateur($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère les Auteurs côté administration
     * @param void
     * @return void
     */
    public function adm_gererAuteur()
    {
        try {
            //Déclaration d'un objet de la classe VueAuteur
            //pour accéder aux méthodes de la classe
            $oVueAuteur = new VueAuteur();
            $oAuteur = new Auteur();
            $sMsg = '';

            if (isset($_GET['action']) == false && isset($_POST['action']) == false) {
                $this->adm_gererAfficherTousAuteur();
            } else {
                if (isset($_GET['action']) == true)
                    $sAction = $_GET['action'];
                else {
                    $sAction = $_POST['action'];
                }
                switch ($sAction) {
                    case 'mod':
                        $this->adm_gererModifierAuteur();
                        break;
                    case 'sup':
                        $this->adm_gererSupprimerAuteur();
                        break;
                    case 'add':
                        $this->adm_gererAjouterAuteur();
                        break;
                    default:
                        $this->adm_gererAfficherTousAuteur();
                }//fin du switch()
            }
        } catch (Exception $oException) {
            echo $oException->getMessage();
        }
    }

//fin de la fonction

    /**
     * Gère 'afficher tous de' Auteurs côté administration
     * @param string $sMsg
     * @return void
     */
    public function adm_gererAfficherTousAuteur($sMsg = '')
    {
        try {
            //Déclaration d'un objet de la classe VueAuteur 
            //pour accéder aux méthodes de la classe
            $oVueAuteur = new VueAuteur();
            $oAuteur = new Auteur();

            //Rechercher tous les Auteur
            $aoAuteurs = $oAuteur->rechercherTous();

            //Affichage         
            $oVueAuteur->adm_afficherTous($aoAuteurs, $sMsg);
        } catch (Exception $oException) {
            echo ($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire de modification ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererModifierAuteur()
    {
        try {
            $oVueAuteur = new VueAuteur();
            $oAuteur = new Auteur();
            $sMsg = '';

            if (isset($_POST['cmd']) == false) {
                $oAuteur = new Auteur($_GET['idAuteur']);
                if ($oAuteur->rechercherUn() == true) {
                    //Affichage         
                    $oVueAuteur->adm_afficherModifierUn($oAuteur, $sMsg);
                } else {
                    throw new Exception('Erreur - Ce Auteur n\'existe pas.  : ' . $_GET['idAuteur']);
                }
            } else {
                $oAuteur = new Auteur($_POST['idAuteur']);
                if ($oAuteur->rechercherUn() == true) {
                    //Affecter
                    $oAuteur = new Auteur($_POST['idAuteur'], $_POST['sNomAuteur'], $_POST['sPrenomAuteur'], $_POST['sCourrielAuteur']);
                    //Sauvegarder
                    if ($oAuteur->modifier() !== false) {
                        $sMsg = 'La modification de  - ' . $oAuteur->getsNomAuteur() . ' - s\'est déroulée avec succès.';
                        //Affichage         
                        echo ($sMsg);
                    } else {
                        echo ('Une erreur est survenue durant la modification de  : ' . $oAuteur->getsNomAuteur());
                    }
                } else {
                    echo ('Erreur - Ce Auteur n\'existe pas.  : ' . $_POST['idAuteur']);
                }
            }
        } catch (Exception $oException) {
            echo ($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire d'ajout ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererAjouterAuteur()
    {
        try {
            $oVueAuteur = new VueAuteur();
            $oAuteur = new Auteur();
            $sMsg = '';
            if (isset($_POST['cmd']) == false) {
                //Affichage         
                $oVueAuteur->adm_afficherAjouterUn();
            } else {
                //Affecter
                $oAuteur = new Auteur(1, $_POST['sNomAuteur'], $_POST['sPrenomAuteur'], $_POST['sCourrielAuteur']);

                //Sauvegarder
                if ($oAuteur->ajouter() !== false) {
                    $sMsg = 'L\'ajout de  - ' . $oAuteur->getsNomAuteur() . ' - s\'est déroulé avec succès.';
                    //Affichage         
                    echo ($sMsg);
                } else {
                    echo ('Une erreur est survenue durant l\'ajout de  : ' . $oAuteur->getsNomAuteur());
                }
            }
        } catch (Exception $oException) {
            echo ($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère la suppression dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererSupprimerAuteur()
    {
        try {
            $oVueAuteur = new VueAuteur();
            $oAuteur = new Auteur();
            $sMsg = '';

            //Affecter
            $oAuteur = new Auteur($_POST['idAuteur']);

            if ($oAuteur->rechercherUn() == true) {
                //Sauvegarder
                if ($oAuteur->supprimer() !== false) {
                    $sMsg = 'La suppression de  - ' . $oAuteur->getsNomAuteur() . ' - s\'est déroulée avec succès.';
                    //Affichage         
                    echo ($sMsg);
                } else {
                    echo ('Une erreur est survenue durant la suppression de  : ' . $oAuteur->getsNomAuteur());
                }
            } else {
                echo ('Erreur - Ce Auteur n\'existe pas.  : ' . $_GET['idAuteur']);
            }
        } catch (Exception $oException) {
            echo ($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère les medias côté administration
     * @param void
     * @return void
     */
    public function adm_gererMedia()
    {
        try {
            //Déclaration d'un objet de la classe VueMedia
            //pour accéder aux méthodes de la classe
            $oVueMedia = new VueMedia();
            $oMedia = new Media();

            if (isset($_GET['action']) == false && isset($_POST['action']) == false) {
                $this->adm_gererAfficherTousMedia();
            } else {
                if (isset($_GET['action']) == true)
                    $sAction = $_GET['action'];
                else {
                    $sAction = $_POST['action'];
                }

                switch ($sAction) {
                    case 'mod':
                        $this->adm_gererModifierMedia();
                        break;
                    case 'sup':
                        $this->adm_gererSupprimerMedia();
                        break;
                    case 'add':
                        $this->adm_gererAjouterMedia();
                        break;
                }//fin du switch()
            }
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

//fin de la fonction

    /**
     * Gère 'afficher tous de' medias côté administration
     * @param string $sMsg
     * @return void
     */
    public function adm_gererAfficherTousMedia($sMsg = '')
    {
        //Déclaration d'un objet de la classe VueMedia 
        //pour accéder aux méthodes de la classe
        $oVueMedia = new VueMedia();
        $oMedia = new Media();

        //Rechercher tous les Media
        $aoMedias = $oMedia->rechercherTous();

        //Affichage         
        $oVueMedia->adm_afficherTous($aoMedias, $sMsg);
    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire de modification ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererModifierMedia()
    {
        try {
            $oVueMedia = new VueMedia();
            $oVue = new Vue();
            $oMedia = new Media();
            $sMsg = '';

            if (isset($_POST['cmd']) == false) {
                $oMedia = new Media($_GET['idMedia']);
                if ($oMedia->rechercherUn() == true) {
                    //Rechercher tous les Auteurs
                    $aoAuteurs = $oMedia->getoAuteur()->rechercherTous();

                    //Affichage         
                    $oVueMedia->adm_afficherModifierUn($oMedia, $aoAuteurs, $sMsg);
                } else {
                    throw new Exception('Erreur - Ce Media n\'existe pas.  : ' . $_POST['idMedia']);
                }
            } else {
                $oMedia = new Media($_POST['idMedia']);
                if ($oMedia->rechercherUn() == true) {

                    //Affecter
                    if ($_POST['bAccepte'] == "true") {
                        $_POST['bAccepte'] = 1;
                    } else {
                        $_POST['bAccepte'] = 0;
                    }

                    $oMedia = new Media($_POST['idMedia'], $_POST['sTitreMedia'], $_POST['sUrlMedia'], $_POST['sMotsClefs'], $_POST['bAccepte'], $_POST['iNoAuteur']);
                    //Sauvegarder
                    if ($oMedia->modifier() !== false) {
                        $sMsg = 'La modification de  - ' . $oMedia->getsTitreMedia() . ' - s\'est déroulée avec succès.';
                        //Affichage         
                        echo $sMsg;
                    } else {
                        echo ('Une erreur est survenue durant la modification de  : ' . $oMedia->getsTitreMedia());
                    }
                } else {
                    echo ('Erreur - Ce Media n\'existe pas.  : ' . $_POST['idMedia']);
                }
            }
        } catch (Exception $oException) {
            echo ($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire d'ajout ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererAjouterMedia()
    {
        try {
            $oVueMedia = new VueMedia();
            $oVue = new Vue();
            $oMedia = new Media();
            $sMsg = '';
            //Rechercher tous les Auteurs
            $aoAuteurs = $oMedia->getoAuteur()->rechercherTous();
            if ($aoAuteurs == false) {
                echo $oVue->getMessage("Commencez par ajouter un Auteur.");
                return;
            }

            if (isset($_POST['cmd']) == false) {
                //Affichage         
                $oVueMedia->adm_afficherAjouterUn($aoAuteurs);
            } else {
                //Affecter
                if (isset($_POST['bAccepte']) == true) {
                    $_POST['bAccepte'] = 1;
                } else {
                    $_POST['bAccepte'] = 0;
                }
                if (isset($_POST['sUrlMedia']) == false) {
                    echo ("Sélectionnez un fichier à téléverser.");
                } else {
                    $oMedia = new Media($_POST['idMedia'], $_POST['sTitreMedia'], $_POST['sUrlMedia'], $_POST['sMotsClefs'], $_POST['bAccepte'], $_POST['iNoAuteur']);
                    //Sauvegarder
                    if ($oMedia->ajouter() !== false) {
                        $this->gererSuppressionMediaTeleverseInutilement();
                        $sMsg = 'L\'ajout de  - ' . $oMedia->getsTitreMedia() . ' - s\'est déroulé avec succès.';
                        //Affichage         
                        echo ($sMsg);
                    } else {
                        echo ('Une erreur est survenue durant l\'ajout de  : ' . $oMedia->getsTitreMedia() . " Vérifiez que ce média n'a pas déjà été téléversé et associé à un auteur.");
                    }
                }
            }
        } catch (Exception $oException) {
            echo ($oException->getMessage());
        }
    }

//fin de la fonction


    /* Gère la suppression de médias téléversés inutilement dans les dossiers medias/reduites/ et medias/
     * @param void
     * @return void
     */

    public function gererSuppressionMediaTeleverseInutilement()
    {
        //Supprimer les médias téléchargés inutilement se trouvant dans $_POST['sUrlMediaAOter'] séparé par des ;
        $aUrlMediaAOter = explode(";", $_POST['sUrlMediaAOter']);


        foreach ($aUrlMediaAOter as $iKey => $sUrl) {
            $aUrl = explode("/", $sUrl);

            if ($sUrl != "" && $aUrl[count($aUrl) - 1] != $_POST['sUrlMedia']) {
                unlink("../" . $sUrl);
                $aUrl = explode($aUrl[count($aUrl) - 1], $sUrl);
                @unlink("../" . $aUrl[0] . "reduites/" . $aUrl[count($aUrl) - 1]);
            }
        }
    }

//fin de la fonction

    function codeToMessage($iCode)
    {

    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire d'ajout ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererTeleversementMedia()
    {
        try {
            $aCodes = array(
                UPLOAD_ERR_OK => "Aucune erreur, le téléchargement est correct.",
                UPLOAD_ERR_INI_SIZE => "La taille du fichier téléchargé excède la valeur permise.",
                UPLOAD_ERR_FORM_SIZE => "La taille du fichier téléchargé excède la valeur permise.",
                UPLOAD_ERR_PARTIAL => "Le fichier n'a été que partiellement téléchargé.",
                UPLOAD_ERR_NO_FILE => "Aucun fichier n'a été téléchargé.",
                UPLOAD_ERR_NO_TMP_DIR => "Un dossier temporaire est manquant.",
                UPLOAD_ERR_CANT_WRITE => "Échec de l'écriture du fichier sur le disque.",
                UPLOAD_ERR_EXTENSION => "Une extension PHP a arrêté l'envoi de fichier."
            );


            if (isset($_FILES['sUrlMedia']) == false || $_FILES['sUrlMedia']['name'] == "") {
                echo ("Vous devez sélectionner un fichier à téléverser.");
            } else {

                if ($_FILES['sUrlMedia']['error'] !== UPLOAD_ERR_OK) {
                    echo $aCodes[$_FILES['sUrlMedia']['error']];
                    return;
                }
                $oFileInfo = new finfo();
                $sTypeMime = $oFileInfo->file($_FILES['sUrlMedia']['tmp_name'], FILEINFO_MIME_TYPE);

                if (in_array($sTypeMime, $this->aTypeMIME) == false) {
                    throw new Exception(ImageLib::ERR_IMAGE_MIME);
                }
                $aTypeMedia = explode("/", $sTypeMime);
                if ($aTypeMedia[0] == "image") {
                    $oImageLib = new ImageLib('sUrlMedia');
                    $sErreur = $oImageLib->televerser($sFilUpload);

                    $sPath = ImageLib::DOSSIER_IMAGES;
                    $sPathDest = ImageLib::DOSSIER_IMAGES . "reduites/";


                    $sErreur = $oImageLib->redimensionner($sFilUpload, $sPath, $sPathDest, $iLargeurMax = 150, $iHauteurMax = 150, $iBordure = 5, $saveCPU = true, $iBorderR = 87, $iBorderG = 84, $iBorderB = 77, $iFondR = 186, $iFondG = 180, $iFondB = 165);

                    $sFilUpload = "image/" . $sFilUpload;
                } else {//audio
                    $oAudioLib = new AudioLib('sUrlMedia');
                    $sErreur = $oAudioLib->televerser($sFilUpload);
                    $sFilUpload = "audio/" . $sFilUpload;
                }
                echo trim($sFilUpload);
            }
        } catch (Exception $oException) {
            echo ($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère la suppression dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererSupprimerMedia()
    {
        try {
            $oVueMedia = new VueMedia();
            $oMedia = new Media();
            $sMsg = '';

            //Affecter

            $oMedia = new Media($_POST['idMedia']);
            if ($oMedia->rechercherUn() == true) {
                //Vérifier que la suppression de ce média ne fait pas en sorte que l'auteur n'ait plus d'oeuvres
                //si oui supprimer l'auteur
                $iNbOeuvre = $oMedia->getoAuteur()->verifierNbOeuvresPourUnAuteur();

                if ($iNbOeuvre == 0) {
                    if ($oMedia->getoAuteur()->supprimer() !== false) {
                        $sMsg = 'La suppression de  - ' . $oMedia->getsTitreMedia() . ' - s\'est déroulée avec succès. L\'auteur associé - ' . $oMedia->getoAuteur()->getsPrenomAuteur() . ', ' . $oMedia->getoAuteur()->getsNomAuteur() . ' - à cette oeuvre a lui aussi été supprimé. Il ne lui restait plus aucun texte ou média.';
                        //Affichage         
                        echo $sMsg;
                    } else {
                        echo ('Une erreur est survenue durant la suppression de  : ' . $oMedia->getsTitreMedia());
                    }
                } else {
                    //Supprimer
                    if ($oMedia->supprimer() !== false) {
                        $sMsg = 'La suppression de  - ' . $oMedia->getsTitreMedia() . ' - s\'est déroulée avec succès.';
                        //Affichage         
                        echo ($sMsg);
                    } else {
                        echo ('Une erreur est survenue durant la suppression de  : ' . $oMedia->getsTitreMedia());
                    }
                }
            } else {
                echo ('Erreur - Ce Media n\'existe pas.  : ' . $_POST['idMedia']);
            }
        } catch (Exception $oException) {
            echo ($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère les pages côté administration
     * @param void
     * @return void
     */
    public function adm_gererPage()
    {
        try {
            //Déclaration d'un objet de la classe VuePage
            //pour accéder aux méthodes de la classe
            $oVuePage = new VuePage();
            $oPage = new Page();
            $sMsg = '';
            if (isset($_GET['action']) == false) {
                $this->adm_gererAfficherTousPage();
            } else {
                switch ($_GET['action']) {
                    case 'mod':
                        $this->adm_gererModifierPage();
                        break;
                    case 'sup':
                        $this->adm_gererSupprimerPage();
                        break;
                    case 'add':
                        $this->adm_gererAjouterPage();
                        break;
                    default:
                        $this->adm_gererAfficherTousPage();
                }//fin du switch()
            }
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

//fin de la fonction

    /**
     * Gère 'afficher tous de' pages côté administration
     * @param string $sMsg
     * @return void
     */
    public function adm_gererAfficherTousPage($sMsg = '')
    {
        //Déclaration d'un objet de la classe VuePage
        //pour accéder aux méthodes de la classe
        $oVuePage = new VuePage();
        $oPage = new Page();

        //Rechercher tous les Page
        $aoPages = $oPage->rechercherTous();
        //Affichage
        $oVuePage->adm_afficherTous($aoPages, $sMsg);
    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire de modification ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererModifierPage()
    {
        try {
            $oVuePage = new VuePage();
            $oPage = new Page();
            $sMsg = '';
            $oPage = new Page($_GET['idPage']);
            if (isset($_GET['cmd']) == false) {

                if ($oPage->rechercherUn() == true) {
                    //Affichage
                    $oVuePage->adm_afficherModifierUn($oPage, $sMsg);
                } else {
                    throw new Exception('Erreur - Ce Page n\'existe pas.  : ' . $_GET['idPage']);
                }
            } else {

                if ($oPage->rechercherUn() == true) {
                    //Affecter
                    $oPage = new Page($_GET['idPage'], $_GET['sTitrePage'], $_GET['sTextePage']);
                    //Sauvegarder
                    if ($oPage->modifier() !== false) {
                        $sMsg = 'La modification de  - ' . $oPage->getsTitrePage() . ' - s\'est déroulée avec succès.';
                        //Affichage
                        $this->adm_gererAfficherTousPage($sMsg);
                    } else {
                        throw new Exception('Une erreur est survenue durant la modification de  : ' . $oPage->getsTitrePage());
                    }
                } else {
                    throw new Exception('Erreur - Ce Page n\'existe pas.  : ' . $_GET['idPage']);
                }
            }
        } catch (Exception $oException) {
            $oVuePage = new VuePage();
            $oPage = new Page($_GET['idPage']);

            $oPage->rechercherUn();
            $oVuePage->adm_afficherModifierUn($oPage, $oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire d'ajout ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererAjouterPage()
    {
        try {
            $oVuePage = new VuePage();
            $oPage = new Page();
            $sMsg = '';
            if (isset($_GET['cmd']) == false) {
                //Affichage
                $oVuePage->adm_afficherAjouterUn();
            } else {
                //Affecter
                $oPage = new Page(1, $_GET['sTitrePage'], $_GET['sTextePage']);

                //Sauvegarder
                if ($oPage->ajouter() !== false) {
                    $sMsg = 'L\'ajout de  - ' . $oPage->getsTitrePage() . ' - s\'est déroulé avec succès.';
                    //Affichage
                    $oVuePage->adm_afficherAjouterUn($sMsg);
                } else {
                    throw new Exception('Une erreur est survenue durant l\'ajout de  : ' . $oPage->getsTitrePage());
                }
            }
        } catch (Exception $oException) {
            $oVuePage = new VuePage();
            $oVuePage->adm_afficherAjouterUn($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère la suppression dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererSupprimerPage()
    {
        try {
            $oVuePage = new VuePage();
            $oPage = new Page();
            $sMsg = '';

            //Affecter
            $oPage = new Page($_GET['idPage']);

            if ($oPage->rechercherUn() == true) {
                //Sauvegarder
                if ($oPage->supprimer() !== false) {
                    $sMsg = 'La suppression de  - ' . $oPage->getsTitrePage() . ' - s\'est déroulée avec succès.';
                    //Affichage
                    $this->adm_gererAfficherTousPage($sMsg);
                } else {
                    throw new Exception('Une erreur est survenue durant la suppression de  : ' . $oPage->getsTitrePage());
                }
            } else {
                throw new Exception('Erreur - Ce Page n\'existe pas.  : ' . $_GET['idPage']);
            }
        } catch (Exception $oException) {
            $this->adm_gererAfficherTousPage($oException->getMessage());
        }
    }

//fin de la fonction

    /**
     * Gère les textes côté administration
     * @param void
     * @return void
     */
    public function adm_gererTexte()
    {
        try {
            //Déclaration d'un objet de la classe VueTexte
            //pour accéder aux méthodes de la classe
            $oVueTexte = new VueTexte();
            $oTexte = new Texte();
            $sMsg = '';


            if (isset($_GET['action']) == false && isset($_POST['action']) == false) {
                $this->adm_gererAfficherTousTexte($sMsg);
            } else {
                if (isset($_GET['action']) == true)
                    $sAction = $_GET['action'];
                else {
                    $sAction = $_POST['action'];
                }

                switch ($sAction) {
                    case 'mod':
                        $this->adm_gererModifierTexte();
                        break;
                    case 'sup':
                        $this->adm_gererSupprimerTexte();
                        break;
                    case 'add':
                        $this->adm_gererAjouterTexte();
                        break;
                    default:
                        $this->adm_gererAfficherTousTexte();
                }//fin du switch()
            }
        } catch (Exception $oException) {
            echo "<p>" . $oException->getMessage() . "</p>";
        }
    }

//fin de la fonction

    /**
     * Gère 'afficher tous de' textes côté administration
     * @param string $sMsg
     * @return void
     */
    public function adm_gererAfficherTousTexte()
    {
        //Déclaration d'un objet de la classe VueTexte 
        //pour accéder aux méthodes de la classe
        $oVueTexte = new VueTexte();
        $oTexte = new Texte();

        //Rechercher tous les Texte
        $aoTextes = $oTexte->rechercherTous();
        //Affichage         
        $oVueTexte->adm_afficherTous($aoTextes);
    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire de modification ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererModifierTexte()
    {
        try {
            $oVueTexte = new VueTexte();
            $oTexte = new Texte();
            $sMsg = '';

            if (isset($_POST['cmd']) == false) {

                $oTexte = new Texte($_GET['idTexte']);
                if ($oTexte->rechercherUn() == true) {
                    //Rechercher tous les Auteurs
                    $aoAuteurs = $oTexte->getoAuteur()->rechercherTous();
                    //Affichage         
                    $oVueTexte->adm_afficherModifierUn($oTexte, $aoAuteurs);
                } else {
                    throw new Exception('Erreur - Ce Texte n\'existe pas.  : ' . $_GET['idTexte']);
                }
            } else {
                $oTexte = new Texte($_POST['idTexte']);
                if ($oTexte->rechercherUn() == true) {

                    //Affecter
                    if (isset($_POST['bAccepte']) == true && $_POST['bAccepte'] == "on") {
                        $_POST['bAccepte'] = 1;
                    } else {
                        $_POST['bAccepte'] = 0;
                    }
                    $oTexte = new Texte($_POST['idTexte'], $_POST['sTitreTexte'], $_POST['sExtraitTexte'], $_POST['sTexte'], $_POST['sNomCategorie'], $_POST['sMotsClefs'], $_POST['bAccepte'], $_POST['iNoAuteur']);
                    //Sauvegarder
                    if ($oTexte->modifier() !== false) {
                        $sMsg = 'La modification de  - ' . $oTexte->getsTitreTexte() . ' - s\'est déroulée avec succès.';
                        //Affichage         
                        echo $sMsg;
                    } else {
                        throw new Exception('Une erreur est survenue durant la modification de  : ' . $oTexte->getsTitreTexte());
                    }
                } else {
                    throw new Exception('Erreur - Ce Texte n\'existe pas.  : ' . $_GET['idTexte']);
                }
            }
        } catch (Exception $oException) {

            echo $oException->getMessage();
        }
    }

//fin de la fonction

    /**
     * Gère l'affichage du formulaire d'ajout ainsi que la sauvegarde dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererAjouterTexte($sMsg = "")
    {
        try {
            $oVueTexte = new VueTexte();
            $oVue = new Vue();
            $oTexte = new Texte();

            //Rechercher tous les Auteurs
            $aoAuteurs = $oTexte->getoAuteur()->rechercherTous();
            if ($aoAuteurs == false) {
                echo $oVue->getMessage("Commencez par ajouter un Auteur.");
                return;
            }
            if (isset($_POST['cmd']) == false) {
                //Affichage         
                $oVueTexte->adm_afficherAjouterUn($aoAuteurs);
            } else {
                //Affecter
                if (isset($_POST['bAccepte']) == true) {
                    $_POST['bAccepte'] = 1;
                } else {
                    $_POST['bAccepte'] = 0;
                }
                $oTexte = new Texte(1, $_POST['sTitreTexte'], $_POST['sExtraitTexte'], $_POST['sTexte'], $_POST['sNomCategorie'], $_POST['sMotsClefs'], $_POST['bAccepte'], $_POST['iNoAuteur']);

                //Sauvegarder
                if ($oTexte->ajouter() !== false) {
                    $sMsg = 'L\'ajout de  - ' . $oTexte->getsTitreTexte() . ' - s\'est déroulé avec succès.';
                    //Affichage         
                    echo $sMsg;
                } else {
                    echo 'Une erreur est survenue durant l\'ajout de  : ' . $oTexte->getsTitreTexte();
                }
            }
        } catch (Exception $oException) {
            echo $oException->getMessage();
        }
    }

//fin de la fonction

    /**
     * Gère la suppression dans la bdd
     * @param void
     * @return void
     */
    public function adm_gererSupprimerTexte()
    {
        try {
            $oVueTexte = new VueTexte();
            $oTexte = new Texte();
            $sMsg = '';

            //Affecter
            $oTexte = new Texte($_POST['idTexte']);
            if ($oTexte->rechercherUn() == true) {
                //Vérifier que la suppression de ce média ne fait pas en sorte que l'auteur n'ait plus d'oeuvres
                //si oui supprimer l'auteur
                $iNbOeuvre = $oTexte->getoAuteur()->verifierNbOeuvresPourUnAuteur();

                if ($iNbOeuvre == 0) {
                    if ($oTexte->getoAuteur()->supprimer() !== false) {
                        $sMsg = 'La suppression de  - ' . $oTexte->getsTitreTexte() . ' - s\'est déroulée avec succès. L\'auteur associé - ' . $oTexte->getoAuteur()->getsPrenomAuteur() . ', ' . $oTexte->getoAuteur()->getsNomAuteur() . ' - à cette oeuvre a lui aussi été supprimé. Il ne lui restait plus aucun texte ou média.';
                        //Affichage         
                        echo $sMsg;
                    } else {
                        echo ('Une erreur est survenue durant la suppression de  : ' . $oTexte->getsTitreTexte());
                    }
                } else {
                    //Supprimer

                    if ($oTexte->supprimer() !== false) {
                        $sMsg = 'La suppression de  - ' . $oTexte->getsTitreTexte() . ' - s\'est déroulée avec succès.';
                        //Affichage         
                        echo $sMsg;
                    } else {
                        echo ('Une erreur est survenue durant la suppression de  : ' . $oTexte->getsTitreTexte());
                    }
                }
            } else {
                echo ('Erreur - Ce Texte n\'existe pas.  : ' . $_GET['idTexte']);
            }
        } catch (Exception $oException) {
            echo ($oException->getMessage());
        }
    }

//fin de la fonction
}

//fin de la classe Controleur