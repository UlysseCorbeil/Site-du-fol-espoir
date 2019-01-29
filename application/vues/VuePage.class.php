<?php

/**
 * Fichier VuePage.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:59 PM
 */
class VuePage
{
    /*     * ********************************************************************** */
    /** INTERNAUTE ********************************************************** */
    /*     * ********************************************************************** */

    /**
     * Affiche la page d'accueil
     *
     * @param type $aoPages
     * @param type $sMsg
     *
     * @return void
     */
    public function afficherAccueil($aoTextes)
    {
        $sHtml = "
                    <section>               
                         <div class='text'>
                              <div> 
                                    <p class='holder'>";

        for ($i = 0; $i < count($aoTextes); $i++) {
            $sHtml .= " -<a href='#' data-idtexte='" . $aoTextes[$i]->getidTexte() . "'>
                         <span class='vers lire_texte' data-idTexte=''>" . $aoTextes[$i]->getsExtraitTexte() . "</span>
                        </a>";
        }
        $sHtml .= "</p>
                                </div>
                            </div>
                            
                            <span class=\"scrollDown\"></span>

                            <!-- SECTION POUR MOBILE -->
                            <div class='element'>
                                <h2 id='titreTexte'>" . $aoTextes[0]->getsTitreTexte() . "</h2>
                                <div class=\"black_bar\"></div>
                                <h1 id='extraitTexte'> «" . $aoTextes[0]->getsExtraitTexte() . "» </h1>
                                <div class='lire_poeme'>
                                <a href='#' data-idtexte='" . $aoTextes[0]->getidTexte() . "'>
                                              <span class='read lire_texte' data-idTexte=''>LIRE</span>
                                           </a>
                                </div>
                                <div class=\"black_bar2\"></div>
                            </div>
                            <!-- FIN SECTION POUR MOBILE --> 

                            <div id=\"preload\">
                                    <div class=\"img_BG1\"> </div>
                                    <div class=\"img_BG2\"> </div>
                                    <div class=\"img_BG3\"> </div>
                                    <div class=\"img_BG4\"> </div>
                            </div>     
                    </section>
                    
                    <script> 
                        $(document).ready(function() {  
                            $('#preload div').each(function(i) {
                                    $(this).delay((i++) * 300).fadeTo(700, 0.35);
                            })
                        });
                    </script>
                    
                    <script src=\"../../public/js/fenetreContenu.js\"></script>
                    <script src='../../public/js/nguyen.js'></script>
                    
                    <script >
                        (function(){
                            var aLinksMenu = document.querySelectorAll('.text a');
                            var aLinksLire = document.querySelectorAll('.lire_poeme a');
                            var aChangeText = document.querySelectorAll('.arrow div');

                            // Liens du menu principal
                            for(var i=0; i<aLinksMenu.length; i++){
                                aLinksMenu[i].addEventListener('click', gererTexte);
                            }
                            
                            // Liens du button lire
                            for(var i=0; i<aLinksLire.length; i++) {
                                aLinksLire[i].addEventListener('click', gererTexte);
                            }
                        })();   
                    </script>
                    ";
        echo $sHtml;
    }
//Fin de la fonction

