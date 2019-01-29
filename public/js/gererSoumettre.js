//addEventListener du formulaire d'ajout/modification
var oBtn = document.querySelector("input[name=cmd]");

$(document).ready(function(){

    $('#typeFichier').change(function () {
        if ($(this).val() == '1') {
             oBtn.removeEventListener("click", gererMedia); 
             oBtn.addEventListener("click", gererAuteurTexte);
        }
        
         if ($(this).val() == '2') {
             
              var oFileUpLoad = document.getElementById("sUrlMedia");	
                oFileUpLoad.addEventListener("change", gererTeleversement);
                oBtn.removeEventListener("click", gererAuteurTexte);
                oBtn.addEventListener("click", gererMedia);    
         }
        
    });
   

});



//Lorsque c'est un texte

/******************************************************************************************************************************************************************
 * gère l'ajout d'un auteur et d'un texte
 * par un appel asynchrone (AJAX)
 * @param void
 * @return void
 * 
 */

function gererAuteurTexte(){
	console.log("Envoie de texte selection");
        
       //récupérer les informations du formulaire
	var aElts = document.forms[1].elements;
	var iS =  aElts['s'].value;
	var sAction =  aElts['action'].value;
	//var iTexte =  aElts['idTexte'].value;
	var sTitre =  aElts['sTitreTexte'].value;
	var sExtrait =  aElts['sExtraitTexte'].value;
	var sTexte =  aElts['sTexte'].value;
	var sMotsClefs =  aElts['sMotsClefs'].value;
	//var bAccepte =  aElts['bAccepte'].checked;
	//var iNoAuteur =  aElts['iNoAuteur'].value;
	var sNomCategorie = aElts['sNomCategorie'].value;
	var sCmd = aElts['cmd'].value;
        
       var sNomAuteur = aElts['sNomAuteur'].value;
       var sPrenomAuteur = aElts['sPrenomAuteur'].value;
       var sCourrielAuteur = aElts['sCourrielAuteur'].value;
	
	$.ajax({
		url:"../controleurs/ajax/gererFormulaire.php",
		method: "post",
		data: { s: iS, action: sAction,sTitreTexte:sTitre, sExtraitTexte:sExtrait,  sTexte:sTexte, sMotsClefs: sMotsClefs, sNomCategorie:sNomCategorie,sNomAuteur:sNomAuteur, sPrenomAuteur:sPrenomAuteur, sCourrielAuteur:sCourrielAuteur,  cmd:sCmd}
	}).done(function(sMsg) {
		
  		document.getElementById("sMsg").innerHTML = sMsg;
  		
                    var aElts = document.forms[1].elements;
  		aElts['sTitreTexte'].value="";
	  		aElts['sExtraitTexte'].value="";
	  		aElts['sTexte'].value="";
	  		aElts['sMotsClefs'].value="";
	  		//document.forms[0].elements['bAccepte'].checked =false;
	  		//document.forms[0].elements['iNoAuteur'].value="1";
	  		aElts['sNomCategorie'].value="essai";
                        aElts['sNomAuteur'].value="";
                        aElts['sPrenomAuteur'].value="";
                        aElts['sCourrielAuteur'].value="";
                        
            
  		
	});
	
}//fin de la fonction

/****************************************************************************************************************************************************************/


/**
 * gère l'ajout, la modification et la suppression d'un média
 * par un appel asynchrone (AJAX)
 * @param void
 * @return void
 * 
 */

