


//addEventListener du formulaire d'ajout/modification
var oBtn = document.querySelector("input[name=cmd]");
if(oBtn != null){
	oBtn.addEventListener("click", gererAuteur);
}else{ //il s'agit de la suppression
	var aLiens = document.querySelectorAll("a[data-action=sup]");
	for(var i=0;i<aLiens.length; i++){
		aLiens[i].addEventListener("click", gererSuppression);
	}
	
}

/**
 * gère l'ajout, la modification et la suppression d'une oeuvre
 * par un appel asynchrone (AJAX)
 * @param void
 * @return void
 * 
 */

function gererAuteur(){
	
	//récupérer les informations du formulaire
	var aElts = document.forms[0].elements;
	var iS =  aElts['s'].value;
	var sAction =  aElts['action'].value;
	
	var iAuteur =  aElts['idAuteur'].value;
	var sNom =  aElts['sNomAuteur'].value;
	var sPrenom =  aElts['sPrenomAuteur'].value;
	var sCourriel =  aElts['sCourrielAuteur'].value;
	
	var sCmd = aElts['cmd'].value;
	
	$.ajax({
		url:"../controleurs/ajax/adm_gererAuteur.php",
		method: "post",
		data: { s: iS, action: sAction, idAuteur:iAuteur, sNomAuteur:sNom, sPrenomAuteur:sPrenom,  sCourrielAuteur:sCourriel, cmd:sCmd}
	}).done(function(sMsg) {
		
  		document.getElementById("sMsg").innerHTML = sMsg;
  		if(sAction == "add"){
  		document.forms[0].elements['sNomAuteur'].value="";
	  		document.forms[0].elements['sPrenomAuteur'].value="";
	  		document.forms[0].elements['sCourrielAuteur'].value="";
	  		
  		}
  		
	});
	
}//fin de la fonction

var oThis;
function gererSuppression(){
	
	//récupérer les informations
	oThis = this;
	var iS =  this.getAttribute("data-s");
	var sAction =  this.getAttribute("data-action");
	var iAuteur =  this.getAttribute("data-idAuteur");
	
	
	    $( "#dialog-confirm" ).dialog({
	      
	      resizable: false,
	      height: "auto",
	      width: 400,
	      modal: true,
	      buttons: {
	        "Supprimer": function() {
	        	$.ajax({
					url:"../controleurs/ajax/adm_gererAuteur.php",
					method: "post",
					data: { s: iS, action: sAction, idAuteur:iAuteur}
				}).done(function(sMsg) {
					//oThis.parentElement.parentElement.classList.add("ote");
					
					var oTr = oThis.parentElement.parentElement;
					var oTable = oTr.parentElement;
					$(oTr).remove();
					if(oTable.children.length < 2){
						var oTr = document.createElement("tr");
						var oTd = document.createElement("td");
						oTd.setAttribute("colspan", "2");
						oTr.appendChild(oTd);
						
						var node = document.createTextNode("Aucun auteur n'a encore été ajouté. Ajoutez-en un !");
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
	
	
	
	
	
	
	
	
}
 