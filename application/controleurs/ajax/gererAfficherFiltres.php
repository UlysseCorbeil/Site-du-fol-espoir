<?php

/**
 * Created by PhpStorm.
 * User: Ulysse
 * Date: 2018-10-17
 * Time: 14:08
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* =================================== */
/* = Nécessaire ====================== */
/* =================================== */
/* =============================================== */
/* = Composant                                   = */
/* =============================================== */
require("../../../composant/lib/PDOLib.class.php");
require("../../../composant/lib/TypeException.class.php");
/* =============================================== */
/* = Modèles                                     = */
/* =============================================== */
require("../../modeles/Media.class.php");
require("../../modeles/Auteur.class.php");
require("../../modeles/Page.class.php");
require("../../modeles/Texte.class.php");

/* =============================================== */
/* = Vues                                     = */
/* =============================================== */
require("../../vues/VueTexte.class.php");
require("../../vues/VuePage.class.php");
require("../../vues/VueMedia.class.php");

/* =============================================== */
/* = Contrôleur                                  = */
/* =============================================== */
require("../Controleur.class.php");


/* =================================== */
/* = Programme Principal ============= */
/* =================================== */
try {

    $oTexte = new Texte();
    $aoTextes = $oTexte->rechercherTousJSONparCateg($_POST['sNomFiltre']);

    echo json_encode($aoTextes);

} catch (Exception $oException) {
    echo $oException->getMessage();
} 