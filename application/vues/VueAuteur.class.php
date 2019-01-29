<?php

/**
 * Fichier VueAuteur.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:59 PM
 */
class VueAuteur {


    /*************************************************************************/
    /** INTERNAUTE ***********************************************************/
    /*************************************************************************/

    /**
     * Affiche le formulaire d'un nouvel Auteur
     * @param string $sMsg
     * @return void
     */
    public function afficherFormAuteur($sMsg = "") {
        $sHtml = "
            <main>
            <p>" . $sMsg . "</p>
            <h1 id=\"titre\">Contact</h1>
            <div id=\"ligne1\"></div>

            
            <div id=\"texte1\"  class='texte'>
               Le fol espoir s'épanouit grâce à vous. Merci de bien vouloir nous faire parvenir votre contenu afin de partager la créativité qui vous habite!
            </div>
                <div class=\"row formulaire formulaireAnimation\">
            <form action=index.php?s=5&p=2 method=post class=\"col s12\">
            
                        
                <div class=\"row \">
                    <div class=\"input-field col s12\">
                        <input id=\"sCourrielAuteur\" type=\"email\" name=sCourrielAuteur >
                        <label for=\"sCourrielAuteur\">Courriel</label>
                    </div>
                </div>


                <div class=\"row\">
                    <div class=\"input-field col s6\">
                        <input id=\"sNomAuteur \" type=\"text\" name=sNomAuteur >
                        <label for=\"sNomAuteur \">Nom</label>
                    </div>

                    <div class=\"input-field col s6\">
                        <input id=\"sPrenomAuteur\" type=\"text\" name=sPrenomAuteur >
                        <label for=\"sPrenomAuteur\">Prénom</label>
                    </div>
                </div>
                
                <div class=\"row\">
                    <button class=\"btn waves-effect waves-light\" type=submit name=cmd_auteur>Suivant
                        <i class=\"material-icons right\">send</i>
                      </button>

                </div>
                </form>
                </div>
                <div id=\"ligne2\"></div>

                <div id=\"texte2\" class=texte>
                    Si vous avez des questions, n’hésitez pas à envoyer un message ou à contacter nos réseaux sociaux. Nous aimerions avoir de vos nouvelles!</div>


                <div class=\"lesIcones\">
                    <div class=\"cercleIcone\">
                        <a href='https://www.gmail.com/'><i class=\"fas fa-envelope fa-2x\"></i></a>

                    </div>

                    <div class=\"cercleIcone\">
                        <a href='https://www.facebook.com/lefolespoir/'><i class=\"fab fa-facebook-f fa-2x\"></i></a>

                    </div>
                </div>
               
                </main>
			";
        echo $sHtml;
    }//fin de la fonction

    /**
     * Affiche tous ou toutes les auteurs
     * @param array $aoAuteurs array d'objets de la classe Auteur
     * @param string $sMsg
     * @return void
     */
    public function afficherTous($aoAuteurs, $sMsg = "") {
        $aTitres = array('idAuteur', 'sNomAuteur', 'sPrenomAuteur', 'sCourrielAuteur');

        $sHtml = "
		<h1>Affichage des Auteurs</h1>
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
        /* == Affichage des informations sur les auteurs === */
        $iMax = count($aoAuteurs);
        if ($aoAuteurs == false) {
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
				
			<td>" . $aoAuteurs[$i]->getidAuteur() . "</td>
			
			<td>" . $aoAuteurs[$i]->getsNomAuteur() . "</td>
			
			<td>" . $aoAuteurs[$i]->getsPrenomAuteur() . "</td>
			
			<td>" . $aoAuteurs[$i]->getsCourrielAuteur() . "</td>
			
			</tr>";
        }

        $sHtml .= "
		</table>";
        echo $sHtml;
    }//fin de la fonction


    /*************************************************************************/
    /** ADMINISTRATION *******************************************************/
    /*************************************************************************/


