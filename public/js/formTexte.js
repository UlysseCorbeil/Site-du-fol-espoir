//Ajouter un ecouteur d'evenement au bouton formulaire TEXTE
var oButton = document.getElementById('buttonTexte');
oButton.addEventListener("click", envoyerFormulaire);
function envoyerFormulaire(){
    //recuperer les dones
    
    var sTitreTexte = document.forms[0].sTitreTexte.value;
    var sTexte = document.forms[0].sTexte.value;
    var sNomCategorie = document.forms[0].sNomCategorie.value;
    var sMotsClefs = document.forms[0].sMotsClefs.value;
    var iNoAuteur = document.forms[0].iNoAuteur.value;
    
    
    //realiser la requete HTTTP pour ajouter l'auteur a la BDD
    $.ajax({
        url:"../controleurs/ajax/gererFormTexte.php",
        data:{sTitreTexte:sTitreTexte, sTexte:sTexte, sNomCategorie:sNomCategorie ,sMotsClefs:sMotsClefs, iNoAuteur:iNoAuteur},
        method:"post"
        }).done(function(sHtml){
            document.getElementById('msg').innerHTML = sHtml;
        });
        
    
}//fin de la fonction

//Ajouter un ecouteur d'evenement au bouton formulaire MEDIA
var oButton = document.getElementById('buttonMedia');
oButton.addEventListener("click", envoyerFormulaire);
function envoyerFormulaire(){
    //recuperer les dones   
    var sTitreMedia = document.forms[0].sTitreMedia.value;
    var sUrlMedia = document.forms[0].sUrlMedia.value;
    var sMotsClefs = document.forms[0].sMotsClefs.value;
    var iNoAuteur = document.forms[0].iNoAuteur.value;
    
    //realiser la requete HTTTP pour ajouter l'auteur a la BDD
    $.ajax({
        url:"../controleurs/ajax/gererFormAuteur.php",
        data:{sTitreMedia:sTitreMedia, sUrlMedia:sUrlMedia, sMotsClefs:sMotsClefs, iNoAuteur:iNoAuteur},
        method:"post"
        }).done(function(sHtml){
            document.getElementById('msg').innerHTML = sHtml;
        });
        
    
}//fin de la fonction