
<?php
/**
 * Fichier VueTexte.class.php
 * Le Fol Espoir, oeuvres littéraires et médiatiques
 * @author Caroline Martin
 * @version Wednesday 3rd of October 2018 07:13:59 PM
 */
class VueAccueilAdmin {
	
	/*************************************************************************/
	/** INTERNAUTE ***********************************************************/
	/*************************************************************************/

    public function adm_afficherAccueil(){
        $sHtml = "<div id='accueil_admin'>
    


    <img src='../../public/images/medias/FolEspoir_Logo.png' alt='Logo Fol Espoir'>

    <h1>Bienvenue sur l'interface d'administration du site du Fol Espoir</h1>

    <p>Vous pourrez ici modifier ou approuver les différentes sections du contenu du site web.</p>
    <p>Vous pouvez utiliser le menu ci-dessus pour naviguer entre les différentes sections, et ajouter, modifier ou supprimer leur contenu respectif.</p>



<div id='admin_instru'>
    <div>
        <i class=\"fas fa-trash\"></i><p>Cette icône vous permettra de supprimer un media ou un texte.</p>
    </div>
    <div>
        <i class=\"far fa-edit\"></i><p>Cette icône vous permettra de modifier un media ou un texte.</p>
    </div>
    <div>
        <i class=\"fas fa-music\"></i><p>Les types de fichiers audio acceptés sont MP3, WAV ou OGG.</p>
    </div>
    <div>
        <i class=\"fas fa-images\"></i><p>Les types de fichiers images acceptés sont JPEG, PNG ou GIF.</p>
    </div>
</div>





</div>";

        echo $sHtml;
    }

}//fin de la classe VueAccueilAdmin