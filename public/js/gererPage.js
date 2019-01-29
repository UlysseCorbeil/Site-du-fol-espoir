


//addEventListener du formulaire d'ajout/modification
var oBtn = document.querySelector("input[name=cmd]");
if(oBtn != null){
	oBtn.addEventListener("click", gererPage);
}

/**
 * gère la modification d'un administrateur
 * par un appel asynchrone (AJAX)
 * @param void
 * @return void
 * 
 */

function gererPage(){
	
	//récupérer les informations du formulaire
	var aElts = document.forms[0].elements;
	var iS =  aElts['s'].value;
	var sAction =  aElts['action'].value;
	
	var iPage =  aElts['idPage'].value;
	var sTitre =  aElts['sTitrePage'].value;
	var sTexte =  aElts['sTextePage'].value;
	
	
	var sCmd = aElts['cmd'].value;
	
	$.ajax({
		url:"../controleurs/ajax/adm_modifierPage.php",
		method: "post",
		data: { s: iS, action: sAction, idPage:iPage, sTitrePage:sTitre, sTextePage:sTexte, cmd:sCmd}
	}).done(function(sMsg) {		
  		document.getElementById("sMsg").innerHTML = sMsg;  		  		
	});
	
}//fin de la fonction
 