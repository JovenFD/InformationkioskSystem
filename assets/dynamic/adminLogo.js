const logoObj = {
    Flogo: document.querySelector('#Flogo'),
    fetchLeftLogo: async() => {
        let path = [];
        const response = await fetch("../index.php?action=dynamicComponent&leftLogo", {
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

    showLeftLogo: () => {
        logoObj.fetchLeftLogo().then(item => {
            console.log(); 
            for(let i in item) {
               logoObj.Flogo.src = `.${item[i].logo_img}`;
            }
        });
    }
}

logoObj.showLeftLogo();

