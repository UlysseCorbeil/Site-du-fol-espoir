var oJson = [];
var aBtnPrec = document.querySelectorAll(".gallerie-btn a")[0];
var aBtnSuivant = document.querySelectorAll(".gallerie-btn a")[1];
var oGallerie = document.getElementById("gallerie");
var btnClose = document.querySelector("#modal-photo span");
var oImg = document.querySelector("#modal-photo img");
var oModalP = document.querySelector("#modal-photo p");
var iPos = 0;
var nbImgParPage = 8;

/**
 * Au chargement de la page
 * @param void
 * @return void
 */
window.addEventListener('DOMContentLoaded', function () {

    // Récupérer les informations de toutes les images (JSON)
    $.ajax({
        url: "../controleurs/ajax/gererAfficherMedias.php",
        method: "get"
    })
        // Si la reqête est terminée
        .done(function (sHtml) {
            // Récupérer le JSON et transformer en objet JS
            oJson = JSON.parse(sHtml);

            // Déterminer le nombre d'image à afficher et les afficher
            nbImgAfficher();
            changerImg(nbImgParPage);

            // Récupérer toutes les images de la page et ajouter des EVENTS pour l'ouvrir en plein écran
            var aLesImg = document.querySelectorAll(".gallerie-row>div");
            for (var i = 0; i < aLesImg.length; i++) {
                aLesImg[i].addEventListener("click", ouvrirModal);
            }
        });

    // À la redimension de la fenêtre,
    window.onresize = function () {
        // Déterminer le nombre d'images à afficher et les afficher
        nbImgAfficher();
        changerImg(nbImgParPage);
    }
}, false);


/**
 * Au clic du bouton suivant, afficher les images suivantes
 * @param void
 * @return void
 */
aBtnSuivant.addEventListener("click", function (evt) {
    // Prévenir de recharger la page
    evt.preventDefault();

    // Déterminer le nombre d'images à afficher
    nbImgAfficher();

    // S'il reste encore des images à afficher,
    if (iPos + nbImgParPage < oJson.length) {
        // Passer à la page suivante
        iPos += nbImgParPage;
    }

    // Animer les rangées contenant les images vers le haut ou le bas de la page
    var aRow = document.querySelectorAll(".gallerie-row");
    aRow[0].classList.add("fadeUp");
    aRow[1].classList.add("fadeDown");

    // Après 1.5 secondes, changer les images et animer les rangées
    setTimeout(function () {
        changerImg(nbImgParPage);

        // Ajouter les EVENT sur les images
        var aLesImg = document.querySelectorAll(".gallerie-row>div");
        for (var i = 0; i < aLesImg.length; i++) {
            aLesImg[i].addEventListener("click", ouvrirModal);
        }
    }, 1500);



});

/**
 * Au clic du bouton précédent, afficher les images précédécentes
 * @param void
 * @return void
 */
aBtnPrec.addEventListener("click", function (evt) {
    // Prévenir de recharger la page
    evt.preventDefault();

    // Déterminer le nombre d'images à afficher
    nbImgAfficher();

    // S'il reste encore des images à afficher,
    if (iPos >= nbImgParPage) {
        // Passer à la page précédente
        iPos -= nbImgParPage;
    }
    else {
        iPos = 0;
    }

    // Animer les rangées contenant les images vers le haut ou le bas de la page
    var aRow = document.querySelectorAll(".gallerie-row");
    aRow[0].classList.add("fadeUp");
    aRow[1].classList.add("fadeDown");

    // Après 1.5 secondes, changer les images et animer les rangées
    setTimeout(function () {
        changerImg(nbImgParPage);

        // Ajouter les EVENT sur les images
        var aLesImg = document.querySelectorAll(".gallerie-row>div");
        for (var i = 0; i < aLesImg.length; i++) {
            aLesImg[i].addEventListener("click", ouvrirModal);
        }
    }, 1500);


});

/**
 * Changer les images du carousel
 * @param iNbImg - Nombre d'images à afficher sur la page
 * @return void
 */
function changerImg(iNbImg) {
    var aoMedias = []; // Tableaux contenant les informations sur les médias
    var sHtml = ""; // Le HTML qui sera généré
    var indMedia = 0; // La position ou le compteur est rendu
    var btnGallerie = document.querySelectorAll(".gallerie-btn a"); // Les boutons suivant ou précédent

    // Si nous ne sommes pas rendu à la fin du nombre maximal d'images
    if (iPos < oJson.length) {
        // Diviser le nombre d'images en fonction du nombre d'images à afficher
        aoMedias = oJson.slice(iPos, iPos + iNbImg);

        // Pour une rangée
        for (var i=0; i < 2; i++) {
            sHtml += "<div class='flex-container gallerie-row'>";
            // Pour chaque images dans une rangée
            for ($j = 0; $j < iNbImg / 2; $j++) {
                // Si le nombre de médias est plus petit que le nombre maximal d'image sur une page
                if (indMedia < aoMedias.length) {
                    // Afficher les images
                    sHtml += "<div class='photo' style='background-image: url(../../public/medias/" + aoMedias[indMedia].sUrlMedia + ")'><span>" + (iPos + indMedia + 1 < 10 ? "0" : "") + (iPos + indMedia + 1) + "</span><div class='photo-info'><p>" + aoMedias[indMedia].sTitreMedia + " &#8226; " + aoMedias[indMedia].sPrenomAuteur + " " + aoMedias[indMedia].sNomAuteur + "</p></div><div class='mask'></div></div>";
                }
                else {
                    // Ne rien mettre
                    sHtml += "<div></div>";
                }

                // Incrémenter la position de l'image où nous sommes rendu
                indMedia++;
            }
            sHtml += "</div>";
        }

        // Faire disparaître le bouton suivant lorsqu'on est à la dernière page
        if (aoMedias.length < iNbImg) {
            btnGallerie[1].style.display = "none";
        }
        else {
            btnGallerie[1].style.display = "flex";
        }

        // Faire disparaître le bouton pécédent lorsqu'on est à la première page
        if (iPos < iNbImg) {
            btnGallerie[0].style.display = "none";
        }
        else {
            btnGallerie[0].style.display = "flex";
        }
    }

    // Écrire dans la page HTML
    oGallerie.innerHTML = sHtml;
}


/**
 * Ouvrir le modal pour voir les images en plein écran
 * @param void
 * @return void
 */
function ouvrirModal() {
    // Obtenir l'url de l'image à afficher en plein écran
    url = this.style.backgroundImage.replace('url(', '').replace(')', '')
    oImg.setAttribute("src", url.replace(/"/g, ""));
    oModalP.innerHTML = this.querySelector("p").innerText;

    // Ouvrir le modal
    document.querySelector("#modal-photo").style.display = "flex";
    document.getElementById("gallerie-container").style.webkitFilter = "blur(15px)";
}


/**
 * Déterminer le nombre d'image à afficher en fonction de la largeur de l'écran
 * @param void
 * @return void
 */
function nbImgAfficher() {
    switch (true) {
        // Si l'écran est entre 992px et 576px (Tablette) -> Afficher 6 images (3 par lignes)
        case (window.innerWidth < 992 && window.innerWidth > 576):
            nbImgParPage = 6;
            break;
        // Si l'écran est de 576px et moins (Téléphone) -> Afficher 2 images (1 par lignes)
        case (window.innerWidth < 576):
            nbImgParPage = 2
            break;
        // Si l'écran est plus grand que 992px (Ordinateur) -> Afficher 8 images (4 par lignes)
        default:
            nbImgParPage = 8;
            break;
    }
}