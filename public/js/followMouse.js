
 /*   $(document).ready(function() {
                
                var mouseX = 0, mouseY = 0, limitX = $(window).width();
                $(window).mousemove(function(e){
                   mouseX = Math.min(e.pageX, limitX);
                   mouseY = Math.min(e.pageY, $(document).height());
                });

                // cache the selector
                var follower = $("#follower");
                var xp = 0, yp = 0;
                var loop = setInterval(function(){
                    // change 12 to alter damping higher is slower
                    xp += (mouseX - xp)/2;
                    yp += (mouseY - yp)/2;
                    follower.css({left:xp-20, top:yp-20});

                }, 30);
        
                // cache le selecteur
                var follower2 = $("#follower2");
                var xp2 = 0, yp2 = 0;
                var loop = setInterval(function(){
                    // change 12 to alter damping higher is slower
                    xp2 += (mouseX - xp2);
                    yp2 += (mouseY - yp2);
                    follower2.css({left:xp2-10, top:yp2-10});

                }, 30);
        
    });*/