var oJson = [];
var aoFiltres = document.querySelectorAll(".filtres li");
var nbFiltres = aoFiltres.length;
var overlay = document.querySelector(".blockFiltres");
var objets = document.querySelectorAll("#mesObjets");
var lesCategory = document.getElementsByClassName("lesCategory");
var boutonBurger = document.getElementsByClassName("burgerButton");
var btnFiltre = document.querySelector(".btnFiltre");
var categDroit = document.querySelector(".imagesCategDroite");
var btnFiltre = document.querySelector(".btnFiltre");

var indicateur = document.querySelector(".indicateurCateg");

// Permet d'appeler la fonction gererFiltres au clic du bouton choisi
for (let i = 0; i < nbFiltres; i++) {
    aoFiltres[i].addEventListener("click", gererFiltres);
}


/**
 * Au clic d'un bouton filtre
 * @param void
 * @return void
 */
function gererAfficherContenu() {

    let oAjax = $.ajax({
        url: "../controleurs/ajax/gererAfficherContenu.php"

    });

    // Si la requête est terminée
    oAjax.done(function (sHtml) {
        // Récupérer le JSON et transformer en objet JS
        oJson = JSON.parse(sHtml);

        // Affichage
        afficherContenuPage(oJson);
        indicateur.innerHTML = "Toutes les oeuvres";
        var lesExtraits = document.querySelectorAll(".extraitPoeme");

        // On ajoute les eventlistener pour le mouseover
        for (let i = 0; i < lesExtraits.length; i++) {
            lesExtraits[i].addEventListener("mousemove", bougeExtraitPoeme);
        }

        var aTexte = document.querySelectorAll(".columnItem");
        for (var i = 0; i < aTexte.length; i++) {
            aTexte[i].addEventListener("click", gererTexte);
        }
    });
}

/**
 * Au clic d'un bouton filtre
 * @param void
 * @return void
 */
function gererFiltres() {

    // Récupère le filtre de la catégorie
    var sFiltre = this.firstElementChild.getAttribute("data-sfiltre");

    // Récupérer l'informations de toutes les pages
    let oAjax = $.ajax({
        url: "../controleurs/ajax/gererAfficherFiltres.php",
        data: {
            sNomFiltre: sFiltre
        },
        method: "POST"

    });

    // Si la requête est terminée
    oAjax.done(function (sHtml) {
        // Récupérer le JSON et transformer en objet JS
        oJson = JSON.parse(sHtml);

        switch (sFiltre) {
            default:
            case "poésie":
                retablirPage();

                // Marche pas pcq l'evt est pas reconnu
                // evtAnimerExtraits();
                // bougeExtraitPoeme(e);
                // resetPositionExtrait();

                // Affichage
                afficherContenuPage(oJson);
                indicateur.innerHTML = sFiltre;

                break;
            case "essai":

                // Cache le menu
                retablirPage();

                // Affichage
                afficherContenuPage(oJson);
                break;
            case "récit":
                // Cache le menu
                retablirPage();

                // Affichage
                afficherContenuPage(oJson);
                break;
            case "théâtre":
                // Cache le menu
                retablirPage();

                // Affichage
                afficherContenuPage(oJson);
                break;
            case "inclassable":
                // Cache le menu
                retablirPage();

                // Affichage
                afficherContenuPage(oJson);
                break;
            case "audio":
                // Cache le menu
                retablirPage();

                // Affichage

                break;
        }
        var lesExtraits = document.querySelectorAll(".extraitPoeme");
        // On ajoute les eventlistener pour le mouseover
        for (let i = 0; i < lesExtraits.length; i++) {
            lesExtraits[i].addEventListener("mousemove", bougeExtraitPoeme);
        }

        var aTexte = document.querySelectorAll(".columnItem");
        for (var i = 0; i < aTexte.length; i++) {
            aTexte[i].addEventListener("click", gererTexte);
        }

    });

}

// Actualise la page
function refreshPage() {
    window.location.reload();
}

/**
 * Enlever les éléments appliquer par le overlay
 * @param void
 * @return void
 */
function retablirPage() {
    overlay.classList.remove("showSection");
    overlay.style.animation = "fadeOutMenu 0.5s forwards";
    lesCategory[0].style.filter = "blur(0)";
    for (let i = 0; i < objets.length; i++) {
        objets[i].style.filter = "blur(0)";
    }
    boutonBurger[0].style.filter = "blur(0)";
    btnFiltre.style.filter = "blur(0)";
}

/**
 * Au clic d'une section on affiche le contenu de cette page
 * @param oJson : passe l'objet JSON en paramètre pour appeler les éléments de l'objet
 * @return void
 */
function afficherContenuPage(oJson) {

    var grandeurJSON = oJson.length;
    var sHtmlDroit = "";
    var sHtmlGauche = "";
    var iNombre = 0;
    var iNombre2 = 1;

    // Impairs
    for (var i = 0; i < grandeurJSON; i += 2) {
        iNombre = i;
        iNombre++;
        sHtmlGauche += '<div class = "columnItem" data-idTexte = ' + oJson[i]['idTexte'] + '>\
        <div class ="itemImages"><div class = "orangeCircle"></div><div class = "grisCarre"></div>\
                <div class = "grisCarreFront"></div>\
                <h2 class = "extraitPoeme">' + oJson[i]['sTitreTexte'] + '</h2>\
            </div>\
            <div class = "itemInfo">\
                <span>' + "0" + iNombre + '</span>\
                <p>' + oJson[i]['sPrenomAuteur'] + " " + oJson[i]['sNomAuteur'] + '</p>\
                <span>' + oJson[i]['sNomCategorie'] + '</span>\
            </div>\
        </div>\
        </div>';
    }

    // Pairs
    for (var i = 1; i < grandeurJSON; i += 2) {
        iNombre2 = i;
        iNombre2++;
        sHtmlDroit += '<div class = "columnItem" data-idTexte = ' + oJson[i]['idTexte'] + '>\
        <div class ="itemImages"><div class = "redCircle"></div><div class = "grisCarre"></div>\
            <div class = "grisCarreFront"></div>\
            <h2 class = "extraitPoeme">' + oJson[i]['sTitreTexte'] + '</h2>\
        </div>\
        <div class = "itemInfo">\
            <span>' + "0" + iNombre2 + '</span>\
            <p>' + oJson[i]['sPrenomAuteur'] + " " + oJson[i]['sNomAuteur'] + '</p>\
            <span>' + oJson[i]['sNomCategorie'] + '</span>\
        </div>\
    </div>\
    </div>';
    }

    // Dernière fonction pour la page auteur (maybe)
    document.querySelectorAll(".lesCategory > .columnCateg")[0].innerHTML = sHtmlDroit;
    document.querySelectorAll(".lesCategory > .columnCateg")[1].innerHTML = sHtmlGauche;

} // fin afficherContenuPage()

var lesExtraits = document.querySelectorAll(".extraitPoeme");

function bougeExtraitPoeme(e) {

    var pageX = e.clientX,
        pageY = e.clientY;

    this.style.transform = "translateX(-" + (pageX / 50) + "%) translateY(-" + (pageY / 50) + "%) scale(1.2)";

}