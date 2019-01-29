 /*
  * INITIALISATION DU SELECT DROPDOWN MENU DU TYPE DE FICHIER
  * 
  */
$(document).ready(function() {
    $('#typeFichier').formSelect();
    $('#sNomCategorie').formSelect();
});

document.getElementById('dateTexte').valueAsDate = new Date();