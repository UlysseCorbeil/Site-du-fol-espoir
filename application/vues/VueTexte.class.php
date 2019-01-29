
<?php
/**
 * Fichier VueTexte.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:59 PM
 */
class VueTexte {
	private $aNomCategories = array('essai','poésie','récit','théâtre','inclassable');
	
	/*************************************************************************/
	/** INTERNAUTE ***********************************************************/
	/*************************************************************************/

    public function afficherUn(){
        $sHtml = "
        <div id='texte_contenu'>
        <div id='fenetre_cercle_background_01' class='fenetre_cercle_background'></div>
        <div id='fenetre_cercle_background_02' class='fenetre_cercle_background'></div>
        <div id='fenetre_cercle_background_03' class='fenetre_cercle_background'></div>
        <div id='fenetre_cercle_foreground_01' class='fenetre_cercle_foreground'>
            <div>
                <div></div>
            </div>
        </div>
        <div id='fenetre_cercle_foreground_02' class='fenetre_cercle_foreground'>
            <div>
                <div></div>
            </div>
        </div>
        <div id='fenetre_cercle_foreground_03' class='fenetre_cercle_foreground'>
            <div>
                <div></div>
            </div>
        </div>
        <div class='bouton_texte' id='bouton_texte_retour'>
            <div class='texte_barrement'></div>
            Retour
        </div>
        <div id='texte_titre_fond'><!-- TITRE FOND --></div>
        <div id='texte_corps'>
            <div id='texte_titre'><!-- TITRE --></div>
            <div id='sepa_titre_auteur'></div>
            <div id='texte_auteur'><!-- TITRE CATÉGORIE ET AUTEUR --></div>
            <div id='texte_reveal'>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div id='texte_texte'><!-- TEXTE --></div>
        </div>
        <div id='texte_copyright'>TEXTE DE <!-- AUTEUR --> <!-- DATE --> &copy; TOUS DROITS RÉSERVÉS À L'AUTEUR</div>
        <div class='bouton_texte' id='bouton_texte_retour_2'>
            <div class='texte_barrement'></div>
            Retour
        </div>
        <div class='bouton_texte' id='bouton_texte_precedent'>Précédent
            <div class='texte_barrement'></div>
        </div>
        <div class='bouton_texte' id='bouton_texte_suivant'>
            <div class='texte_barrement'></div>
            Suivant
        </div>
        <div id='fenetre_limite'></div>
    </div>

        ";

        echo $sHtml;
    }


   /**
	 * Affiche tous ou toutes les textes
	 * @param array $aoTextes array d'objets de la classe Texte
	 * @param string $sMsg 
	 * @return void
	 */
	public function afficherTous($aoTextes, $sMsg=""){
		$aTitres = array('idTexte', 'sTitreTexte', 'sTexte', 'sNomCategorie', 'sMotsClefs', 'bAccepte', 'dateTexte', 'iNoAuteur');
		
		$sHtml ="
		<h1>Affichage des Textes</h1>
		<p>".$sMsg."</p>
		<table >
			
			<tr>";
		/* == Affichage des titres=========================== */		
		$iMaxTitre = count($aTitres);
		for($i=0; $i<$iMaxTitre; $i++){
			$sHtml .= "
				<td>".$aTitres[$i]."</td>";
		}
		$sHtml .="
			</tr>";
		/* == Affichage des informations sur les textes === */
		$iMax = count($aoTextes);
		if($aoTextes == false ){
			$sHtml .= "
			<tr>
				<td colspan=".$iMaxTitre.">Aucune donnée.</td>
			</tr>
		</table>";
			echo $sHtml;
			return;
		}
		for($i=0; $i < $iMax; $i++){
			$sHtml .= "
			<tr>
				
			<td>".$aoTextes[$i]->getidTexte()."</td>
			
			<td>".$aoTextes[$i]->getsTitreTexte()."</td>
			
			<td>".$aoTextes[$i]->getsTexte()."</td>
			
			<td>".$aoTextes[$i]->getsNomCategorie()."</td>
			
			<td>".$aoTextes[$i]->getsMotsClefs()."</td>
			
			<td>".$aoTextes[$i]->getbAccepte()."</td>
			
			<td>".$aoTextes[$i]->getdateTexte()."</td>
			
			<td>".$aoTextes[$i]->getoAuteur()->getidAuteur()."</td>
			
			</tr>";
		}
		
		$sHtml .="
		</table>";
		echo $sHtml; 
	}//fin de la fonction
	/*************************************************************************/
	/** ADMINISTRATION *******************************************************/
	/*************************************************************************/
   