function gererMedia(){
	console.log("Envoie de media selection");
        
	//récupérer les informations du formulaire
	
	var aElts = document.forms[1].elements;
	var iS =  aElts['s'].value;
	var sAction =  aElts['action'].value;
	//var iMedia =  aElts['idMedia'].value;
	var sTitre =  aElts['sTitreMedia'].value;
	
	
	var sMotsClefs =  aElts['sMotsClefs'].value;
	//var bAccepte =  aElts['bAccepte'].checked;
	
	//var iNoAuteur =  aElts['iNoAuteur'].value;
	var sCmd = aElts['cmd'].value;
        
        
        var sNomAuteur = aElts['sNomAuteur'].value;
       var sPrenomAuteur = aElts['sPrenomAuteur'].value;
       var sCourrielAuteur = aElts['sCourrielAuteur'].value;
        
	
	//récupérer les médias cachés
	
	var sUrlMedia="";
	var bPasDeAjax = false;
		
	var aDiv = document.getElementsByTagName("article");
  	var iTaille = aDiv.length;
  	sUrlMediaAOter ="";
	for(var i=iTaille-1; i >= 1; i--){
		sUrlMediaAOter += aDiv[i].getAttribute("data-url") + ";";  			
	}
	//ôter le dernier ";"
	sUrlMediaAOter = sUrlMediaAOter.slice(0, sUrlMediaAOter.length-1);
	if(aDiv.length > 0)
		sUrlMedia  = aDiv[0].getAttribute("data-url").split("/")[4];
	
	
	
		$.ajax({
		url:"../controleurs/ajax/gererFormulaire.php",
		method: "post",
		data: { s: iS, action: sAction,  sTitreMedia:sTitre,  sMotsClefs: sMotsClefs, sUrlMedia:sUrlMedia, sUrlMediaAOter:sUrlMediaAOter,sNomAuteur:sNomAuteur, sPrenomAuteur:sPrenomAuteur, sCourrielAuteur:sCourrielAuteur,  cmd:sCmd}
		
		}).done(function(sMsg) {
			
	  		document.getElementById("sMsg").innerHTML = sMsg;
	  		
                            
                           // document.getElementById("fileinfo").reset();
                            
                            
                            var aElts = document.forms[1].elements;
	  			aElts['sTitreMedia'].value="";
		  		aElts['sUrlMedia'].value="";
		  		
                                aElts['sNomAuteur'].value="";
                                aElts['sPrenomAuteur'].value="";
                                aElts['sCourrielAuteur'].value="";
                                
		  		aElts['sMotsClefs'].value="";
		  		aElts['bAccepte'].checked =false;
		  		aElts['iNoAuteur'].options[0].selected=true;
		  		var iTaille = document.images.length;
		  		for(var i=0; i<iTaille; i++){	  			
		  			document.images[0].remove();
		  		}
		  		var aDiv = document.getElementsByTagName("div");
		  		iTaille =  aDiv.length;
		  		for(var i=0; i<iTaille; i++){	  			
		  			aDiv[0].remove();
		  		}
                                
         
	  		
		});
	
	
	
}//fin de la fonction gererMedia()



var fd;
function gererTeleversement(){
	//récupérer les informations du formulaire
        var oForm = document.forms[1];
	fd = new FormData(oForm);
	
	var oAjax = $.ajax({
		url:"../controleurs/ajax/adm_gererTeleversementMedia.php",
		method: "post",
		data: fd,
		processData: false,  // tell jQuery not to process the data
        contentType: false   // tell jQuery not to set contentType
	});
	
	oAjax.done(function(sUrlMedia) {
		console.log(sUrlMedia);
		var i = sUrlMedia.search("/");
		if(i <= -1 ){
			document.getElementById("sMsg").innerHTML = sUrlMedia;
			return;
		}
		document.getElementById("sMsg").innerHTML = "";
		var aMedia = sUrlMedia.split("/");
		sUrlMedia = aMedia[1].trim();
		sTypeMedia  = aMedia[0].trim();		
			
		var oDiv = document.createElement("article");
	  	oDiv.setAttribute("class", "right");
	  	oDiv.setAttribute("data-url", "../../public/medias/"+sUrlMedia);
	  	var oTitre = document.createElement("p");  		  	
	  	var sTitre = document.createTextNode(sUrlMedia);
	  	oTitre.appendChild(sTitre);
	  	
		sUrlMedia = aMedia[1].trim();
		switch(sTypeMedia){
			case "image":		
			var oImg = document.createElement("img");		
			oImg.setAttribute("src", "../../public/medias/reduites/"+sUrlMedia);
			oDiv.appendChild(oTitre);
  		  	oDiv.appendChild(oImg);
  		  	oForm.elements['sTitreMedia'].after(oDiv);
  		  	
		  	var aDiv = document.getElementsByTagName("article");
		  	var iTaille = aDiv.length;
	  		for(var i=iTaille-1; i >= 1; i--){
	  			aDiv[i].style.display = "none";	  			
	  		}
  		  break;
  		  case "audio":
  		  	
  		  	var oAudio = document.createElement("audio");
  		  	oAudio.setAttribute("controls", true);
  		  	var oSrcAudio = document.createElement("source");
  		  	oSrcAudio.setAttribute("src", "../../public/medias/"+sUrlMedia);
  		  	oAudio.appendChild(oSrcAudio);
  		  	
  		  	oDiv.appendChild(oTitre);
  		  	oDiv.appendChild(oAudio);

  		  	oForm.elements['sTitreMedia'].after(oDiv);
		  	var aDiv = document.getElementsByTagName("article");
		  	var iTaille = aDiv.length;
	  		for(var i=iTaille-1; i >= 1; i--){
	  			aDiv[i].style.display = "none";	  			
	  		}

  		  break;
  		  default:	
  		  document.getElementById("sMsg").innerHTML = sUrlMedia;
  		  }//fin du il media/audio ?
  		  
	  		    
	  
	  		                                                                                                                                                                                                                                                                             
	});
}//fin de la fonction gererTeleversement()
