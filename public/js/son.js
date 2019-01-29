//IIFE
(function () {
    function gererSon() {
        var idSon = this.getAttribute("data-idtexte");
        
        $.ajax({
            url: "../controleurs/ajax/gererAffichageSon.php",
            data:{
                idSon: idSon
            },
            method: "get"
        })
        .done(function (sHtml) {
            oJson = JSON.parse(sHtml);

            document.getElementById("Titre-Son").innerHTML = oJson['sTitreMedia'];
            document.getElementById("Auteur").innerHTML = oJson['sPrenomAuteur'] +" "+ oJson['sNomAuteur'];
            document.getElementById("sonPlay").src = oJson['sUrlMedia'];
        });
    }
})(); //IIFE

var timer;
var percent = 0;
var audio = document.getElementById('sonPlay');
var wave = document.getElementById('animWaveTop');
var wave1 = document.getElementById('animWaveMiddle');
var wave2 = document.getElementById('animWaveBottom');

audio.addEventListener('playing', function (_event) {
    var duration = _event.target.duration;
    advance(duration, audio);
});

audio.addEventListener('pause', function (_event) {
    clearTimeout(timer);
});

var advance = function (duration, element) {
    var progress = document.getElementById('progress');
    increment = 10 / duration;
    percent = Math.min(increment * element.currentTime * 10, 100);
    progress.style.width = percent + '%';
    startTimer(duration, element);
};

var startTimer = function (duration, element) {
    if (percent < 100) {
        timer = setTimeout(function () {
            advance(duration, element);
        }, 100);
    }
};

function togglePlay(e) {
    e = e || window.event;
    var btn = e.target;
    if (!audio.paused) {
        btn.classList.remove('active');
        audio.pause();
        isPlaying = false;
        wave.style.animationPlayState = "paused";
        wave1.style.animationPlayState = "paused";
        wave2.style.animationPlayState = "paused";
    } else {
        btn.classList.add('active');
        audio.play();
        isPlaying = true;
        wave.style.animationPlayState = "running";
        wave1.style.animationPlayState = "running";
        wave2.style.animationPlayState = "running";
    }
}