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


/* =================================== */
/* = Programme Principal ============= */
/* =================================== */
try{
    $aoResultats = rechercherTousRechercheJSON($_POST['sTerme']);

    echo json_encode($aoResultats);

}catch(Exception $oException){
    echo $oException->getMessage();
}


function rechercherTousRechercheJSON($sTermeRecherche){

    $aEnregs = array();

    // Vérification
    if(is_numeric($sTermeRecherche) == true){
        throw new Exception("Le terme de recherche n'est pas une string...");
    }

    //Se connecter à la base de données
    $oPDOLib = new PDOLib();

    /* ============================================================= */
    /* TEXTES */
    /* ============================================================= */

    //Réaliser la requête
    $sRequete="
			SELECT idTexte, sPrenomAuteur, sNomAuteur, sTitreTexte FROM textes 
			LEFT JOIN auteurs ON auteurs.idAuteur = textes.iNoAuteur
            WHERE (sTitreTexte LIKE concat(concat('%', :sSearch), '%')
            OR sMotsClefs LIKE concat(concat('%', :sSearch), '%') 
            OR auteurs.sPrenomAuteur LIKE concat(concat('%', :sSearch), '%') 
            OR auteurs.sNomAuteur LIKE concat(concat('%', :sSearch), '%')) 
            AND bAccepte = 1
            ORDER BY dateTexte DESC LIMIT 10;";

    //Préparer la requête
    $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

    //Lier les paramètres aux valeurs
    $oPDOStatement->bindValue(":sSearch", $sTermeRecherche, PDO::PARAM_STR);

    //Exécuter la requête
    $b = $oPDOStatement->execute();

    //Si la requête a bien été exécutée
    if($b == true){
        //Récupérer le array
        array_push($aEnregs, $oPDOStatement->fetchAll(PDO::FETCH_ASSOC));
    }
    else{
        return false;
    }

    /* ============================================================= */
    /* AUTEURS */
    /* ============================================================= */

    //Réaliser la requête
    $sRequete="
			SELECT idAuteur, sNomAuteur, sPrenomAuteur FROM auteurs 
            WHERE sNomAuteur LIKE concat(concat('%', :sSearch), '%') 
            OR sPrenomAuteur LIKE concat(concat('%', :sSearch), '%')
            LIMIT 10;";

    //Préparer la requête
    $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

    //Lier les paramètres aux valeurs
    $oPDOStatement->bindValue(":sSearch", $sTermeRecherche, PDO::PARAM_STR);

    //Exécuter la requête
    $b = $oPDOStatement->execute();

    //Si la requête a bien été exécutée
    if($b == true){
        //Récupérer le array
        array_push($aEnregs, $oPDOStatement->fetchAll(PDO::FETCH_ASSOC));
    }

    /* ============================================================= */
    /* IMAGES */
    /* ============================================================= */

    //Réaliser la requête
    $sRequete="
			SELECT sPrenomAuteur, sNomAuteur, sTitreMedia, idMedia FROM medias
			LEFT JOIN auteurs ON auteurs.idAuteur = medias.iNoAuteur
            WHERE (sTitreMedia LIKE concat(concat('%', :sSearch), '%')
            OR sMotsClefs LIKE concat(concat('%', :sSearch), '%')
            OR auteurs.sPrenomAuteur LIKE concat(concat('%', :sSearch), '%') 
            OR auteurs.sNomAuteur LIKE concat(concat('%', :sSearch), '%'))
            AND enumTypeMedia LIKE 'image%'
            AND bAccepte = 1
            ORDER BY dateMedia DESC LIMIT 5;";

    //Préparer la requête
    $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

    //Lier les paramètres aux valeurs
    $oPDOStatement->bindValue(":sSearch", $sTermeRecherche, PDO::PARAM_STR);

    //Exécuter la requête
    $b = $oPDOStatement->execute();

    //Si la requête a bien été exécutée
    if($b == true){
        //Récupérer le array
        array_push($aEnregs, $oPDOStatement->fetchAll(PDO::FETCH_ASSOC));
    }

    /* ============================================================= */
    /* SONS */
    /* ============================================================= */

    //Réaliser la requête
    $sRequete="
			SELECT idMedia, sPrenomAuteur, sNomAuteur, sTitreMedia FROM medias
			LEFT JOIN auteurs ON auteurs.idAuteur = medias.iNoAuteur
            WHERE (sTitreMedia LIKE concat(concat('%', :sSearch), '%')
            OR sMotsClefs LIKE concat(concat('%', :sSearch), '%')
            OR auteurs.sPrenomAuteur LIKE concat(concat('%', :sSearch), '%') 
            OR auteurs.sNomAuteur LIKE concat(concat('%', :sSearch), '%'))
            AND enumTypeMedia LIKE 'audio%'
            AND bAccepte = 1
            ORDER BY dateMedia DESC LIMIT 5;";

    //Préparer la requête
    $oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);

    //Lier les paramètres aux valeurs
    $oPDOStatement->bindValue(":sSearch", $sTermeRecherche, PDO::PARAM_STR);

    //Exécuter la requête
    $b = $oPDOStatement->execute();

    //Si la requête a bien été exécutée
    if($b == true){
        //Récupérer le array
        array_push($aEnregs, $oPDOStatement->fetchAll(PDO::FETCH_ASSOC));
    }

    /* ============================================================= */

    $oPDOLib->fermerLaConnexion();
    return $aEnregs;

}//fin de la fonction