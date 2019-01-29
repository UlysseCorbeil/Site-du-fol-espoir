<?php
/**
 * Created by PhpStorm.
 * User: Pierrot
 * Date: 2018-10-17
 * Time: 14:08
 */

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
require("../../vues/VueMedia.class.php");
/* =============================================== */
/* = Contrôleur                                  = */
/* =============================================== */
require("../Controleur.class.php");


/* =================================== */
/* = Programme Principal ============= */
/* =================================== */
try{
    $oMedia = new Media();
    $aoMedias = $oMedia->rechercherTousJSON();

    echo json_encode($aoMedias);
}catch(Exception $oException){
    echo $oException->getMessage();
}