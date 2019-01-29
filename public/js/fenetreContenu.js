    // Tous les boutons "lire" de la page. Utile pour afficher les textes.
    var boutons_texte = document.querySelectorAll(".lire_texte");
    var oRechercher = document.getElementById("rechercher-container");

    // Le bouton "retour" apparait sur la page du texte, fermant la fenêtre de lecture
    var bouton_texte_retour = document.getElementById("bouton_texte_retour");
    var bouton_texte_retour_2 = document.getElementById("bouton_texte_retour_2");
    var bouton_texte_retour_barre = document.querySelector("#bouton_texte_retour .texte_barrement");

    function gererTexte() {

        // Fermer la fenêtre
        // fermetureFenetreLecture();
        // Récupérer l'ID du texte
        var idTexte = this.getAttribute("data-idtexte");

        // Récupérer les données du texte à afficher
        $.ajax({
                url: "../controleurs/ajax/gererAffichageTexte.php",
                data: {
                    idTexte: idTexte
                },
                method: "get"
            })
            .done(function(sHtml) {
                oJson = JSON.parse(sHtml);

                // Écrire ce qu'il faut
                document.getElementById("texte_titre_fond").innerHTML = oJson['sTitreTexte'];
                document.getElementById("texte_titre").innerHTML = oJson['sTitreTexte'];
                document.getElementById("texte_auteur").innerHTML = oJson['sPrenomAuteur'] + " " + oJson['sNomAuteur'];
                document.getElementById("texte_texte").innerHTML = oJson['sTexte'];
                document.getElementById("texte_copyright").innerHTML = "TEXTE DE " + oJson['sPrenomAuteur'] + " " + oJson['sNomAuteur'] + " " + new Date().getFullYear() + " &copy; TOUS DROITS RÉSERVÉS À L'AUTEUR";


                // Fermer le menu
                $("nav").css("transform", "translateY(-110vh)");
                $("#checkMenu").prop("checked", false);

                // Fermer la barre de recherche
                oRechercher.style.display = "none";

                // Ouvrir la fenêtre
                actFenetre();
            });
    }


    // On détecte les clics sur les différents boutons si dessus pour jouer les animations et :
    // 1/2) Pour ouvrir la fenêtre de lecture
    for (var i = 0; i < boutons_texte.length; i++) {
        boutons_texte[i].addEventListener("click", actFenetre, false);
    }
    // 2/2) Pour fermer la fenêtre de lecture
    //bouton_texte_retour.addEventListener("click", fermetureFenetreLecture, false);
    if ($('#bouton_texte_retour').length != 0) {
        // console.log("Retour.");
        bouton_texte_retour.addEventListener("click", fermetureFenetreLecture, false);
        bouton_texte_retour_2.addEventListener("click", fermetureFenetreLecture, false);

        bouton_texte_retour.addEventListener("mouseover", function() {
            $("#bouton_texte_retour > .texte_barrement").css("transform", "translateX(95px)");
        });
        bouton_texte_retour.addEventListener("mouseout", function() {
            $("#bouton_texte_retour > .texte_barrement").css("transform", "translateX(0px)");
        });
        bouton_texte_retour.addEventListener("click", function() {
            setTimeout(btn_retour_delay, 1000);

        });
        bouton_texte_retour_2.addEventListener("click", function() {
            setTimeout(btn_retour_delay, 1000);
        });
    }

    function btn_retour_delay() {
        $("#bouton_texte_retour > .texte_barrement").css("transform", "translateX(95px)");
    }

    if ($('#bouton_texte_retour').length) {
        bouton_texte_precedent.addEventListener("mouseover", function() {
            $("#bouton_texte_precedent > .texte_barrement").css("transform", "translateX(-115px) scaleX(1.4)");
        });
        bouton_texte_precedent.addEventListener("mouseout", function() {
            $("#bouton_texte_precedent > .texte_barrement").css("transform", "translateX(0px) scaleX(1)");
        });


        bouton_texte_suivant.addEventListener("mouseover", function() {
            $("#bouton_texte_suivant > .texte_barrement").css("transform", "translateX(99px) scaleX(1.08)");
        });
        bouton_texte_suivant.addEventListener("mouseout", function() {
            $("#bouton_texte_suivant > .texte_barrement").css("transform", "translateX(0px) scaleX(1)");
        });
    }









    // ENSEMBLE DES ANIMATIONS DE LA FENETRE DE LECTURE D'UN TEXTE
    // Animations à l'ouverture et fermeture ne dépendant pas du contenu. (Devraient toujours marcher)


    // L'ensemble de la fenêtre de lecture
    var texte_fenetre = document.getElementById("texte_contenu");
    var texte_revealers = document.querySelectorAll("#texte_reveal div");






    // ----------------------------------------------------------
    // ------  ANIMATIONS D'OUVERTURE DE LA FENÊTRE TEXTE  ------
    // ----------------------------------------------------------
    function actFenetre() {
        texte_fenetre.style.display = "block";
        setTimeout(ouvertureFenetreLecture, 50);
        setTimeout(bloquerScroll, 50);
    }
    function virerUlysse() {
        $(".global").css("display", "none");
    }

    function ouvertureFenetreLecture() {
        // console.log("Ouverture.");
        $(".global").css("opacity", "0");
        setTimeout(virerUlysse, 1000);

        // document.body.style.overflow = 'hidden';
        texte_fenetre.style.pointerEvents = "auto";
        texte_fenetre.style.transitionDelay = "0s";
        texte_fenetre.style.opacity = 1;

        // On sauvegarde la hauteur de la page pour y ramener l'utilisateur à la fermeture
        scrollHauteur = $(window).scrollTop();

        // On lance l'animation d'apparition des boutons
        setTimeout(anim_btn_entree, 1000);

        // On scroll jusqu'en haut de la fenêtre de contenu
        $("html").scrollTop(0);

        $("#fenetre_cercle_foreground_01").addClass("anim_cercle_exterieur_01");
        $("#fenetre_cercle_foreground_01 div").addClass("anim_cercle_interieur_a");
        $("#fenetre_cercle_foreground_01 div div").addClass("anim_cercle_interieur_b");

        $("#fenetre_cercle_foreground_02").addClass("anim_cercle_exterieur_02");
        $("#fenetre_cercle_foreground_02 div").addClass("anim_cercle_interieur_a");
        $("#fenetre_cercle_foreground_02 div div").addClass("anim_cercle_interieur_b");

        $("#fenetre_cercle_foreground_03").addClass("anim_cercle_exterieur_03");
        $("#fenetre_cercle_foreground_03 div").addClass("anim_cercle_interieur_a");
        $("#fenetre_cercle_foreground_03 div div").addClass("anim_cercle_interieur_b");

        $("#bouton_texte_retour .texte_barrement").addClass("anim_entree_btn_retour");
        $("#bouton_texte_retour").addClass("anim_btn_entree");
        $("#bouton_texte_retour_2").addClass("anim_btn_entree");
        $("#bouton_texte_suivant .texte_barrement").addClass("anim_entree_btn_suivant");
        $("#bouton_texte_suivant").addClass("anim_btn_entree");
        $("#bouton_texte_precedent .texte_barrement").addClass("anim_entree_btn_precedent");
        $("#bouton_texte_precedent").addClass("anim_btn_entree");


        $("#texte_reveal").css('transition-delay', '1s');
        $("#texte_reveal").css("opacity", "1");

        $("#texte_titre_fond").css('transition-delay', '2.5s');
        $("#texte_titre_fond").css("opacity", "0.03");

        $("#texte_titre").css('transition-delay', '1.4s');
        $("#texte_titre").css({ "opacity": "1", "transform": "translateY(0)" });

        $("#sepa_titre_auteur").css('transition-delay', '1.5s');
        $("#sepa_titre_auteur").css({ "opacity": "1", "width": "80px" });

        $("#texte_auteur").css('transition-delay', '1.6s');
        $("#texte_auteur").css({ "opacity": "1", "transform": "translateY(0)" });

        $("#texte_texte").css('transition-delay', '1.1s');
        $("#texte_texte").css("opacity", "1");

        $("#texte_copyright").css('transition-delay', '3s');
        $("#texte_copyright").css("opacity", "1");

        $("#sepa_titre_auteur_image").css("transition-delay", "1");
        $("#sepa_titre_auteur_image").css({ "opacity": "1", "width": "80px" });


        for (i = 0; i < 50; ++i) {
            texte_revealers[i].style.transitionDelay = 1.8 + i / 30 + "s";
            texte_revealers[i].style.opacity = "0";
        }

    }



    // --------------------------------------------------------------------
    // ------  ANIMATIONS DE FERMETURE DE LA FENÊTRE TEXTE ET RESET  ------
    // --------------------------------------------------------------------
    function fermetureFenetreLecture() {
        // console.log("Fermeture.");
        $(".global").css("display", "block");
        $(".global").css("opacity", "1");
        // $("#fenetre_limite").css("margin-top", "3000px");

        // document.body.style.overflow = 'visible';

        // On rend la fenêtre de texte invisible et inclicable
        texte_fenetre.style.pointerEvents = "none";
        texte_fenetre.style.transitionDelay = "0.3s";
        texte_fenetre.style.opacity = 0;

        // On ramène l'utilisateur là où il était avant d'ouvrir le texte
        $("html").scrollTop(scrollHauteur);

        // On reset les différents params nécessaires à l'ouverture
        // $("#fenetre_cercle_foreground_01").removeClass("anim_cercle_exterieur_01");
        // $("#fenetre_cercle_foreground_01 div").removeClass("anim_cercle_interieur_a");
        // $("#fenetre_cercle_foreground_01 div div").removeClass("anim_cercle_interieur_b");

        // $("#fenetre_cercle_foreground_02").removeClass("anim_cercle_exterieur_02");
        // $("#fenetre_cercle_foreground_02 div").removeClass("anim_cercle_interieur_a");
        // $("#fenetre_cercle_foreground_02 div div").removeClass("anim_cercle_interieur_b");

        // $("#fenetre_cercle_foreground_03").removeClass("anim_cercle_exterieur_03");
        // $("#fenetre_cercle_foreground_03 div").removeClass("anim_cercle_interieur_a");
        // $("#fenetre_cercle_foreground_03 div div").removeClass("anim_cercle_interieur_b");


        $("#bouton_texte_retour .texte_barrement").removeClass("anim_entree_btn_retour");
        $("#bouton_texte_retour").removeClass("anim_btn_entree");
        $("#bouton_texte_retour_2").removeClass("anim_btn_entree");
        $("#bouton_texte_suivant .texte_barrement").removeClass("anim_entree_btn_suivant");
        $("#bouton_texte_suivant").removeClass("anim_btn_entree");
        $("#bouton_texte_precedent .texte_barrement").removeClass("anim_entree_btn_precedent");
        $("#bouton_texte_precedent").removeClass("anim_btn_entree");



        $("#texte_reveal").css('transition-delay', '0s');
        $("#texte_titre_fond").css('transition-delay', '0s');
        $("#texte_titre").css('transition-delay', '0s');
        $("#sepa_titre_auteur").css('transition-delay', '0s');
        $("#texte_auteur").css('transition-delay', '0s');
        $("#texte_texte").css('transition-delay', '0s');
        $("#texte_copyright").css('transition-delay', '0s');


        $("#texte_reveal").removeAttr('style');
        $("#texte_titre_fond").removeAttr('style');
        $("#texte_titre").removeAttr('style');
        $("#sepa_titre_auteur").removeAttr('style');
        $("#texte_auteur").removeAttr('style');
        $("#texte_texte").removeAttr('style');
        $("#texte_copyright").css('opacity', '0');


        $("#bouton_texte_retour > .texte_barrement").css("transform", "translateX(95px)");
        $("#bouton_texte_precedent > .texte_barrement").css("transform", "translateX(-115px) scaleX(1.4)");
        $("#bouton_texte_suivant > .texte_barrement").css("transform", "translateX(99px) scaleX(1.08)");





        for (i = 0; i < 50; ++i) {
            texte_revealers[i].style.transitionDelay = "0s";
            texte_revealers[i].style.opacity = "1";
        }
        setTimeout(desactFenetre, 500);


    }
    // --------------------------------------------------------------------

    function desactFenetre() {
        texte_fenetre.style.display = "none";
    }



    // ---------------------------------------------------------
    // ------  ANIMATIONS D'ENTRÉE ET SORTIE DES BOUTONS  ------
    // ---------------------------------------------------------
    function anim_btn_entree() {
        // $("#bouton_texte_retour > .texte_barrement").css("transform", "translateX(95px)");
        $("#bouton_texte_retour > .texte_barrement").css("transition-delay", "0.2s");
        $("#bouton_texte_retour > .texte_barrement").css("transform", "translateX(0px)");

        $("#bouton_texte_precedent > .texte_barrement").css("transition-delay", "0.2s");
        $("#bouton_texte_precedent > .texte_barrement").css("transform", "translateX(0px)");

        $("#bouton_texte_suivant > .texte_barrement").css("transition-delay", "0.2s");
        $("#bouton_texte_suivant > .texte_barrement").css("transform", "translateX(0px)");

        setTimeout(anim_btn_entree_fin, 500);
    }

    function anim_btn_entree_fin() {
        $("#bouton_texte_retour > .texte_barrement").css("transition-delay", "0s");
        $("#bouton_texte_precedent > .texte_barrement").css("transition-delay", "0s");
        $("#bouton_texte_suivant > .texte_barrement").css("transition-delay", "0s");
        // $("#bouton_texte_retour > .texte_barrement").css("transform", "translateX(95px)");
    }
    // ---------------------------------------------------------




    // Bloquer le scrolling de la fenêtre pour qu'il s'arrête à la fin de la fenêtre
    // et pas de la page principale en arrière-plan.
    var hauteur_texte = 0;
    var positionLimite = 0;
    var hauteur_doc = 0;
    function bloquerScroll() {
        hauteur_doc = $( document ).height();
        hauteur_texte = $("#texte_corps").height()+300;
        hauteur_ecran = $( window ).height();

        positionLimite = hauteur_texte - hauteur_ecran;
        // console.log("Hauteur texte: "+hauteur_texte);
        // console.log("Hauteur écran: "+hauteur_ecran);
        // console.log("Position limite: "+positionLimite);
        // console.log("Document height: "+hauteur_doc);

        $(window).scroll(function(e) {
            if ($(window).scrollTop() >= positionLimite && positionLimite < hauteur_doc && texte_fenetre.style.display != "none") {
                $(window).scrollTop(positionLimite);
            }
        });
    }