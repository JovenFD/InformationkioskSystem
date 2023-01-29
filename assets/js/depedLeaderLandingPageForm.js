function DepedLandingLeaders() {

    this.msgDepedLandingLeaders = (msg, type_icon) => {
        swal({
            title: msg,
            icon: type_icon,
            timer: 2000,
            buttons: {
                cancel: "Close",
            }
        });
    }

    this.fetchDepedLandingLeaders= async() => {
        const response = await fetch("./index.php?action=dynamicComponent&viewDepedLeader", {
            credentials: "same-origin",
            method: "GET",
        });

        let { message, status} = await response.json();

        if(status == 'success') {
            this.contentDepedLandingLeaders(message);
        } else {
            this.msgDepedLandingLeaders(message, 'error'); 
        }
    }

    this.contentDepedLandingLeaders = (data) => {
        if(data != true) {
            data.forEach(el => {
                switch (el.position) {
                    case "1":
                        document.querySelector('#imgPosition1').src = el.avatar;
                        document.querySelector('#namePosition1').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition1').innerHTML = el.role;
                    break;
                    case "2":
                        document.querySelector('#imgPosition2').src = el.avatar;
                        document.querySelector('#namePosition2').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition2').innerHTML = el.role;
                    break;
                    case "3":
                        document.querySelector('#imgPosition3').src = el.avatar;
                        document.querySelector('#namePosition3').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition3').innerHTML = el.role;
                    break;
                    case "4":
                        document.querySelector('#imgPosition4').src = el.avatar;
                        document.querySelector('#namePosition4').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition4').innerHTML = el.role;
                    break;
                    case "5":
                        document.querySelector('#imgPosition5').src = el.avatar;
                        document.querySelector('#namePosition5').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition5').innerHTML = el.role;
                    break;
                    case "6":
                        document.querySelector('#imgPosition6').src = el.avatar;
                        document.querySelector('#namePosition6').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition6').innerHTML = el.role;
                    break;
                    case "7":
                        document.querySelector('#imgPosition7').src = el.avatar;
                        document.querySelector('#namePosition7').innerHTML = 
                        `${el.fname} 
                         ${el.mname.charAt(0).toUpperCase()}, 
                         ${el.lname}`;
                        document.querySelector('#rolePosition7').innerHTML = el.role;
                    break;
                    default:
                        document.querySelector('#imgPosition8').src = el.avatar;
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

}

let depedObj = new DepedLandingLeaders();
depedObj.fetchDepedLandingLeaders();