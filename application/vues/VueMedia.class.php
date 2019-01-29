
<?php

/**
 * Fichier VueMedia.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:59 PM
 */
class VueMedia {

    private $aTypeMIME = array('image/gif', 'image/jpeg', 'image/png', 'audio/wav', 'audio/x-wav', 'audio/mpeg', 'audio/mpeg3', 'audio/x-mpeg-3', 'audio/ogg', 'application/ogg');

    /*     * ********************************************************************** */

    /** INTERNAUTE ********************************************************** */
    /*     * ********************************************************************** */

    public function afficherTous() {
        $sHtml = "
        <div id='gallerie-container'>
            <div class='gallerie-btn'>
                <a href='#'><i class='fas fa-angle-left'></i></a>
            </div>
        
            <div id='gallerie' class='flex-container'>
            
</div>
        
            <div class='gallerie-btn'>
                <a href='#'><i class='fas fa-angle-right'></i></a>
            </div>
        </div>
        
        <div id='modal-photo' class='flex-container'>
            <div class='flex-container'>
                <span><i class='fas fa-times'></i></span>
                <img src='' alt=''>
                <p> &#8226; </p>
            </div>
        </div>
        
        
        <div id='forme'>
            <div class='cercle'></div>
            <div class='cercle'></div>
        </div>
        
        
        <script src='../../public/js/galerie.js'></script>
        <script src='../../public/js/testGalerie.js'></script>
        ";

        echo $sHtml;
    }

    public function afficherUn(Media $oMedia) {
        $sHtml = "
        <div id='gallerie-container'>
            <div class='gallerie-btn'>
                <a href='#'><i class='fas fa-angle-left'></i></a>
            </div>
        
            <div id='gallerie' class='flex-container'>
            
</div>
        
            <div class='gallerie-btn'>
                <a href='#'><i class='fas fa-angle-right'></i></a>
            </div>
        </div>
        
        <div id='modal-photo' class='flex-container' style='display: flex;'>
            <div class='flex-container'>
                <span><i class='fas fa-times'></i></span>
                <img src='../../public/medias/" . $oMedia->getsUrlMedia() . "' alt=''>
                <p>" . $oMedia->getsTitreMedia() . " &#8226; " . $oMedia->getoAuteur()->getsPrenomAuteur() . " " . $oMedia->getoAuteur()->getsNomAuteur() . "</p>
            </div>
        </div>
        
        
        <div id='forme'>
            <div class='cercle'></div>
            <div class='cercle'></div>
        </div>
        
        
        <script src='../../public/js/galerie.js'></script>
        <script src='../../public/js/testGalerie.js'></script>
        ";

        echo $sHtml;
    }

    public function afficherPageSon(Media $oSon) {
        $sHtml = "
            <body>
            <section class='son'>
                <div class='playpause'>
                    <input type='checkbox' value='None' id='playpause' name='check' onClick='togglePlay()' />
                    <label for='playpause' tabindex=1></label>
                </div>
                
                <div class='titre'>
                    <!--<h1 id=\"Titre-Son\">TEXTE </h1> -->
                    <h1 id=\"Titre-Son\">" . $oSon->getsTitreMedia() . "</h1>
                    <!--<h2 id=\"Auteur\"> par  NOM ARTISTE </h2> -->
                    <h2 id=\"Auteur\"> par " . $oSon->getoAuteur()->getsPrenomAuteur() . " " . $oSon->getoAuteur()->getsNomAuteur() . "</h2>
                    <div class='container'>
                        <div class='progress' id='progress'></div>
                        <!--<audio id='sonPlay' src=' SOURCE DU FICHIER AUDIO DANS BDD '></audio> -->
                        <audio id='sonPlay' src='" . $oSon->getsUrlMedia() . "'></audio>
                    </div>
                </div>
            </section>
            
            <div class='waveWrapper waveAnimation'>
                <div class='waveWrapperInner bgTop'>
                    <div class='wave waveTop' id='animWaveTop'></div>
                </div>
                <div class='waveWrapperInner bgMiddle'>
                    <div class='wave waveMiddle' id='animWaveMiddle'></div>
                </div>
                <div class='waveWrapperInner bgBottom'>
                    <div class='wave waveBottom' id='animWaveBottom'></div>
                </div>
            </div>
            </body>
            <script src='../../public/js/son.js'></script>    
        ";

        echo $sHtml;
    }

