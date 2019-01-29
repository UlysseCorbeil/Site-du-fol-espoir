<?php
/**
 * Fichier VueSoumettre.class.php
 * Projet - Le Fol Espoir
 * @author Kevin Langlois
 * @version Saturday 2018-10-13
 */
class VueSoumettre{
    /*************************************************************/
    /**INTERNAUTE*************************************************/
    /*************************************************************/
    private $aTypeMIME = array('image/gif','image/jpeg','image/png', 'audio/wav', 'audio/x-wav', 'audio/mpeg', 'audio/mpeg3','audio/x-mpeg-3', 'audio/ogg', 'application/ogg');
   
    
   
    
    /**
     * Affiche le formulaire qui contient la soumission d'un texte et d'un media
     * @param 
     * @param string $sMsg
     * @return void
     * @param string $sMsg
     */
    public function afficherFormulaire($sMsg=""){
        //$aActions= array('add'=>'ajouter', 'mod'=>'modifier');
        $oMedia = new Media();
        $sHtml ="
    <main>
         <p id=sMsg>".$sMsg."</p>
        <h1 id='titre'>Soumettre</h1>
        <div class='ligne' id='animationLigne'></div>
        <div class='paragraphe' id='animationTexte1'>
            Le fol espoir s'épanouit grâce à vous. Veuillez nous faire parvenir votre contenu afin de partager la créativité qui vous habite!
        </div>
        

        <form action=../controleurs/ajax/gererFormulaire.php method=post  class='formulaireAnimation'  id=\"fileinfo\">
            <input type=hidden name=s value=".$_GET['s'].">
            <input type=hidden name=action value='' id='actionFormulaire'>

        <!-- ----------------ENTETE POUR LES 2 TYPES TEXTE ET MEDIA--------------- -->

            <input type='email' id='sCourrielAuteur' name='sCourrielAuteur'>
            <label for='sCourrielAuteur' class='labelInfos'>Courriel</label>

            <div id='nomPrenom'>

                <div id='nom'>
                    <input type='text' id='sNomAuteur' name='sNomAuteur'>
                    <label for='sNomAuteur' class='labelInfos'>Nom</label>
                </div>
                <div id='prenom'>
                    <input type='text' id='sPrenomAuteur' name='sPrenomAuteur'>
                    <label for='sPrenomAuteur' class='labelInfos'>Prénom</label>
                </div>
            </div>
            
            <input id=sMotsClefs type='text' name=sMotsClefs>
            <label for=sMotsClefs class='labelInfos'>Mots clefs</label>
            
            <!-- Selection du media -->
            
             <select id=\"typeFichier\">
              <option disabled selected value>  Choisissez un type  </option>
              <option value=\"1\">Texte</option>
              <option value=\"2\">Image ou audio</option>
            </select>
            <label for='typeFichier' class='labelInfos'>Type d'œuvre</label>

<!-- ---------------------------------------------------------------- -->

<!-- ------------------LORSQUE USER CHOISI UN TEXTE----------------- -->
            <div id='typeDeTexte'>
                <input type='text' id='sTitreTexte' name='sTitreTexte'>
                <label for='sTitreTexte' class='labelInfos'>Titre du texte</label>
                

                <select id=sNomCategorie name=sNomCategorie>
                    <option value=essai>essai</option>
                    <option value=poésie>poésie</option>
                    <option value=récit>récit</option>
                    <option value=théâtre>théâtre</option>
                    <option value=inclassable>inclassable</option>
		</select>
                <label for=sNomCategorie class='labelInfos'>Type d'oeuvre</label>
                
                <input type='text' id='sExtraitTexte' name='sExtraitTexte'>
                <label for='sExtraitTexte' class='labelInfos'>Extrait de votre texte</label>

                <label for='sTexte' id='labelTexte'>Votre texte</label>
                <textarea name='sTexte' id='sTexte'></textarea>
            </div>
            
<!-- ---------------------------------------------------------------- -->

<!-- ------------------LORSQUE USER CHOISI UN MEDIA----------------- -->
            <div id='typeDeFichier'>
               
               
               
               <input type=hidden name=sUrlMedia value=\"informe_par_js\">
                <input type='text' id='sTitreMedia' name='sTitreMedia'>
                <label for='sTitreMedia' class='labelInfos' id='labelTitreMedia'>Titre du media</label>
               <input type=file id=sUrlMedia name=sUrlMedia >
               <label for=sUrlMedia class='labelInfos'>Votre media</label>
            </div>
            ";
        if($oMedia->getsUrlMedia() != ""){
            $sUrlMedia = "../../public/medias/".$oMedia->getsUrlMedia();
            $oFileInfo = new finfo();
            $sTypeMime = @$oFileInfo->file($sUrlMedia, FILEINFO_MIME_TYPE);

            if(in_array($sTypeMime, $this->aTypeMIME) == false){
                    throw new Exception(ImageLib::ERR_IMAGE_MIME);
            }
            $aTypeMedia = explode("/", $sTypeMime);
            if($aTypeMedia[0] == "image"){
                    $sContenuDiv ="
                    <img src='../../public/medias/reduites/".$oMedia->getsUrlMedia()."' alt=\"".$oMedia->getsTitreMedia()."\">				
                    ";
            }else{
                    $sContenuDiv ="
                    <audio controls><source src='../../public/medias/".$oMedia->getsUrlMedia()."'></audio>
                    ";
            }
            $sHtml .="
                    <div class=\"right\" data-url=\"../../public/medias/".$oMedia->getsUrlMedia()."\">
                    <p>".$oMedia->getsUrlMedia()."</p>".
                    $sContenuDiv
                    ."</div>

                    ";
		}
           
            
        $sHtml .="

			
<!-- ---------------------------------------------------------------- -->
            
            <input  type=button name=cmd id='btnSoumettre' class='.hvr-radial-out' value=Envoyer>

        </form>
        <script src='../../public/js/gererSoumettre.js'></script>
        

        <div class='paragraphe' id='animationTexte2'>
            Si vous avez des questions, n’hésitez pas à envoyer un message ou à contacter nos réseaux sociaux. Nous aimerions avoir de vos nouvelles!
        </div>

        <div class='lesIcones'>
        <a href='mailto:lefolespoir@cmaisonneuve.qc.ca'>
            <div class='cercleIcone'>
                <i class='fas fa-envelope fa-2x'></i>
            </div>
        </a>
        <a target='_blank' href='https://www.facebook.com/lefolespoir/'>
            <div class='cercleIcone'>
                <i class='fab fa-facebook-f fa-2x'></i>
            </div>
        </a>
        </div>
    </main>
    <script src='../../public/TE/editor_aspect.js'></script>
    <script src='../../public/js/form.js'></script>
        ";		
		
    echo $sHtml;
    }
  
}