    /**
     * Afficher les textes par catégories
     * @param void
     * @return void
     */
    public function AfficherTextesParCateg($sFiltre = "", $aoAuteurs = array())
    {
        $sHtml = "";
        if ($sFiltre == "") {
            $sHtml .= '
			
				<script>
					$(document).ready(function() {
			
						$(".Continuer").on("click", function() {
							var lesImgBackground = $(this).attr("imgBackground");
							var vitesse = 1000;
							$("html, body").animate({
								scrollTop: $(lesImgBackground).offset().top
							}, vitesse);
							return false;
						});
			
					});
                </script>
				
		<div class="global">
        <div class = "btnFiltre">Filtres</div>
        <span class ="indicateurCateg"></span>
        <div class="blockFiltres">
        <span><i class="fas fa-arrow-left"></i></span>
        <ul class="filtres">
            
            <li>
                <div class="filtreUn" data-sfiltre = "Essai">Essai</div>
            </li>

            <li>
                <div class="filtreDeux" data-sfiltre = "Poésie">Poésie</div>
            </li>

            <li>
                <div class="filtreTrois" data-sfiltre = "Récit">Récit</div>
            </li>

            <li>
                <div class="filtreQuatre" data-sfiltre = "Théatre">Théatre</div>
            </li>

            <li>
                <div class="filtreCinq" data-sfiltre = "Inclassable">Inclassable</div>
            </li>

            <li>
                <div class="filtreSix" data-sfiltre = "Audio">Audio</div>
            </li>

        </ul>
    </div>
			        <!-- <div id="follower"></div> -->
                
            <div class="lesCategory">
                    <div class = "columnCateg">
                        <div class = "columnItem" data-idTexte = "">
                            <div class ="itemImages">
                                <div class = "redCircle"></div>
                                <div class = "grisCarre"></div>
                                <div class = "grisCarreFront"></div>
                                <h2 class = "extraitPoeme"></h2>
                            </div>
                            <div class = "itemInfo">
                                <span></span>
                                <p></p>
                                <span></span>
                            </div>
                        </div>
                    </div>

                <div class = "columnCateg">
                    <div class = "columnItem" data-idTexte = "">
                        <div class ="itemImages">
                            <div class = "orangeCircle"></div>
                            <div class = "grisCarre"></div>
                            <div class = "grisCarreFront"></div>
                            <h2 class = "extraitPoeme"></h2>
                        </div>
                        <div class = "itemInfo">
                            <span></span>
                            <p></p>
                            <span></span>
                        </div>
                    </div>
                    
                </div>
            </div>

		</div>
			<script src="../../public/js/fenetreContenu.js"></script>
			<script>
				(function() {
			
					var boutonBurger = document.getElementsByClassName("burgerButton");
					var overlayMenu = document.getElementsByClassName("overlay");
			
					var pageGlobal = document.getElementsByClassName("global");
			
					var leFollower = document.getElementById("follower");
			
					var laBarreDeRecherche = document.getElementsByClassName("barreRecherche");
			
					var lesSpans = document.querySelectorAll(".menuItem");
					var nbSpans = lesSpans.length;
			
					var lesCategory = document.getElementsByClassName("lesCategory");
			
					var objets = document.querySelectorAll("#mesObjets");
					var nbObjets = objets.length;
			
					var elemMenu = document.querySelectorAll(".elem");
					var nbElem = elemMenu.length;
			
                    var leBoutonX = document.querySelector(".boutonX");
                    
                    var btnFiltre = document.querySelector(".btnFiltre");
                    var overlay = document.querySelector(".blockFiltres");

                    var elemFiltres = document.querySelector(".filtres");
                    var btnRetour = document.querySelector(".fa-arrow-left");

                    btnFiltre.addEventListener("click", function(){ 
                        overlay.classList.add("showSection");

                            // Si le overlay existe donc qu\'il est display block partez l\'animation
                            if(overlay){

                                // Ajouter un blur aux éléments de ma page
                                overlay.style.animation =  "fadeInMenu 0.5s forwards";
                                lesCategory[0].style.filter = "blur(0.5rem)";
                                for(let i = 0; i < objets.length; i++){
                                    objets[i].style.filter = "blur(0.5rem)";
                                }
                                boutonBurger[0].style.filter = "blur(0.5rem)";
                                btnFiltre.style.filter = "blur(0.5rem)";

                                // Partir l\'animation du texte quand l\'animation du overlay est terminé
                                overlay.addEventListener("animationend", function(){
                                    elemFiltres.style.opacity = "1";
                                    elemFiltres.style.transform = "translateX(0)";
                                    elemFiltres.style.filter = "blur(0)";
                                    btnRetour.style.opacity = "1";
                                    btnRetour.style.transform = "translateX(0)";
                                });
                                
                                btnRetour.addEventListener("click", function(){

                                    overlay.classList.remove("showSection");
            
                                    overlay.style.animation = "fadeOutMenu 0.5s forwards";
                                    lesCategory[0].style.filter = "blur(0)";
                                    for (let i = 0; i < objets.length; i++) {
                                        objets[i].style.filter = "blur(0)";
                                    }
                                    boutonBurger[0].style.filter = "blur(0)";
                                    btnFiltre.style.filter = "blur(0)";
                                        
                                }); // fin fonction
                            }
                    });
			
					for (let i = 0; i < nbSpans; i++) {
						lesSpans[i].addEventListener("hover", function() {
							leFollower.style.width = "80px";
							leFollower.style.height = "80px"  
						});
					} // fin for
			
					var boutonOuvrir = document.querySelectorAll(".lire_texte");
					var iNbBoutonOuvrir = boutonOuvrir.length;
			
					for (let i = 0; i < iNbBoutonOuvrir; i++) {
						boutonOuvrir[i].addEventListener("click", function() {
							ouvertureFenetreLecture();
						});
					}
                    window.onload = function () {
                        gererAfficherContenu();
                    }
                })();
                
			</script>
                        
                        <script src="../../public/js/parallax.js"></script>
                        <script src="../../public/js/smoothScroll.min.js"></script>
                        <script src="../../public/js/afficherFiltres.js"></script>
			';
        } else {
            $sHtml .= '
			
            <script>
            $(document).ready(function() {
    
                $(".Continuer").on("click", function() {
                    var lesImgBackground = $(this).attr("imgBackground");
                    var vitesse = 1000;
                    $("html, body").animate({
                        scrollTop: $(lesImgBackground).offset().top
                    }, vitesse);
                    return false;
                });
    
            });
        </script>
        <div class = "btnFiltre">Filtres</div>
        <span class ="indicateurCateg"></span>
        <div class="blockFiltres">
        <span><i class="fas fa-arrow-left"></i></span>
        <ul class="filtres">
            
            <li>
                <div class="filtreUn" data-sfiltre = "Essai">Essai</div>
            </li>

            <li>
                <div class="filtreDeux" data-sfiltre = "Poésie">Poésie</div>
            </li>

            <li>
                <div class="filtreTrois" data-sfiltre = "Récit">Récit</div>
            </li>

            <li>
                <div class="filtreQuatre" data-sfiltre = "Théatre">Théatre</div>
            </li>

            <li>
                <div class="filtreCinq" data-sfiltre = "Inclassable">Inclassable</div>
            </li>

            <li>
                <div class="filtreSix" data-sfiltre = "Audio">Audio</div>
            </li>

        </ul>
    </div>
				
		<div class="global">
			
			        <!-- <div id="follower"></div> -->
                
            <div class="lesCategory">
                <div class = "columnCateg">
            ';

            $iNombre = 0;
            for ($i = 0; $i < count($aoAuteurs); $i += 2) {
                $iNombre = $i;
                $iNombre++;
                $sHtml .= "<div class = 'columnItem' data-idTexte = '" . $aoAuteurs[$i]['idTexte'] . "'>
                <div class ='itemImages'><div class = 'redCircle'></div><div class = 'grisCarre'></div>
                        <div class = 'grisCarreFront'></div>
                        <h2 class = 'extraitPoeme'>" . $aoAuteurs[$i]['sTitreTexte'] . "</h2>
                    </div>
                    <div class = 'itemInfo'>
                        <span>0" . $iNombre . "</span>
                        <p>" . $aoAuteurs[$i]['sPrenomAuteur'] . " " . $aoAuteurs[$i]['sNomAuteur'] . "</p>
                        <span>" . $aoAuteurs[$i]['sNomCategorie'] . "</span>
                    </div>
                
                </div>";
            }




            $sHtml .= "
</div>
<div class = 'columnCateg'>";


            $iNombre2 = 1;
            for ($i = 1; $i < count($aoAuteurs); $i += 2) {
                $iNombre2 = $i;
                $iNombre2++;
                $sHtml .= "<div class = 'columnItem' data-idTexte = '" . $aoAuteurs[$i]['idTexte'] . "'>
                <div class ='itemImages'><div class = 'orangeCircle'></div><div class = 'grisCarre'></div>
                        <div class = 'grisCarreFront'></div>
                        <h2 class = 'extraitPoeme'>" . $aoAuteurs[$i]['sTitreTexte'] . "</h2>
                    </div>
                    <div class = 'itemInfo'>
                        <span>0" . $iNombre2 . "</span>
                        <p>" . $aoAuteurs[$i]['sPrenomAuteur'] . " " . $aoAuteurs[$i]['sNomAuteur'] . "</p>
                        <span>" . $aoAuteurs[$i]['sNomCategorie'] . "</span>
                    </div>
                </div>
                </div>";
            }

            $sHtml .= '
                                        
                </div>
            </div>

		</div>
        <script src="../../public/js/fenetreContenu.js"></script>
        <script>
            (function() {
        
                var boutonBurger = document.getElementsByClassName("burgerButton");
                var overlayMenu = document.getElementsByClassName("overlay");
        
                var pageGlobal = document.getElementsByClassName("global");
        
                var leFollower = document.getElementById("follower");
        
                var laBarreDeRecherche = document.getElementsByClassName("barreRecherche");
        
                var lesSpans = document.querySelectorAll(".menuItem");
                var nbSpans = lesSpans.length;
        
                var lesCategory = document.getElementsByClassName("lesCategory");
        
                var objets = document.querySelectorAll("#mesObjets");
                var nbObjets = objets.length;
        
                var elemMenu = document.querySelectorAll(".elem");
                var nbElem = elemMenu.length;
        
                var leBoutonX = document.querySelector(".boutonX");
                
                var btnFiltre = document.querySelector(".btnFiltre");
                var overlay = document.querySelector(".blockFiltres");

                var elemFiltres = document.querySelector(".filtres");
                var btnRetour = document.querySelector(".fa-arrow-left");

                btnFiltre.addEventListener("click", function(){ 
                    overlay.classList.add("showSection");

                        // Si le overlay existe donc qu\'il est display block partez l\'animation
                        if(overlay){

                            // Ajouter un blur aux éléments de ma page
                            overlay.style.animation =  "fadeInMenu 0.5s forwards";
                            lesCategory[0].style.filter = "blur(0.5rem)";
                            for(let i = 0; i < objets.length; i++){
                                objets[i].style.filter = "blur(0.5rem)";
                            }
                            boutonBurger[0].style.filter = "blur(0.5rem)";
                            btnFiltre.style.filter = "blur(0.5rem)";

                            // Partir l\'animation du texte quand l\'animation du overlay est terminé
                            overlay.addEventListener("animationend", function(){
                                elemFiltres.style.opacity = "1";
                                elemFiltres.style.transform = "translateX(0)";
                                elemFiltres.style.filter = "blur(0)";
                                btnRetour.style.opacity = "1";
                                btnRetour.style.transform = "translateX(0)";
                            });
                            
                            btnRetour.addEventListener("click", function(){

                                overlay.classList.remove("showSection");
        
                                overlay.style.animation = "fadeOutMenu 0.5s forwards";
                                lesCategory[0].style.filter = "blur(0)";
                                for (let i = 0; i < objets.length; i++) {
                                    objets[i].style.filter = "blur(0)";
                                }
                                boutonBurger[0].style.filter = "blur(0)";
                                btnFiltre.style.filter = "blur(0)";
                                    
                            }); // fin fonction
                        }
                });
        
                for (let i = 0; i < nbSpans; i++) {
                    lesSpans[i].addEventListener("hover", function() {
                        leFollower.style.width = "80px";
                        leFollower.style.height = "80px"  
                    });
                } // fin for
        
                var boutonOuvrir = document.querySelectorAll(".lire_texte");
                var iNbBoutonOuvrir = boutonOuvrir.length;
        
                for (let i = 0; i < iNbBoutonOuvrir; i++) {
                    boutonOuvrir[i].addEventListener("click", function() {
                        ouvertureFenetreLecture();
                    });
                }
        
            })();
        </script>
                    
                    <script src="../../public/js/parallax.js"></script>
                    <script src="../../public/js/smoothScroll.min.js"></script>
                    <script src="../../public/js/afficherFiltres.js"></script>
        ';
        }

        echo $sHtml;
    }

