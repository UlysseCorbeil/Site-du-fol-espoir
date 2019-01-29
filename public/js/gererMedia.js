


//addEventListener du formulaire d'ajout/modification
var oBtn = document.querySelector('input[name="cmd"]');
if(oBtn != null){
	var oFileUpLoad = document.getElementById("sUrlMedia");	
	oFileUpLoad.addEventListener("change", gererTeleversement);
	oBtn.addEventListener("click", gererMedia);    

}else{ //il s'agit de la suppression
	var aLiens = document.querySelectorAll("a[data-action=sup]");
	
	for(var i=0;i<aLiens.length; i++){
		aLiens[i].addEventListener("click", gererSuppression);
	}
	
		
}

/**
 * gère l'ajout, la modification et la suppression d'un média
 * par un appel asynchrone (AJAX)
 * @param void
 * @return void
 * 
 */

function gererMedia(){
	
	//récupérer les informations du formulaire
	
	var aElts = document.forms[0].elements;
	var iS =  aElts['s'].value;
	var sAction =  aElts['action'].value;
	var iMedia =  aElts['idMedia'].value;
	var sTitre =  aElts['sTitreMedia'].value;
	
	
	var sMotsClefs =  aElts['sMotsClefs'].value;
	var bAccepte =  aElts['bAccepte'].checked;
	
	var iNoAuteur =  aElts['iNoAuteur'].value;
	var sCmd = aElts['cmd'].value;
	
	//récupérer les médias cachés
	
	var sUrlMedia="";
	var bPasDeAjax = false;
		
	var aDiv = document.getElementsByTagName("div");
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
		url:"../controleurs/ajax/adm_gererMedia.php",
		method: "post",
		data: { s: iS, action: sAction, idMedia:iMedia, sTitreMedia:sTitre,  sMotsClefs: sMotsClefs, sUrlMedia:sUrlMedia, sUrlMediaAOter:sUrlMediaAOter, bAccepte:bAccepte, iNoAuteur:iNoAuteur, cmd:sCmd}
		
		}).done(function(sMsg) {
			
	  		document.getElementById("sMsg").innerHTML = sMsg;
	  		if(sAction == "add"){
	  			document.forms[0].elements['sTitreMedia'].value="";
		  		document.forms[0].elements['sUrlMedia'].value="";
		  		
		  		document.forms[0].elements['sMotsClefs'].value="";
		  		document.forms[0].elements['bAccepte'].checked =false;
		  		document.forms[0].elements['iNoAuteur'].options[0].selected=true;
		  		var iTaille = document.images.length;
		  		for(var i=0; i<iTaille; i++){	  			
		  			document.images[0].remove();
		  		}
		  		var aDiv = document.getElementsByTagName("div");
		  		iTaille =  aDiv.length;
		  		for(var i=0; i<iTaille; i++){	  			
		  			aDiv[0].remove();
		  		}
		  		
	  		}
	  		
		});
	
	
	
}//fin de la fonction gererMedia()

var oThis;
function gererSuppression(){
	
	//récupérer les informations
	oThis = this;
	var iS =  this.getAttribute("data-s");
	var sAction =  this.getAttribute("data-action");
	var iMedia =  this.getAttribute("data-idMedia");
	
	
	    $( "#dialog-confirm" ).dialog({
	      
	      resizable: false,
	      height: "auto",
	      width: 400,
	      modal: true,
	      buttons: {
	        "Supprimer": function() {
	        	$.ajax({
					url:"../controleurs/ajax/adm_gererMedia.php",
					method: "post",
					data: { s: iS, action: sAction, idMedia:iMedia}
				}).done(function(sMsg) {
					
					var oTr = oThis.parentElement.parentElement;
					var oTable = oTr.parentElement;
					$(oTr).remove();
					if(oTable.children.length < 2){
						var oTr = document.createElement("tr");
						var oTd = document.createElement("td");
						oTd.setAttribute("colspan", "2");
						oTr.appendChild(oTd);
						
						var node = document.createTextNode("Aucun média n'a encore été soumis. Ajoutez-en un !");
						oTd.appendChild(node);
						var element = document.getElementsByTagName("table")[0];
						element.appendChild(oTr);
					}		
							
			  		document.getElementById("sMsg").innerHTML = sMsg;
			  		
				});
	           $( this ).dialog( "close" );
	        },
	        Cancel: function() {
	          $( this ).dialog( "close" );
	        }
	      }
    });//fin de la fonction anonyme
    
      $( "[data-action=sup]" ).on( "click", function() {
      $( "#dialog-confirm" ).dialog( "open" );
    
  } );

	
}//fin de la fonction gererSuppression()


var fd;
function gererTeleversement(){
	//récupérer les informations du formulaire
	console.log("sss");
	fd = new FormData(document.forms[0]);
	
	var oAjax = $.ajax({
		url:"../controleurs/ajax/adm_gererTeleversementMedia.php",
		method: "post",
		data: fd,
		processData: false,  // tell jQuery not to process the data
        contentType: false   // tell jQuery not to set contentType
	});
	
	oAjax.done(function(sUrlMedia) {
		
		var i = sUrlMedia.search("/");
		if(i <= -1 ){
			document.getElementById("sMsg").innerHTML = sUrlMedia;
			return;
		}
		document.getElementById("sMsg").innerHTML = "";
		var aMedia = sUrlMedia.split("/");
		sUrlMedia = aMedia[1].trim();
		sTypeMedia  = aMedia[0].trim();		
			
		var oDiv = document.createElement("div");
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
  		  	document.forms[0].elements['sTitreMedia'].after(oDiv);
  		  	
		  	var aDiv = document.getElementsByTagName("div");
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

  		  	document.forms[0].elements['sTitreMedia'].after(oDiv);
		  	var aDiv = document.getElementsByTagName("div");
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