    /*     * ********************************************************************** */
    /** ADMINISTRATION ****************************************************** */
    /*     * ********************************************************************** */

    /**
     * Affiche tous ou toutes les medias afin de pouvoir les modifier/supprimer ou ajouter
     * @param array $aoMedias array d'objets de la classe Media
     * @param string $sMsg 
     * @return void
     */
    public function adm_afficherTous($aoMedias, $sMsg = "") {
        $aTitres = array('Medias', "Type", 'Actions');
        $sHtml = "
		<div id=\"dialog-confirm\" title=\"Suppression de ce média ?\">
		  <p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:12px 12px 20px 0;\"></span>Ce média sera supprimé de manière permanente et ne pourra pas être récupéré. Êtes-vous sûr ?</p>
		</div>
		<header>
		    <h1>Gestion de Médias</h1>
		    <a href='index.php?s=" . $_GET['s'] . "&amp;action=add' ><span>Ajouter un média <i class=\"fas fa-plus\"></i></span></a>
        </header>
		<p id=sMsg>" . $sMsg . "</p>
		<table >
			
			<tr>";
        /* == Affichage des titres=========================== */

        $sHtml .= "
				<td >" . $aTitres[0] . "</td>
				<td >" . $aTitres[1] . "</td>
				<td colspan=2>" . $aTitres[2] . "</td>";

        $sHtml .= "
			</tr>";
        /* == Affichage des informations sur les medias === */
        $iMax = count($aoMedias);
        if ($aoMedias == false) {
            $sHtml .= "
			<tr>
				<td colspan=" . count($aTitres) . ">Aucune donnée.</td>
			</tr>
		</table>";
            echo $sHtml;
            return;
        }
        for ($i = 0; $i < $iMax; $i++) {
            $sHtml .= "
			<tr>
				
			<td>" . $aoMedias[$i]->getsTitreMedia() . "</td>
			<td>" . $aoMedias[$i]->getsTypeMedia() . "</td>
			<td><a href='index.php?s=" . $_GET['s'] . "&amp;action=mod&amp;idMedia=" . $aoMedias[$i]->getidMedia() . "'>
			<span><i class=\"far fa-edit\"></i></span>
			</a></td>
			<td><a href='#' data-s=" . $_GET['s'] . " data-action=sup data-idMedia=" . $aoMedias[$i]->getidMedia() . ">
			<span><i class=\"fas fa-trash\"></i></span>
			</a></td>
			
			</tr>";
        }

        $sHtml .= "
		</table>
		<script src=\"../../public/js/gererMedia.js\"></script>
		";
        echo $sHtml;
    }

//fin de la fonction
    /**
     * Affiche le formulaire de saisie de media
     * @param  Media $oMedia objet de la classe Media
     * @param array $aoAuteurs array d'objets de la classe Auteur
     * @param string $sMsg 
     * @return void
     */