    /**
     * Affiche tous ou toutes les auteurs afin de pouvoir les modifier/supprimer ou ajouter
     * @param array $aoAuteurs array d'objets de la classe Auteur
     * @param string $sMsg
     * @return void
     */
    public function adm_afficherTous($aoAuteurs, $sMsg = "") {
        $aTitres = array('Auteurs', 'Actions');

        $sHtml = "
        <div id=\"dialog-confirm\" title=\"Suppression de cet auteur ?\">
          <p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:12px 12px 20px 0;\"></span>Cet auteur sera supprimé de manière permanente et ne pourra pas être récupéré. Êtes-vous sûr ?</p>
        </div>
        <header>
            <h1>Gestion de Auteurs</h1>
            <a href='index.php?s=".$_GET['s']."&amp;action=add' ><span>Ajouter un auteur <i class=\"fas fa-plus\"></i></span></a>
        </header>";

        if($sMsg != ""){
            if(strtok($sMsg, " ") != "La"){
                $sHtml .= "
        <div class='alert alert-admin flex-container' data-type='error'>
                        <div>
                            <i class='fas fa-exclamation-triangle'></i>
                        </div>
                        
                        <p id='sMsg'>". $sMsg ."</p>
                    </div>
        ";
            }
            else{
                $sHtml .= "
            <div class='alert alert-admin flex-container' data-type='success'>
                        <div>
                            <i class='fas fa-check'></i>
                        </div>
                        
                        <p id='sMsg'>". $sMsg ."</p>
                    </div>
        ";
            }
        }

        $sHtml .= "
        <table >
            
            <tr>";
        /* == Affichage des titres=========================== */

        $sHtml .= "
                <td >" . $aTitres[0] . "</td>
                <td colspan=2>" . $aTitres[1] . "</td>";

        $sHtml .= "
            </tr>";
        /* == Affichage des informations sur les auteurs === */
        $iMax = count($aoAuteurs);
        if ($aoAuteurs == false) {
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
                
            <td>" . $aoAuteurs[$i]->getsPrenomAuteur() . ", " . $aoAuteurs[$i]->getsNomAuteur() . "</td>
            <td><a href='index.php?s=" . $_GET['s'] . "&amp;action=mod&amp;idAuteur=" . $aoAuteurs[$i]->getidAuteur() . "'>
            <span title='Modifier'><i class=\"far fa-edit\"></i></span>
            </a></td>
            <td><a href='#' data-s=" . $_GET['s'] . " data-action=sup data-idAuteur=" . $aoAuteurs[$i]->getidAuteur() . ">
            <span title='Supprimer'><i class=\"fas fa-trash\"></i></span>
            </a></td>
            
            </tr>";
        }

        $sHtml .= "
        </table>
        <script src=\"../../public/js/gererAuteur.js\"></script>
        ";
        echo $sHtml;
    }//fin de la fonction

    /**
     * Affiche le formulaire de saisie de auteur
     * @param  Auteur $oAuteur objet de la classe Auteur
     * @param string $sMsg
     * @return void
     */
    public function adm_afficherModifierUn(Auteur $oAuteur, $sMsg = "") {
        $aActions = array('add' => 'ajouter', 'mod' => 'modifier');
        $sHtml = "
        <form action=index.php method=get>";

        if($sMsg != ""){
            if(strtok($sMsg, " ") != "L'ajout"){
                $sHtml .= "
            <div class='alert alert-admin flex-container' data-type='error'>
                        <div>
                            <i class='fas fa-exclamation-triangle'></i>
                        </div>
                        
                        <p>". $sMsg ."</p>
                    </div>
            ";
            }
            else{
                $sHtml .= "
            <div class='alert alert-admin flex-container' data-type='success'>
                        <div>
                            <i class='fas fa-check'></i>
                        </div>
                        
                        <p>". $sMsg ."</p>
                    </div>
            ";
            }
        }

        $sHtml .= "
            <input type=hidden name=s value=" . $_GET['s'] . ">
            <input type=hidden name=action value=" . $_GET['action'] . ">
            <input type=hidden name=idAuteur value=" . $oAuteur->getidAuteur() . ">
        <fieldset>
                <legend>Auteur à " . $aActions[$_GET['action']] . "</legend>
                
            <label for=sNomAuteur>Nom de l'auteur</label>
            <input type=text id=sNomAuteur name=sNomAuteur 
             
            value=\"" . htmlentities($oAuteur->getsNomAuteur()) . "\">
            <br>
            <label for=sPrenomAuteur>Prénom de l'auteur</label>
            <input type=text id=sPrenomAuteur name=sPrenomAuteur 
             
            value=\"" . htmlentities($oAuteur->getsPrenomAuteur()) . "\">
            <br>
            <label for=sCourrielAuteur>Courriel de l'auteur</label>
            <input type=email id=sCourrielAuteur name=sCourrielAuteur 
             
            value=\"" . $oAuteur->getsCourrielAuteur() . "\">
            <br>
                <br>
                <input type=submit name=cmd value=Sauvegarder>
                
                <a href='index.php?s=" . $_GET['s'] . "'>Retour</a>
            </fieldset>
        </form>";

        echo $sHtml;
    }//fin de la fonction

    /**
     * Affiche le formulaire de saisie de auteur
     * @param string $sMsg
     * @return void
     */
    public function adm_afficherAjouterUn($sMsg = "") {
        $oAuteur = new Auteur();
        $this->adm_afficherModifierUn($oAuteur, $sMsg);
    }//fin de la fonction

}//fin de la classe VueAuteur