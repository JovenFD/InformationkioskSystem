const logLogoObj = {
    Flogo: document.querySelector('#Flogo'),
    fetchLeftLogo: async() => {
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
                logLogoObj.Flogo.src = './assets/slideShowImg/defaultImg.jpg';
            }

        } else {
            console.log(message); 
        }
        return path;
    },

    showLeftLogo: () => {
        logLogoObj.fetchLeftLogo().then(item => {
            for(let i in item) {
               logLogoObj.Flogo.src = `${item[i].logo_img}`;
            }
        });
    }
}

logLogoObj.showLeftLogo();

