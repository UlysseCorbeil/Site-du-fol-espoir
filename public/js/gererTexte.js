


//addEventListener du formulaire d'ajout/modification
var oBtn = document.querySelector("input[name=cmd]");
if(oBtn != null){
	oBtn.addEventListener("click", gererTexte);
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

function gererTexte(){
	
	//récupérer les informations du formulaire
	var aElts = document.forms[0].elements;
	var iS =  aElts['s'].value;
	var sAction =  aElts['action'].value;
	var iTexte =  aElts['idTexte'].value;
	var sTitre =  aElts['sTitreTexte'].value;
	var sExtrait =  aElts['sExtraitTexte'].value;
	var sTexte =  aElts['sTexte'].value;
	var sMotsClefs =  aElts['sMotsClefs'].value;
	var bAccepte =  aElts['bAccepte'].checked;
	var iNoAuteur =  aElts['iNoAuteur'].value;
	var sNomCategorie = aElts['sNomCategorie'].value;
	var sCmd = aElts['cmd'].value;
	
	$.ajax({
		url:"../controleurs/ajax/adm_gererTexte.php",
		method: "post",
		data: { s: iS, action: sAction, idTexte:iTexte, sTitreTexte:sTitre, sExtraitTexte:sExtrait,  sTexte:sTexte, sMotsClefs: sMotsClefs, sNomCategorie:sNomCategorie, bAccepte:bAccepte, iNoAuteur:iNoAuteur, cmd:sCmd}
	}).done(function(sMsg) {
		
  		document.getElementById("sMsg").innerHTML = sMsg;
  		if(sAction == "add"){
  		document.forms[0].elements['sTitreTexte'].value="";
	  		document.forms[0].elements['sExtraitTexte'].value="";
	  		document.forms[0].elements['sTexte'].value="";
	  		document.forms[0].elements['sMotsClefs'].value="";
	  		document.forms[0].elements['bAccepte'].checked =false;
	  		document.forms[0].elements['iNoAuteur'].value="1";
	  		document.forms[0].elements['sNomCategorie'].value="1";
  		}
  		
	});
	
}//fin de la fonction

var oThis;
function gererSuppression(){
	
	//récupérer les informations
	oThis = this;
	var iS =  this.getAttribute("data-s");
	var sAction =  this.getAttribute("data-action");
	var iTexte =  this.getAttribute("data-idTexte");
	
	
	    $( "#dialog-confirm" ).dialog({
	      
	      resizable: false,
	      height: "auto",
	      width: 400,
	      modal: true,
	      buttons: {
	        "Supprimer": function() {
	        	$.ajax({
					url:"../controleurs/ajax/adm_gererTexte.php",
					method: "post",
					data: { s: iS, action: sAction, idTexte:iTexte}
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
						
						var node = document.createTextNode("Aucune oeuvre n'a encore été soumise. Ajoutez-en une !");
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
 