(function () {
    var xmlns = "http://www.w3.org/2000/svg",
        xlinkns = "http://www.w3.org/1999/xlink",
        select = function (s) {
            return document.querySelector(s);
        },
        selectAll = function (s) {
            return document.querySelectorAll(s);
        },
        ball = select('.ball'),
        container = select('.container'),
        offset = 0.03,
        oscillation = 28,
        colorArr = ['#FFF', '#FFF'],
        delta = 6,
        radius = 110,
        num = 130

    /* CustomEase.create("mugReturnBack", "M0,0 C0.786,0.332 0.782,0.92 0.918,1.028 0.974,1.072 1,1 1,1"); */

    /* CustomEase.create('wobble', 'M0,0 C0.266,0.412 -0.05,1.344 0.5,1 0.958,1.264 0.78,0 1,0');
     */

    for (var i = 0; i < num; i++) {

        var point = {
            x: (Math.cos((delta * i) * Math.PI / 180) * radius) + 400,
            y: (Math.sin((delta * i) * Math.PI / 180) * radius) + 300
        }
        var ballClone = ball.cloneNode(true);

        container.appendChild(ballClone);
        TweenMax.set(ballClone, {
            x: point.x,
            y: point.y,
            fill: (colorArr[i]) ? colorArr[i] : '#FFC857'
        })
        /*  else {
          wholeText2.appendChild(ballClone);
          TweenMax.set(ballClone, {
            x:(i+1)*10,
            y:200
          })   
        } */


    }

    var allBalls1 = selectAll('.container circle');
    //var allBalls2 = selectAll('.wholeText2 path');

    CustomWiggle.create("wiggle1", {
        type: "random",
        wiggles: 110
    })
    TweenMax.set('svg', {
        visibility: 'visible'
    })

    TweenMax.set([allBalls1], {
        transformOrigin: '80% -150%'
    })

    var mainTl = new TimelineMax({}).timeScale(1);
    var tl1 = new TimelineMax({}).timeScale(1);
    tl1.staggerTo(allBalls1, 1, {

        x: '+=' + oscillation,
        y: '+=' + -oscillation,
        scale: 0.9,
        repeat: -1,
        cycle: {
            ease: function (i) {
                return CustomWiggle.create("", {
                    type: "uniform",
                    timingEase: Power1.easeOut, //affects how things are mapped along the x-axis (time).
                    amplitudeEase: Sine.easeInOut, //affects the shape of the amplitude curve
                    wiggles: 3
                })
            },
            rotation: function (i) {
                //return (i+1) * 12
            }
        }
        // ease: 'wiggle1'

    }, offset)

    TweenMax.to(container, 7.5, {
        rotation: -360,
        repeat: -1,
        transformOrigin: '50% 50%',
        ease: Linear.easeNone
    })

    mainTl.add(tl1).seek(1000);

})();