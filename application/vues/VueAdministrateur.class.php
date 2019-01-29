
<?php
/**
 * Fichier VueAdministrateur.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:59 PM
 */
class VueAdministrateur {
	/*************************************************************************/
	/** INTERNAUTE ***********************************************************/
	/*************************************************************************/
   
   
	/*************************************************************************/
	/** ADMINISTRATION *******************************************************/
	/*************************************************************************/
   
   /**
	 * Affiche tous ou toutes les administrateurs afin de pouvoir les modifier/supprimer ou ajouter
	 * @param array $aoAdministrateurs array d'objets de la classe Administrateur
	 * @param string $sMsg 
	 * @return void
	 */
	public function adm_afficherTous($aoAdministrateurs, $sMsg=""){
		$aTitres = array('Administrateurs', 'Actions');
		$sHtml ="
		<header>
		    <h1>Gestion des Administrateurs</h1>
        </header>";

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

        $sHtml .= "
		<table >
			
			<tr>";
		/* == Affichage des titres=========================== */		
		
		$sHtml .= "
				<td >".$aTitres[0]."</td>
				<td >".$aTitres[1]."</td>";
		
		$sHtml .="
			</tr>";
		/* == Affichage des informations sur les administrateurs === */
		$iMax = count($aoAdministrateurs);
		if($aoAdministrateurs == false ){
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
				<td>".$aoAdministrateurs[$i]->getsLoginAdmin()."</td>
				<td><a href='index.php?s=".$_GET['s']."&amp;action=mod&amp;idAdmin=".$aoAdministrateurs[$i]->getidAdmin()."'>
				<span title='Modifier'><i class=\"far fa-edit\"></i></span></a></td>						
			</tr>";
		}
		
		$sHtml .="
		</table>";
		echo $sHtml; 
	}//fin de la fonction
	/**
	 * Affiche le formulaire de saisie de administrateur
	 * @param  Administrateur $oAdministrateur objet de la classe Administrateur
	 * @param string $sMsg 
	 * @return void
	 */
	public function adm_afficherModifierUn(Administrateur $oAdministrateur, $sMsg=""){
		$aActions= array('add'=>'ajouter', 'mod'=>'modifier');
		$sHtml ="
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
			<input type=hidden name=s value=".$_GET['s'].">
			<input type=hidden name=action value=".$_GET['action'].">
			<input type=hidden name=idAdmin value=".$oAdministrateur->getidAdmin().">
		<fieldset>
				<legend>Administrateur à ".$aActions[$_GET['action']]."</legend>
				
			<label for=sLoginAdmin>Nom d'utilisateur</label>
			<input type=text id=sLoginAdmin name=sLoginAdmin value=\"".$oAdministrateur->getsLoginAdmin()."\">
			<br>
			<label for=sPwdAdmin>Mot de passe</label>
			<input type=password id=sPwdAdmin name=sPwdAdmin>
			<br>
			<label for=sCourrielAdmin>Courriel</label>
			<input type=email id=sCourrielAdmin name=sCourrielAdmin 
			 
			value=\"".$oAdministrateur->getsCourrielAdmin()."\">
			<br>
				<br>
				<input type=submit name=cmd value=Sauvegarder>
				
				<a href='index.php?s=".$_GET['s']."'>Retour</a>
			</fieldset>
		</form>";		
		
		echo $sHtml;
	}//fin de la fonction
	/**
	 * Affiche le formulaire de saisie de administrateur
	 * @param string $sMsg 
	 * @return void
	 */
	public function adm_afficherAjouterUn($sMsg=""){
		$oAdministrateur = new Administrateur();
		$this->adm_afficherModifierUn($oAdministrateur, $sMsg);
	}//fin de la fonction


    /**
     * Afficher le formulaire de connexion
     * @param string $sMsg
     * @return void
     */
    public function adm_afficherConnexion($sMsg=""){
        $sHtml = '
        <div id="connexion">
            <div id="form-login" class="flex-container">
                <img src="../../public/medias/logo.png" alt="">
                <form action="index.php" method="post">';

        if($sMsg != ""){
            $sHtml .= '
                    <div class="alert alert-connexion flex-container" data-type="error">
                        <div>
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        
                        <p>'. $sMsg .'</p>
                    </div>';
        }


        $sHtml .= '
                    <div class="flex-container">
                        <input type="text" name="sCourrielAdmin" id="sCourrielAdmin" placeholder="Courriel" autofocus>
                    </div>
                    <div class="flex-container">
                        <input type="password" name="sPwdAdmin" id="sPwdAdmin" placeholder="Mot de passe">
                    </div>
                    <button type="submit" name="cmd">Connexion <i class="fas fa-angle-right"></i></button>

                </form>
            </div>
            </div>
        ';

        echo $sHtml;
    }

}//fin de la classe VueAdministrateur