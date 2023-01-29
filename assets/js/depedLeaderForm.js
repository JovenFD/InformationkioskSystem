function DepedLeaders() {

    this.msgDepedLeaders = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchDepedLeaders= async() => {
        const response = await fetch("../index.php?action=dynamicComponent&viewDepedLeader", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.contentDepedLeaders(message);
        } else {
            this.msgDepedLeaders(message, 'error'); 
        }
    }

    this.modalValue = async(numPosition) => {
        let formData = new FormData();
        let modal = document.querySelector('#modal');
        formData.append('numPosition', numPosition);

        let response = await fetch(`../index.php?action=dynamicComponent`, {
          credentials: "same-origin",
          method: 'POST',
          body: formData
        });
        let { message, status} = await response.json();

        if(status == 'success') {
            document.querySelector('#avatarDepedLeaders').src = `.${message.avatar}`;
            document.querySelector('#avatarValDepedLeaders').value = message.avatar;
            document.querySelector('#userLeaderId').value = message.organization_id;
            document.querySelector('#fnameDepedLeaders').value = message.fname;
            document.querySelector('#mnameDepedLeaders').value = message.mname;
            document.querySelector('#lnameDepedLeaders').value = message.lname;
            document.querySelector('#numpos').value = message.role;
            
        } else {
            this.msgDepedLeaders(message, 'error'); 
        }
    }

    this.contentDepedLeaders = (data) => {
        if(data != true) {
            data.forEach(el => {
                switch (el.position) {
                    case "1":
                        document.querySelector('#imgPosition1').src = `.${el.avatar}`;
                        document.querySelector('#namePosition1').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition1').innerHTML = el.role;
                    break;
                    case "2":
                        document.querySelector('#imgPosition2').src = `.${el.avatar}`;
                        document.querySelector('#namePosition2').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition2').innerHTML = el.role;
                    break;
                    case "3":
                        document.querySelector('#imgPosition3').src = `.${el.avatar}`;
                        document.querySelector('#namePosition3').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition3').innerHTML = el.role;
                    break;
                    case "4":
                        document.querySelector('#imgPosition4').src = `.${el.avatar}`;
                        document.querySelector('#namePosition4').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition4').innerHTML = el.role;
                    break;
                    case "5":
                        document.querySelector('#imgPosition5').src = `.${el.avatar}`;
                        document.querySelector('#namePosition5').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition5').innerHTML = el.role;
                    break;
                    case "6":
                        document.querySelector('#imgPosition6').src = `.${el.avatar}`;
                        document.querySelector('#namePosition6').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition6').innerHTML = el.role;
                    break;
                    case "7":
                        document.querySelector('#imgPosition7').src = `.${el.avatar}`;
                        document.querySelector('#namePosition7').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition7').innerHTML = el.role;
                    break;
                    default:
                        document.querySelector('#imgPosition8').src = `.${el.avatar}`;
                        document.querySelector('#namePosition8').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition8').innerHTML = el.role;
                    break;
                }
            });
        }
    }

    this.addDepedLeaders = () => {

        cameraDepedLeaders.onclick = (e) => {
            document.querySelector('#fileChooserDepedLeaders').click();
        }
        
        fileChooserDepedLeaders.onchange = (e) => {
            if (e.target.files && e.target.files[0]) {
                document.querySelector('#avatarDepedLeaders').src = URL.createObjectURL(event.target.files[0]);
            }
        }

        leadersAddForm.onsubmit = async (e) => {
            e.preventDefault();
            let btnVal = document.querySelector("#leaders-btn");
            let resetForm = document.querySelector("#leadersAddForm");
            let closeModaL = document.querySelector("#depedLeadersModal");
        
            btnVal.value = "Please Wait...";
        
            let response = await fetch('../index.php?action=dynamicComponent', {
                credentials: "same-origin",
                method: 'POST',
                body: new FormData(leadersAddForm)
            });
        
            let { message, status } = await response.json();
            
            if (status == 'success') {
                setTimeout(() => {
                    btnVal.value = "Save";
                    this.fetchDepedLeaders();
                    this.msgDepedLeaders(message, 'success');
                    closeModaL.click();
                    resetForm.reset();
                }, 1000);
            } else {
                this.msgDepedLeaders(message, 'error');
                btnVal.value = "Field to Save";
            }
        };
    }
}

let depedObj = new DepedLeaders();
depedObj.fetchDepedLeaders();
depedObj.addDepedLeaders();