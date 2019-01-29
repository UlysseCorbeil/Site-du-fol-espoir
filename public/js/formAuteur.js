//Ajouter un ecouteur d'evenement
var oButton = document.querySelector('button[type="button"]');
oButton.addEventListener("click", envoyerFormulaire);
function envoyerFormulaire(){
    //recuperer les dones
    var sNom = document.forms[0].sNomAuteur.value;
    var sPrenom = document.forms[0].sPrenomAuteur.value;
    var sCourriel = document.forms[0].sCourrielAuteur.value;
    
    
    //realiser la requete HTTTP pour ajouter l'auteur a la BDD
    $.ajax({
        url:"../controleurs/ajax/gererFormAuteur.php",
        data:{sNomAuteur:sNom, sPrenomAuteur:sPrenom, sCourrielAuteur:sCourriel},
        method:"post"
        }).done(function(sHtml){
            document.getElementById('msg').innerHTML = sHtml;
        });
        
    
}//fin de la fonction