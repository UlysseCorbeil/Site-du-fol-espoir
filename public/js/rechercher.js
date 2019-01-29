(function(){
    var txtRecherche = document.querySelector("form input[type=text]");
    var aSouligne = document.querySelector("#rechercher-form form>span");
    var btnClose = document.querySelector("#rechercher-form>span");
    var panRechercher = document.querySelector("#rechercher-container");
    var btnRechercher = document.getElementById("btnRechercher");

    btnRechercher.addEventListener("click", OuvrirRechercher);

    btnClose.addEventListener("click", FermerRechercher);

    // Ajout d'un évément lorsque le value de l'input change
    txtRecherche.addEventListener("input", function () {
        aSouligne.innerHTML = txtRecherche.value;

        // Si la boite de texte n'est pas vide,
        if(txtRecherche.value !== ""){

            // AJAX
            $.ajax({
                url: "../controleurs/ajax/gererRecherche.php",
                data: {sTerme : txtRecherche.value},
                method: "post",
                beforeSend: function() {
                    // Retirer tous les résultats précédents
                    document.querySelector("#resultats-textes ul").innerHTML = "";
                    document.querySelector("#resultats-auteurs ul").innerHTML = "";
                    document.querySelector("#resultats-img ul").innerHTML = "";
                    document.querySelector("#resultats-sons ul").innerHTML = "";

                    // Mettre une icone de chargement
                    document.getElementById("loading").style.display = "flex";
                }
            })
            // Si la reqête est terminée
                .done(function (sHtml) {

                    // Enlever l'icone de chargement
                    document.getElementById("loading").style.display = "none";

                    // Récupérer le JSON et transformer en objet JS
                    oJson = JSON.parse(sHtml);

                    // Afficher les résultats
                    afficherResultatsTexte(oJson);

                    // Tous les liens vers un texte
                    var aLinksRecherche = document.querySelectorAll('#resultats-textes ul li a');

                    // Ajouter les écouteurs d'événements
                    for(var i=0; i<aLinksRecherche.length; i++){
                        aLinksRecherche[i].addEventListener('click', gererTexte);
                    }
                });


            document.getElementById("rechercher-resultats").style.display = "flex";
            document.getElementById("resultats-container").style.backgroundColor = "rgba(38, 38, 38, 0.995)";
        }
        else{
            document.getElementById("rechercher-resultats").style.display = "none";
            document.getElementById("resultats-container").style.backgroundColor = "rgba(255, 255, 255, 0.98)";
        }
    });

    /**
     * Ouvrir le panneau de recherche
     * @param void
     * @return void
     */
    function OuvrirRechercher(){
        panRechercher.style.display = "flex";
        txtRecherche.focus();
    }

    /**
     * Fermer le panneau de recherche
     * @param void
     * @return void
     */
    function FermerRechercher(){
        panRechercher.style.display = "none";
    }


    /**
     * Afficher tous les résultats de recherche en fonction des termes de recherches
     * @param array aJson
     * @return void
     */
    function afficherResultatsTexte(aJson){
        var sHtml = "";

        // Textes
        if(aJson[0].length > 0){
            for(var i=0; i<aJson[0].length; i++){
                sHtml += "<li><a href='#' data-idtexte='"+ aJson[0][i].idTexte +"'><span>"+ aJson[0][i].sTitreTexte +"</span><span>"+ aJson[0][i].sPrenomAuteur +" " +  aJson[0][i].sNomAuteur +"</span></a></li>";
            }
        }
        else{
            sHtml = "<li>Aucun résultat.</li>";
        }
        document.querySelector("#resultats-textes ul").innerHTML = sHtml;
        sHtml = "";

        // Auteurs
        if(aJson[1].length > 0){
            for(var i=0; i<aJson[1].length; i++){
                sHtml += "<li><a href='?s=2&idAuteur="+ aJson[1][i].idAuteur +"'>"+ aJson[1][i].sPrenomAuteur +" "+ aJson[1][i].sNomAuteur +"</a></li>";
            }
        }
        else{
            sHtml = "<li>Aucun résultat.</li>";
        }
        document.querySelector("#resultats-auteurs ul").innerHTML = sHtml;
        sHtml = "";

        // Medias img
        if(aJson[2].length > 0){
            sHtml = "";

            for(var i=0; i<aJson[2].length; i++){
                sHtml += "<li><a href='?s=3&idMedia="+ aJson[2][i].idMedia +"'><span>"+ aJson[2][i].sTitreMedia +"</span><span>"+ aJson[2][i].sPrenomAuteur +" " +  aJson[2][i].sNomAuteur +"</span></a></li>";
            }
        }
        else{
            sHtml = "<li>Aucun résultat.</li>";
        }
        document.querySelector("#resultats-img ul").innerHTML = sHtml;
        sHtml = "";

        // Medias sons
        if(aJson[3].length > 0){

            for(var i=0; i<aJson[3].length; i++){
                sHtml += "<li><a href='?s=7&idSon="+ aJson[3][i].idMedia +"'><span>"+ aJson[3][i].sTitreMedia +"</span><span>"+ aJson[3][i].sPrenomAuteur +" " +  aJson[3][i].sNomAuteur +"</span></a></li>";
            }
        }
        else{
            sHtml = "<li>Aucun résultat.</li>";
        }

        document.querySelector("#resultats-sons ul").innerHTML = sHtml;
        sHtml = "";
    }

})();