    /**
     * Affiche le contenu de la page Apropos
     *
     * @param string $sMsg
     *
     * @return void
     */
    public function afficherApropos(Page $oPage, $sMsg = '')
    {
        $sHtml = "	   					  
        <main>
 
        <h1 id='titre'>" . $oPage->getsTitrePage() . "</h1>
        <div class='ligne' id='animationLigne'></div>
                    
            <div class='paragraphe' id='animationTexte1'>" . $oPage->getsTextePage() . "</div>

            		
             				
    </main>	
			
     ";
        echo $sHtml;
    }

    /**
     * Affiche tous ou toutes les pages
     *
     * @param array $aoPages array d'objets de la classe Page
     * @param string $sMsg
     *
     * @return void
     */
    public function afficherTous($aoPages, $sMsg = "")
    {
        $aTitres = array('idPage', 'sTitrePage', 'sTextePage');

        $sHtml = "
		<h1>Affichage des Pages</h1>
		<p>" . $sMsg . "</p>
		<table >
			
			<tr>";
        /* == Affichage des titres=========================== */
        $iMaxTitre = count($aTitres);
        for ($i = 0; $i < $iMaxTitre; $i++) {
            $sHtml .= "
				<td>" . $aTitres[$i] . "</td>";
        }
        $sHtml .= "
			</tr>";
        /* == Affichage des informations sur les pages === */
        $iMax = count($aoPages);
        if ($aoPages == false) {
            $sHtml .= "
			<tr>
				<td colspan=" . $iMaxTitre . ">Aucune donnée.</td>
			</tr>
		</table>";
            echo $sHtml;
            return;
        }
        for ($i = 0; $i < $iMax; $i++) {
            $sHtml .= "
			<tr>
				
			<td>" . $aoPages[$i]->getidPage() . "</td>
			
			<td>" . $aoPages[$i]->getsTitrePage() . "</td>
			
			<td>" . $aoPages[$i]->getsTextePage() . "</td>
			
			</tr>";
        }

        $sHtml .= "
		</table>";
        echo $sHtml;
    }

//fin de la fonction
    /*     * ********************************************************************** */
    /** ADMINISTRATION ****************************************************** */
    /*     * ********************************************************************** */

