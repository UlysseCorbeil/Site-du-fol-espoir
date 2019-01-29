$(document).ready(function () {
    $(window).scroll(function () {

        // variables oranges
        var orange = document.querySelectorAll(".orangeCircle");
        var nbOrange = orange.length;

        // variables rouges
        var rouge = document.querySelectorAll(".redCircle");
        var nbRouge = rouge.length;

        // Position en y
        var yPos = 0 - window.pageYOffset / 12;

        // Pour les oranges
        for (let i = 0; i < nbOrange; i++) {
            orange[i].style.top = 30 + yPos + "%";
        }

        // Pour les rouges
        for (let i = 0; i < nbRouge; i++) {
            rouge[i].style.top = 30 + yPos + "%";
        }

    });

});