   /**
     * Affiche tous ou toutes les textes afin de pouvoir les modifier/supprimer ou ajouter
     * @param array $aoTextes array d'objets de la classe Texte
     * @param string $sMsg 
     * @return void
     */
    public function adm_afficherTous($aoTextes, $sMsg=""){
        $aTitres = array('Textes', 'Actions');
        $sHtml ="
        <div id=\"dialog-confirm\" title=\"Suppression de ce texte ?\">
          <p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:12px 12px 20px 0;\"></span>Ce texte sera supprimé de manière permanente et ne pourra pas être récupéré. Êtes-vous sûr ?</p>
        </div>
        <header>
            <h1>Gestion de Textes</h1>
            <a href='index.php?s=".$_GET['s']."&amp;action=add' ><span>Ajouter un texte <i class=\"fas fa-plus\"></i></span></a>
        </header>

        <p id=sMsg></p>";
        if($sMsg != ""){
            if(strtok($sMsg, " ") != "La"){
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


        $sHtml .="
        <table >
            
            <tr>";
        /* == Affichage des titres=========================== */        
        
        $sHtml .= "
                <td >".$aTitres[0]."</td>
                <td colspan=2>".$aTitres[1]."</td>";
        
        $sHtml .="
            </tr>";
        /* == Affichage des informations sur les textes === */
        $iMax = count($aoTextes);
        if($aoTextes == false ){
            $sHtml .= "
            <tr>
                <td colspan=".count($aTitres).">Aucune donnée.</td>
            </tr>
        </table>";
            echo $sHtml;
            return;
        }
        for($i=0; $i < $iMax; $i++){
            $sHtml .= "
            <tr>
                
            <td>".$aoTextes[$i]->getsTitreTexte()."</td>
            <td><a href='index.php?s=".$_GET['s']."&amp;action=mod&amp;idTexte=".$aoTextes[$i]->getidTexte()."'>
            <span title='Modifier'><i class=\"far fa-edit\"></i></span>
            </a></td>
            <td><a href='#' data-s=".$_GET['s']." data-action=sup data-idTexte=".$aoTextes[$i]->getidTexte().">
            <span title='Supprimer'><i class=\"fas fa-trash\"></i></span>
            </a></td>
            
            </tr>";
        }
        
        $sHtml .="
        </table>
        <script src=\"../../public/js/gererTexte.js\"></script>
        ";
        echo $sHtml; 
    }//fin de la fonction
    /**
     * Affiche le formulaire de saisie de texte
     * @param  Texte $oTexte objet de la classe Texte
     * @param array $aoAuteurs array d'objets de la classe Auteur
     * @param string $sMsg 
     * @return void
     */


    public function adm_afficherModifierUn(Texte $oTexte, $aoAuteurs, $sMsg=""){
        $aActions= array('add'=>'ajouter', 'mod'=>'modifier');
        $sHtml ="
        <form action=../controleurs/ajax/adm_gererTexte.php method=post>
        <p id=sMsg>".$sMsg."</p>
            <input type=hidden name=s value=".$_GET['s'].">
            <input type=hidden name=action value=".$_GET['action'].">
            <input type=hidden name=idTexte value=".$oTexte->getidTexte().">
        <fieldset>
                <legend>Oeuvre à ".$aActions[$_GET['action']]."</legend>
                
            <label for=sTitreTexte>Titre</label>
            <input type=text id=sTitreTexte name=sTitreTexte 
             
            value=\"".htmlentities($oTexte->getsTitreTexte())."\">
            <br>
            <label for=sExtrait>Extrait</label>
            <input type=text id=sExtrait name=sExtraitTexte 
             
            value=\"".$oTexte->getsExtraitTexte()."\">
            
            <br>
            <label for=sTexte>Texte</label>
            <textarea id=sTexte name=sTexte>".$oTexte->getsTexte()."</textarea>
            <br>
            <label for=sNomCategorie>Categorie</label>";
        $sHtml .="  
            <select id=sNomCategorie name=sNomCategorie >";
        for($iCat=0; $iCat<count($this->aNomCategories); $iCat++){   
            $sHtml .="<option value=\"".$this->aNomCategories[$iCat]."\">".$this->aNomCategories[$iCat]."</option>";
        }
        $sHtml .="
            </select>   
            <br>
            <label for=sMotsClefs>Mots Clefs</label>
            <input type=text id=sMotsClefs name=sMotsClefs 
             
            value=\"".$oTexte->getsMotsClefs()."\">
            <br>
            <label for=bAccepte>Approuvé</label>";
            $sChecked = "";
            if($oTexte->getbAccepte() == 1){
                $sChecked = " checked ";
            }
        $sHtml .="
            <div id=boiteCheck><input type=checkbox id=bAccepte name=bAccepte ".$sChecked."></div>
            <br>
            
            
            <label for=iNoAuteur>Auteur</label>
            <select id=iNoAuteur name=iNoAuteur >";
            
        for($iAuteur=0; $iAuteur<count($aoAuteurs); $iAuteur++){
            $sSelected = "";
            if($oTexte->getoAuteur()->getidAuteur() == $aoAuteurs[$iAuteur]->getidAuteur()){
                $sSelected = " selected ";
            } 
            $sHtml .="<option ".$sSelected." value=\"".$aoAuteurs[$iAuteur]->getidAuteur()."\">".$aoAuteurs[$iAuteur]->getsPrenomAuteur().", ".$aoAuteurs[$iAuteur]->getsNomAuteur()."</option>";
        }
        $sHtml .="  
            </select>
            <br>
                <br>
                <input type=button name=cmd value=Sauvegarder>
                
                <a href='index.php?s=".$_GET['s']."'>Retour</a>
            </fieldset>
        </form>
        <script src=\"../../public/TE/editor_aspect.js\"></script>
        <script src=\"../../public/js/gererTexte.js\"></script>
        ";      
        
        echo $sHtml;
    }//fin de la fonction
    /**
     * Affiche le formulaire de saisie de texte
     * @param array $aoAuteurs array d'objets de la classe Auteur
     * @param string $sMsg 
     * @return void
     */
    public function adm_afficherAjouterUn($aoAuteurs, $sMsg=""){
        $oTexte = new Texte();
        $this->adm_afficherModifierUn($oTexte, $aoAuteurs, $sMsg);
    }//fin de la fonction
}//fin de la classe VueTexte