    /**
     * Affiche tous ou toutes les pages afin de pouvoir les modifier/supprimer ou ajouter
     *
     * @param array $aoPages array d'objets de la classe Page
     * @param string $sMsg
     *
     * @return void
     */
    public function adm_afficherTous($aoPages, $sMsg = "")
    {
        $aTitres = array('Pages', 'Actions');
        $sHtml = "
		<header>
		<h1>Gestion de Pages</h1>
        </header>
		<p>" . $sMsg . "</p>
		<table >
			
			<tr>";
        /* == Affichage des titres=========================== */

        $sHtml .= "
				<td >" . $aTitres[0] . "</td>
				<td>" . $aTitres[1] . "</td>";

        $sHtml .= "
			</tr>";
        /* == Affichage des informations sur les pages === */
        $iMax = count($aoPages);
        if ($aoPages == false) {
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
				<td>" . $aoPages[$i]->getsTitrePage() . "</td>
				<td><a href='index.php?s=" . $_GET['s'] . "&amp;action=mod&amp;idPage=" . $aoPages[$i]->getidPage() . "'><span>Modifier</span></a></td>
			</tr>";
        }

        $sHtml .= "
		</table>";
        echo $sHtml;
    }

//fin de la fonction

    /**
     * Affiche le formulaire de saisie de page
     *
     * @param  Page $oPage objet de la classe Page
     * @param string $sMsg
     *
     * @return void
     */
    public function adm_afficherModifierUn(Page $oPage, $sMsg = "")
    {
        $aActions = array('add' => 'ajouter', 'mod' => 'modifier');
        $sHtml = "
		<form action=index.php method=get>
		<p>" . $sMsg . "</p>
			<input type=hidden name=s value=" . $_GET['s'] . ">
			<input type=hidden name=action value=" . $_GET['action'] . ">
			<input type=hidden name=idPage value=" . $oPage->getidPage() . ">
		<fieldset>
				<legend>Page à " . $aActions[$_GET['action']] . "</legend>
				
			<label for=sTitrePage>sTitrePage</label>
			<input type=text id=sTitrePage name=sTitrePage 
			 
			value=\"" . $oPage->getsTitrePage() . "\">
			<br>
			<label for=sTextePage>sTextePage</label>
			<textarea id=sTextePage name=sTextePage>" . $oPage->getsTextePage() . "</textarea>
			<br>
				
			<input type=submit name=cmd value=Sauvegarder>
			
			<a href='index.php?s=" . $_GET['s'] . "'>Retour</a>
			</fieldset>
		</form>";

        echo $sHtml;
    }

//fin de la fonction

    /**
     * Affiche le formulaire de saisie de page
     *
     * @param string $sMsg
     *
     * @return void
     */
    public function adm_afficherAjouterUn($sMsg = "")
    {
        $oPage = new Page();
        $this->adm_afficherModifierUn($oPage, $sMsg);
    }

//fin de la fonction
}

//fin de la classe VuePage