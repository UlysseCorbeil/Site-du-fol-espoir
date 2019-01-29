
var sJson = "";

$.ajax({
    url:"../controleurs/ajax/gererAfficherMedias.php",
    data:{
        iPos:0
    },
    method:"get"
})
    .done(function(sHtml){
        console.log(JSON.parse(sHtml));
    });



/*$sHtml = "
    <div id='gallerie-container'>
    <div class='gallerie-btn'>
    <a href='?s=1&iPos=". ($indMedias - 8) ."'><i class='fas fa-angle-left'></i></a>
</div>

<div id='gallerie' class='flex-container' data-nbmedias='". count($aoMedias) ."'>";



for($i=0; $i<2; $i++){
    $sHtml .= "<div class='flex-container gallerie-row'>";
    for($j=0; $j<4; $j++){

        if($indMedias < count($aoMedias)){
            $sHtml .= "
                <div class='photo' style='background-image: url(". $aoMedias[$indMedias]->getsUrlMedia() .")'>
                <span>".($indMedias+1 < 10 ? "0" : "") . ($indMedias+1) ."</span>
            <div class='photo-info'>
                <p>". ucfirst($aoMedias[$indMedias]->getsTitreMedia()) ." &#8226; ". $aoMedias[$indMedias]->getoAuteur()->getsPrenomAuteur() ." ". $aoMedias[$indMedias]->getoAuteur()->getsNomAuteur() ."</p>
            </div>
            <div class='mask'></div>
                </div>";
            $indMedias++;
        }
        else{
            $sHtml .= "
                <div></div>";
        }
    }
    $sHtml .= "</div>";
}

$sHtml .= "
    </div>

    <div class='gallerie-btn'>
    <a href='?s=1&iPos=". $indMedias ."'><i class='fas fa-angle-right'></i></a>
</div>
</div>

<div id='modal-photo' class='flex-container'>
    <div class='flex-container'>
    <span><i class='fas fa-times'></i></span>
<img src='' alt=''>
    <p> &#8226; </p>
</div>
</div>
<script src='../../public/js/galerie.js'></script>
";*/