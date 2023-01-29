function Events() {

    this.msgEvents = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 1000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this. dateFormatEvents=(input) => {
        setTimeout(() => {
            input.type = 'text';
        }, 60000);
    }
    
    this.addEvents = () => {
        eventAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#events-btn");
            let resetForm = document.querySelector("#eventAddForm");
            let closeModaL = document.querySelector("#ModalAdd");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=dynamicComponent', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(eventAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                
                btnVal.value = "Save";
                this.msgEvents(message, 'success');
                closeModaL.click();
                resetForm.reset();
                
                setTimeout(() => { 
                   window.location.reload();
                }, 1000);
            } else {
                this.msgEvents(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }

    this.eventDrop = async(event) => {
        start = event.start.format('YYYY-MM-DD HH:mm:ss');
        if(event.end) {
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
        }else{
            end = start;
        }

        evenst_id = event.evenst_id;

        Event = [];
        Event[0] = evenst_id;
        Event[1] = start;
        Event[2] = end;

        let formData = new FormData();
        formData.append('eventsDrop', Event);

        let response = await fetch('../index.php?action=dynamicComponent', {
            credentials: "same-origin",
            method: 'POST',
            body: formData
        });
    
        let { message, status } = await response.json();
        
        if (status == 'success') {

            this.msgEvents(message, 'success');

        } else {
            this.msgEvents(message, 'error');
        }
    }

    this.updateEvents = () => {
        eventUpdateForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#updateevents-btn");
            let resetForm = document.querySelector("#eventUpdateForm");
            let closeModaL = document.querySelector("#ModalEdit");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=dynamicComponent', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(eventUpdateForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                
                btnVal.value = "Update";
                this.msgEvents(message, 'success');
                closeModaL.click();
                resetForm.reset();

                setTimeout(() => { 
                    window.location.reload();
                }, 1000);
            
            } else {
                this.msgEvents(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }  
}

let eventObj = new Events();
eventObj.addEvents();
eventObj.updateEvents();