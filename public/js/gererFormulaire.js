//addEventListener du formulaire d'ajout/modification
var oBtn = document.querySelector("input[name=cmd]");





 oBtn.addEventListener("click", gererAuteurTexte);
/*
//var monAction = document.querySelector("input[name=action]");


var monAction = $("input[type='text'][name='action']").val();

console.log("monAction");
*/

/*

switch (monAction) {
        case 'ajouterAuteurTexte':
            oBtn.addEventListener("click", gererAuteurTexte);
            break;
        case 'ajouterTexte':
             oBtn.addEventListener("click", gererTexte);
            break;
        case 'ajouterAuteurMedia':
             oBtn.addEventListener("click", gererAuteurTexte);
            break;
        case 'ajouterMedia':
             oBtn.addEventListener("click", gererAuteurTexte);
            break;
    }//fin du switch()



*/

/*
    if(monAction == "texte" ){
        oBtn.addEventListener("click", gererTexte);
    }
    else{
        oBtn.addEventListener("click", gererMedia);
    }
    
*/

/**
 * gère l'ajout d'un auteur
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
        
        /**

	var iTexte =  aElts['idTexte'].value;
	var sTitre =  aElts['sTitreTexte'].value;
	var sExtrait =  aElts['sExtraitTexte'].value;
	var sTexte =  aElts['sTexte'].value;
	var sMotsClefs =  aElts['sMotsClefs'].value;
	var bAccepte =  aElts['bAccepte'].checked;
	var iNoAuteur =  aElts['iNoAuteur'].value;
	var sNomCategorie = aElts['sNomCategorie'].value;
        */
       
       var sNomAuteur = aElts['sNomAuteur'].value;
       var sPrenomAuteur = aElts['sPrenomAuteur'].value;
       var sCourrielAuteur = aElts['sCourrielAuteur'].value;
       
       
	var sCmd = aElts['cmd'].value;
	
	$.ajax({
		url:"../controleurs/ajax/gererFormulaire.php",
		method: "post",
		data: { s: iS, action: sAction, sNomAuteur:sNomAuteur, sPrenomAuteur:sPrenomAuteur, sCourrielAuteur:sCourrielAuteur,  cmd:sCmd}
	}).done(function(sMsg) {
		
  		document.getElementById("sMsg").innerHTML = sMsg;
  		if(sAction == "add"){
  		document.forms[0].elements['sNomAuteur'].value="";
                document.forms[0].elements['sPrenomAuteur'].value="";
	  	document.forms[0].elements['sCourrielAuteur'].value="";
  		}
  		
	});
	
}//fin de la fonction


/******************************************************************************************************************************************************************
 * gère l'ajout d'un auteur et d'un texte
 * par un appel asynchrone (AJAX)
 * @param void
 * @return void
 * 
 */

function gererAuteurTexte(){
	
       //récupérer les informations du formulaire
	var aElts = document.forms[0].elements;
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
  		if(sAction == "add"){
  		document.forms[0].elements['sTitreTexte'].value="";
	  		document.forms[0].elements['sExtraitTexte'].value="";
	  		document.forms[0].elements['sTexte'].value="";
	  		document.forms[0].elements['sMotsClefs'].value="";
	  		//document.forms[0].elements['bAccepte'].checked =false;
	  		//document.forms[0].elements['iNoAuteur'].value="1";
	  		document.forms[0].elements['sNomCategorie'].value="essai";
                        document.forms[0].elements['sNomAuteur'].value="";
                        document.forms[0].elements['sPrenomAuteur'].value="";
                        document.forms[0].elements['sCourrielAuteur'].value="";
  		}
  		
	});
	
}//fin de la fonction

/****************************************************************************************************************************************************************/

/**
 * gère l'ajout
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
	//var iTexte =  aElts['idTexte'].value;
	var sTitre =  aElts['sTitreTexte'].value;
	var sExtrait =  aElts['sExtraitTexte'].value;
	var sTexte =  aElts['sTexte'].value;
	var sMotsClefs =  aElts['sMotsClefs'].value;
	//var bAccepte =  aElts['bAccepte'].checked;
	//var iNoAuteur =  aElts['iNoAuteur'].value;
	var sNomCategorie = aElts['sNomCategorie'].value;
	var sCmd = aElts['cmd'].value;
	
	$.ajax({
		url:"../controleurs/ajax/gererAuteur.php",
		method: "post",
		data: { s: iS, action: sAction,sTitreTexte:sTitre, sExtraitTexte:sExtrait,  sTexte:sTexte, sMotsClefs: sMotsClefs, sNomCategorie:sNomCategorie, cmd:sCmd}
	}).done(function(sMsg) {
		
  		document.getElementById("sMsg").innerHTML = sMsg;
  		if(sAction == "add"){
  		document.forms[0].elements['sTitreTexte'].value="";
	  		document.forms[0].elements['sExtraitTexte'].value="";
	  		document.forms[0].elements['sTexte'].value="";
	  		document.forms[0].elements['sMotsClefs'].value="";
	  		//document.forms[0].elements['bAccepte'].checked =false;
	  		//document.forms[0].elements['iNoAuteur'].value="1";
	  		document.forms[0].elements['sNomCategorie'].value="1";
  		}
  		
	});
	
}//fin de la fonction



