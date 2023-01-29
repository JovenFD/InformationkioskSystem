function tableTitle() {

    this.msgTableTitle = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchTableTitle = async() => {
        const response = await fetch("../index.php?action=dynamicComponent&tableTitle", {
            credentials: "same-origin",
            method: "GET",
        });
    
        let { message, status} = await response.json();
        let title_id  = document.querySelector('#idTableTitle');
        let tbltitle    = document.querySelector('#tableTitle');
        let tblregion   = document.querySelector('#region');
        let tbldivision = document.querySelector('#division');
    
        if(status == 'success') {

            if(message != true) {

                message.forEach(el => {
                    title_id.value        = el.title_id ;
                    tbltitle.innerHTML    = el.tabletitle;
                    tblregion.innerHTML   = el.region;
                    tbldivision.innerHTML = el.division;
                });

            } else {
                tbltitle.innerHTML    = 'Not Aialable!';
                tblregion.innerHTML   = 'Not Aialable!';
                tbldivision.innerHTML = 'Not Aialable!';
            }

        } else {
            this.msgTableTitle(message, 'error');
        }
    }

    this.addFormTableTitle = () => {
        titleTableForm.onsubmit = async (e) => {
            e.preventDefault();

            swal({
                title: "Are you sure do want to change system table title header?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(add) => {
                if (add) {
                    let response = await fetch('../index.php?action=dynamicComponent', {
                        credentials: "same-origin",
                        method: 'POST',
                        body: new FormData(titleTableForm)
                    });
                
                    let { message, status } = await response.json();
                    
                    if (status == 'success') {
                        this.fetchTableTitle();
                        this.msgTableTitle(message, 'success');
                        
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        this.msgTableTitle(message, 'error');
                    }
                } else {
                    swal("Cancel Changes!");
                }
            });
        };
    }
}

let tbltitleObj = new tableTitle();
tbltitleObj.fetchTableTitle();
tbltitleObj.addFormTableTitle();