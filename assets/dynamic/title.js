const titleObj = {
    title: document.querySelector('#titleHeader'),
    fetchTitle: async() => {
        let paragh = '';
        const response = await fetch("./index.php?action=dynamicComponent&title", {
            credentials: "same-origin",
            method: "GET",
        });
    
        let { message, status} = await response.json();
    
        if(status == 'success') {

            if(message != true) {
                message.forEach(el => {
                    paragh = el;
                });
            } else {
                paragh ='<h1>Title Not Available!<h1>';
            }

        } else {
            console.log(message); 
        }
        return paragh;
    },

    showTitle: () => {
        titleObj.fetchTitle().then(item => { 
            titleObj.title.innerHTML = item.title;
        });
    }
}

titleObj.showTitle();

