const tblLogoObj = {
    Ftbllogo: document.querySelector('#Ftbllogo'),
    Stbllogo: document.querySelector('#Stbllogo'),
    tbltitle: document.querySelector('#tabletitle'),
    tblregion: document.querySelector('#region'),
    tbldivision: document.querySelector('#division'),
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
                tblLogoObj.Ftbllogo.src = '../assets/slideShowImg/defaultImg.jpg';
            }

        } else {
            console.log(message); 
        }
        return path;
    },

    fetchRightLogo: async() => {
        let path = [];
        const response = await fetch("../index.php?action=dynamicComponent&rightLogo", {
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
                tblLogoObj.Stbllogo.src = '../assets/slideShowImg/defaultImg.jpg';
            }

        } else {
            console.log(message); 
        }
        return path;
    },

    fetchTableTitle: async() => {
        const response = await fetch("../index.php?action=dynamicComponent&tableTitle", {
            credentials: "same-origin",
            method: "GET",
        });
    
        let { message, status} = await response.json();
    
        if(status == 'success') {

            if(message != true) {

                message.forEach(el => {
                    tblLogoObj.tbltitle.innerHTML    = el.tabletitle;
                    tblLogoObj.tblregion.innerHTML   = el.region;
                    tblLogoObj.tbldivision.innerHTML = el.division;
                });

            } else {
                tblLogoObj.tbltitle.innerHTML    = 'Not Aialable!';
                tblLogoObj.tblregion.innerHTML   = 'Not Aialable!';
                tblLogoObj.tbldivision.innerHTML = 'Not Aialable!';
            }

        } else {
            console.log(message); 
        }
    },

    showLeftLogo: () => {
        tblLogoObj.fetchLeftLogo().then(item => {
            for(let i in item) {
               tblLogoObj.Ftbllogo.src = `.${item[i].logo_img}`;
            }
        });
    },

    showRightLogo: () => {
        tblLogoObj.fetchRightLogo().then(item => {
            for(let i in item) {
               tblLogoObj.Stbllogo.src = `.${item[i].logo_img}`;
            }
        });
    }
}

tblLogoObj.showLeftLogo();
tblLogoObj.showRightLogo();
tblLogoObj.fetchTableTitle();

