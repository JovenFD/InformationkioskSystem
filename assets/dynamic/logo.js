const logoObj = {
    Flogo: document.querySelector('#Flogo'),
    Slogo: document.querySelector('#Slogo'),
    fetchFLogo: async() => {
        let path = [];
        const response = await fetch("./index.php?action=dynamicComponent&leftLogo", {
            credentials: "same-origin",
            method: "GET",
        });
    
        let { message, status} = await response.json();
    
        if(status == 'success') {

            if(message != true) {
                message.forEach(el => {
                    path.push(el);
                });

            } else {
                logoObj.Flogo.src = '../assets/slideShowImg/defaultImg.jpg';
            }

        } else {
            console.log(message); 
        }
        return path;
    },

    fetchSLogo: async() => {
        let path = [];
        const response = await fetch("./index.php?action=dynamicComponent&rightLogo", {
            credentials: "same-origin",
            method: "GET",
        });
    
        let { message, status} = await response.json();
    
        if(status == 'success') {

            if(message != true) {
                message.forEach(el => {
                    path.push(el);
                });

            } else {
                logoObj.Slogo.src = '../assets/slideShowImg/defaultImg.jpg';

            }

        } else {
            console.log(message); 
        }
        return path;
    },

    showLeftLogo: () => {
        logoObj.fetchFLogo().then(item => {
            for(let i in item) {
               logoObj.Flogo.src = item[i].logo_img;
            }
        });
    },

    showRightLogo: () => {
        logoObj.fetchSLogo().then(item => {
            for(let i in item) {
               logoObj.Slogo.src = item[i].logo_img;
            }
        });
    }
}

logoObj.showLeftLogo();
logoObj.showRightLogo();


