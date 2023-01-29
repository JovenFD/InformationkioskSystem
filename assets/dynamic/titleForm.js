function Title() {

    this.msgTitle = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchTitle = async() => {
        const response = await fetch("../index.php?action=dynamicComponent&title", {
            credentials: "same-origin",
            method: "GET",
        });
    
        let { message, status} = await response.json();
        let title = document.querySelector('#titleInput');
        let id = document.querySelector('#idTitle');
        if(status == 'success') {
            if(message != true) {
                message.forEach(el => {
                    id.value = el.title_id;
                    title.value = el.title;
                });
            } else {
                paragh ='<h1>System Title Not Available!<h1>';
            }
        } else {
            this.msgTitle(message, 'error'); 
        }
    }

    this.addFormTitle = () => {
        titleSystemForm.onsubmit = async (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do want to change system title?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(add) => {
                if (add) {
                    let response = await fetch('../index.php?action=dynamicComponent', {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(titleSystemForm)
                    });
                
                    let { message, status } = await response.json();
                    
                    if (status == 'success') {
                        this.fetchTitle();
                        this.msgTitle(message, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        this.msgTitle(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };
    }
}

let titleObj = new Title();
titleObj.fetchTitle();
titleObj.addFormTitle();