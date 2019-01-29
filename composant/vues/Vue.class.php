<?php

/**
 * Component du framework
 * pour le cours 582-346-MA
 * @author Caroline Martin
 * @version 2015-06-16
 */
class Vue {

    /**
     * Header de la page HTML
     * @param string $sTitre
     * @param array $aUrlCss
     * @param array $aUrlJS
     * @param string $sDescription
     * @param string $sAuteur
     * @param string $sFavIcon
     * @param string $sLangue
     * @param string $sCharset
     */
    public function getHeader($sTitre = "Votre titre", $aUrlCss = array(), $aUrlJS = array(), $sDescription = "", $sAuteur = "Caroline Martin", $sFavIcon = "../../public/medias/favicon.png", $sLangue = "fr", $sCharset = "utf-8") {
        $sCh = '<!DOCTYPE html>
<html lang="' . $sLangue . '">
	<head>
		<meta charset="' . $sCharset . '">
	    	
		<title>' . $sTitre . '</title>
		<meta name="description" content="' . $sDescription . '">
		<meta name="author" content="' . $sAuteur . '">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link rel="icon" href="' . $sFavIcon . '">';

        for ($iCss = 0; $iCss < count($aUrlCss); $iCss++) {
            $sCh .= '
	    <link rel="stylesheet" href="' . $aUrlCss[$iCss] . '">
	    ';
        }

        for ($iJs = 0; $iJs < count($aUrlJS); $iJs++) {
            $sCh .= '
	    <script src="' . $aUrlJS[$iJs] . '"></script>
	    ';
        }

        $sCh .= '
	</head>
	<body>';
        return $sCh;
    }//fin de la fonction getHeader()


    /**
     * Footer de la page HTML
     * @param void
     * @return void
     */
    public static function getFooter() {
        return "
    <script src='../../public/js/fenetreContenu.js'></script> 
</body></html>";
    }//fin de la fonction getFooter()

    /**
     * @param array $aSections
     */
    public function getNavigation($aoTextes) {
        $sCh = "
        <header class='flex-container'>
            <div>
                <a href='index.php'>
                    <img src='../../public/medias/FolEspoir_Logo.png' alt='Logo Fol Espoir'>
                </a>
            </div>
            <div>
                <div class=\"burgerButton\">
                    <div class=\"bar1\"></div>
                    <div class=\"bar2\"></div>
                    <div class=\"bar3\"></div>
                    <input type=\"checkbox\" id=\"checkMenu\">
                </div> 
            </div>
            <div>
                <span id='btnRechercher'><i class=\"fas fa-search fa-lg\"></i></span>
            </div>
                
        </header>
        
        
	    <nav id='menu_princ'>
            <section id='nav_section_contenu'>
                <div id='nav_section_contenu_header'>
                    <img src='../../public/medias/FolEspoir_Logo.png' alt='Logo Fol Espoir' id='nav_logo'>
                    <h1>ŒUVRES LITTÉRAIRES ET VISUELLES</h1>
                    <div id='nav_social'>
                        <div>
                            <a target='_blank' href='https://www.facebook.com/lefolespoir/'><i class='fab fa-facebook-f'></i></a>
                     
                            <a href='mailto:lefolespoir@cmaisonneuve.qc.ca'><i class='fas fa-envelope'></i></a>
                        </div>
                    </div>
                </div>
                <div id='nav_section_contenu_menu'>
                    <a href='?s=1'>
                        <div>
                            <div></div><div></div><p>Accueil</p>
                        </div>
                    </a>
                    <a href='?s=2'>
                        <div>
                            <div></div><div></div><p>Œuvres</p>
                        </div>
                    </a>
                    <a href='?s=3'>
                        <div>
                            <div></div><div></div><p>Galerie</p>
                        </div>
                    </a>
                    <a href='?s=4'>
                        <div>
                            <div></div><div></div><p>À propos</p>
                        </div>
                    </a>
                    <a href='?s=5'>
                        <div>
                            <div></div><div></div><p>Soumettre</p>
                        </div>
                    </a>
                </div>
                <div id='nav_section_contenu_textes'>
                    <h1>Nos derniers textes</h1>";


        if (count($aoTextes) <= 1) {
            $sCh .= "<p>Aucun texte pour l'instant!</p>";
        } else {

            $indTexte = 0;

            for ($i = 0; $i < 2; $i++) {
                $sCh .= "<div>";
                for ($j = 0; $j < count($aoTextes) / 2; $j++) {

                    if ($indTexte < count($aoTextes)) {
                        $sCh .= "<a href='#' data-idtexte='" . $aoTextes[$indTexte]->getidTexte() . "'><div class='lire_texte' data-idTexte=''>
                            <p>" . $aoTextes[$indTexte]->getsTitreTexte() . "</p>
                            <p>- " . $aoTextes[$indTexte]->getsNomCategorie() . " par " . $aoTextes[$indTexte]->getoAuteur()->getsPrenomAuteur() . " " . $aoTextes[$indTexte]->getoAuteur()->getsNomAuteur() . "</p>
                        </div></a>";
                    } else {
                        $sCh .= "<div><p></p><p></p></div>";
                    }


                    $indTexte++;
                }
                $sCh .= "</div>";
            }
        }

        $sCh .= "

                </div>
            </section>
            <section id='nav_section_fermeture'>
                <p>&copy; Le fol espoir " . date("Y") . "</p>
                <div id='nav_section_fermeture_btnFermer'>
                    <span><i class='fas fa-angle-up fa-lg'></i></span>
                </div>
                <p>Collège de Maisonneuve</p>
            </section>
        </nav>
    
    <script src='../../public/js/menu.js'></script>
    
    <div id=\"rechercher-container\" class=\"flex-container\">
    <div id=\"rechercher-form\">
        <form action=\"index.php?s=". $_GET['s'] ."\" method=\"POST\">
            <span></span>
            <input type=\"text\" placeholder=\"Rechercher\" autofocus>
        </form>
        <span><i class=\"fas fa-times fa-2x\"></i></span>
    </div>
    <div id=\"resultats-container\" class=\"flex-container\">
        <div id=\"rechercher-resultats\" class=\"flex-container\">
            <div id=\"resultats-auteurs\" class=\"resultats\">
                <span>Auteur</span>
                <ul>

                </ul>
            </div>
            <div id=\"resultats-textes\" class=\"resultats\">
                <span>Textes</span>
                <ul>

                </ul>
            </div>

            <div id=\"resultats-medias\" class=\"flex-container\">
                <div id=\"resultats-img\" class=\"resultats\">
                    <span>Medias</span>
                    <ul>

                    </ul>
                </div>
                <div id=\"resultats-sons\" class=\"resultats\">
                    <span>Sons</span>
                    <ul>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id=\"loading\">
        <img src=\"../../public/medias/loading.gif\" alt=\"\">
    </div>
</div>

  

    <!-- Ajout des événements sur tous les liens -->
    
    <script src='../../public/js/rechercher.js'></script> 
    <script >
                        (function(){
                            var aLinksMenu = document.querySelectorAll('#nav_section_contenu_textes a');
                            
                            // Liens du menu principal
                            for(var i=0; i<aLinksMenu.length; i++){
                                aLinksMenu[i].addEventListener('click', gererTexte);
                            }
                        })();   
    </script>
    
	    ";

        return $sCh;

    }//fin de la fonction getNavigation()


