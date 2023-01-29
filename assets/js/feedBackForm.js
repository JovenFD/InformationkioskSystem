function FeedBackForm() {

    this.msgFeedBackForm = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.countNewMessage = async() => {
        const response = await fetch("../index.php?action=feedback&countNewMsg", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();
        let msgContainer = document.querySelector('#countNewMsg');

        if(status == 'success') {
            
            msgContainer.innerHTML = message;

        } else {
            this.msgFeedBackForm(message, 'error'); 
        }
    }

    this.fetchAllNewMsg = async() => {
        const response = await fetch("../index.php?action=feedback&viewNewMsg", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();
        let msgContainer = document.querySelector('#feedBackData');
        let output = ``;

        if(status == 'success') {
            
            if(message != true) {
                message.forEach(el => {
                    
                let year = moment(el.created_date).toObject().years;
                let month = moment(el.created_date).toObject().months;
                let day = moment(el.created_date).toObject().date;

                let date=`${year}/${month}/${day}`;

                    output +=`
                        <li class="nav-item hover:bg-blue-100">
                            <a onclick="feedbackObj.updateOldMsg('${el.feedback_id}')" class="dropdown-item">
                            <span>
                                <strong class="text-lg">${el.fullname}</strong>
                                <span class="time text-lg">Create on: ${date}</span>
                            </span>
                            <span class="message">${this.trancateStr(el.feedback)}</span>
                            </a>
                        </li> 
                    `;
                });

                msgContainer.innerHTML = output
            } else {
                msgContainer.innerHTML = `  
                <li class="nav-item animate-bounce">
                    <div class="text-center">
                        <strong>Empty New Message</strong>
                    </div>
                </li>`;
            }

        } else {
            this.msgFeedBackForm(message, 'error'); 
        }
    }

    this.trancateStr = (data) => {
        let length = data.length;

        if(length > 100) {
            let str    = data;
            length     = length / 6;
            data = str.slice(0, length)+'...'
        }

        return data;
    }

    this.updateOldMsg = async(id) => {
        let formData = new FormData();

        formData.append('updateToOldMsg', id);

        let response = await fetch(`../index.php?action=feedback`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });
        let { message, levelYear, status} = await response.json();

        if(status == 'success') {
            this.fetchAllNewMsg();
            this.countNewMessage();
            this.fetchAllOldMessages();
            $('#previewMsgModal').modal('show');
            $("#name").html(message.fullname);
            $("#yearLevel").html(`${levelYear.grade_level} - ${levelYear.discription}`);
            let date = new Date(message.create_date).toDateString();
            let time = new Date(message.create_date).toLocaleTimeString();

            $("#date").html(`${date} - ${time}`);
            $("#msg").html(message.feedback);
        } else {
            this.msgFeedBackForm(message, 'error'); 
        }
    }

    this.ShowAllMessage = () => {
        ShowAllMsg.onclick = async(e) => {
            $('#allMsgModal').modal('show');
        }
    }

    this.fetchAllOldMessages = async() => {
        const response = await fetch("../index.php?action=feedback&viewOldMsg", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.tableBodyAllMessage(message);
        } else {
            this.msgFeedBackForm(message, 'error'); 
        }
    }

    this.searchMessage = () => {
        searchAllMessages.oninput = async(e) => {
            let count = e.currentTarget.value.length;
            let data  = e.currentTarget.value;
            
            if(count > 0) {
                let formData = new FormData();
                formData.append('data', data);
    
                let response = await fetch(`../index.php?action=feedback`, {
                  credentials: "same-origin",
                  method: 'POST',
                  body: formData
                });
                let { message, status} = await response.json();

                if(status == 'success') {
                    this.tableBodyAllMessage(message);
                } else {
                    this.msgFeedBackForm(message, 'error'); 
                }
            } else {
                this.fetchAllOldMessages();
            }
        };
    }

    this.tableBodyAllMessage = (data) => {
        let output = ``;
        let inc = 1;
        let msgContainer = document.querySelector('#msgList');

        if(data != true) {

            data.forEach(el => {
                let date = new Date(el.create_date).toDateString();
                let time = new Date(el.create_date).toLocaleTimeString();

                output += `   
                    <div class="row mb-3">
                        <div class="col border-2 border-gray-500 rounded-lg p-3">
                        <h2>Name: <b>${el.fullname}</b></h2>
                        <h2>Grade & Section: <b>${el.grade_level} - ${el.discription}</b></h2>
                        <h2>Create On: <b class="text-red-700">${date}</b> - <b class="text-blue-500">${time}</b></h2>
                        <hr>
                        <p class="mt-2">${el.feedback}</p>
                        </div>
                    </div>
                `;
            });

            msgContainer.innerHTML = output;
            
        } else {
            msgContainer.innerHTML = `
                <div row class="animate-bounce text-center">
                    <div class="col">
                        <h1 class="text-3xl">Empty Message</h1>
                        <hr>
                    </div>
                <div>
            `;
        }
    }
}

let feedbackObj = new FeedBackForm();
feedbackObj.countNewMessage();
feedbackObj.fetchAllNewMsg();
feedbackObj.ShowAllMessage()
feedbackObj.fetchAllOldMessages();
feedbackObj.searchMessage();