    public function adm_afficherModifierUn(Media $oMedia, $aoAuteurs, $sMsg = "") {
        $aActions = array('add' => 'ajouter', 'mod' => 'modifier');
        $sHtml = "
		<form action=index.php method=post id=\"fileinfo\">
		<p id=sMsg>" . $sMsg . "</p>
			<input type=hidden name=s value=" . $_GET['s'] . ">
			<input type=hidden name=action value=" . $_GET['action'] . ">
			<input type=hidden name=idMedia value=" . $oMedia->getidMedia() . ">
			<input type=hidden name=sUrlMedia value=\"informe_par_js\">
		<fieldset>
				<legend>Media à " . $aActions[$_GET['action']] . "</legend>
			
			<label for=sTitreMedia>Titre Media</label>
			<input type=text id=sTitreMedia name=sTitreMedia 
			 
			value=\"" . htmlentities($oMedia->getsTitreMedia()) . "\">
			";
        if ($oMedia->getsUrlMedia() != "") {
            $sUrlMedia = "../../public/medias/" . $oMedia->getsUrlMedia();
            $oFileInfo = new finfo();
            $sTypeMime = @$oFileInfo->file($sUrlMedia, FILEINFO_MIME_TYPE);

            if (in_array($sTypeMime, $this->aTypeMIME) == false) {
                throw new Exception(ImageLib::ERR_IMAGE_MIME);
            }
            $aTypeMedia = explode("/", $sTypeMime);
            if ($aTypeMedia[0] == "image") {
                $sContenuDiv = "
				<img src='../../public/medias/reduites/" . $oMedia->getsUrlMedia() . "' alt=\"" . $oMedia->getsTitreMedia() . "\">				
				";
            } else {
                $sContenuDiv = "
				<audio controls><source src='../../public/medias/" . $oMedia->getsUrlMedia() . "'></audio>
				";
            }
            $sHtml .= "
				<div class=\"right\" data-url=\"../../public/medias/" . $oMedia->getsUrlMedia() . "\">
				<p>" . $oMedia->getsUrlMedia() . "</p>" .
                    $sContenuDiv
                    . "</div>
				
				";
        }



        $sHtml .= "
			<br>
			<label for=sUrlMedia>Url Media</label>
			<input type=file id=sUrlMedia name=sUrlMedia >
			<br>
			<label for=sMotsClefs>Mots Clefs</label>
			<input type=text id=sMotsClefs name=sMotsClefs 
			 
			value=\"" . htmlentities($oMedia->getsMotsClefs()) . "\">
			<br>
			<label for=bAccepte>Approuvé</label>
			";
        $sChecked = "";
        if ($oMedia->getbAccepte() == 1) {
            $sChecked = " checked ";
        }
        $sHtml .= "	
			<input type=checkbox id=bAccepte " . $sChecked . " name=bAccepte >
			<br>
			
			<label for=iNoAuteur>Auteur</label>
			<select id=iNoAuteur name=iNoAuteur >";
        for ($iAuteur = 0; $iAuteur < count($aoAuteurs); $iAuteur++) {
            $sSelected = "";
            if ($oMedia->getoAuteur()->getidAuteur() == $aoAuteurs[$iAuteur]->getidAuteur()) {
                $sSelected = " selected ";
            }
            $sHtml .= "<option " . $sSelected . " value=\"" . $aoAuteurs[$iAuteur]->getidAuteur() . "\">" . $aoAuteurs[$iAuteur]->getsPrenomAuteur() . ", " . $aoAuteurs[$iAuteur]->getsNomAuteur() . "</option>";
        }
        $sHtml .= "	
			</select>
			<br>
			<input type=button name=cmd value=Sauvegarder>
			
			<a href='index.php?s=" . $_GET['s'] . "'>Retour</a>
			</fieldset>
		</form>
		<script src=\"../../public/js/gererMedia.js\"></script>
		";

        echo $sHtml;
    }

//fin de la fonction
    /**
     * Affiche le formulaire de saisie de media
     * @param array $aoAuteurs array d'objets de la classe Auteur
     * @param string $sMsg 
     * @return void
     */

    public function adm_afficherAjouterUn($aoAuteurs, $sMsg = "") {
        $oMedia = new Media();
        $this->adm_afficherModifierUn($oMedia, $aoAuteurs, $sMsg);
    }

//fin de la fonction
}

//fin de la classe VueMedia