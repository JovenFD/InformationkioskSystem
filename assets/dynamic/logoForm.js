function SystemLogo() {
    this.msgLogo = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchLeftLogo = async() => {
        const response = await fetch("../index.php?action=dynamicComponent&leftLogo", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let img    = document.querySelector('#leftlogoavatar');
            let leftId = document.querySelector('#idleftlogo');
            let fname = document.querySelector('#leftfname');
            
            if(message != true) {
                message.forEach(el => {
                    let filename = el.logo_img.slice(10, el.logo_img.length);

                    img.src = `.${el.logo_img}`;
                    leftId.value = el.logo_id;
                    fname.innerHTML = filename;
                });
            }
        } else {
            this.msgLogo(message, 'error'); 
        }
    }

    this.fetchRightLogo = async() => {
        const response = await fetch("../index.php?action=dynamicComponent&rightLogo", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            let img     = document.querySelector('#rightlogoavatar');
            let rightId = document.querySelector('#idrightlogo');
            let fname = document.querySelector('#rightfname');

            if(message != true) {
                message.forEach(el => {
                    let filename = el.logo_img.slice(10, el.logo_img.length);

                    img.src = `.${el.logo_img}`;
                    rightId.value = el.logo_id;
                    fname.innerHTML = filename;
                });
            }
        } else {
            this.msgLogo(message, 'error'); 
        }
    }

    this.addFormLogo = () => {

        leftlogocameras.onclick = (e) => {
            document.querySelector('#leftlogofileChooser').click();
        }
        
        leftlogofileChooser.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#leftlogoavatar').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        rightlogocameras.onclick = (e) => {
            document.querySelector('#rightlogofileChooser').click();
        }
        
        rightlogofileChooser.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#rightlogoavatar').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        logoForm.onsubmit = async (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do want to change system logo?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(add) => {
                if (add) {
                    let response = await fetch('../index.php?action=dynamicComponent', {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(logoForm)
                    });
                
                    let { message, status } = await response.json();
                    
                    if (status == 'success') {
                        this.fetchLeftLogo();
                        this.fetchRightLogo();
                        this.msgLogo(message, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);   
                    } else {
                        this.msgLogo(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };
    }

}
let logoformObj = new SystemLogo();
logoformObj.fetchLeftLogo();
logoformObj.fetchRightLogo();
logoformObj.addFormLogo();