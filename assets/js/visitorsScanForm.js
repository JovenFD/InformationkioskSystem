function VisitorsScanForm() {

    this.msgVisitors = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.visitorsDateFormat = (input) => {
        setTimeout(() => {
            input.type = 'text';
        }, 60000);
    }

    this.visitorsScanForm = () => {
        addLogVisitors.onsubmit = async (e) => {
            e.preventDefault();

            let btnVal = document.querySelector("#visitors-btn");
            let resetForm = document.querySelector("#addLogVisitors");
            let closeModaL = document.querySelector("#visitorsModal");

            swal({
                title: "Do you want to accept this visitor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then( async(remove) => {
                if (remove) {                
                    btnVal.value = "Please Wait...";
                
                    let response = await fetch(`./index.php?action=visitors`, {
                        method: 'POST',
                        body: new FormData(addLogVisitors)
                    });
                
                    let { message, status } = await response.json();
                
                    if (status == 'success') {
                        closeModaL.click();
                        resetForm.reset();
                        this.msgVisitors(message, 'success');
                    } else {
                        this.msgVisitors(message, 'error');
                        btnVal.value = "Field To Save";
                    }

                } else {
                    swal("Cancel Changes!");
                    closeModaL.click();
                    resetForm.reset();
                }
            });
        };
    }
}

let visitorObj = new VisitorsScanForm();
visitorObj.visitorsScanForm();
