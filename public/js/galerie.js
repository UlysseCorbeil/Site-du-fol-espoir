var btnClose = document.querySelector("#modal-photo span");
var aLesImg = document.querySelectorAll(".gallerie-row>div");
var oImg = document.querySelector("#modal-photo img");
var oModalP = document.querySelector("#modal-photo p");
var iPos = 0;

for(var i=0; i<aLesImg.length; i++){
    aLesImg[i].addEventListener("click", ouvrirModal);
}

btnClose.addEventListener("click", function(){
    document.querySelector("#modal-photo").style.display = "none";
    document.getElementById("gallerie-container").style.webkitFilter = "blur(0px)";
});


function ouvrirModal(){
    url = this.style.backgroundImage.replace('url(','').replace(')','')
    oImg.setAttribute("src", url.replace(/"/g,""));
    oModalP.innerHTML = this.querySelector("p").innerText;

    document.querySelector("#modal-photo").style.display = "flex";
    document.getElementById("gallerie-container").style.webkitFilter = "blur(15px)";
}

function changerImg(iPos, sDirection){

    aLesImg[iPos].style.transitionDelay = iPos/4 + "s";

    if(sDirection == "haut"){
        // Animation vers le haut
        aLesImg[iPos].classList.toggle("fadeUp");

        // Changement d'images (2s)
        setTimeout(function(){
            aLesImg[iPos].style.backgroundImage = "url(https://picsum.photos/1000/600/?image="+ Math.floor(Math.random() * 400)   +")";
            aLesImg[iPos].classList.toggle("fadeOutDown");
        }, 2500);

    }

    else if(sDirection == "bas"){
        // Animation vers le haut
        aLesImg[iPos].classList.toggle("fadeDown");

        // Changement d'images (2s)
        setTimeout(function(){
            aLesImg[iPos].style.backgroundImage = "url(https://picsum.photos/1000/600/?image="+ Math.floor(Math.random() * 400)   +")";
            aLesImg[iPos].classList.toggle("fadeOutDown");
        }, 2500);
    }

}