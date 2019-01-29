 /*
  * Sélection du type de média et affichage des champs appropriés
  */
  $('#typeFichier').change(function () {


	//Si le format de fichier texte est choisi
     if ($(this).val() == '1') {
         
        
        $('#formulaireTexte').show();
       
        $('#formulaireMedia').hide();
       

     }
	
	//Si le format de fichier media est choisi
     if ($(this).val() == '2') {
        
        $('#formulaireTexte').hide();
        $('#formulaireTexte').removeClass("formulaireAnimation");
        $('#formulaireMedia').show();
        $('#formulaireMedia').removeClass("formulaireAnimation");
     }

 });
 

 
 