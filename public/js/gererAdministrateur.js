


//addEventListener du formulaire d'ajout/modification
var oBtn = document.querySelector("input[name=cmd]");
if(oBtn != null){
	oBtn.addEventListener("click", gererAdministrateur);
}

/**
 * gère la modification d'un administrateur
 * par un appel asynchrone (AJAX)
 * @param void
 * @return void
 * 
 */

function gererAdministrateur(){
	
	//récupérer les informations du formulaire
	var aElts = document.forms[0].elements;
	var iS =  aElts['s'].value;
	var sAction =  aElts['action'].value;
	
	var iAdmin =  aElts['idAdmin'].value;
	var sLogin =  aElts['sLoginAdmin'].value;
	var sPwd =  aElts['sPwdAdmin'].value;
	var sCourriel =  aElts['sCourrielAdmin'].value;
	
	var sCmd = aElts['cmd'].value;
	
	$.ajax({
		url:"../controleurs/ajax/adm_modifierAdministrateur.php",
		method: "post",
		data: { s: iS, action: sAction, idAdmin:iAdmin, sLoginAdmin:sLogin, sPwdAdmin:sPwd,  sCourrielAdmin:sCourriel, cmd:sCmd}
	}).done(function(sMsg) {		
  		document.getElementById("sMsg").innerHTML = sMsg;  		  		
	});
	
}//fin de la fonction
 