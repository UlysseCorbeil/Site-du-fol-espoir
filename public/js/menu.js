// Gestion des animations du menu mobile 

console.log(document.getElementById("checkMenu"));

$("#checkMenu").click(function() {



    if ($(this).is(':checked')) {
       
        $("nav").css("transform", "translateY(0vh)");
        // $(".separateur_01").addClass("sepa_sitePortfolio");
        // $("#soustitre2").addClass("txt_sitePortfolio");
        // $("#soustitre").addClass("txt_sousTitre");
    } else {
        $("nav").css("transform", "translateY(-110vh)");
        
        // $("#titre > p").removeClass("titreAnim");
        // $(".separateur_01").removeClass("sepa_sitePortfolio");
        // $("#soustitre2").removeClass("txt_sitePortfolio");
        // $("#soustitre").removeClass("txt_sousTitre");
    }


});


$("#nav_section_fermeture_btnFermer").click(function() {
    $("#checkMenu").prop("checked", false);
    $("nav").css("transform", "translateY(-110vh)");

});
