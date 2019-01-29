 $(document).ready(function(){
    $('#typeDeTexte').hide();
    $('#typeDeFichier').hide();
     
     $('#typeDeTexte').children().attr('disabled', 'disabled');
     $('#typeDeFichier').children().attr('disabled', 'disabled');
     
      $('#actionFormulaire').val("");
     
    /*
    * Sélection du type de média et affichage des champs appropriés
    */
   $('#typeFichier').change(function () {


       //Si le format de fichier texte est choisi
       if ($(this).val() == '1') {
           
           $('#actionFormulaire').val("ajouterTexte");
           
            console.log("form.js " +  $('#actionFormulaire').val());
           
           $('#typeDeFichier').children().attr('disabled', 'disabled');

           $('#typeDeTexte').show();

           $('#typeDeFichier').hide();

           $('#typeDeTexte').children().removeAttr('disabled');
       }

       //Si le format de fichier media est choisi
       if ($(this).val() == '2') {
           
           $('#actionFormulaire').val("ajouterMedia");
           
            console.log("form.js " +   $('#actionFormulaire').val());
           
           $('#typeDeTexte').children().attr('disabled', 'disabled');
           $('#typeDeFichier').children().removeAttr('disabled');


         $('#typeDeTexte').hide();
           $('#typeDeTexte').removeClass("formulaireAnimation");
         $('#typeDeFichier').show();
           $('#typeDeFichier').removeClass("formulaireAnimation");

       }

   });
   
        $('#sUrlMedia').change(function () {
            
            $('#labelTitreMedia').addClass("titreMediaClass");
                 
        });
        
        
        
        
         $('#btnSoumettre').click(function () {
            $("html, body").animate({ scrollTop: 0 }, "slow");
              return false;
            });
   
 });
 
 
 
 
 

