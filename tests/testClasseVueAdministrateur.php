
<?php
/**
 * Fichier testClasseVueAdministrateur.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:14:04 PM
 */
/* ========================================= */
/* ==== Inclure les fichiers composant ===== */
/* ========================================= */
require('../composant/lib/PDOLib.class.php');
require('../composant/lib/TypeException.class.php');
require('../composant/vues/Vue.class.php');
/* ========================================= */
/* ==== Inclure les fichiers modele ======== */
/* ========================================= */
require('../application/modeles/Administrateur.class.php');
/* ========================================= */
/* ==== Inclure les fichiers vue =========== */
/* ========================================= */
require('../application/vues/VueAdministrateur.class.php');

try{
    /* ========================================= */
    /* ====== Début de la page HTML ============ */
    /* ========================================= */
    $oVue = new Vue();
    $aCss = array("../public/css/global.css");
    $aJs = array();
    echo $oVue->getHeader("Tests de la classe Administrateur", $aCss, $aJs, "Fichier de tests", "Caroline Martin", "../public/css/ff.png", "fr", "utf-8");

    /* ====== Initialisation ============ */
    $_GET['s'] = 1;
    ?>
    <?php
    /* ========================================= */
    /* ====== Contenu de la page HTML ========== */
    /* ========================================= */
    ?>
    <h1>Test de la classe VueAdministrateur</h1>

    <h2>adm_afficherTous($aoAdministrateurs, $sMsg="")</h2>
    <?php
    try{
        /*Declaration d'un objet*/
        $oVueAdministrateur = new VueAdministrateur();

        $aoAdministrateurs  = array(
            new Administrateur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères"),
            new Administrateur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères"),
            new Administrateur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères")
        );

        $oVueAdministrateur->adm_afficherTous($aoAdministrateurs );


    }catch(Exception $oException){
        echo $oException->getMessage();
    }
    ?>
    <h2>adm_afficherModifierUn(Administrateur $oAdministrateur, $sMsg="")</h2>
    <?php
    try{
        /* ====== Initialisation ============ */
        $_GET['action'] = 'mod';
        /*Declaration d'un objet*/
        $oVueAdministrateur = new VueAdministrateur();

        $oAdministrateur = new Administrateur(2,"Une chaine de caractères","Une chaine de caractères","Une chaine de caractères");

        $oVueAdministrateur->adm_afficherModifierUn($oAdministrateur);


    }catch(Exception $oException){
        echo $oException->getMessage();
    }
    ?>
    <h2>adm_afficherAjouterUn($sMsg="")</h2>
    <?php
    try{
        /* ====== Initialisation ============ */
        $_GET['action'] = 'add';
        /*Declaration d'un objet*/
        $oVueAdministrateur = new VueAdministrateur();

        $oVueAdministrateur->adm_afficherAjouterUn();


    }catch(Exception $oException){
        echo $oException->getMessage();
    }
    ?>
    <h2>adm_afficherFromConnexion($sMsg="")</h2>
    <?php
    try{
        /* ====== Initialisation ============ */
        $oVueAdministrateur = new VueAdministrateur();

        $oVueAdministrateur->adm_afficherConnexion();


    }catch(Exception $oException){
        echo $oException->getMessage();
    }
    ?>
    <?php
    /* ========================================= */
    /* ====== Fin de la page HTML ============== */
    /* ========================================= */
    echo $oVue->getFooter("Caroline Martin &copy;2018");
}catch(Exception $oException){
    echo "<p>". $oException->getMessage()."</p>";
}
?>
 