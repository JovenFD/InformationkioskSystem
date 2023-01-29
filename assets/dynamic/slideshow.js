'use strict';

const Obj = {
    count: 0,
    timer: null,
    countImg: 1,
    img:document.querySelector("#imgSlideshow"),
    fetchImg: async() => {
        let path = [];
        const response = await fetch("./index.php?action=dynamicComponent&slideshow", {
            credentials: "same-origin",
            method: "GET",
        });
    
        let { message, status} = await response.json();
    
        if(status == 'success') {

            if(message != true) {
                message.forEach(el => {
                    path.push(el.slidehow_img);
                });

            } else {
                clearInterval(Obj.timer);
                Obj.timer = null;
                Obj.playPause.style.display = "none";
                Obj.prevBtn.style.display = "none";
                Obj.nextBtn.style.display = "none";
                Obj.img.src = './assets/slideShowImg/defaultImg.JPG';
            }

        } else {
            console.log(message); 
        }
        return path;
    },

    slide: () => {
        Obj.fetchImg().then(item => { 
            Obj.count = (Obj.count + 1) % item.length;

            Obj.img.style.transition = "opacity 0.9s linear 0s";
            Obj.img.style.opacity = 0.5;
            setTimeout(() => {  
                Obj.img.style.transition = "opacity 0.9s linear 0s";
                Obj.img.style.opacity = 2;

                Obj.img.src = item[Obj.count];
            }, 800);            
        }); 
    },

    setTimer: () => {
        if (Obj.timer) {
            clearInterval(Obj.timer);
            Obj.timer = null;
        } else {
            Obj.timer = setInterval(Obj.slide, 4000);
        }
    }
}

Obj.setTimer();