    /**
     * Menu de navigation de l'administration
     * @param array $aSections
     * @param int $iSectionCliquee
     * @return string $sCh
     */
    public function adm_getNavigation($aSections) {
        $sCh = "
		<nav>
			<ul>";

        for ($iLi = 0; $iLi < count($aSections); $iLi++) {
            $sCh .= "
				<li><a href=\"" . $aSections[$iLi]['href'] . "\" title=\"" . $aSections[$iLi]['title'] . "\"><span>" . $aSections[$iLi]['text'] . "</span></a></li>
				";
        }
        $sCh .= "
			</ul>
		</nav>
                <script src='../../public/js/menu.js'></script>
		";
        return $sCh;

    }//fin de la fonction getNavigation()


    /**
     * retourne le message à afficher
     * @param string $sMsg
     * @return string
     */
    public static function getMessage($sMsg) {
        $sHTML = "
		<p>" . $sMsg . "</p>
		";
        return $sHTML;
    }//fin de la fonction getMessage()


    public static function getHead($sTitre = "", $aUrlCss = array("../../public/css/reset.min.css", "../../public/css/averta.min.css", "../../public/css/style.css"), $aUrlJS = array("../../public/js/countUp.js"), $sDescription = "", $sAuteur = "", $sFavIcon = "") {

        $sHtml = '<head>
		<meta charset="UTF-8">
		<meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	    	
		<title>' . $sTitre . '</title>
		<meta name="description" content="' . $sDescription . '">
		<meta name="author" content="' . $sAuteur . '">
		<link rel="icon" href="' . $sFavIcon . '">';

        for ($iCss = 0; $iCss < count($aUrlCss); $iCss++) {
            $sHtml .= '
	    <link rel="stylesheet" href="' . $aUrlCss[$iCss] . '">
	    ';
        }

        for ($iJs = 0; $iJs < count($aUrlJS); $iJs++) {
            $sHtml .= '
	    <script src="' . $aUrlJS[$iJs] . '"></script>
	    ';
        }

        $sHtml .= '
	</head>';

        echo $sHtml;
    }

}//fin de la classe Vue